<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReservationsController extends Controller
{
    public function post(Request $request)
    {
        $now = Carbon::now();
        $param = [
            "shop_id" => $request->shop_id,
            "user_id" => $request->user_id,
            "num_of_users" => $request->number,
            "reserved_at" => $request->date,
            "created_at" => $now,
            "updated_at" => $now
        ];
        DB::table('reservations')->insert($param);
        return response()->json([
            'message' => 'Reservation created successfully',
            'data' => $param
        ], 200);
    }
    public function delete(Request $request)
    {
        DB::table('reservations')->where('shop_id', $request->shop_id)->where('user_id', $request->user_id)->delete();
        return response()->json([
            'message' => 'Reservaiton deleted successfully',
        ], 200);
    }
}