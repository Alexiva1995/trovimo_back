<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Recommendation;

class UserController extends Controller
{

    public function recommendation(Request $request){
        $request->validate([
            'recommendation'    => 'required',
        ]);
        try{
            $recommendation = new Recommendation($request->all());
            $recommendation->user_id = $request->user()->id;
            $recommendation->recommendation = $request->recommendation;
            $recommendation->save();
            return response()->json(['message' => 'Success'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }


}
