<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Shipping;

class ShippingForm extends Component
{
    public $zone, $description, $value, $modelId;

    protected $listeners = [
        'getModelId',
        'forcedCloseModal'
    ];

    public function getModelId($modelId)
    {
        $this->modelId = $modelId;

        $model = Shipping::find($this->modelId);

        $this->zone = $model->zone;
        $this->description = $model->description;
        $this->value = $model->value;
    }

    public function save(){
        $edit = false;

        if($this->modelId){
            $shipping = Shipping::findOrFail($this->modelId);
            $edit = true;
        }else{
            $shipping = new Shipping;
        }

        $this->validate();

        $shipping->zone = $this->zone;
        $shipping->description = $this->description;
        $shipping->value  =$this->value;
        $shipping->save();

        $this->dispatchBrowserEvent('closeModal', ['name' => 'createShipping']);
        if ($edit) {
            $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Domicilio actualizado exitosamente!']);
        } else {
            $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Domicilio creado exitosamente!']);
        }
        
        
        $this->emit('refreshParent');
        $this->clearForm();

    }

    private function clearForm()
    {
        $this->modelId = null;
        $this->zone = null;
        $this->description = null;
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
            'zone' => 'required|max:20',
            'description' => 'required',
            'value' => 'required|numeric',
        ];
    }

    public function render()
    {
        return view('livewire.shipping-form');
    }
}
