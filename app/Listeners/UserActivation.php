<?php

namespace App\Listeners;

use App\Events\ActivateUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserActivation
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
    public function handle(ActivateUser $event)
    {
        $user = $event->user;
        $user->update(['is_active' => 1]);
    }
}
