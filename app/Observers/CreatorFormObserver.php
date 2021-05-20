<?php

namespace App\Observers;

use App\Models\CreatorForm;
use App\Notifications\CreatorFormNotification;

class CreatorFormObserver
{
    /**
     * Handle the CreatorForm "created" event.
     *
     * @param  \App\Models\CreatorForm  $creatorForm
     * @return void
     */
    public function created(CreatorForm $creatorForm)
    {
        //
        dd("in");
        $creatorForm->notify(new CreatorFormNotification());

    }

    /**
     * Handle the CreatorForm "updated" event.
     *
     * @param  \App\Models\CreatorForm  $creatorForm
     * @return void
     */
    public function updated(CreatorForm $creatorForm)
    {
        //
        $creatorForm->notify(new CreatorFormNotification());
    }

    /**
     * Handle the CreatorForm "deleted" event.
     *
     * @param  \App\Models\CreatorForm  $creatorForm
     * @return void
     */
    public function deleted(CreatorForm $creatorForm)
    {
        //
    }

    /**
     * Handle the CreatorForm "restored" event.
     *
     * @param  \App\Models\CreatorForm  $creatorForm
     * @return void
     */
    public function restored(CreatorForm $creatorForm)
    {
        //
    }

    /**
     * Handle the CreatorForm "force deleted" event.
     *
     * @param  \App\Models\CreatorForm  $creatorForm
     * @return void
     */
    public function forceDeleted(CreatorForm $creatorForm)
    {
        //
    }
}
