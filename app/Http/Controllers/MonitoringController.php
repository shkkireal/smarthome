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
         $Temp = Temp::create([
        'T1' => $this->request->get('t'),
        'H1' => $this->request->get('h'),
        'T2' => $this->request->get('t2'),
        'H2' => $this->request->get('h2'),
        'T_pola_1' => $this->request->get('tempC'),
        'PPM' => $this->request->get('gasValue'),
    ]);



        if($Temp) {
            $this->calculation = new Device;
            $this->calculation->CalculationNewStage();

            echo 'create';
        }

        else echo 'bad';
    }

}
