<?php

namespace App\Listeners;

use App\Events\FormSubmit;
use App\Helpers\DiscordNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\FormSubmit as FormSubmitEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

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

        $data = Arr::except($event->form,['created_at','updated_at']);
        Mail::to($event->form['email'])->cc('admin@gmail.com')->send(new FormSubmitEmail($data));
        $this->discord->sendDiscordNotification($event->form);
    }
}
