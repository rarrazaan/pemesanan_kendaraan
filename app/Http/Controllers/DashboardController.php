<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $title = "Halaman Dashboard";

        $get_vehicle = [];
        $get_total = [];

        $get_top_vehicle = 
        // DB::select('SELECT v.id, COUNT(b.id) as total
        // FROM
        //     vehicles v LEFT JOIN
        //     bookings b ON v.id = b.vehicle_id
        // WHERE b.is_approved IS TRUE
        // GROUP BY v.id;');
        Booking::selectRaw("vehicle_id, COUNT(id) as total")
            ->where('is_approved', '=', TRUE)
            ->with('vehicle')
            ->groupBy('vehicle_id')
            ->get()
            ->sortByDesc('total')
            // ->take(5)
            ->toArray();

        foreach ($get_top_vehicle as $vehicle){
            $get_total[] = $vehicle['total'];
            $get_vehicle[] = substr(trim(str_replace(
                "Vehicle", "", $vehicle['vehicle']['name'])), 0, 15
            ).$vehicle['vehicle']['id'];
        }

        $booking = Booking::with('peminjam', 'approver', 'vehicle', 'driver')->latest()->get();

        return view('dashboard', compact(
            'title', 'booking',
            'get_vehicle', 'get_total'
        ));
    }
    public function daftarKendaraan()
    {
        $title = "Daftar Pemesanan Kendaraan yang Membutuhkan Persetujuan";
        // $booking = DB::table('bookings')
        // ->leftJoin('users', 'users.id', '=', 'bookings.approver_id')
        // ->select('*')
        // ->whereRaw('')
        // ->get();
        $vehicles = Vehicle::all();

        return view('vehicles', compact(
            'title', 'vehicles',
        ));
    }
}