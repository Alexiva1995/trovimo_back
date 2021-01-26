<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\UsersExperience;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UsersExperienceController extends Controller {
    function __construct(){ }


    public function index(Request $request) {
        $data = collect([
            'filter'=>DB::table('users_experiences_categories')->get(),
        ]);
        $query = UsersExperience::where('id','>','0');
        foreach ( $request->except('perPage') as $key => $value )
            $query = $query->where($key, 'LIKE', "%$value%");
        return $data->merge(
            $query->paginate()->withQueryString()
        );
    }

    public function show(UsersExperience $UserExperience){
        try { return response()->json([ 'data'=>$UserExperience, ]); }
        catch (\Throwable $th) { return response()->json([ 'message'=>$th, ]); }
    }

    public function store(Request $request){
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title'=> 'required|string',
            'pictures' => 'required',
            'pictures.*' => 'mimes:jpg,jpeg',
            'categorie' => 'string',
            'style' => 'string',
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
            'user_id' => 'required|exists:user,id',
            'title'=> 'required|string',
            'pictures.*' => 'mimes:jpg,jpeg',
            'categorie' => 'string',
            'style' => 'string',
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
