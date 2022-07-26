<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public User $user;
    public $showSavedAlert = false;
    public $showDemoNotification = false;
    public $upload;

    protected $listeners = [
        'refreshParent' => '$refresh'
    ];

    public function rules() {
        
        if (auth()->user()->role === 'client') {
            $validate = [
                'user.first_name' => 'required|max:15',
                'user.last_name' => 'required|max:20',
                'user.email' => 'required|email',
                'user.phone' => 'required',
                'user.date_birthday' => 'date',
                'user.address' => 'required|max:40',
                'user.neighborhood' => 'required',
                'user.location' => 'required',
                'user.city' => 'required',
                'user.role' => 'required',
                'user.identificacion' => 'required',
                'user.confirm' => 'required',
                'user.method' => 'max:20'  
            ];
        }else{
            $validate = [
                'user.first_name' => 'required|max:15',
                'user.last_name' => 'required|max:20',
                'user.email' => 'required|email',
                'user.phone' => 'required',
                'user.date_birthday' => 'date',
                'user.address' => 'required|max:40',
                'user.neighborhood' => 'required',
                'user.location' => 'required',
                'user.city' => 'required',
                'user.role' => 'required',
                'user.identificacion' => 'required'  
            ];
        }
        
        return $validate;
    }

    public function mount() {
        $this->user = auth()->user(); 
    }

    public function testListen()
    {
        $this->dispatchBrowserEvent('openModal', ['name' => 'changePass']);
        $this->emit('changePass', $this->user->password);
    }

    public function save(){

        if($this->user->confirm == 'option1'){
            $this->user->method = '';
        }

        $this->validate();
        $this->user->email_verified_at = 'yes';
        $this->user->save();
        
        if (auth()->user()->role === 'client') {
            if($this->user->advertisement != 'yes'){
                $this->dispatchBrowserEvent('openModal', ['name' => 'advertisement']);
            }else{
                $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Perfil salvado!']);
            }
        }else{
            $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Perfil salvado!']);
        }

    }

    public function update(){
        
        $this->validate([
            'upload' => 'image|max:2000',
        ]); 
        $user = User::findOrFail(auth()->user()->id);
        $filename = $this->upload->store('/', 'images_profile');
        $user->user_image = $filename; 
        $user->save();
        //$this->emit('refreshParent');

    } 

    public function first_time(){
        $user = User::findOrFail(auth()->user()->id);

        $user->first_time = 'yes';
        $user->save();
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
