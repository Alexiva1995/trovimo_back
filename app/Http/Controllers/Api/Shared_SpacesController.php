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
use App\Models\Viewed;
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
                $name = 'image_' . $request->shared_space . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/shared_spaces/images/', $name);

                $shared_space = Shared_space::find($request->shared_space_id);
                $photos = json_decode($shared_space->photos);
                array_push($photos, $name);
                $shared_space->photos = json_encode($photos);
                $shared_space->save();
            }
            return response()->json(['message' => 'success'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'error'], 500);
        }
    }

    public function add_video_shared_space(Request $request)
    {
        $request->validate([
            'shared_space_id' => 'required',
            'type' => 'required',
        ]);
        try {

            if ($request->hasFile('video')) {
                $file = $request->file('video');
                $name = 'video_' . $request->shared_space_id . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/shared_spaces/videos/', $name);
                $url = "https://trovimo.com/";
                $shared_space = Shared_space::find($request->shared_space_id);
                $videos = json_decode($shared_space->videos);
                array_push($videos, $url . $name);
                $shared_space->videos = json_encode($videos);
                $shared_space->save();
            } else {
                $shared_space = Shared_space::find($request->shared_space_id);
                $videos = json_decode($shared_space->videos);
                array_push($videos, $request->video);
                $shared_space->videos = json_encode($videos);
                $shared_space->save();
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
            return response()->json([
                'place_equiment' => $place_equipments, 'preferences' => $preferences,
                'place_details' => $place_details
            ], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }

    public function search(Request $request)
    {
        try {
            $Shared_Spaces = Shared_Space::address($request->address)
                ->type($request->type)
                ->price($request->pricemin, $request->pricemax)
                ->Furnished($request->furnished)
                ->Pets($request->pets)
                ->Bathrooms($request->bath)
                ->get();

            if (!is_null($request->amenities)) {
                $shared = collect();
                foreach ($Shared_Spaces as $possible) {
                    $check = DB::table('shared_spaces_place_details')
                        ->where('shared_space_id', '=', $possible->id)
                        ->whereIn('coworking_place_details_id', $request->amenities)
                        ->count();
                    if ($check > 0) {
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
            $shared_space = Shared_space::where('id', '=', $request->shared_space_id)->with('equiments', 'preferences', 'amenities', 'plans')->get();
            $favorite = Favorite::where('shared_space_id', '=', $request->shared_space_id)
                ->where('user_id', '=', $request->user()->id)->get();
            $shared_space->favorite = $favorite;
            //guardando como visto
            $viewed = Viewed::where('user_id', '=', $request->user()->id)
                ->where('shared_space_id', '=', $request->shared_space_id)->count();
            if ($viewed < 1) {
                $view =  new Viewed();
                $view->user_id = $request->user()->id;
                $view->shared_space_id = $request->shared_space_id;
                $view->save();
            }
            return response()->json(['shared_spaces' => $shared_space], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }

    public function updated_shared_space(Request $request)
    {
        $request->validate([
            'price' => 'required', 'description' => 'required', 'country' => 'required', 'city' => 'required',
            'postal_code' => 'required', 'lat' => 'required', 'lon' => 'required', 'tour' => 'required', 'name' => 'required',
            'email' => 'required', 'phone' => 'required', 'category_id' => 'required', 'shared_space_id' => 'required',
        ]);
        try {
            $shared_space = Shared_space::find($request->shared_space_id);
            $shared_space->fill($request->all());
            $shared_space->save();
            return response()->json(['message' => $shared_space], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }

    public function updated_photo_shared_space(Request $request)
    {
        $request->validate(['photo_name' => 'required', 'photo' => 'required']);
        try {
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $file->move(public_path() . '/uploads/shared_space/images/', $request->photo_name);
            }
            return response()->json(['message' => 'success'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'error'], 500);
        }
    }

    public function updated_video_shared_space(Request $request)
    {
        try {
            $request->validate([
                'video_id' => 'required',
            ]);
            $video = Product_video::where('shared_space_id', '=', $request->video_id);
            if ($request->hasFile('video')) {
                $file = $request->file('video');
                $file->move(public_path() . '/uploads/shared_space/videos/', $video->name);
            } else {
                $video->fill($request->all());
                $video->save();
            }
            return response()->json(['message' => 'Success'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'error'], 500);
        }
    }
}
