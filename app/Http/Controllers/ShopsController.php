<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Shop::all();
        return response()->json([
            'message' => 'OK',
            'data' => $items
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        $item = Shop::where('name', $shop->name)->first();
        $user_id = $item->user_id;
        $user = DB::table('users')->where('id', (int)$user_id)->first();
        $comment = DB::table('comments')->where('share_id', $share->id)->get();
        $comment_data = array();
        if (empty($comment->toArray())) {
            $items = [
                "item" => $item,
                "like" => $like,
                "comment" => $comment_data,
                "name" => $user->name,
            ];
            return response()->json($items, 200);
        }
        foreach ($comment as $value) {
            $comment_user = DB::table('users')->where('id', $value->user_id)->first();
            $comments = [
                "comment" => $value,
                "comment_user" => $comment_user
            ];
            array_push($comment_data, $comments);
        }
        $items = [
            "item" => $item,
            "like" => $like,
            "comment" => $comment_data,
            "name" => $user->name,
        ];
        return response()->json($items, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        //
    }
}
