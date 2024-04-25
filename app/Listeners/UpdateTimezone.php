<?php

namespace App\Listeners;

use App\Events\UserLoggedIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Stevebauman\Location\Facades\Location;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateTimezone
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserLoggedIn $event): void
    {
        $user = $event->user;
        $ip = $event->ipAddress ?? null;

        // $ipAddress = '103.11.0.0'; // Example public IP address (Pakistan)
        $location = Location::get($ip);
        $user->update([
            'timezone' => $location->timezone ?? 'UTC',
        ]);
    }
}
