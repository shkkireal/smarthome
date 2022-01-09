<?php

namespace App\Observers;

use App\Models\TermoHead;
use Illuminate\Support\Facades\Log;

class TermoHeadObserver
{
    /**
     * Handle the TermoHead "created" event.
     *
     * @param  \App\Models\TermoHead  $termoHead
     * @return void
     */
    public function created(TermoHead $termoHead)
    {
        //


        Log::info('TermoHead insert from monitoring .', ['id' => $termoHead->id, 'HeadNomber'=>$termoHead->HeadNomber, 'Status'=>$termoHead->Status, 'created_at'=>$termoHead->created_at]);

    }

    /**
     * Handle the TermoHead "updated" event.
     *
     * @param  \App\Models\TermoHead  $termoHead
     * @return void
     */
    public function updated(TermoHead $termoHead)
    {
        //

        Log::info('TermoHead updated from monitoring .', ['id' => $termoHead->id, 'HeadNomber'=>$termoHead->HeadNomber, 'Status'=>$termoHead->Status, 'created_at'=>$termoHead->created_at , 'updated_at'=>$termoHead->updated_at]);
    }

    /**
     * Handle the TermoHead "deleted" event.
     *
     * @param  \App\Models\TermoHead  $termoHead
     * @return void
     */
    public function deleted(TermoHead $termoHead)
    {
        //
    }

    /**
     * Handle the TermoHead "restored" event.
     *
     * @param  \App\Models\TermoHead  $termoHead
     * @return void
     */
    public function restored(TermoHead $termoHead)
    {
        //
    }

    /**
     * Handle the TermoHead "force deleted" event.
     *
     * @param  \App\Models\TermoHead  $termoHead
     * @return void
     */
    public function forceDeleted(TermoHead $termoHead)
    {
        //
    }
}
