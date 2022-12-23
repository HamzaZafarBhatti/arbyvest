<?php

namespace App\Listeners;

use App\Events\AccountVerification;
use App\Mail\AccountVerificationEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailAccountVerificationNotification implements ShouldQueue
{
    public $queue = 'email_listener';
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
     * @param  \App\Events\AccountVerification  $event
     * @return void
     */
    public function handle(AccountVerification $event)
    {
        //
        Mail::to($event->user->email)->send(new AccountVerificationEmail($event->user->username));
    }
}
