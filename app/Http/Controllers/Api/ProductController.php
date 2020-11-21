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
use App\Models\Reference_point;
use Storage;


class ProductController extends Controller
{

    public function options(Request $request){
        try{
            $options = Option::with('categories')->get();
            return response()->json(['message' => $options], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }

    public function create_product(Request $request){
        try{
            $product= new Product($request->all());
            $product->save();
            return response()->json(['message' => $product], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }

    public function Add_photo_product(Request $request){
        $request->validate(['product_id'=> 'required', 'photo' => 'required']);
        try{
            if ($request->hasFile('photo')){
                $file = $request->file('photo');
                $name = 'image_'.$request->product_id.time().'.'.$file->getClientOriginalExtension();
                $file->move(public_path().'/uploads/images/products', $name);
                
                $photo= new Product_image();
                $photo->url= $name;
                $photo->product_id= $request->product_id;
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
                'product_id' => 'required',
                'video'  => 'required',
                'type' => 'required',
            ]);
            if ($request->hasFile('video')) {
                $file = $request->file('video');
                $name = 'video_'.$request->product_id.time().'.'.$file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/products/videos/', $name);
                
                $video = new Product_video();
                $video->url = $name;
                $video->product_id = $request->product_id;
                $video->type=$request->type;
                $video->save();
            }
            return response()->json(['message' => 'Success'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'error'], 500);
        }
    }

    public function Add_service_product(Request $request){
        try{
            $service= new Additional_service($request->all());
            $service->save();
            return response()->json(['message' => $service], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }

    public function Add_reference_point(Request $request){
        try{
            $reference_point= new Reference_point($request->all());
            $reference_point->save();
            return response()->json(['message' => $reference_point], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }

}
