<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DutyCycle extends Model
{
    use HasFactory;



    protected $fillable = [
        'updated_at',
        'WorkOnCircle'

    ];
    public function getCircle($id){
        return DutyCycle::select('WorkOnCircle')->where('id',$id);

    }

    public function updateOrInsert($id){




    }
}
