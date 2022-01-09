<?php

namespace App\Observers;

use App\Models\Temp;
use Illuminate\Support\Facades\Log;

class TempObserver
{
    /**
     * Handle the Temp "created" event.
     *
     * @param  \App\Models\Temp  $temp
     * @return void
     */
    public function created(Temp $temp)
    {


     Log::info('Temp insert from monitoring .', ['T1' => $temp->T1, 'H1'=>$temp->H1, 'T2'=>$temp->T2, 'H2'=>$temp->H2, 'T_pola_1' => $temp->T_pola_1, 'PPM' => $temp->PPM]);

    }

    /**
     * Handle the Temp "updated" event.
     *
     * @param  \App\Models\Temp  $temp
     * @return void
     */
    public function updated(Temp $temp)
    {
        //
    }

    /**
     * Handle the Temp "deleted" event.
     *
     * @param  \App\Models\Temp  $temp
     * @return void
     */
    public function deleted(Temp $temp)
    {
        //
    }

    /**
     * Handle the Temp "restored" event.
     *
     * @param  \App\Models\Temp  $temp
     * @return void
     */
    public function restored(Temp $temp)
    {
        //
    }

    /**
     * Handle the Temp "force deleted" event.
     *
     * @param  \App\Models\Temp  $temp
     * @return void
     */
    public function forceDeleted(Temp $temp)
    {
        //
    }
}
