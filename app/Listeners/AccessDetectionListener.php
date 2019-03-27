<?php

namespace App\Listeners;

use App\Events\AccessDetection;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AccessDetectionListener
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
     * @param  AccessDetection  $event
     * @return void
     */
    public function handle(AccessDetection $event)
    {
        dump('Access Detected param=' . $event->param);
    }
}
