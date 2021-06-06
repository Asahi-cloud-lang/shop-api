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
            foreach ($likeItems as $likeItem) {
                $shopItems = DB::table('shops')->where('id', $likeItem->shop_id)->first();
                $userItems = DB::table('users')->where('id', $id)->first();
                $areaItems = DB::table('areas')->where('id', $shopItems->area_id)->first();
                $genreItems = DB::table('genres')->where('id', $shopItems->genre_id)->first();
                $likeItem->shop_name = $shopItems->name;
                $likeItem->shop_img = $shopItems->img;
                $likeItem->user_name = $userItems->name;
                $likeItem->area_name = $areaItems->name;
                $likeItem->genre_name = $genreItems->name;
            }
            return response()->json([
                'message' => 'Likes got successfully',
                'data' => $likeItems
            ], 200);
        } else {
            return response()->json(['status' => 'not found'], 404);
        }
    }
}
