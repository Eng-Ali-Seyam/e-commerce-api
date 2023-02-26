<?php

namespace App\Listeners;

use App\Events\NewProductEvent;
use App\Mail\EmailMailable;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;

class SendNewProductEmail
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
     * @param  \App\Events\NewProductEvent  $event
     * @return void
     */
    public function handle(NewProductEvent $event)
    {
        $users = User::all();
        if ($users->count() > 0) {
            foreach($users as $key => $value){
                if (!empty($value->email)) {
                    Mail::to($value->email)->send(new EmailMailable($event->product));
                }
            }
        }
    }
}
