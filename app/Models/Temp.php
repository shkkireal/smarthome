<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temp extends Model
{

    use HasFactory;
    protected $table ="HomeTemp";
    protected $fillable = [
        'T1',
        'H1',
        'T2',
        'H2',
        'T_pola_1',
        'PPM'
    ];
}
