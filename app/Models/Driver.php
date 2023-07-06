<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    public $fillable = ['name', 'age'];

    public function booking(){
        return $this->hasOne(Booking::class, 'id', 'driver_id');
    }
}