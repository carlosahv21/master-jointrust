<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\Address;

use Livewire\WithPagination;

use Cart;
use Carbon\Carbon;

use App\Notifications\NotificarPedido;

use Illuminate\Support\Facades\DB;

class Orders extends Component
{
    use WithPagination;
    public $search = '';
    public $comment, $radioButtom, $date_order, $gift_check, $gift, $delivery_address, $valueGif, $showAddress, $valueShipping;

    public $addresses = [];

    protected $listeners = [
        'refreshParent' => '$refresh',
        'resetGitf' => 'resetGitf'
    ];

 
    public function resetGitf()
    {
        $this->gift = null;
        $this->valueGif = null;
    }

    public function rules() {
        return [
            'radioButtom' => 'required',
            'delivery_address' =>  'required',
        ];
    }

    protected $messages = [
        'radioButtom.required' => 'Seleccione al menos una entrega.',
        'delivery_address.required' => 'La Dirección de entrega es requerida.'
    ];

    public function addProduct($id, $name, $price, $reference)
    {       
        if(Cart::instance('cart')->count() > 0){ 
            $rowId = Cart::instance('cart')->getName($name);
            if($rowId){
                $product = Cart::instance('cart')->get($rowId);
                $qty = $product->qty + 1;

                $validate = Product::find($product->id);

                if ($qty > $validate->stock) {
                    $this->dispatchBrowserEvent('openModal', ['name' => 'validateStock']);    
                }else{
                    Cart::instance('cart')->update($rowId,$qty);
                } 
            }else{
                Cart::instance('cart')->add($id, $name, 1, $price, ['reference' => $reference])->associate('App\Model\Product');
            }           
        }else{
            Cart::instance('cart')->add($id, $name, 1, $price, ['reference' => $reference])->associate('App\Model\Product');
            $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Producto agregado a tu pedido!']);
        }
    }

    public function removeProduct($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        $this->dispatchBrowserEvent('notify', ['type' => 'danger', 'message' => 'Producto eliminado de tu pedido!']);
    }

    public function increaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;

        foreach(Cart::instance('cart')->content() as $items ){

            $validate = Product::find($items->id);

            if ($product->name == $validate->name) {
                if ($qty > $validate->stock) {
                    $this->dispatchBrowserEvent('openModal', ['name' => 'validateStock']);    
                }else{
                    Cart::instance('cart')->update($rowId,$qty);
                } 
            }
        }
    }

    public function decreaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowId,$qty);

        if($qty == 0){
            $this->dispatchBrowserEvent('notify', ['type' => 'danger', 'message' => 'Producto eliminado de tu pedido!']);
        }
    }

    public function mount()
    {
        Cart::instance('cart')->destroy();
    }

    public function cancel(){
        
        $this->dispatchBrowserEvent('closeModal', ['name' => 'resumeOrder']);

        $this->dispatchBrowserEvent('openModal', ['name' => 'cancelOrder']);
    }

    public function accept(){
        $this->dispatchBrowserEvent('closeModal', ['name' => 'cancelOrder']);
        return redirect()->route('dashboard');
    }

    public function resume(){
        if(Cart::instance('cart')->count() > 0){
            if (empty($this->date_order)) {
                return $this->dispatchBrowserEvent('showMessagge');
            }

            $this->validate();
            $this->dispatchBrowserEvent('openModal', ['name' => 'resumeOrder']);
        }else{
            $this->dispatchBrowserEvent('notify', ['type' => 'danger', 'message' => 'Al menos debes agregar un producto a tu pedido!']);
        }
    }

    public function save(){

        $mytime = Carbon::now();
        $current_date =$mytime->toDateString();
        
        $order = new Order;
        $order->code = $this->getReference();
        $order->subtotal = Cart::instance('cart')->subtotal();
        $order->tax = 0;
        $order->gift_sets = $this->gift;
        $order->total = Cart::instance('cart')->total();
        $order->partial_delivery = $this->radioButtom;
        $order->delivery_address = $this->delivery_address;
        $order->date_order = $this->date_order;
        $order->state = 'Pendiente';
        $order->commentaries = '';
        $order->user_id = auth()->user()->id;

        $order->save();
        User::where('role', '=', 'admin')
              ->each(function(User $user) use ($order) {
                    $user->notify(new NotificarPedido($order));
        });

        foreach(Cart::instance('cart')->content() as $items ){
            $order->products()->attach($items->id, ['qty' => $items->qty]);
        }

        Cart::instance('cart')->destroy();
        $this->dispatchBrowserEvent('closeModal', ['name' => 'resumeOrder']);

        if($this->date_order !== $current_date){            
            $this->dispatchBrowserEvent('openModal', ['name' => 'differentDate']);    
        }else{
            $this->date_order = null;
            $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Tu pedido fue creado existosamente!']);
        }


        $this->clearForm();
        $this->dispatchBrowserEvent('goListOrder');
    }

    private function clearForm()
    {
        $this->comment = null;
        $this->radioButtom = null;
        $this->date_order = null;
        $this->gift_check = null;
        $this->gift = null;
        $this->delivery_address = null;
    }

    public function show($id, $notification_id = false)
    {
        auth()->user()->unreadNotifications
                ->when($notification_id, function($query) use ($notification_id){
                    return $query->where('id', $notification_id);
                })->markAsRead();

        $id = decrypt($id);

        return view('livewire.show-order',$this->formatData($id));
    }

    public function confirmation($id){
        $data = $this->formatData($id);

        $text = "https://api.whatsapp.com/send/?phone=+57".$data['user']['phone']."&text=Sr.(a) *".$data['user']['first_name']." ".$data['user']['last_name']."*, cordial saludo.%0D%0ASu pedido queda programado durante la tarde de hoy entre 3 y 9 p.m, a la siguiente direcci%C3%B3n *(".$data['order']['delivery_address'].")*: %0D%0A%0D%0A";

        foreach ($data['order_data'] as $key => $value) {
            $text.= $value->qty." ".strtoupper($value->name)." ".$value->reference." - $".$value->qty*$value->price."%0D%0A";
        }

        $text.= "Domicilio - $4000 %0D%0A%0D%0A*Total a pagar: $38500 - CONFIRMAR LA FORMA DE PAGO.*%0D%0A%0D%0A_*POR FAVOR VERIFICAR LA INFORMACI%C3%93N. EN CASO QUE LA DIRECCI%C3%93N NO CORRESPONDA Y NO INFORME DICHO CAMBIO EN LOS SIGUIENTES 20 MINUTOS DE LLEGADO ESTE MENSAJE%2C EL DOMICILIO SER%C3%81 COBRADO ADICIONAL.*_ ¡Feliz día!";
        
        return str_replace("#","%23",$text);
    }

    public function formatData($id)
    {
        $order = Order::find($id);
        $order_data = DB::table('products')
            ->join('order_product', 'products.id', '=', 'order_product.product_id')
            ->join('orders', 'order_product.order_id', '=', 'orders.id')
            ->select('products.*', 'order_product.*')
            ->where('orders.id', '=', $id)
            ->get();
        
        $user = User::find($order['user_id']);

        $order = collect($order)->toArray();
        $order_data = collect($order_data)->toArray();
        $user = collect($user)->toArray();

        return ['order' => $order, 'order_data' => $order_data, 'user' => $user];
    }

    public function acceptPopup(){
        $this->date_order = null;
        $this->dispatchBrowserEvent('closeModal', ['name' => 'differentDate']);
        $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Tu pedido fue creado existosamente!']);
    }

    static public function getReference() 
    {
		// La nomenclatura sera join_order_0001

        $code_order = Order::select('id')->latest('id')->first();

        if ($code_order || $code_order > 0) {
            $num_code = $code_order->id+1;
        }else{
            $num_code = 1;
        }

        $code = 'ORDER';
        

		$countNumber = strlen($num_code);

		switch ($countNumber) {
			case '1':
				$newSeq = '000'.$num_code;
				break;
			case '2':
				$newSeq = '00'.$num_code;
				break;
			case '3':
				$newSeq = '0'.$num_code;
				break;
            case '3':
                $newSeq = $num_code;
                break;
			default:
				$newSeq = $num_code;
				break;
		}

		return $code."_".$newSeq;
	}

    public function showShipping()
    {
        $this->addresses = Address::where('user_id', '=', auth()->user()->id)
            ->get();
    }

    public function selectShipping()
    {
        $data = DB::table('addresses')
            ->leftjoin('shippings', 'addresses.shipping_id', '=', 'shippings.id')
            ->select('addresses.*', 'shippings.*')
            ->where('addresses.id', '=', $this->delivery_address)
            ->get();

        $_data = $data[0];

        if(empty($_data->shipping_id)){
            $this->dispatchBrowserEvent('openModal', ['name' => 'alertShipping']);
        }
        $this->showAddress = $_data->address;
        $this->valueShipping = $_data->value;
    }

    public function changeGift($value){
        $this->valueGif = $value;
    }

    public function render()
    {
        return view('livewire.orders',
            [
                'products'  => Product::search('name', $this->search)->paginate(6),
                'gift_sets' => DB::table('gift_sets')->get()
            ]
        );   
    }
}
