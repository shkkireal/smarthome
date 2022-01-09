<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermoHead extends Model
{
    use HasFactory;

    protected $fillable = [
        'Status',
        'updated_at',
        'HeadNomber'

    ];
}
