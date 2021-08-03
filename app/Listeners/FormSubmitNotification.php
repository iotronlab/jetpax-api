<?php

namespace App\Listeners;

use App\Events\FormSubmit;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\FormSubmit as FormSumitEmail;

class FormSubmitNotification implements ShouldQueue
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
     * @param  FormSubmit  $event
     * @return void
     */
    public function handle(FormSubmit $event)
    {
        Mail::to($event->form['email'])->cc('admin@gmail.com')->send(new FormSumitEmail($event->form));
    }
}
