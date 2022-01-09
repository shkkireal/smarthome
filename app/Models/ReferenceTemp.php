<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceTemp extends Model
{
    use HasFactory;

    protected $fillable = [
        'CityInTemp',
        'CityOutTemp',
        'FloorInTemp',
        'FloorOutTemp',
        'OutDoorTemp',
        'termoHead_1',
        'termoHead_2',
        'termoHead_3',
        'termoHead_4'


    ];
    public function updateOrInsert(){



    }
}
