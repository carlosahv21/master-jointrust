<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

        $user->save();

        // $user = User::create([
        //     'email' =>$this->email,
        //     'password' => Hash::make($this->password),
        //     'remember_token' => Str::random(10),
        //     'role' => 'client'
        // ]);

        auth()->login($user);

        return redirect('/profile');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
