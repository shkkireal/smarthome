<?php

namespace App\Observers;

use App\Models\DutyCycle;
use Illuminate\Support\Facades\Log;

class DutyCycleObserver
{
    /**
     * Handle the DutyCycle "created" event.
     *
     * @param  \App\Models\DutyCycle  $dutyCycle
     * @return void
     */
    public function created(DutyCycle $dutyCycle)
    {
        //

        Log::info('DutyCycle insert from monitoring .', ['WorkOnCircle' =>  $dutyCycle->WorkOnCircle, 'created_at'=>$dutyCycle->created_at, 'updated_at'=>$dutyCycle->updated_at]);


    }

    /**
     * Handle the DutyCycle "updated" event.
     *
     * @param  \App\Models\DutyCycle  $dutyCycle
     * @return void
     */
    public function updated(DutyCycle $dutyCycle)
    {
        //

        Log::info('DutyCycle updated from monitoring .', ['WorkOnCircle' =>  $dutyCycle->WorkOnCircle, 'created_at'=>$dutyCycle->created_at, 'updated_at'=>$dutyCycle->updated_at]);
    }

    /**
     * Handle the DutyCycle "deleted" event.
     *
     * @param  \App\Models\DutyCycle  $dutyCycle
     * @return void
     */
    public function deleted(DutyCycle $dutyCycle)
    {
        //
    }

    /**
     * Handle the DutyCycle "restored" event.
     *
     * @param  \App\Models\DutyCycle  $dutyCycle
     * @return void
     */
    public function restored(DutyCycle $dutyCycle)
    {
        //
    }

    /**
     * Handle the DutyCycle "force deleted" event.
     *
     * @param  \App\Models\DutyCycle  $dutyCycle
     * @return void
     */
    public function forceDeleted(DutyCycle $dutyCycle)
    {
        //
    }
}
