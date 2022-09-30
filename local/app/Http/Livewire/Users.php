<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Guest;
use App\Models\Address;


class Users extends Component
{
    use WithPagination;
    public $item, $action, $search, $countUsers, $title_modal = '';
    public $selected, $shippings, $addresses = [];

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'refreshParent' => '$refresh',
        'seeAddress',
        'forcedCloseModal'
    ];

    public function selectItem($item, $action)
    {
        $this->item = $item;
        
        if($action == 'delete'){
            $this->dispatchBrowserEvent('openModal', ['name' => 'deleteUser']);
        }else if($action == 'masiveDelete'){
            $this->dispatchBrowserEvent('openModal', ['name' => 'deleteUserMasive']);
            $this->countUsers = count($this->selected);
        }else if($action == 'create'){
            $this->title_modal = 'Crear Usuario';
            $this->dispatchBrowserEvent('openModal', ['name' => 'createUser']);
            $this->emit('clearForm');
        }else if($action == 'seeAddress'){
            $this->dispatchBrowserEvent('openModal', ['name' => 'seeAddress']);
            $this->emit('seeAddress', $this->item);
        }else{
            $this->title_modal = 'Editar Usuario';
            $this->dispatchBrowserEvent('openModal', ['name' => 'createUser']);
            $this->emit('getModelId', $this->item);
        }
    }

    public function massiveDelete()
    {
        $users = User::whereKey($this->selected);
        $users->delete();
        $this->selected = null;

        $this->dispatchBrowserEvent('closeModal', ['name' => 'deleteUserMasive']);

    }

    public function delete()
    {
        $user = User::findOrFail($this->item);
        $user->delete();

        $this->dispatchBrowserEvent('closeModal', ['name' => 'deleteUser']);
        $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Usuario eliminado!']);

    }

    public function seeAddress()
    {
        $this->addresses = DB::table('addresses')
            ->where('user_id', '=', $this->item)
            ->get();

        $this->shippings = DB::table('shippings')
            ->get();
        
    }

    public function updateShipping(Request $request)
    {
        $address = Address::findOrFail($request->id);
        $address->shipping_id = $request->shipping;

        if($address->save()){
            return true;
        }
        return false;

    }

    public function forcedCloseModal()
    {
        $this->addresses = [];
    }

    public function render()
    {
        return view('livewire.users', 
            ['users' => User::search('first_name', $this->search)->paginate(10)]
        );
    }
}
