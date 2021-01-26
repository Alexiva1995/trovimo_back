<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\favorite;
use App\Models\Property;
use App\Models\additional_service;
use App\Models\Project_professional_group;
use App\Models\Project_details_name;
use App\Models\Viewed;
use App\Models\Project;
use App\Models\Product_image;
use App\Models\Product_video;
use App\Models\Reference_point;
use Storage;
use DB;



class ProjectController extends Controller
{
    public function create_project(Request $request)
    {
        $request->validate([
            'price' => 'required', 'show_price' => 'required', 'rooms' => 'required', 'bath' => 'required',
            'parking_spots' => 'required', 'area' => 'required', 'description' => 'required', 'country' => 'required',
            'city' => 'required', 'postal_code' => 'required', 'lat' => 'required', 'lon' => 'required', 'tour' => 'required', 'name' => 'required',
            'email' => 'required', 'phone' => 'required', 'category_id' => 'required',
        ]);
        try {
            $project = new Project($request->all());
            $project->user_id = $request->user()->id;
            $project->save();
            return response()->json(['message' => $project], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }

    public function add_photo_project(Request $request)
    {
        $request->validate(['project_id' => 'required', 'photo' => 'required']);
        try {
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $name = 'image_' . $request->project_id . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/projects/images/', $name);

                $project = Project::find($request->project_id);
                $photos = json_decode($project->photos);
                array_push($photos,$name);
                $project->photos = json_encode($photos);
                $project->save();
            }
            return response()->json(['message' => 'success'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'error'], 500);
        }
    }

    public function add_video_project(Request $request)
    {
        $request->validate([
            'project_id' => 'required',
            'video' => 'required',
        ]);
        try {
            if ($request->hasFile('video')) {
                $file = $request->file('video');
                $name = 'video_' . $request->project_id . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path() . '/uploads/projects/videos/', $name);
                $url = "https://trovimo.com/";
                $project = Project::find($request->project_id);
                $videos = json_decode($project->videos);
                array_push($videos, $url . $name);
                $project->videos = json_encode($videos);
                $project->save();
            } else {
                $project = Project::find($request->project_id);
                $videos = json_decode($project->videos);
                array_push($videos, $request->video);
                $project->videos = json_encode($videos);
                $project->save();
            }
            return response()->json(['message' => 'Success'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'error'], 500);
        }
    }

    public function add_property_project(Request $request)
    {
        $request->validate([
            'project_id' => 'required',
            'area' => 'required',
            'especifications' => 'required',
            'price' => 'required',
            'rooms' => 'required',
            'bathrooms' => 'required',
        ]);
        try {
            $property = new Property($request->all());
            $property->project_id = $request->project_id;
            $property->save();
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $name = $request->project_id . '.jpg';
                $file->move(public_path() . '/uploads/projects/property/', $name);
            }
            return response()->json(['message' => $property], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }


    public function create_optional_project(Request $request)
    {
        $request->validate([
            'project_id' => 'required',
            'project_details' => 'required',
            'reference_points' => 'required',
        ]);

        try {
            $date = date('Y-m-d H:i:s');
            foreach ($request->project_details as $detail) {
                DB::table('projects_details')->insert([
                    'project_id' => $request->project_id,
                    'project_details_name_id' => $detail,
                    'created_at' =>  $date,
                    'updated_at' =>  $date
                ]);
            }
            foreach ($request->reference_points as $point) {
                $reference_point = new Reference_point();
                $reference_point->project_id = $request->project_id;
                $reference_point->name = $point[1];
                $reference_point->point = $point[0];
                $reference_point->save();
            }
            return response()->json(['message' => 'success'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }

    public function add_professional_group(Request $request)
    {
        $request->validate(['project_id' => 'required', 'name' => 'required', 'photo' => 'required']);
        try {
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $name = 'image_' . $request->project_id . 'jpg';
                $file->move(public_path() . '/uploads/projects/professionalGroup/', $name);

                $professional_group = new Project_professional_group();
                $professional_group->name = $request->name;
                $professional_group->project_id = $request->project_id;
                $professional_group->save();
            }
            return response()->json(['message' => 'success'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'error'], 500);
        }
    }

    public function show_project_detail(Request $request)
    {
        try {
            $project_detail = Project_details_name::get();
            return response()->json(['message' => $project_detail], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }

    public function search(Request $request)
    {
        try {
            $project = Project::address($request->address)
                ->type($request->type)
                ->price($request->pricemin, $request->pricemax)
                ->area($request->areamin, $request->areamax)
                ->room($request->room)
                ->bath($request->bath)
                ->parking($request->Parking)
                ->get();
            return response()->json(['project' => $project], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }

    public function show(Request $request)
    {
        $request->validate(['project_id' => 'required']);
        try {
            $project = Project::where('id', '=', $request->project_id)->with('details', 'propertys', 'reference_point', 'professional_groups')->get();
            $favorite = Favorite::where('project_id', '=', $request->project_id)
                ->where('user_id', '=', $request->user()->id)->get();
            $project->favorite = $favorite;
            //guardando como visto
            $viewed = Viewed::where('user_id', '=', $request->user()->id)
                ->where('project_id', '=', $request->project_id)->count();
            if ($viewed < 1) {
                $view =  new Viewed();
                $view->user_id = $request->user()->id;
                $view->project_id = $request->project_id;
                $view->save();
            }
            return response()->json(['products' => $project], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }

    public function update_project(Request $request)
    {
        $request->validate([
            'price' => 'required', 'show_price' => 'required', 'rooms' => 'required', 'bath' => 'required',
            'parking_spots' => 'required', 'area' => 'required', 'description' => 'required', 'country' => 'required',
            'city' => 'required', 'postal_code' => 'required', 'lat' => 'required', 'lon' => 'required', 'tour' => 'required', 'name' => 'required',
            'email' => 'required', 'phone' => 'required', 'category_id' => 'required', 'project_id' => 'required',
        ]);
        try {
            $project = Project::find($request->project_id);
            $project->fill($request->all());
            $project->save();
            return response()->json(['message' => $project], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }

    public function update_photo_project(Request $request)
    {
        $request->validate(['photo_name' => 'required', 'photo' => 'required']);
        try {
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $file->move(public_path() . '/uploads/projects/images/', $request->photo_name);
            }
            return response()->json(['message' => 'success'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'error'], 500);
        }
    }

    public function update_video_project(Request $request)
    {
        try {
            $request->validate([
                'video_id' => 'required',
            ]);
            $video = Product_video::where('project_id', '=', $request->video_id);

            if ($request->hasFile('video')) {
                $file = $request->file('video');
                $file->move(public_path() . '/uploads/projects/videos/', $video->name);
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
