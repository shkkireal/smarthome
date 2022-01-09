<?php

namespace App\Observers;

use App\Models\ReferenceTemp;
use Illuminate\Support\Facades\Log;

class ReferenceTempObserver
{
    /**
     * Handle the ReferenceTemp "created" event.
     *
     * @param  \App\Models\ReferenceTemp  $referenceTemp
     * @return void
     */
    public function created(ReferenceTemp $referenceTemp)
    {

        Log::info('ReferenceTemp insert from monitoring .', ['OutDoorTemp' => $referenceTemp->OutDoorTemp, 'termoHead_1'=>$referenceTemp->termoHead_1, 'termoHead_2'=>$referenceTemp->termoHead_2, 'termoHead_3'=>$referenceTemp->termoHead_3, 'termoHead_4' => $referenceTemp->termoHead_4, 'T_pola_1' => $referenceTemp->T_pola_1, 'FloorInTemp' => $referenceTemp->PPM]);

    }

    /**
     * Handle the ReferenceTemp "updated" event.
     *
     * @param  \App\Models\ReferenceTemp  $referenceTemp
     * @return void
     */
    public function updated(ReferenceTemp $referenceTemp)
    {
        //

        Log::info('ReferenceTemp updated from monitoring .', ['OutDoorTemp' => $referenceTemp->OutDoorTemp, 'termoHead_1'=>$referenceTemp->termoHead_1, 'termoHead_2'=>$referenceTemp->termoHead_2, 'termoHead_3'=>$referenceTemp->termoHead_3, 'termoHead_4' => $referenceTemp->termoHead_4, 'T_pola_1' => $referenceTemp->T_pola_1, 'FloorInTemp' => $referenceTemp->PPM]);
    }

    /**
     * Handle the ReferenceTemp "deleted" event.
     *
     * @param  \App\Models\ReferenceTemp  $referenceTemp
     * @return void
     */
    public function deleted(ReferenceTemp $referenceTemp)
    {
        //
    }

    /**
     * Handle the ReferenceTemp "restored" event.
     *
     * @param  \App\Models\ReferenceTemp  $referenceTemp
     * @return void
     */
    public function restored(ReferenceTemp $referenceTemp)
    {
        //
    }

    /**
     * Handle the ReferenceTemp "force deleted" event.
     *
     * @param  \App\Models\ReferenceTemp  $referenceTemp
     * @return void
     */
    public function forceDeleted(ReferenceTemp $referenceTemp)
    {
        //
    }
}
