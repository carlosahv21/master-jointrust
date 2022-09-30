<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Shipping;
use Livewire\WithPagination;

class Shippings extends Component
{
    use WithPagination;
    public $item, $action, $search, $countShippings = '', $title_modal = '';
    public $selected = [];

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'refreshParent' => '$refresh'
    ];

    public function selectItem($item, $action)
    {
        $this->item = $item;
        
        if($action == 'delete'){
            $this->dispatchBrowserEvent('openModal', ['name' => 'deleteShipping']);
        }else if($action == 'masiveDelete'){
            $this->dispatchBrowserEvent('openModal', ['name' => 'deleteShippingMasive']);
            $this->countShippings = count($this->selected);
        }else if($action == 'create'){
            $this->title_modal = 'Crear Domicilio';
            $this->dispatchBrowserEvent('openModal', ['name' => 'createShipping']);
        }else {
            $this->title_modal = 'Editar Kit de regalo';
            $this->dispatchBrowserEvent('openModal', ['name' => 'createShipping']);
            $this->emit('getModelId', $this->item);
        }
    }

    public function massiveDelete()
    {
        $shipping = Shipping::whereKey($this->selected);
        $shipping->delete();
        $this->selected = null;

        $this->dispatchBrowserEvent('closeModal', ['name' => 'deleteShippingMasive']);
        $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Kits de regalos eliminados!']);

    }

    public function delete()
    {
        $shipping = Shipping::findOrFail($this->item);
        $shipping->delete();

        $this->dispatchBrowserEvent('closeModal', ['name' => 'deleteShipping']);
        $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Kist de regalo eliminado!']);

    }

    public function render()
    {
        return view('livewire.shippings', [
            'shippings' => Shipping::search('name', $this->search)->paginate(10)
        ]);
    }
}
