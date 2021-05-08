<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ShopsController extends Controller
{
    public function getShops(){
        $shops = DB::table('shops')->get();
        $genres = DB::table('genres')->get();
        $areas = DB::table('areas')->get();
        return response()->json([
            'message' => 'Shops got successfully',
            'data' => $shops , $genres , $areas
        ], 200);
    }
    public function getShop($id){
        if ($id) {
            $shopItems = DB::table('shops')->where('id', $id)->get();
            $areaItems = DB::table('areas')->where('id', $shopItems->area_id)->get();
            $genreItems = DB::table('genres')->where('id', $shopItems->genre_id)->get();
            return response()->json([
                'message' => 'Shop got successfully',
                'data' => $shopItems, $areaItems, $genreItems
            ], 200);
        } else {
            return response()->json(['status' => 'not found'], 404);
        }
    }
}
