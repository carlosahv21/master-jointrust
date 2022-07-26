<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\GiftSet;

class GiftSetForm extends Component
{
    public $name, $value, $modelId;

    protected $listeners = [
        'getModelId',
        'forcedCloseModal'
    ];

    public function getModelId($modelId)
    {
        $this->modelId = $modelId;

        $model = GiftSet::find($this->modelId);

        $this->name = $model->name;
        $this->value = $model->value;
    }

    public function save(){

        if($this->modelId){
            $giftset = GiftSet::findOrFail($this->modelId);
            $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Kit de regalo actualizado exitosamente!']);
        }else{
            $giftset = new GiftSet;
            $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Kit de regalo creado exitosamente!']);
        }

        $this->validate();

        $giftset->name = $this->name;
        $giftset->value  =$this->value;
        $giftset->save();

        $this->dispatchBrowserEvent('closeModal', ['name' => 'createGiftSet']);
        
        $this->emit('refreshParent');
        $this->clearForm();

    }

    private function clearForm()
    {
        $this->name = null;
        $this->value = null;

    }

    public function forcedCloseModal()
    {
        // This is to <re></re>set our public variables
        $this->clearForm();

        // These will reset our error bags
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function rules() {
        return [
            'name' => 'required|max:15',
            'value' => 'required|numeric',
        ];
    }

    public function render()
    {
        return view('livewire.gift-set-form');
    }
}
