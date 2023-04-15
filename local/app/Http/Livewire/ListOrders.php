<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Order;
use Livewire\WithPagination;
use App\Models\Shipping;
use App\Models\User;
use App\Models\OrderDomiciliary;
use DateTime;

class ListOrders extends Component
{
    use WithPagination;
    public $item, $action, $search, $countOrders, $idDomiciliary, $commentaries = '';
    public $statusFilter = 'Pendiente';
    public $perPage = '5';
    public $orderBy = 'date_order';
    public $sortBy = 'asc';
    public $date_ini =  '';
    public $date_fin =  '';
    public $dateBetween = 'today';

    public $selected = [];
    public $orders_products = [];
    

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'refreshParent' => '$refresh'
    ];

    public function __construct()
    {
        $this->date_ini = date('Y-m-d');
        $this->date_fin = date('Y-m-d');

    }

    public function getOrdersProperty()
    {
        $input = $this->search;

        return Order::when($this->statusFilter, function($query) {
                if($this->statusFilter !== 'Todos'){
                    $query->where('state',$this->statusFilter);
                }
            })
            ->where(function ($query) use ($input) {
                $query->with('user')->whereHas('user', function ($q) use ($input) {
                    $q->where('first_name', 'like', '%' . $input . '%')
                        ->orWhere('code', 'like', '%' . $input . '%');
                });
            })
            ->where(function ($query) use ($input) {
                if(!empty($this->date_ini) && !empty($this->date_fin)){
                    $query->whereBetween('date_order', [$this->date_ini, $this->date_fin]);
                }
            })
            ->where(function ($query) use ($input) {
                if(auth()->user()->role != 'admin'){
                    $query->where('user_id', auth()->user()->id);
                }
            })
            ->orderBy('date_order', $this->sortBy)
            ->paginate($this->perPage);
    }

    public function selectItem($item, $action)
    {
        $this->item = $item;
        
        if($action == 'delete'){
            $this->dispatchBrowserEvent('openModal', ['name' => 'deleteOrder']);
        }else if($action == 'assignShipping'){
            $this->dispatchBrowserEvent('openModal', ['name' => 'assignShipping']);
            $this->countOrders = count($this->selected);
        }else if($action == 'assignDomiciliary'){
            if(($this->item) || ($this->selected)){
                $this->dispatchBrowserEvent('openModal', ['name' => 'assignDomiciliary']);            
            }else{
                $this->dispatchBrowserEvent('notify', ['type' => 'danger', 'message' => 'Debes seleccionar al menos un pedido!']);            
            }
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

        if ($this->selected) {
            $orders = Order::whereKey($this->selected)->get();

            foreach (collect($orders)->toArray() as $key => $value) {
                $this->insertDomiciliary($value['id']);
            }

        }else{
            $order = Order::findOrFail($this->item);
            $this->insertDomiciliary($order->id);
        }       
    }

    public function insertDomiciliary($order_id)
    {
        if(OrderDomiciliary::where('order_id', $order_id)->count() > 0){
            $this->dispatchBrowserEvent('notify', ['type' => 'danger', 'message' => 'Este Pedido ya se encuentra asignado a un domiciliario!']);
       }else{
           $domiciliary = new OrderDomiciliary();
           $domiciliary->order_id = $order_id;
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


    public function changeDate($value)
    {
        switch ($value) {
            case 'today':
                $this->date_ini = date('Y-m-d');
                $this->date_fin = date('Y-m-d');
                break;
            case 'week':
                $diaSemana = date("w");
                $tiempoDeInicioDeSemana = strtotime("-" . $diaSemana . " days");
                $fechaInicioSemana = date("Y-m-d", $tiempoDeInicioDeSemana);
                $tiempoDeFinDeSemana = strtotime("+" . $diaSemana . " days", $tiempoDeInicioDeSemana);
                $fechaFinSemana = date("Y-m-d", $tiempoDeFinDeSemana);

                $this->date_ini = $fechaInicioSemana;
                $this->date_fin = $fechaFinSemana;
                break;
            case 'month':
                $this->date_ini = date('Y-m-01');
                
                $fecha = new DateTime();
                $fecha->modify('last day of this month');

                $this->date_fin = $fecha->format('Y-m-d');
                break;
            case 'last_month':
                
                $fecha_ini = new DateTime();
                $fecha_ini->modify('first day of previous month');
                $this->date_ini = $fecha_ini->format('Y-m-d');

                $fecha_fin = new DateTime();
                $fecha_fin->modify('last day of previous month');
                $this->date_fin = $fecha_fin->format('Y-m-d');
                break;
            case 'all':
                $this->date_ini = '';
                $this->date_fin = '';
                break;
            default:
                $this->date_ini = date('Y-m-d');
                $this->date_fin = date('Y-m-d');
                break;
        }
    }

    public function render()
    {

        $input = $this->search;

        return view('livewire.list-orders', 
            [
                'orders' => $this->orders,
                'users' => User::where('role', 'domiciliary')->get()
            ]
        );
        
    }
}
