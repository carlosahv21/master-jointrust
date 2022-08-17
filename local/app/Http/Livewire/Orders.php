<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;
use Livewire\WithPagination;
use App\Models\Product;
use App\Mail\OrdersMail;
use Illuminate\Support\Facades\Mail;
use Cart;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Orders extends Component
{
    use WithPagination;
    public $search = '';
    public $comment, $radioButtom, $date_order, $gift_check, $gift, $delivery_address;

    protected $listeners = [
        'refreshParent' => '$refresh',
        'resetGitf' => 'resetGitf'
    ];

 
    public function resetGitf()
    {
        $this->gift = null;
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
        Cart::instance('cart')->add($id, $name, 1, $price, ['reference' => $reference])->associate('App\Model\Product');
        $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Producto agregado a tu pedido!']);
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
        Cart::instance('cart')->update($rowId,$qty);
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
        $lastOrder = Order::latest()->first();
        $this->sendEmail( $lastOrder );
        
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

    public function acceptPopup(){
        $this->date_order = null;
        $this->dispatchBrowserEvent('closeModal', ['name' => 'differentDate']);
        $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Tu pedido fue creado existosamente!']);
    }

    static public function getReference() {
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

    public function sendEmail( $lastOrder )
    {

        $mailData = [
            'cart' => Cart::instance('cart'),
            'model' => $lastOrder
        ];

        Mail::to( auth()->user()->email )->send( new OrdersMail($mailData) );
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
