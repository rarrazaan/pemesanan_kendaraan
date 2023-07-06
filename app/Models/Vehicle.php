<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    public $fillable = ['name', 'jenis_angkut', 'pemilik', 'konsumsi_BBM', 'jadwal_service', 'riwayat_pemakaian'];

    public function booking(){
        return $this->hasOne(Booking::class, 'id', 'vehicle_id');
    }
}