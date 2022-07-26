<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ChangePass extends Component
{

    public $current_hashed_password;
    public $password;
    public $password_confirmation;
    public $current_password;


    protected $listeners = ['changePass' => 'getPass'];

    public function getPass($pass){
        
        $this->current_hashed_password = $pass;
    }

    public function save(){
        $user = User::findOrFail(auth()->user()->id);

        $this->validate();

        $user->password = Hash::make($this->password);
        $user->save();

        $this->dispatchBrowserEvent('closeModal', ['name' => 'changePass']);
        $this->clearFormPass();

    }

    private function clearFormPass()
    {
        $this->password = null;
        $this->password_confirmation = null;
        $this->current_password = null;
    }

    public function rules() {
        if($this->password){
            return [
                'password' => 'min:6',
                'password_confirmation' => 'same:password|required',
                'current_password' => 'customPassCheckHashed:'.$this->current_hashed_password,
            ];
        }
    }


    public function render()
    { 
        return view('livewire.change-pass');
    }
}
