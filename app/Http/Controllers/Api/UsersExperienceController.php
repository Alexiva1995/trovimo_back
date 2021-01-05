<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\UsersExperience;
use App\Http\Controllers\Controller;

class UsersExperienceController extends Controller
{

    function __construct(){

    }

    public function show(UsersExperience $post){ return response()->json($post, 200); }

    public function store(Request $request){
        $request->validate([
            'tags' => 'array',
            'style' => 'string',
            'categorie' => 'string',
            'pictures' => 'required',
            'pictures.*' => 'mimes:jpg,jpeg',
            'user_id' => 'required|exists:user,id',
        ]);
        try {
            $data = $request->input();
            if($request->hasFile('pictures')){
                foreach($request->file('pictures') as $key => $file){
                    $name = time().'.'.$file->extension();
                    $file->move(public_path('/experiences/images/'), $name);
                    $data['pictures'][$key] = $name;
                }
            }
            $Post = new UsersExperience($data);
            return response()->json($Post, 200);
        } catch (\Throwable $th) {
            return response()->json([], 500);
        }
    }

    public function update(Request $request, UsersExperience $post){
        $request->validate([
            'tags' => 'array',
            'style' => 'string',
            'categorie' => 'string',
            'pictures' => 'required',
            'pictures.*' => 'mimes:jpg,jpeg',
            'user_id' => 'required|exists:user,id',
        ]);
        try {
            $data = $request->input();
            if($request->hasFile('pictures')){
                foreach($request->file('pictures') as $key => $file){
                    $name = time().'.'.$file->extension();
                    $file->move(public_path('/experiences/images/'), $name);
                    $data['pictures'][$key] = $name;
                }
            }
            $post->update($data);
        } catch (\Throwable $th) { return response()->json([],500); }
    }

    public function destroy(UsersExperience $post){
        try {
            $post->delete();
            return response()->json($post,200);
        } catch (\Throwable $th) {
            return response()->json([],500);
        }
    }

}
