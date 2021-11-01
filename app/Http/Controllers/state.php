<?php

namespace App\Http\Controllers;

use App\Http\Controllers\box\BoxController;


class state extends Box
{
public $donat;

public function __construct($boxArg)
{

    if ($boxArg->gasim){

        $boxArg->donat = new donat();

       return ($boxArg->donat->blind($boxArg->token));

    }

  //return    $donat->get($boxArg);
}




}
