<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\Additional_service;
use App\Models\Building_detail;
use App\Models\Viewed;
use App\Models\Home_detail;
use App\Models\Option;
use App\Models\Product_image;
use App\Models\Product_video;
use App\Models\Reference_point;
use Storage;
use DB;


class ProductController extends Controller
{

    public function options(Request $request)
    {
        try {
            $options = Option::with('categories')->get();
            return response()->json(['message' => $options], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }

    public function create_product(Request $request)
    {
        $request->validate([
            'price' => 'required', 'show_price' => 'required', 'rooms' => 'required', 'bath' => 'required',
            'parking_spots' => 'required', 'n_pieces' => 'required', 'area' => 'required', 'year_built' => 'required',
            'year_remodeled' => 'required', 'description' => 'required', 'country' => 'required', 'city' => 'required',
            'postal_code' => 'required', 'lat' => 'required', 'lon' => 'required', 'tour' => 'required', 'name' => 'required',
            'email' => 'required', 'phone' => 'required', 'option_id' => 'required', 'category_id' => 'required',
        ]);
        try {
            $product = new Product($request->all());
            $product->user_id = $request->user()->id;
            $product->save();
            return response()->json(['message' => $product], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }

    public function add_photo_product(Request $request)
    {
        $request->validate(['product_id' => 'required', 'photo' => 'required']);
        try {
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $name = 'image_' . $request->product_id . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/products/images/', $name);

                $product = Product::find($request->product_id);
                $photos = json_decode($product->photos);
                array_push($photos, $name);
                $product->photos = json_encode($photos);
                $product->save();
            }
            return response()->json(['message' => 'success'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'error'], 500);
        }
    }

    public function add_video_product(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required',
                'video' => 'required',
            ]);
            if ($request->hasFile('video')) {
                $file = $request->file('video');
                $name = 'video_' . $request->product_id . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/products/videos/', $name);
                $url = "https://trovimo.com/";
                $product = Product::find($request->product_id);
                $videos = json_decode($product->videos);
                array_push($videos, $url . $name);
                $product->videos = json_encode($videos);
                $product->save();
            } else {
                $product = Product::find($request->product_id);
                $videos = json_decode($product->videos);
                array_push($videos, $request->video);
                $product->videos = json_encode($videos);
                $product->save();
            }
            return response()->json(['message' => 'Success'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'error'], 500);
        }
    }

    public function create_optional(Request $request)
    {

        $request->validate([
            'product_id' => 'required',
            'home_details' => 'required',
            'builds' => 'required',
            'condition' => 'required',
            'furnished' => 'required',
            'reference_points' => 'required',
            'services' => 'required',

        ]);

        try {
            $date = date('Y-m-d H:i:s');
            foreach ($request->home_details as $det) {
                DB::table('product_home_details')->insert([
                    'product_id' => $request->product_id,
                    'home_detail_id' => $det,
                    'created_at' =>  $date,
                    'updated_at' =>  $date
                ]);
            }
            foreach ($request->builds as $build) {
                DB::table('product_building_details')->insert([
                    'product_id' => $request->product_id,
                    'building_detail_id' => $build,
                    'created_at' =>  $date,
                    'updated_at' =>  $date
                ]);
            }

            foreach ($request->services as $serv) {
                $service = new Additional_service();
                $service->product_id = $request->product_id;
                $service->service = $serv[0];
                $service->price = $serv[1];
                $service->save();
            }

            foreach ($request->reference_points as $point) {
                $reference_point = new Reference_point();
                $reference_point->product_id = $request->product_id;
                $reference_point->name = $point[1];
                $reference_point->point = $point[0];
                $reference_point->save();
            }

            $product = Product::find($request->product_id);
            $product->fill($request->all());
            $product->save();


            return response()->json(['message' => 'success'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }

    public function optional_options(Request $request)
    {
        try {
            $home_details = Home_detail::get();
            $builds = Building_detail::get();
            return response()->json(['home_details' => $home_details, 'builds' => $builds], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }

    public function search(Request $request)
    {
        try {

            $product = Product::address($request->address)
                ->type($request->type)
                ->price($request->pricemin, $request->pricemax)
                ->area($request->areamin, $request->areamax)
                ->room($request->room)
                ->bath($request->bath)
                ->get();


            return response()->json(['products' => $product], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }

    public function show(Request $request)
    {
        $request->validate(['product_id' => 'required']);
        try {
            $product = Product::where('id', '=', $request->product_id)->with('home_detail', 'building_detail', 'Additional_service', 'reference_point')->get();
            $favorite = Favorite::where('product_id', '=', $request->product_id)
                ->where('user_id', '=', $request->user()->id)->get();
            $product->favorite = $favorite;
            //guardando como visto
            $viewed = Viewed::where('user_id', '=', $request->user()->id)
                ->where('product_id', '=', $request->product_id)->count();
            if ($viewed < 1) {
                $view =  new Viewed();
                $view->user_id = $request->user()->id;
                $view->product_id = $request->product_id;
                $view->save();
            }

            return response()->json(['products' => $product], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }

    public function update_product(Request $request)
    {
        $request->validate([
            'price' => 'required', 'show_price' => 'required', 'rooms' => 'required', 'bath' => 'required',
            'parking_spots' => 'required', 'n_pieces' => 'required', 'area' => 'required', 'year_built' => 'required',
            'year_remodeled' => 'required', 'description' => 'required', 'country' => 'required', 'city' => 'required',
            'postal_code' => 'required', 'lat' => 'required', 'lon' => 'required', 'tour' => 'required', 'name' => 'required',
            'email' => 'required', 'phone' => 'required', 'option_id' => 'required', 'category_id' => 'required', 'product_id' => 'required',
        ]);
        try {
            $product = Product::find($request->product_id);
            $product->fill($request->all());
            $product->save();
            return response()->json(['message' => $product], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }

    public function updated_photo_product(Request $request)
    {
        $request->validate(['photo_name' => 'required', 'photo' => 'required']);
        try {
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $file->move(public_path() . '/uploads/products/images/', $request->name);
            }
            return response()->json(['message' => 'success'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'error'], 500);
        }
    }

    public function update_video_product(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required',
                'video_id' => 'required',
                'video' => 'required',
            ]);
            if ($request->hasFile('video')) {
                $file = $request->file('video');
                $name = 'video_' . $request->product_id . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/products/videos/', $name);

                $url = "https://trovimo.com/";
                $product = Product::find($request->product_id);
                $videos = json_decode($product->videos);
                $video[$request->video_id] = $url.$name;
                $product->videos = json_encode($videos);
                $product->save();
             } else {
                $product = Product::find($request->product_id);
                $videos = json_decode($product->videos);
                $videos[$request->video_id] = $request->video;
                $product->videos = json_encode($videos);
                $product->save();
             }
            return response()->json(['message' => 'Success'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'error'], 500);
        }
    }
}
