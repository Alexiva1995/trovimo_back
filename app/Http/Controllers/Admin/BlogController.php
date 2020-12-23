<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends \App\Http\Controllers\Controller
{
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $user = $request->user();
            return $request->isMethod('get')||($user && $user->role === 0)
                ?$next($request)
                :abort(403, 'No tienes permisos suficientes');
        })->except('show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() { }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() { }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'picture' => 'required|url',
            'content' => 'required',
            'user_id' => 'exists:user,id|integer',
        ]);
        return [
            'status'=>'ok',
            'data'=>\App\Models\Blog::create($request->input()),
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog){
        return [ 'status'=>$blog?'ok':'failed','message'=>!$blog?'El blog solicitado no existe':null, 'data'=>$blog, ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog) { }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        if(!$blog) return [ 'status'=> 'failed', 'message'=>'El blog solicitado no existe', ];
        $request->validate([
            'title' => 'required|string',
            'picture' => 'required|url',
            'content' => 'required',
            'user_id' => 'exists:user,id|integer',
        ]);
        $update = $blog->update($request->input());
        return [
            'status'=>$update?'ok':'failed',
            'data'=>$update?$blog:null,
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        return [
            'message'=>!$blog?'El blog solicitado no existe':null,
            'status'=> ($blog&&$blog->delete())?'ok':'failed',
            'data'=>null,
        ];
    }
}
