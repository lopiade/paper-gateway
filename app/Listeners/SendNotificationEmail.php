<?php namespace App\Listeners;

use App\Events\ServerWasNotFound;
use Mail;

class SendNotificationEmail {

    /**
     * Handle the event.
     *
     * @param  ServerWasNotFound $event
     * @return void
     */
    public function handle(ServerWasNotFound $event)
    {
        Mail::send(
            'admin.emails.online-notification', ['data' => $event->paperResource->load('paper')], function ($m) {
            $m->from(env('APP_MAIL_RECEIVER_ADDRESS', ''), 'PaperGateway - Notifier');
            $m->to(env('APP_MAIL_RECEIVER_ADDRESS', ''), 'To whom it may concern')->subject('Notification: Resource@paperGateway offline');
        });
    }
}
