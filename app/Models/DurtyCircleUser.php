<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DurtyCircleUser extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'created_at',
        'updated_at',
        'WorkOnCircle',
        'room'
    ];


    public function room()
    {
        return $this->hasOne(RoomName::class, 'id');
    }


}
