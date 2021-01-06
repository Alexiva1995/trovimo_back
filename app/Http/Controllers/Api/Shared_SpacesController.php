<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\favorite;
use App\Models\Product;
use App\Models\additional_service;
use App\Models\building_detail;
use App\Models\Category;
use App\Models\Home_detail;
use App\Models\Option;
use App\Models\Product_image;
use App\Models\Product_video;
use App\Models\Coworking_place_detail;
use App\Models\Shared_office_preference;
use App\Models\Shared_office_place_equipment;
use App\Models\Shared_space;
use App\Models\Shared_space_plan;
use Storage;
use DB;


class Shared_SpacesController extends Controller
{

    public function create_shared_space(Request $request)
    {
        $request->validate([
            'price' => 'required', 'description' => 'required', 'country' => 'required', 'city' => 'required',
            'postal_code' => 'required', 'lat' => 'required', 'lon' => 'required', 'tour' => 'required', 'name' => 'required',
            'email' => 'required', 'phone' => 'required', 'category_id' => 'required',
        ]);
        try {
            $shared_space = new Shared_space($request->all());
            $shared_space->user_id = $request->user()->id;
            $shared_space->save();
            if ($request->plans) {
                foreach ($request->plans as $p) {
                    $plan = new Shared_space_plan();
                    $plan->shared_space_id = $shared_space->id;
                    $plan->name = $p[0];
                    $plan->price = $p[1];
                    $plan->description = $p[2];
                    $plan->save();
                }
            }
            return response()->json(['message' => $shared_space], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }

    public function add_photo_shared_space(Request $request)
    {
        $request->validate(['shared_space_id' => 'required', 'photo' => 'required']);
        try {
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $name = 'image_' . $request->shared_space_id . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/shared_space/images/', $name);
                $photo = new Product_image();
                $photo->url = $name;
                $photo->shared_space_id = $request->shared_space_id;
                $photo->save();
            }
            return response()->json(['message' => 'success'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'error'], 500);
        }
    }

    public function add_video_shared_space(Request $request)
    {
        try {
            $request->validate([
                'shared_space_id' => 'required',
                'type' => 'required',
            ]);
            if ($request->hasFile('video')) {
                $file = $request->file('video');
                $name = 'video_' . $request->shared_space_id . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/shared_space/videos/', $name);

                $video = new Product_video();
                $video->url = $name;
                $video->shared_space_id = $request->shared_space_id;
                $video->type = $request->type;
                $video->save();
            } else {
                $video = new Product_video();
                $video->url = $request->url;
                $video->shared_space_id = $request->shared_space_id;
                $video->type = $request->type;
                $video->save();
            }
            return response()->json(['message' => 'Success'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'error'], 500);
        }
    }

    public function create_optional(Request $request)
    {

        $request->validate([
            'shared_space_id' => 'required',
            'place_equiments' => 'required',
            'preferences' => 'required',
            'place_details' => 'required',

        ]);

        try {
            $date = date('Y-m-d H:i:s');
            foreach ($request->place_equiments as $equiment) {
                DB::table('shared_spaces_place_equipment')->insert([
                    'shared_space_id' => $request->shared_space_id,
                    'shared_office_place_equipment_id' => $equiment,
                    'created_at' =>  $date,
                    'updated_at' =>  $date
                ]);
            }

            foreach ($request->preferences as $preference) {
                DB::table('shared_spaces_preferences')->insert([
                    'shared_space_id' => $request->shared_space_id,
                    'shared_office_preference_id' => $preference,
                    'created_at' =>  $date,
                    'updated_at' =>  $date
                ]);
            }

            foreach ($request->place_details as $detail) {
                DB::table('shared_spaces_place_details')->insert([
                    'shared_space_id' => $request->shared_space_id,
                    'coworking_place_details_id' => $detail,
                    'created_at' =>  $date,
                    'updated_at' =>  $date
                ]);
            }

            return response()->json(['message' => 'success'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }

    public function show_optional_options(Request $request)
    {
        try {
            $place_equipments = Shared_office_place_equipment::get();
            $preferences = Shared_office_preference::get();
            $place_details = Coworking_place_detail::get();
            return response()->json(['place_equiment' => $place_equipments, 'preferences' => $preferences,
             'place_details' => $place_details], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }

    public function search(Request $request){
        try{
                $Shared_Spaces = Shared_Space::address($request->address)
                            ->type($request->type)
                            ->price($request->pricemin, $request->pricemax)
                            ->Furnished($request->furnished)
                            ->Pets($request->pets)
                            ->Bathrooms($request->bath)
                            ->get();

                    if (!is_null($request->amenities)){   
                        $shared = collect();      
                        foreach ($Shared_Spaces as $possible){
                                    $check = DB::table('shared_spaces_place_details')
                                                ->where('shared_space_id', '=', $possible->id)
                                                ->whereIn('coworking_place_details_id', $request->amenities)
                                                ->count();
                                    if($check>0){
                                        $shared->push($possible);
                                    }
                        }
                        return response()->json(['shared_spaces' => $shared], 200); 
                    }
            return response()->json(['shared_spaces' => $Shared_Spaces], 200);                    
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }

    }

    public function show(Request $request)
    {
        $request->validate(['shared_space_id' => 'required']);
        try {
            $shared_space = Shared_space::where('id', '=', $request->shared_space_id)->with('photos', 'videos','equiments', 'preferences', 'amenities', 'plans')->get();
            $favorite = Favorite::where('shared_space_id', '=', $request->shared_space_id)
                ->where('user_id', '=', $request->user()->id)->get();
            $shared_space->favorite = $favorite;
            return response()->json(['shared_spaces' => $shared_space], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }
}
