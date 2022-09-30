<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Address;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Addresses extends Component
{

    public $address = '';

    protected $listeners = [
        'inviteReferrals' => 'inviteReferrals'
    ];


    protected $rules = [
        'address' => 'required',
    ];

    public function show($id)
    {

        $guests = DB::table('guests')
            ->where('user_id', '=', $id)
            ->get();
        $guests = collect($guests)->toArray();

        return view('livewire.show-guest',['guests' => $guests]);
    }

    public function save(){

        $this->validate();

        $address = new Address;

        $address->user_id = auth()->user()->id;
        $address->address = $this->address;

        $address->save();

        $this->clearForm();
        $this->dispatchBrowserEvent('closeModal', ['name' => 'address']);
        $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Direccion creada!']);
    }

    private function clearForm()
    {
        $this->address = '';
    }

    public function render()
    { 
        return view('livewire.addresses');
    }
}
