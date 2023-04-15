<?php

namespace App\Http\Livewire;

use Carbon\Carbon;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

use App\Models\Address;
use App\Models\User;

class Users extends Component
{
    use WithPagination;
    public $item, $action, $search, $countUsers, $title_modal, $user_email = '';
    public $selected, $shippings, $addresses = [];
    public $typeUser = 'Todos';
    public $perPage = '5';

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
        }else if($action == 'deleteUserRegister'){
            $this->emit('deleteUserRegister', $this->item);
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

    public function confirmEmail($token)
    {
        try {
            $decrypted = Crypt::decryptString($token);
            $decrypted_ = explode("/",$decrypted);

            $to = Carbon::createFromFormat('Y-m-d H:i:s',  $decrypted_[0]);
            $date = Carbon::parse(date('Y-m-d H:i:s'))->format('Y-m-d H:i:s');
            $from = Carbon::createFromFormat('Y-m-d H:i:s', $date );
    
            $diff_day = $to->diffInHours($from);

            $data = [
                'email' => $decrypted_[1],
                'password' => $decrypted_[2],
                'diff_day' => $diff_day
            ];

        } catch (DecryptException $e) {
            // ...
        }

        return view('livewire.confirm-email', ['data' => $data]);
    }

    public function loginUser($token)
    {
        try {
            $decrypted = Crypt::decryptString($token);
            $decrypted_ = explode("-",$decrypted);
            if(auth()->attempt(['email' => $decrypted_[0], 'password' => $decrypted_[1]])){
                $user = User::where('email', $decrypted_[0])->first();

                $user->email_verified_at = 'yes';
                $user->save();

                return redirect('/profile');
            }

        } catch (DecryptException $e) {
            // ...
        }
        
    }

    public function deleteUserRegister($email)
    {
        $user = User::where('email', $email)->first();
        $user->delete();

        return redirect('/login');
    }

    public function forcedCloseModal()
    {
        $this->addresses = [];
    }

    public function getUsersProperty()
    {
        $input = $this->search;

        return User::when($this->typeUser, function($query) {
                if($this->typeUser !== 'Todos'){
                    $query->where('role',$this->typeUser);
                }
            })
            ->where(function ($query) use ($input) {
                    $query->where('first_name', 'like', '%' . $input . '%');
            })
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.users', 
            ['users' =>  $this->users]
        );
    }
}
