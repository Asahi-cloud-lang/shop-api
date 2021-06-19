<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EvaluationsController extends Controller
{
    public function postEvaluations(Request $request, $id, $shopid)
    {
        $param = [
            "shop_id" => $shopid,
            "user_id" => $id,
            "num_of_stars" => $request->num_of_stars,
        ];
        DB::table('evaluations')->insert($param);
        return response()->json([
            'message' => 'Evaluation created successfully',
            'data' => $param
        ], 200);
    }
    
    public function putEvaluation(Request $request, $id, $shopid)
    {
        $param = [
            'num_of_stars' => $request->num_of_stars
        ];
        DB::table('evaluations')->where('user_id', $id)->where('shop_id', $shopid)->update($param);
        return response()->json([
            'message' => 'evaluation updated successfully',
            'data' => $param
        ], 200);
    }

}
