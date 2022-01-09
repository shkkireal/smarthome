<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DutyCycle extends Model
{
    use HasFactory;

    public function getCircle($id){
        return DutyCycle::select('WorkOnCircle')->where('id',$id);

    }

    public function updateOrInsert($id){




    }
}
