<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BlogController extends \App\Http\Controllers\Controller
{
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $user = $request->user();
            return $request->isMethod('get')||($user && $user->role === 0)
                ?$next($request)
                :abort(403, 'No tienes permisos suficientes');
        })->except('index','show');
    }

    public function index(Request $request) {
        $data = collect([
            'filter'=>DB::table('blogs_categories')->get(),
        ]);
        $query = Blog::where('id','>','0');
        foreach ( $request->except('perPage') as $key => $value )
            $query = $query->where($key, 'LIKE', "%$value%");
        return $data->merge(
            $query->paginate()->withQueryString()
        );
    }

    public function show(Blog $blog){
        try { return response()->json([ 'data'=>$blog, ]); }
        catch (\Throwable $th) { return response()->json([ 'message'=>$th, ]); }
    }

    public function store(Request $request) {
        try { return response()->json([ 'data'=>Blog::create($request->input()), ]); }
        catch (\Throwable $th) { return response()->json([ 'message'=>$th, ]); }
    }

    public function update(Request $request, Blog $blog) {
        if(!$blog) return [ 'status'=> 'failed', 'message'=>'El blog solicitado no existe', ];
        try {
            $update = $blog->update($request->only([ 'title', 'picture', 'content', 'user_id', ]));
            return response()->json([ 'data'=>$blog, ]);
        } catch (\Throwable $th) {
            return response()->json([ 'message'=>$th, ]);
        }
    }

    public function destroy(Blog $blog) {
        try { $update = $blog->delete(); return response()->json([ 'data'=>null, ]);
        } catch (\Throwable $th) { return response()->json([ 'message'=>$th, ]); }
    }


}
