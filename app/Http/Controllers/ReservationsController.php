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
    public function deleteReservation(Request $request, $id, $reservationid)
    {
        DB::table('reservations')->where('shop_id', $id)->where('user_id', $request->user_id)->where('id', $reservationid)->delete();
        return response()->json([
            'message' => 'Reservaiton deleted successfully',
        ], 200);
    }
    public function getReservations($id)
    {
        if ($id) {
            $reservationItems = DB::table('reservations')->where('user_id', $id)->get();
            foreach ($reservationItems as $reservationItem) {
                $shopItems = DB::table('shops')->where('id', $reservationItem->shop_id)->first();
                $evaluationsItems = DB::table('evaluations')->where('user_id', $id)->where('shop_id', $reservationItem->shop_id)->first();
                if ($evaluationsItems === null) {
                    $param = [
                        "user_id" => $id,
                        "shop_id" => $reservationItem->shop_id,
                        "num_of_stars" => "0",
                    ];
                    DB::table('evaluations')->insert($param);
                }
                $userItems = DB::table('users')->where('id', $reservationItem->user_id)->first();
                $areaItems = DB::table('areas')->where('id', $shopItems->area_id)->first();
                $genreItems = DB::table('genres')->where('id', $shopItems->genre_id)->first();
                $reservationItem->shop_name = $shopItems->name;
                $reservationItem->shop_img = $shopItems->img;
                $reservationItem->user_name = $userItems->name;
                $reservationItem->area_name = $areaItems->name;
                $reservationItem->genre_name = $genreItems->name;
                $reservationItem->num_of_stars = $evaluationsItems->num_of_stars;
            }
            return response()->json([
                'message' => 'Reservations got successfully',
                'data' => $reservationItems
            ], 200);
        } else {
            return response()->json(['status' => 'not found'], 404);
        }   
    }

    public function putReservation(Request $request, $id, $shopid)
    {
        $param = [
            'reserved_at' => $request->reserved_at,
            'num_of_users' => $request->num_of_users
        ];
        DB::table('reservations')->where('user_id', $id)->where('shop_id', $shopid)->where('id', $request->id)->update($param);
        return response()->json([
            'message' => 'Reservation updated successfully',
            'data' => $param
        ], 200);
    }

    public function getReservation($id, $shopid, $reservationid)
    {
        if ($id) {
            $reservationItems = DB::table('reservations')->where('user_id', $id)->where('shop_id', $shopid)->where('id', $reservationid)->get();
            foreach ($reservationItems as $reservationItem) {
                $shopItems = DB::table('shops')->where('id', $reservationItem->shop_id)->first();
                $userItems = DB::table('users')->where('id', $reservationItem->user_id)->first();
                $areaItems = DB::table('areas')->where('id', $shopItems->area_id)->first();
                $genreItems = DB::table('genres')->where('id', $shopItems->genre_id)->first();
                $reservationItem->shop_name = $shopItems->name;
                $reservationItem->shop_img = $shopItems->img;
                $reservationItem->user_name = $userItems->name;
                $reservationItem->area_name = $areaItems->name;
                $reservationItem->genre_name = $genreItems->name;
            }
            return response()->json([
                'message' => 'Reservation got successfully',
                'data' => $reservationItems
            ], 200);
        } else {
            return response()->json(['status' => 'not found'], 404);
        }
    }
}