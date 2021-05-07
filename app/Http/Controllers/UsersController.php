<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function get(Request $request)
    {
        if ($request->has('email')) {
            $useritems = DB::table('users')->where('email', $request->email)->get();
            return response()->json([
                'message' => 'User got successfully',
                'data' => $useritems
            ], 200);
        } else {
            return response()->json(['status' => 'not found'], 404);
        }
        if ($request->has('id')) {
            $reservationitems = DB::table('reservations')->where('user_id', $request->id)->get();
            return response()->json([
                'message' => 'Reservation got successfully',
                'data' => $reservationitems
            ], 200);
        } else {
            return response()->json(['status' => 'not found'], 404);
        }
        if ($request->has('id')) {
            $likeitems = DB::table('likes')->where('user_id', $request->id)->get();
            return response()->json([
                'message' => 'Like got successfully',
                'data' => $likeitems
            ], 200);
        } else {
            return response()->json(['status' => 'not found'], 404);
        }
    }
}
