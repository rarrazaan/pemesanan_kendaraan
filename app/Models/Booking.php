<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    public $fillable = ['driver_id', 'vehicle_id', 'peminjam_id', 'approver_id', 'is_approved', 'need_approval', 'start_book', 'end_book'];

    public function driver(){
        return $this->hasOne(Driver::class, 'id', 'driver_id');
    }
    public function vehicle(){
        return $this->hasOne(Vehicle::class, 'id', 'vehicle_id');
    }
    public function peminjam(){
        return $this->hasOne(User::class, 'id', 'peminjam_id');
    }
    public function approver(){
        return $this->hasOne(User::class, 'id', 'approver_id');
    }
}