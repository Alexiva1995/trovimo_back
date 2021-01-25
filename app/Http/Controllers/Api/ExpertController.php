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
    public function create_expert_profile(Request $request){
        $request->validate(['user_id' => 'required','areas' => 'required', 'about_us' => 'required',
        'phones' => 'required','address' => 'required',
        '24/7' => 'required',]);
      try {
            $expert = new Expert_profile($request->all());
            $expert->user_id= $request->user()->id;
            $expert->save();
            //cargamos la imagen
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $name = 'image_' . $request->expert_id . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/experts_profile/images/', $name);
                $expert->picture_profile = $name;
                $expert->save();
            }
            return response()->json(['message' => 'Success'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }
    public function add_photo_expert_profile(Request $request)
    {
        $request->validate(['expert_id' => 'required', 'photo' => 'required']);
        try {
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $name = 'image_' . $request->expert_id . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/experts_profile/cover_pictures/', $name);

                $expert = Expert_profile::find($request->expert_id);
                $photos = json_decode($expert->cover_picture);
                array_push($photos,$name);
                $expert->cover_picture = json_encode($photos);
                $expert->save();
            }
            return response()->json(['message' => 'Success'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'error'], 500);
        }
    }
}