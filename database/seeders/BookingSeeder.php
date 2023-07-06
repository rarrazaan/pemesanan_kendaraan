<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'vehicle_id' => 1,
                'driver_id' => 1,
                'peminjam_id' => 6,
                'approver_id' => 1,
                'is_approved' => False,
                'need_approval' => True,
                'start_book' => '2023-07-07 17:48:08',
                'end_book' => '2023-07-12 17:48:08',
            ],
            [
                'vehicle_id' => 2,
                'driver_id' => 2,
                'peminjam_id' => 9,
                'approver_id' => 2,
                'is_approved' => False,
                'need_approval' => True,
                'start_book' => '2023-07-06 17:48:08',
                'end_book' => '2023-07-09 17:48:08',
            ],
            [
                'vehicle_id' => 3,
                'driver_id' => 3,
                'peminjam_id' => 13,
                'approver_id' => 2,
                'is_approved' => False,
                'need_approval' => True,
                'start_book' => '2023-07-14 17:48:08',
                'end_book' => '2023-07-24 17:48:08',
            ],
            [
                'vehicle_id' => 7,
                'driver_id' => 4,
                'peminjam_id' => 18,
                'approver_id' => 20,
                'is_approved' => True,
                'need_approval' => True,
                'start_book' => '2023-07-09 17:48:08',
                'end_book' => '2023-07-14 17:48:08',
            ],
            [
                'vehicle_id' => 4,
                'driver_id' => 5,
                'peminjam_id' => 18,
                'approver_id' => 14,
                'is_approved' => False,
                'need_approval' => False,
                'start_book' => '2023-07-11 17:48:08',
                'end_book' => '2023-07-22 17:48:08',
            ],
            [
                'vehicle_id' => 5,
                'driver_id' => 9,
                'peminjam_id' => 12,
                'approver_id' => 20,
                'is_approved' => True,
                'need_approval' => False,
                'start_book' => '2023-07-25 17:48:08',
                'end_book' => '2023-07-29 17:48:08',
            ],
        ];
        Booking::insert($data);
    }
}