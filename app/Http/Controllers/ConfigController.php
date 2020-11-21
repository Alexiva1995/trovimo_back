<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Today_coin;

class ConfigController extends Controller
{

    public function update_coin(Request $request){

        try{
            $coin = Today_coin::find(1);
            $coin->fill($request->all());
            $coin->save();
            return response()->json(['message' => 'Success'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }


}
