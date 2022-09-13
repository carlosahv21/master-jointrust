<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NotificarPedido;

class newOrderListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        dd($event);
        User::where('role', '=', 'admin')
              ->each(function(User $user) use ($event) {
                Notification::send($user, new NotificarPedido($event->order));
                    // $user->notify(new NotificarPedido($order));
            });
    }
}
