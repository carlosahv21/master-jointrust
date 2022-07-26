<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Models\Guest;


class Users extends Component
{
    use WithPagination;
    public $item, $action, $search, $countUsers, $title_modal = '';
    public $selected, $referrals = [];

    protected $paginationTheme = 'bootstrap';
    protected $listeners = [
        'refreshParent' => '$refresh',
        'getReferrals'
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
        }else if($action == 'seeReferrals'){
            $this->dispatchBrowserEvent('openModal', ['name' => 'seeReferrals']);
            $this->emit('getReferrals', $this->item);
        }else if($action == 'inviteReferrals'){
            $this->emit('inviteReferrals', $this->item);
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

    public function getReferrals($modelId)
    {
        $this->referrals = DB::table('guests')
            ->where('user_id', '=', $modelId)
            ->get();
    }

    public function inviteReferrals($modelId)
    {
        dd($guest);

        $guest = Guest::findOrFail($this->item);
        $guest->guest = 1;
        dd($guest);
        $guest->save();


        // $this->emit('getReferrals', $this->item);
        // $this->dispatchBrowserEvent('getLinkInvitation', ['name' => $guest->name, 'phone' => $guest->phone]);

    }

    public function delete()
    {
        $user = User::findOrFail($this->item);
        $user->delete();

        $this->dispatchBrowserEvent('closeModal', ['name' => 'deleteUser']);
        $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Usuario eliminado!']);

    }

    public function render()
    {
        return view('livewire.users', 
            ['users' => User::search('first_name', $this->search)->paginate(10)]
        );
    }
}
