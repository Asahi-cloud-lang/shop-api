<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ShopsController extends Controller
{
    public function getShops(){
        $shops = DB::table('shops')->get();
        return response()->json([
            'message' => 'Shops got successfully',
            'data' => $shops
        ], 200);
        $areas = DB::table('areas')->get();
        return response()->json([
            'message' => 'Areas got successfully',
            'data' => $areas
        ], 200);
        $genres = DB::table('genres')->get();
        return response()->json([
            'message' => 'Genres got successfully',
            'data' => $genres
        ], 200);
    }
    public function getShop($id){
        if ($id) {
            $shopItems = DB::table('shops')->where('id', $id)->get();
            $areaItems = DB::table('areas')->where('id', $shopItems->area_id)->get();
            $genreItems = DB::table('genres')->where('id', $shopItems->genre_id)->get();
            return response()->json([
                'message' => 'Shop got successfully',
                'data' => $shopItems
            ], 200);
        } else {
            return response()->json(['status' => 'not found'], 404);
        }
    }
}
