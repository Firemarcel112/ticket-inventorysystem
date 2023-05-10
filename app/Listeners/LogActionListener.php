<?php

namespace App\Listeners;

use App\Events\LogActionEvent;
use App\Models\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class LogActionListener
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
    public function handle(LogActionEvent $event)
    {
        Log::create([
            'username' => Auth::user()->username,
            'tablename' => $event->tablename,
            'object' => $event->object,
            'object_id' => $event->object_id,
            'action' => $event->action
        ]);
    }
}
