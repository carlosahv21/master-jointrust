<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\GiftSet;
use Livewire\WithPagination;

class GiftSets extends Component
{
    use WithPagination;
    public $item, $action, $search, $countGiftSets = '', $title_modal = '';
    public $selected = [];

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'refreshParent' => '$refresh'
    ];

    public function selectItem($item, $action)
    {
        $this->item = $item;
        
        if($action == 'delete'){
            $this->dispatchBrowserEvent('openModal', ['name' => 'deleteGiftSet']);
        }else if($action == 'masiveDelete'){
            $this->dispatchBrowserEvent('openModal', ['name' => 'deleteGiftSetMasive']);
            $this->countGiftSets = count($this->selected);
        }else if($action == 'create'){
            $this->title_modal = 'Crear Kit de regalo';
            $this->dispatchBrowserEvent('openModal', ['name' => 'createGiftSet']);
            $this->emit('clearForm');
        }else {
            $this->title_modal = 'Editar Kit de regalo';
            $this->dispatchBrowserEvent('openModal', ['name' => 'createGiftSet']);
            $this->emit('getModelId', $this->item);
        }
    }

    public function massiveDelete()
    {
        $giftset = GiftSet::whereKey($this->selected);
        $giftset->delete();
        $this->selected = null;

        $this->dispatchBrowserEvent('closeModal', ['name' => 'deleteGiftSetMasive']);
        $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Kits de regalos eliminados!']);

    }

    public function delete()
    {
        $giftset = GiftSet::findOrFail($this->item);
        $giftset->delete();

        $this->dispatchBrowserEvent('closeModal', ['name' => 'deleteGiftSet']);
        $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Kist de regalo eliminado!']);

    }

    public function render()
    {
        return view('livewire.gift-sets', [
            'gift_sets' => GiftSet::search('name', $this->search)->paginate(10)
        ]);
    }
}
