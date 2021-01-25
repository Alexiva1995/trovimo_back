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
            'user_id' => 'required|exists:user,id',
            'title'=> 'required|string',
            'pictures' => 'required',
            'pictures.*' => 'mimes:jpg,jpeg',
            'categories' => 'string',
            'styles' => 'string',
            'tags' => 'array',
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
            $data['tags'] = 'picture,'.$data['tags'];
            $Post = new UsersExperience($data);
            return response()->json($Post, 200);
        } catch (\Throwable $th) {
            return response()->json([], 500);
        }
    }

    public function update(Request $request, UsersExperience $post){
        $request->validate([
            'user_id' => 'required|exists:user,id',
            'title'=> 'required|string',
            'pictures.*' => 'mimes:jpg,jpeg',
            'categories' => 'string',
            'styles' => 'string',
            'tags' => 'array',
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


    public function search(Request $request, UsersExperience $post){
        $query = $post->query();
        if($request->has('title'))
            $query->where('title', $request->input('title'));
        if($request->has('types'))
            foreach ($request->input('types') as $type)
                $query->orWhere('types', 'LIKE', `,$type`);
        if($request->has('styles'))
            foreach ($request->input('styles') as $style)
                $query->orWhere('styles', 'LIKE', `,$style`);
        if($request->has('colors'))
            foreach ($request->input('colors') as $color)
                $query->orWhere('colors', 'LIKE', `,$color`);
        if($request->has('tags'))
            foreach ($request->input('tags') as $tag)
                $query->orWhere('tags', 'LIKE', `,$tag`);
        return $query->paginate(20);
    }


}
