<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function getUser($id)
    {
        if ($id) {
            $userItems = DB::table('users')->where('id', $id)->get();
            return response()->json([
                'message' => 'User got successfully',
                'data' => $userItems
            ], 200);
        } else {
            return response()->json(['status' => 'not found'], 404);
        }
    }
}
