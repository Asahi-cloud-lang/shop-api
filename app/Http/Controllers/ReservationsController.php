<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationsController extends Controller
{
    public function postReservation(Request $request, $id)
    {
        $param = [
            "shop_id" => $id,
            "user_id" => $request->user_id,
            "num_of_users" => $request->num_of_users,
            "reserved_at" => $request->reserved_at,
        ];
        DB::table('reservations')->insert($param);
        return response()->json([
            'message' => 'Reservation created successfully',
            'data' => $param
        ], 200);
    }
    public function deleteReservation(Request $request, $id)
    {
        DB::table('reservations')->where('shop_id', $id)->where('id', $request->reservation_id)->delete();
        return response()->json([
            'message' => 'Reservaiton deleted successfully',
        ], 200);
    }
    public function getReservations($id)
    {
        if ($id) {
            $reservationItems = DB::table('reservations')->where('user_id', $id)->get();
            return response()->json([
                'message' => 'Reservations got successfully',
                'data' => $reservationItems
            ], 200);
        } else {
            return response()->json(['status' => 'not found'], 404);
        }   
    }
}