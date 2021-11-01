<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DriverController extends Controller
{
    //
    protected $sireal;
    /**
     * @var Device
     */
    public $device;

    /**
     * @var Device
     */


    public function __construct()
    {


    }

    public function box_reqest(Request $request)
    {
       $this->device = new Device();

      return view('answer_box', ['deviceAnswer'=>$this->device->Answer()]);
    }
}
