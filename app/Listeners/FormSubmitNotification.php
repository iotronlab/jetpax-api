<?php

namespace App\Listeners;

use App\Events\FormSubmit;
use App\Helpers\DiscordNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\FormSubmit as FormSubmitEmail;

class FormSubmitNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public $discord;
    public function __construct(DiscordNotification $discord)
    {
        $this->discord = $discord;
    }

    /**
     * Handle the event.
     *
     * @param  FormSubmit  $event
     * @return void
     */
    public function handle(FormSubmit $event)
    {
        Mail::to($event->form['email'])->cc('admin@gmail.com')->send(new FormSubmitEmail($event->form));
        $this->discord->sendDiscordNotification($event->form);
    }
}
