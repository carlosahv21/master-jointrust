<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\User;
use App\Models\OrderDomiciliary;

class ListOrders extends Component
{
    use WithPagination;
    public $item, $action, $search, $countOrders, $idDomiciliary, $commentaries = '';
    public $statusFilter = 'Pendiente';
    public $perPage = '5';
    public $orderBy = 'date_order';
    public $sortBy = 'asc';

    public $selected = [];
    public $orders_products = [];
    

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'refreshParent' => '$refresh'
    ];

    public function selectItem($item, $action)
    {
        $this->item = $item;
        
        if($action == 'delete'){
            $this->dispatchBrowserEvent('openModal', ['name' => 'deleteOrder']);
        }else if($action == 'masiveDelete'){
            $this->dispatchBrowserEvent('openModal', ['name' => 'deleteOrderMasive']);
            $this->countOrders = count($this->selected);
        }else if($action == 'assignDomiciliary'){
            $this->dispatchBrowserEvent('openModal', ['name' => 'assignDomiciliary']);            
        }else if($action == 'comments'){
            $order = Order::findOrFail($this->item);
            if ($order->commentaries) {
                $this->dispatchBrowserEvent('notify', ['type' => 'danger', 'message' => 'El pedido ya tiene un comentario!']);            
            }else{
                $this->dispatchBrowserEvent('openModal', ['name' => 'costumersCommentaries']);            
            }
        }else{
            $this->dispatchBrowserEvent('openModal', ['name' => 'createOrder']);
            $this->emit('getModelId', $this->item);
        }
    }

    public function massiveDelete()
    {
        $orders = Order::whereKey($this->selected);
        $orders->delete();
        $this->selected = null;

        $this->dispatchBrowserEvent('closeModal', ['name' => 'deleteOrderMasive']);

    }

    public function delete()
    {
        $order = Order::findOrFail($this->item);

        $order->products()->delete();
        $order->delete();

        $this->dispatchBrowserEvent('closeModal', ['name' => 'deleteOrder']);
        $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Pedido eliminado!']);

    }

    public function saveDomiciliary(){

        $order = Order::findOrFail($this->item);

        if(OrderDomiciliary::where('order_id', $this->item)->count() > 0){
             $this->dispatchBrowserEvent('notify', ['type' => 'danger', 'message' => 'Este Pedido ya se encuentra asignado a un domiciliario!']);
        }else{
            $domiciliary = new OrderDomiciliary();
            $domiciliary->order_id = $order->id;
            $domiciliary->user_id = $this->idDomiciliary;
            $domiciliary->save();            
           
            $this->dispatchBrowserEvent('closeModal', ['name' => 'assignDomiciliary']);
            $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Pedido asignado a un domiciliario!']);          
        }        
    }

    public function saveCommentaries(){

        $order = Order::findOrFail($this->item);
        $order->commentaries = $this->commentaries;
        $order->save();     
        
        $this->commentaries = '';
        
        $this->dispatchBrowserEvent('closeModal', ['name' => 'costumersCommentaries']);
        $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Comentario agregado al pedido!']); 
    }


    // public function filterStatus($status)
    // {
    //     $this->statusFilter = $status;
    // }

    public function render()
    {
        return view('livewire.list-orders', 
            [
                // 'orders' => Order::search('code', $this->search)->paginate(10),
                'orders' => Order::when($this->statusFilter, function($query) {
                        if($this->statusFilter !== 'Todos'){
                            $query->where('state',$this->statusFilter);
                        }
                    })
                    ->search('code', $this->search)
                    ->orderBy($this->orderBy, $this->sortBy)
                    ->paginate($this->perPage),
                'users' => User::where('role', 'domiciliary')->get()
            ]
        );
        
    }
}
