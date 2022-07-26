<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithFileUploads;

class ProductForm extends Component
{
    use WithFileUploads;

    public $name, $reference, $presentation, $price, $stock, $product_image, $modelId, $favorite, $fileProducts, $seeFileProducts;
    
    protected $listeners = [
        'getModelId',
        'forcedCloseModal'
    ];

    public function getModelId($modelId)
    {
        $this->modelId = $modelId;

        $model = Product::find($this->modelId);

        $this->name = $model->name;
        $this->reference = $model->reference;
        $this->presentation = $model->presentation;
        $this->price = $model->price;
        $this->stock = $model->stock;
        $this->seeFileProducts = $model->product_image;
    }

    public function save()
    {
        if($this->modelId){
            $product = Product::findOrFail($this->modelId);
        }else{
            $product = new Product;
        }

        $this->validate();

        $filename = $this->fileProducts->store('/', 'images_products');

        $product->name = $this->name;
        $product->reference = $this->reference;
        $product->presentation = $this->presentation;
        $product->price = $this->price;
        $product->stock = $this->stock;
        $product->favorite = ($this->favorite) ? 1 : 0;
        $product->product_image = $filename;

        $product->save();
        
        $this->dispatchBrowserEvent('closeModal', ['name' => 'createProduct']);
        $this->emit('refreshParent');
        $this->clearForm();
    }

    private function clearForm()
    {
        $this->name = null;
        $this->reference = null;
        $this->presentation = null;
        $this->price = null;
        $this->stock = null;
        $this->fileProducts = null;
        $this->seeFileProducts = null;
        $this->modelId = null;

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
            'reference' => 'required',
            'presentation' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric|gt:0',
            'fileProducts' => 'image|max:5120',
        ];
    }

    public function render()
    {
        return view('livewire.product-form');
    }
}
