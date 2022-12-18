<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderDomiciliary;
use App\Models\Product;
use App\Models\Address;
use App\Models\Shipping;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class ListDomiciliary extends Component
{

    use WithPagination;
    public $item, $action, $search, $selectedOrder, $idDomiciliary = null, $selectedUser = null;
       

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'refreshParent' => '$refresh'
    ];

    public function selectItem($item, $action)
    {
        $this->item = $item;
        
        if($action == 'delete'){
            $this->dispatchBrowserEvent('openModal', ['name' => 'deleteDomiciliary']);
        }elseif($action == 'sendRoute'){
            $this->dispatchBrowserEvent('openModal', ['name' => 'sendRoute']);
        }
    }

    public function delete()
    {
        $order = OrderDomiciliary::findOrFail($this->item);
        $order->delete();

        $this->dispatchBrowserEvent('closeModal', ['name' => 'deleteDomiciliary']);
        $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Domicilio eliminado!']);


    }

    public function sendRouteWhatsapp($id)
    {
        $data = $this->formatData($id);

        if($data['order_data']){
            $sum_boxes = 0;
            foreach ($data['order_data'] as $user_name => $data_) {
                $sum_boxes= $sum_boxes + $data_['boxes'];
            }

            $text = "https://web.whatsapp.com/send/?phone=+57".$data['domiciliary']['phone']."&text=Hola *".$data['domiciliary']['name']."*, esta es la ruta asignada con un total de ".$sum_boxes." cajas,  Repartidas de la siguiente forma:  %0D%0A%0D%0A";

            foreach ($data['order_data'] as $user_name => $data_) {
                $text.= $user_name."(".$data_['address']."): "."%0D%0A%0D%0A";

                for ($i=0; $i < count($data_['products']); $i++) { 
                    $text.= $data_['products'][$i]['qty']." ".$data_['products'][$i]['name']." ".$data_['products'][$i]['reference']."%0D%0A";
                }

                $text.="Domicilio "."$".$data_['shipping']."%0D%0A";
                $text.="Total a Pagar:  "."$".$data_['total']."%0D%0A";
                $text.="NOTA "."%0D%0A";
                $text.="*".$data_['note']."* %0D%0A";
                $text.="------------------------------------------------------"."%0D%0A";
            }
            
            return str_replace("#","%23",$text);
        }else{
            return false;
        }
        
    }

    public function formatData($id)
    {
        $domiciliary = User::find($id);
        $data_domiciliary = [
            'name' => $domiciliary->first_name ." ".$domiciliary->last_name,
            'phone' => $domiciliary->phone
        ];
        
        $orderDomiciliary = OrderDomiciliary::where('user_id', '=' ,$id)->get();

        $data = [];
        foreach (collect($orderDomiciliary)->toArray() as $key => $value) {
            $order = Order::find($value['order_id']);

            if($order->date_order == date('Y-m-d')){
                $order_product = DB::table('order_product')
                ->join('orders', 'order_product.order_id', '=', 'orders.id')
                ->select('order_product.*')
                ->where('orders.id', '=', $order->id)
                ->get();

                $aux_sum = 0;
                for ($i=0; $i < count($order_product); $i++) { 
                    $user     = User::find($order->user_id);
                    $product  = Product::find($order_product[$i]->product_id);
                    $address  = Address::find($order->delivery_address);
                    $shipping = Shipping::find($address->shipping_id);

                    $data[$user->first_name." ".$user->last_name]['address']  = $address->address;
                    $data[$user->first_name." ".$user->last_name]['shipping'] = number_format( $shipping->value ,'0',',','.') ;
                    $data[$user->first_name." ".$user->last_name]['total']    = number_format( $order->total ,'0',',','.') ;
                    $data[$user->first_name." ".$user->last_name]['note']     = $order->commentaries ;
                    
                    $aux_sum = $aux_sum + $order_product[$i]->qty;
                    $data[$user->first_name." ".$user->last_name]['boxes']    = $aux_sum;

                    $data[$user->first_name." ".$user->last_name]['products'][] = [
                        'name' => $product->name,
                        'reference' => $product->reference,
                        'qty' => $order_product[$i]->qty
                    ];

                    if(array_key_exists($product->reference, $data[$user->first_name." ".$user->last_name])) {
                        $aux = $data[$user->first_name." ".$user->last_name][$product->reference] + $order_product[$i]->qty;
                        $data[$user->first_name." ".$user->last_name][$product->reference] = $aux;
                    }else{
                        $data[$user->first_name." ".$user->last_name][$product->reference] = $order_product[$i]->qty;
                    }
                }
            }
        }

        return ['domiciliary' => $data_domiciliary, 'order_data' => $data];
    }

    function searchForId($id, $array) {
        foreach ($array as $key => $val) {
            if ($val['uid'] === $id) {
                return $key;
            }
        }
        return null;
     }


    public function render()
    {
         
        $input = $this->search;

        return view('livewire.list-domiciliary', [
    		'orders_domiciliaries'		=>	 

                OrderDomiciliary::with('orders')
                ->where('created_at', 'like', '%' . $input . '%')
                ->orWhere(function ($query) use ($input) {
                    $query->whereHas('orders', function ($q) use ($input) {
                        $q->where('code', 'like', '%' . $input . '%');
                    });
                })
                ->orWhere(function ($query) use ($input) {
                    $query->with('user')->whereHas('user', function ($q) use ($input) {
                        $q->where('first_name', 'like', '%' . $input . '%');
                    });
                })
                ->paginate(10),
                'users' => User::where('role', 'domiciliary')->get()
    	]);
    }
}
