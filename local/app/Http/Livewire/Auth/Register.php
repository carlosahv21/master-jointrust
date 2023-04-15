<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use App\Mail\UserConfirmation;
use Illuminate\Support\Facades\Mail;

class Register extends Component
{

    public $email ,$password, $passwordConfirmation = '';

    public function mount()
    {
        if (auth()->user()) {
            return redirect()->intended('/dashboard');
        }
    }

    public function updatedEmail()
    {
        $this->validate(['email'=>'required|email:rfc,dns|unique:users']);
    }
    
    public function register()
    {   
        $this->validate([
            'email' => 'required',
            'password' => 'required|same:passwordConfirmation|min:6',
        ]);

        $user = new User;
        $user->email = $this->email;
        $user->role = 'client';
        $user->remember_token = Str::random(10);
        $user->password = Hash::make($this->password);

        if($user->save()){
            $hash = Crypt::encryptString(date('Y-m-d H:i:s')."/".$this->email."/".$this->password);
            $url =  explode('/', url()->current())[2]."/confirm-email/".$hash;

            $data = [
                'email' => $user->email,
                'url' => $url
            ];

            $correo = new UserConfirmation($data);
            Mail::to($this->email,$correo)->send($correo);
        }
        
        $this->dispatchBrowserEvent('openModal', ['name' => 'back_to_login']);
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
