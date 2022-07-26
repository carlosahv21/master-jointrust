<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderDomiciliary;

class ListDomiciliary extends Component
{

    use WithPagination;
    public $item, $action, $search, $selectedOrder = null, $selectedUser = null;
       

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'refreshParent' => '$refresh'
    ];

    public function selectItem($item, $action)
    {
        $this->item = $item;
        
        if($action == 'delete'){
            $this->dispatchBrowserEvent('openModal', ['name' => 'deleteDomiciliary']);
        }
    }

    public function delete()
    {
        $order = OrderDomiciliary::findOrFail($this->item);
        $order->delete();

        $this->dispatchBrowserEvent('closeModal', ['name' => 'deleteDomiciliary']);
        $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Domicilio eliminado!']);


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
                ->paginate(10)
    	]);
    }
}
