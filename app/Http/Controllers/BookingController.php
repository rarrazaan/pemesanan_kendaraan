<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BookingRequest;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function form()
    {
        $title = 'Form Pemesanan Kendaraan';
        $method = 'post';
        $action = 'booking';
        $peminjamData['data'] = User::selectRaw("*")
        ->where('role_id', '=', 1)
        ->orWhere('role_id', '=', 2)
        ->get()
        ->sortBy('role_id');

        $drvData['data'] = Driver::selectRaw("name, id")
        ->get()
        ->sortBy('name');

        $vhcData['data'] = Vehicle::selectRaw("name, id")
        ->get()
        ->sortBy('name');

        return view('booking', compact('title', 'method', 'action', 'peminjamData', 'drvData', 'vhcData'));
    }

    public function getApprover($staffId){
        $minGrade = User::selectRaw('role_id')->where('id', $staffId)->get()[0]['role_id'] + 2;
        // Fetch Approver
        $aprData['data'] = User::orderby("name","asc")
        ->select('id','name')
        ->where('role_id', '>=',$minGrade)
        ->get();
    
        return response()->json($aprData);  
    }

    public function addBook(BookingRequest $request)
    {
        $data = $request->validated();

        Booking::create($data);
        Log::channel('process')->info("Pemesanan baru telah ditambahkan");
        return redirect('/dashboard')->with('message', 'Data booking berhasil ditambahkan');
    }

    public function approvalPage()
    {
        $title = "Daftar Pemesanan Kendaraan yang Membutuhkan Persetujuan";
        // $booking = DB::table('bookings')
        // ->leftJoin('users', 'users.id', '=', 'bookings.approver_id')
        // ->select('*')
        // ->whereRaw('')
        // ->get();
        $booking = Booking::selectRaw('*')
        ->with('approver')
        ->where('approver_id', '=', session()->get('user')->id)
        ->get();

        return view('approval', compact(
            'title', 'booking',
        ));
    }

    public function approve($id)
    {
        Booking::where('id', $id)->update(['is_approved' => 1, 'need_approval' => 0]);
        Log::channel('process')->info("Pemesanan dengan id {id} berhasil di-approve", ['id' => $id]);
        return redirect('/approvalPage')->with('message', 'Permohonan berhasil disetujui');
    }

    public function decline($id)
    {
        Booking::where('id', $id)->update(['is_approved' => 0, 'need_approval' => 0]);
        Log::channel('process')->info("Pemesanan dengan id {id} telah di-decline", ['id' => $id]);
        return redirect('/approvalPage')->with('message', 'Permohonan berhasil ditolak');
    }

    // public function getDriver(Request $request){
    // public function getDriver($start_date, $end_date){

    //     $s = gmdate("Y-m-d", $start_date);
    //     $e = gmdate("Y-m-d", $end_date);

    //     // Fetch Drivers
    //     $drvData['data'] = Driver::orderby("name","asc")
    //     ->select('id','name')
    //     ->whereNotIn('id', function($query)
    //     {
    //         // $start = $request->start;
    //         // $end = $request->end;
    //         $start = $s;
    //         $end = $e;
    //         $query->select(DB::raw('driver_id'))
    //         ->from('bookings')
    //         ->where([
    //             ['start_book', '>=', $start],
    //             ['start_book', '<=', $end],
    //         ])
    //         ->orWhere([
    //             ['start_book', '<=', $start],
    //             ['end_book', '>=', $end],
    //         ])
    //         ->orWhere([
    //             ['end_book', '>=', $start],
    //             ['end_book', '<=', $end],
    //         ]);
    //     })
    //     ->get();
    
    //     return response()->json($drvData);  
    // }

    
}