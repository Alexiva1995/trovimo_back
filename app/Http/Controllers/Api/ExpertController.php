<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\favorite;
use App\Models\Property;
use App\Models\additional_service;
use App\Models\Expert_profile;
use App\Models\Project_professional_group;
use App\Models\Project_details_name;
use App\Models\Home_detail;
use App\Models\Project;
use App\Models\Product_image;
use App\Models\Product_video;
use App\Models\Reference_point;
use Storage;
use DB;



class ExpertController extends Controller
{
    public function search(Request $request){
        try{
            $expert = Expert_profile::address($request->address)->areas($request->areas)
            ->verified($request->verified)->Type_Expert($request->type_expert)->Availability($request->availability)->with('user')->get();
                return response()->json(['experts' => $expert], 200); 
                       
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }

    }

}