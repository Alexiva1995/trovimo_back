<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Recommendation;
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


class ProductController extends Controller
{

    public function create(Request $request){
        try{
            $shared_space= new Shared_space($request->all());
            $shared_space->save();
            return response()->json(['message' => $shared_space], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }

    public function Add_photo_product(Request $request){
        $request->validate(['shared_space_id'=> 'required', 'photo' => 'required']);
        try{
            if ($request->hasFile('photo')){
                $file = $request->file('photo');
                $name = 'image_'.$request->product_id.time().'.'.$file->getClientOriginalExtension();
                $file->move(public_path().'/uploads/images/products', $name);
                $photo= new Product_image();
                $photo->url= $name;
                $photo->shared_space_id= $request->shared_space_id;
                $photo->save();
            }
            return response()->json(['message' => 'success'], 200);
        }catch (Exception $e) {
            return response()->json(['message' => 'error'], 500);
        } 
    }

    public function Add_video_product(Request $request){
        try {
            $request->validate([
                'shared_space_id' => 'required',
                'video'  => 'required',
                'type' => 'required',
            ]);
            if ($request->hasFile('video')) {
                $file = $request->file('video');
                $name = 'video_'.$request->product_id.time().'.'.$file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/products/videos/', $name);
                
                $video = new Product_video();
                $video->url = $name;
                $video->shared_space_id = $request->shared_space_id;
                $video->type=$request->type;
                $video->save();
            }
            return response()->json(['message' => 'Success'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'error'], 500);
        }
    }

    public function show_place_equipment(Request $request){
        try{
            $place_equipment= Shared_office_place_equipment::get();
            return response()->json(['message' => $place_equipment], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }

    public function show_preference(Request $request){
        try{
            $preference= Shared_office_preference::get();
            return response()->json(['message' => $preference], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }

    public function show_place_detail(Request $request){
        try{
            $place_detail= Coworking_place_detail::get();
            return response()->json(['message' => $place_detail], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }

    public function create_plans_coworking(Request $request){
        $request->validate([
            'shared_space_id' => 'required',
            'name' => 'required',
            'price'  => 'required',
        ]);
        try{
            $plan= new Shared_space_plan($request->all());
            $plan->shared_space_id= $request->shared_space_id;
            $plan->save();
            return response()->json(['message' => $plan], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }
}
