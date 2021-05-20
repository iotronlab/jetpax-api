<?php

namespace App\Observers;

use App\Models\BusinessForm;
use App\Notifications\BusinessFormNotification;

class BusinessFormObserver
{
    /**
     * Handle the BusinessForm "created" event.
     *
     * @param  \App\Models\BusinessForm  $businessForm
     * @return void
     */
    public function created(BusinessForm $businessForm)
    {
       
        $businessForm->notify(new BusinessFormNotification());

    }

    /**
     * Handle the BusinessForm "updated" event.
     *
     * @param  \App\Models\BusinessForm  $businessForm
     * @return void
     */
    public function updated(BusinessForm $businessForm)
    {
        //
        $businessForm->notify(new BusinessFormNotification());
    }

    /**
     * Handle the BusinessForm "deleted" event.
     *
     * @param  \App\Models\BusinessForm  $businessForm
     * @return void
     */
    public function deleted(BusinessForm $businessForm)
    {
        //
    }

    /**
     * Handle the BusinessForm "restored" event.
     *
     * @param  \App\Models\BusinessForm  $businessForm
     * @return void
     */
    public function restored(BusinessForm $businessForm)
    {
        //
    }

    /**
     * Handle the BusinessForm "force deleted" event.
     *
     * @param  \App\Models\BusinessForm  $businessForm
     * @return void
     */
    public function forceDeleted(BusinessForm $businessForm)
    {
        //
    }
}
