<?php

namespace App\Http\Controllers;

use App\Models\DurtyCircleUser;
use App\Models\DutyCycle;
use App\Models\ReferenceTemp;
use App\Models\Temp;
use App\Models\TermoHead;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
   $this->request = $request;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        if($request->ajax()){
            if($request->RangeId){
                $circleId = $request->RangeId;
                $circleStatus = $request->RangeVal;
                $userChangeFillTemp = DurtyCircleUser::where('id', $circleId)->update(['WorkOnCircle' =>  $circleStatus]);
                return $userChangeFillTemp;
            }
            if($request->changeTargetTemp){
               $targetTemp = $request->changeTargetTemp;

              $changeTargetTemp = ReferenceTemp::create(['CityInTemp'=> 1, 'CityOutTemp'=>'1','FloorInTemp'=>$targetTemp,'FloorOutTemp'=>'0']);
              return $changeTargetTemp;

            }

            return redirect()->action('DriverController@box_reqest');
        }
        elseif($this->request->request->has('sireal'))
        {
           return redirect()->action('MonitoringController@pushTemp');

        }
        else {

            $TermHeadStatus = TermoHead::Select('*')->OrderBy('id', 'DESC')->take('4')->get();
            $homeTemp = Temp::Select('*')->OrderBy('id', 'DESC')->take('1')->get();
            $DutyCircleStatus = DutyCycle::Select('*')->OrderBy('id', 'DESC')->take('4')->get();
            $referenceTemp = ReferenceTemp::Select('*')->OrderBy('id', 'DESC')->take('1')->get();
            $durtyCircleUserStatus = DurtyCircleUser::Select('*')->OrderBy('id', 'DESC')->take('4')->get();
            $outDoorTemp = ReferenceTemp:: Select('OutDoorTemp')->OrderBy('updated_at', 'DESC')->take('1')->toBase()->get()[0];

            return view('home', [

                'HomeTemp' => $homeTemp,
                'TermHeadStatus' => $TermHeadStatus,
                'DutyCircleStatus' => $DutyCircleStatus,
                'DutyRoundOff' => $DutyCircleStatus[0]->updated_at->addMinute(10),
                'time' => Carbon::now(),
                'referenceTemp' => $referenceTemp,
                'durtyCircleUserStatus' => $durtyCircleUserStatus,
                'outDoorTemp' => $outDoorTemp



            ]);
        }
    }
}
