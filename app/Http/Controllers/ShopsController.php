<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ShopsController extends Controller
{
    public function getShops(){
        $shops = DB::table('shops')->get();
        foreach( $shops as $shop ){
            $areaItems = DB::table('areas')->where('id', $shop->area_id)->first();
            $genreItems = DB::table('genres')->where('id', $shop->genre_id)->first();
            $likeItems = DB::table('likes')->where('shop_id', $shop->id)->get();
            $shop->area_name = $areaItems->name;
            $shop->genre_name = $genreItems->name;
            $shop->likes = $likeItems;       
        }
        return response()->json([
            'message' => 'Shops got successfully',
            'data' => $shops
        ], 200);
    }
    public function getShop($id){
        if ($id) {
            $shopItems = DB::table('shops')->where('id', $id)->first();
            $areaItems = DB::table('areas')->where('id', $shopItems->area_id)->first();
            $genreItems = DB::table('genres')->where('id', $shopItems->genre_id)->first();
            $likeItems = DB::table('likes')->where('shop_id', $shopItems->id)->get();
            $shopItems->area_name = $areaItems->name;
            $shopItems->genre_name = $genreItems->name;
            $shopItems->likes = $likeItems;
            return response()->json([
                'message' => 'Shop got successfully',
                'data' => $shopItems
            ], 200);
        } else {
            return response()->json(['status' => 'not found'], 404);
        }
    }
}
