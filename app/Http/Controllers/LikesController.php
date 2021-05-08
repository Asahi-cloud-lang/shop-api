<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LikesController extends Controller
{
    public function postLike(Request $request, $id)
    {
        $param = [
            "shop_id" => $id,
            "user_id" => $request->user_id,
        ];
        DB::table('likes')->insert($param);
        return response()->json([
            'message' => 'Like created successfully',
            'data' => $param
        ], 200);
    }
    public function deleteLike(Request $request, $id)
    {
        DB::table('likes')->where('shop_id', $id)->where('user_id', $request->user_id)->delete();
        return response()->json([
            'message' => 'Like deleted successfully',
        ], 200);
    }
    public function getLikes($id)
    {
        if ($id) {
            $likeItems = DB::table('likes')->where('user_id', $id)->get();
            return response()->json([
                'message' => 'Likes got successfully',
                'data' => $likeItems
            ], 200);
        } else {
            return response()->json(['status' => 'not found'], 404);
        }
    }
}
