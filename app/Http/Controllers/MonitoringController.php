<?php

namespace App\Http\Controllers;

use App\Models\Temp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MonitoringController extends Controller
{

    protected $sireal;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function pushTemp()
    {

          if(empty($this->request->get('tempC'))){
              $floorTemp = '10';
          }
          else $floorTemp = $this->request->get('tempC');
         $Temp = Temp::create([
        'T1' => $this->request->get('t2'),
        'H1' => $this->request->get('h2'),
        'T2' => $this->request->get('t'),
        'H2' => $this->request->get('h'),
        'T_pola_1' => $floorTemp,
        'PPM' => $this->request->get('gasValue'),
    ]);



        if($Temp) {
            $this->outTemp = new ApiYandexWeather;
            $this->outTemp->getWeather();
            $this->calculation = new Device;
            $this->calculation->CalculationNewStage($this->outTemp);
            echo 'create';
        }

        else echo 'bad';
    }

}
