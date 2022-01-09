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

        return '{1%0' . $responceString . '}';
    }


    /**
     * @param $outweather
     * crone device
     */
    public function calculationNewStage($weatherNow)
    {
        $outDoorTempNow = $weatherNow->weather->temp;

        //определяем время следующего такта
        $lastRoomTemps = Temp::select()
            ->orderBy('id', 'DESC')
            ->first();

        $dutyCircleOn = DutyCycle::select('updated_at')->take(1)->get();
        $dutyCircleOff = $dutyCircleOn[0]->updated_at->addMinute(10);


        //исправляем режим по ощущениям пользователя

        self::updateReferenseTempFromUserTemp($outDoorTempNow, $lastRoomTemps->T2);

        //выставляем текущий такт термоголовок
        self::setTermoHeadsStatuses($dutyCircleOff);

        //если пришло время смены такта

       if ($dutyCircleOff->lessThanOrEqualTo(Carbon::now())) self::getDutyCircleNextRound($outDoorTempNow, $lastRoomTemps->T2);

           }

    public function updateReferenseTempFromUserTemp($outDoorTempNow, $floorInTemp){

        $hasOutDoorTemp = ReferenceTemp::select('OutDoorTemp')
            ->where(['OutDoorTemp' => $outDoorTempNow])
            ->where(['FloorInTemp' => $floorInTemp])
            ->orderBy('id', 'DESC')
            ->first();

        $UserRoomTemps = DurtyCircleUser::select('WorkOnCircle')
            ->orderBy('id')
            ->take(4)
            ->get();
        foreach ($UserRoomTemps as $UserRoomTemp) {
            $UserRoomTempAr[] = $UserRoomTemp->WorkOnCircle;

        }

        if(empty($hasOutDoorTemp)) ReferenceTemp::insert(['termoHead_1' => $UserRoomTempAr[0], 'termoHead_2' => $UserRoomTempAr[1], 'termoHead_3' => $UserRoomTempAr[2], 'termoHead_4' => $UserRoomTempAr[3], 'OutDoorTemp' => $outDoorTempNow, 'FloorInTemp' => $floorInTemp]);

        else ReferenceTemp::where('OutDoorTemp', $outDoorTempNow)->where('FloorInTemp', $floorInTemp)->update(['termoHead_1' => $UserRoomTempAr[0], 'termoHead_2' => $UserRoomTempAr[1], 'termoHead_3' => $UserRoomTempAr[2], 'termoHead_4' => $UserRoomTempAr[3]]);

    }


    public function getDutyCircleNextRound($outweather, $floorInTemp)
    {
        $nextStage = ReferenceTemp::select('termoHead_1', 'termoHead_2', 'termoHead_3', 'termoHead_4')
            ->where('OutDoorTemp', $outweather)
            ->where('FloorInTemp', $floorInTemp)
            ->toBase()
            ->first();

        if(empty($nextStage)) {
            $nextStage['termoHead_1'] = 5 ;
            $nextStage['termoHead_2'] = 5 ;
            $nextStage['termoHead_3'] = 5 ;
            $nextStage['termoHead_4'] = 5 ;

        }

        $i = 1;

        foreach ($nextStage as $value){

            self::setDutyCircle($i, $value);
            $i++;

        }

        return true;
    }

    public function setReferenceTemp($termoHead_1, $termoHead_2, $termoHead_3, $termoHead_4, $outweather)
    {
        $outDoorTempNow = $outweather->weather->temp;
       $hasReferenceTemp = ReferenceTemp::select('termoHead_1', 'termoHead_2', 'termoHead_3', 'termoHead_4')->where("OutDoorTemp", $outDoorTempNow)->get(1);

        if($hasReferenceTemp)  ReferenceTemp::where("OutDoorTemp", $outDoorTempNow)->update(['termoHead_1' => $termoHead_1, 'termoHead_2' => $termoHead_2, 'termoHead_3' => $termoHead_3, 'termoHead_4' => $termoHead_4]);
        else ReferenceTemp::insert(['termoHead_1' => $termoHead_1, 'termoHead_2' => $termoHead_2, 'termoHead_3' => $termoHead_3, 'termoHead_4' => $termoHead_4, 'OutDoorTemp' => $outDoorTempNow]);
        return true;
    }


    public function setDutyCircle($id, $WorkOnCircle )
    {
        DutyCycle::find($id)->update(['WorkOnCircle' => 0]);
        DutyCycle::find($id)->update(['WorkOnCircle' => $WorkOnCircle]);
        return true;
    }

    public function setTermoHeadsStatuses($dutyCircleOff)
    {


        $NowDutyCycles = DutyCycle::get()->all();

        foreach ($NowDutyCycles as $NowDutyCycle) {

             $timeIsOf = $NowDutyCycle->updated_at->addMinute($NowDutyCycle->WorkOnCircle);
             if($timeIsOf->greaterThanOrEqualTo(Carbon::now())){

             TermoHead::find($NowDutyCycle->id)->update(['Status' => 1]);
             }
            else TermoHead::find($NowDutyCycle->id)->update(['Status' => 0]);

        }

            return true;
    }




}
