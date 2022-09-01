<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Guest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Guests extends Component
{

    public $inputs = [];

    protected $listeners = [
        'inviteReferrals' => 'inviteReferrals'
    ];


    protected $rules = [
        'inputs.*.guest_name' => 'required',
        'inputs.*.guest_phone' => 'required|numeric|min:10',
    ];

    protected $messages = [
        'inputs.*.guest_name.required' => 'This name is required.',
        'inputs.*.guest_phone.required' => 'This phone is required.',
        'inputs.*.guest_phone.numeric' => 'This phone must be numeric.',
    ];

    public function addInput()
    {
        $this->inputs->push(['guest_name' => '']);
    }

    public function show($id)
    {

        $guests = DB::table('guests')
            ->where('user_id', '=', $id)
            ->get();
        $guests = collect($guests)->toArray();

        return view('livewire.show-guest',['guests' => $guests]);
    }

    public function removeInput($key)
    {
        $this->inputs->pull($key);
    }

    public function save(){

        $this->validate();

        $guestCounts = count($this->inputs);

        for ($i=0; $i < $guestCounts; $i++) { 
            $guests = new Guest;

            $guests->user_id = auth()->user()->id;
            $guests->guest_name = $this->inputs[$i]['guest_name'];
            $guests->guest_phone = $this->inputs[$i]['guest_phone'];

            $guests->save();
        }

        $this->clearForm();
        $this->dispatchBrowserEvent('closeModal', ['name' => 'advertisement']);
        $this->dispatchBrowserEvent('notify', ['type' => 'success', 'message' => 'Amigo invitado!']);

        $user = User::findOrFail(auth()->user()->id);

        $user->advertisement = 'yes';
        $user->save();

        if($user->first_time != 'yes'){
            $this->dispatchBrowserEvent('openModal', ['name' => 'first_time']);
        }
    }


    public function inviteReferrals($data)
    {

        $guest = Guest::findOrFail($data);
        $guest->guest = 1;

        $guest->save();
        
        $this->dispatchBrowserEvent('notify', ['type' => 'info', 'message' => 'No podras invitar a tus amigos nuevamente']);

        return ['name' => $guest->guest_name, 'phone' => $guest->guest_phone];


    }

    private function clearForm()
    {
        $this->fill([
            'inputs' => collect([['guest_name' => '']]),
            'inputs' => collect([['guest_phone' => '']]),
        ]);
    }


    public function mount()
    {
        $this->fill([
            'inputs' => collect([['guest_name' => '']]),
            'inputs' => collect([['guest_phone' => '']]),
        ]);
    }


    public function render()
    { 
        return view('livewire.guests');
    }
}
