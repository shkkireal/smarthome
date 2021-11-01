<?php


namespace App\Http\Controllers;


use App\Models\DurtyCircleUser;
use App\Models\DutyCycle;
use App\Models\ReferenceTemp;
use App\Models\SystemHeatingJob;
use App\Models\Temp;
use App\Models\TermoHead;
use Carbon\Carbon;
use Database\Seeders\DurtyCircleUserSeeder;

class Device
{
    public $stage;
    public $alarmSystemStatus = 0;

    /**
     * Device constructor.
     */
    public function __construct()
    {
    }

    public function Stage()
    {
        $stage = TermoHead::select('Status')
            ->orderBy('id')
            ->take(4)
            ->get();

        return $stage;
    }

    public function answer()
    {

        $status = self::Stage();
        $responceString = '';
        foreach ($status as $value) {
            $responceString .= '%' . $value->Status;

        }

        return '{1%1' . $responceString . '}';
    }

    public function calculationNewStage()
    {
        $lastRoomTemps = Temp::select('T1')
            ->orderBy('id', 'DESC')
            ->take(10)
            ->get();
        foreach ($lastRoomTemps as $lastRoomTemp) {
            $lastRoomTempAr[] = $lastRoomTemp->T1;
        }

        $dutyCircleOn = DutyCycle::select('updated_at')->take(1)->get();
        $dutyCircleOff = $dutyCircleOn[0]->updated_at->addMinute(10);
        $lastRoundDutyCircle = $dutyCircleOn[0]->updated_at->subMinute(10);
        $RealRoomTempTrend = self::getRealRoomTempTrend($lastRoundDutyCircle, $dutyCircleOn);
        $UserRoomTempTrend = self::getUserRoomTempTrend();
        $SystemRoomTempTrend = self::getSystemRoomTempTrend();
       // dd($dutyCircleOn, $dutyCircleOff, Carbon::now(), $RealRoomTempTrend, $UserRoomTempTrend, $SystemRoomTempTrend->RoomNeedHeating);
        $systemRoomNeedHeat = self::setSystemRoomNeedHeating($RealRoomTempTrend,$UserRoomTempTrend);
        $setTermoHeadsStatuses = self::setTermoHeadsStatuses($dutyCircleOff);
       if ($dutyCircleOff < Carbon::now()) {
            $dutyCircleNextRound = self::getDutyCircleNextRound($RealRoomTempTrend, $UserRoomTempTrend, $SystemRoomTempTrend->RoomNeedHeating);

        }
    }

    public function setSystemRoomNeedHeating($RealRoomTempTrend,$UserRoomTempTrend){

        $lastRoomTemps = Temp::select('T1')->orderBy('id', 'DESC')->take(1)->get();
        $targetRoomTemp = ReferenceTemp::select('FloorInTemp')->orderBy('id', 'DESC')->take(1)->get();;
        $lastRoomTemp = $lastRoomTemps[0]->T1-1;
        if($lastRoomTemp > $targetRoomTemp[0]->FloorInTemp) $setSystemRoomNeedHeat = SystemHeatingJob::create(['SystemNowHeating' => '1', 'RoomNeedHeating' =>'1']);
        if($lastRoomTemp <= $targetRoomTemp[0]->FloorInTemp) $setSystemRoomNeedHeat = SystemHeatingJob::create(['SystemNowHeating' => '1', 'RoomNeedHeating' =>'0']);
    }

    public function getRealRoomTempTrend($lastRoundDutyCircle, $dutyCircleOn)
    {
        $lastDutyRoundRoomTempAr[] = '';
        $lastDutyRoundRoomTemps = Temp::select('T1')->whereBetween('updated_at', [$lastRoundDutyCircle, $dutyCircleOn[0]->updated_at])->orderBy('id')->get();
       if(count($lastDutyRoundRoomTemps) > 1) {
           foreach ($lastDutyRoundRoomTemps as $lastDutyRoundRoomTemp) {
               $lastDutyRoundRoomTempAr1[] = $lastDutyRoundRoomTemp->T1;
           }
           $sizeMassPart = round(count($lastDutyRoundRoomTempAr1) / 2);
           $lastDutyRoundRoomTempAr = array_chunk($lastDutyRoundRoomTempAr1, $sizeMassPart);
           $lastDutyRoundRoomTempsPart1 = array_sum($lastDutyRoundRoomTempAr[0]);
           $lastDutyRoundRoomTempsPart2 = array_sum($lastDutyRoundRoomTempAr[1]);

           if ($lastDutyRoundRoomTempsPart1 > $lastDutyRoundRoomTempsPart2) $RealRoomTempUp = false;
           elseif ($lastDutyRoundRoomTempsPart1 < $lastDutyRoundRoomTempsPart2) $RealRoomTempUp = true;
           else {
               $deltaTDutyRoundRoomTempsParts = $lastDutyRoundRoomTempsPart1 - $lastDutyRoundRoomTempsPart2;
               if ($deltaTDutyRoundRoomTempsParts < $sizeMassPart) $RealRoomTempUp = null;

           }

           return $RealRoomTempUp;
       }
       else return null;
    }

    public function getUserRoomTempTrend()
    {
        $UserRoomTemps = DurtyCircleUser::select('WorkOnCircle')
            ->orderBy('id')
            ->take(4)
            ->get();
        foreach ($UserRoomTemps as $UserRoomTemp) {
            $UserRoomTempAr[] = $UserRoomTemp->WorkOnCircle;
        }
        $UserRoomTempSum = array_sum($UserRoomTempAr);
        $SystemRoomRounds = DutyCycle::select('WorkOnCircle')
            ->orderBy('id')
            ->take(4)
            ->get();
        foreach ($SystemRoomRounds as $SystemRoomRound) {
            $SystemRoomRoundAr[] = $SystemRoomRound->WorkOnCircle;
        }
        $SystemRoomRoundSum = array_sum($SystemRoomRoundAr);
        $deltaRoomRoundTemp = $UserRoomTempSum - $SystemRoomRoundSum;
        if ($deltaRoomRoundTemp > 1) $UserRoomTempUp = true;
        elseif ($deltaRoomRoundTemp < -1) $UserRoomTempUp = false;
        else $UserRoomTempUp = null;

        return $UserRoomTempUp;
    }

    public function getSystemRoomTempTrend()
    {

        $SystemRoomTempTrend = SystemHeatingJob::select('RoomNeedHeating')->get()->last();

        return $SystemRoomTempTrend;

    }

    public function getDutyCircleNextRound($RealRoomTempTrend, $UserRoomTempTrend, $SystemRoomTempTrend)
    {
/*???
        $NowDutyCycles = DutyCycle::get()->all();
        foreach ($NowDutyCycles as $NowDutyCycle) {
            $statusJob = $NowDutyCycle->WorkOnCircle + 1;
            DutyCycle::where('id', $NowDutyCycle->id)->update(['WorkOnCircle' => $statusJob]);
        }
*/

        //нужно греть
        if ($RealRoomTempTrend === false) {
            //пользователь говорит нужно греть
            if ($UserRoomTempTrend) {
                //система пытается греть?
                if ($SystemRoomTempTrend = 1) {
                    $lastSystemHeatingJob = SystemHeatingJob::select('RoomNeedHeating')->get()->take(-1);
                    //пытается греть - добавляем
                    if ($lastSystemHeatingJob->RoomNeedHeating = 1) {
                        self::setDutyCircle(3, true);

                    }

                }
                self::setDutyCircle(2, true);

            }

            self::setDutyCircle(1, false);

        } else self::setDutyCircle(10, false);

        return true;
    }


    public function setDutyCircle($ratio, $trend = null)
    {
        $NowDutyCycles = DutyCycle::get()->all();
        foreach ($NowDutyCycles as $NowDutyCycle) {

            if ($trend)  $statusJob = $NowDutyCycle->WorkOnCircle + $ratio;
            else  $statusJob = $NowDutyCycle->WorkOnCircle - $ratio;

            if ($statusJob > 10) $statusJob = 10;
            if ($statusJob < 0) $statusJob = 0;

            DutyCycle::where('id', $NowDutyCycle->id)->update(['WorkOnCircle' => $statusJob]);

        }
        return true;
    }

    public function setTermoHeadsStatuses($dutyCircleOff)
    {


        $NowDutyCycles = DutyCycle::get()->all();
        foreach ($NowDutyCycles as $NowDutyCycle) {

             $timeIsOf = $NowDutyCycle->updated_at->addMinute($NowDutyCycle->WorkOnCircle);
             if($timeIsOf > Carbon::now()){

             TermoHead::where('id', $NowDutyCycle->id)->update(['Status' => 1]);
             }
            else TermoHead::where('id', $NowDutyCycle->id)->update(['Status' => 0]);

        }

            return true;
    }




}
