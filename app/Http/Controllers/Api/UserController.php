<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Favorite;
use App\Models\Mail;
use App\Models\Recommendation;

class UserController extends Controller
{
       
    public function update(Request $request){
        $request->validate([
            'name' => 'required',
        ]);
        try {
            $user = User::find($request->user()->id);
            $user->fill($request->all());
            if (!is_null($request->password)){
                $user->password = bcrypt($request->password);
                $user->save();
            }else{
               $user->save(); 
            }
            return response()->json(['user' => $user], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'error'], 500);
        }
    }
    public function update_avatar(Request $request){
        $request->validate([
            'photo'=> 'required',
        ]);
        try{
            $user = User::find($request->user()->id);
            //cargamos la imagen
            $name='image_' . $user->id. time() . '.jpg';
            $file_data = $request->input('photo');
            $image_64 = substr($file_data, strpos($file_data, ",")+1);// Obtener el String base-64 de los datos  
            Storage::disk('user')->put('/avatar/'.$name, base64_decode($image_64));  
            $user->photo= $name;
            $user->save();
            return response()->json(['message' => 'success'], 200);
        }catch (Exception $e) {
            return response()->json(['message' => 'error'], 500);
        } 
    }
    public function recommendation(Request $request){
        $request->validate([
            'recommendation'    => 'required',
        ]);
        try{
            $recommendation = new Recommendation($request->all());
            $recommendation->user_id = $request->user()->id;
            $recommendation->recommendation = $request->recommendation;
            $recommendation->save();
            return response()->json(['message' => 'Success'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }
    public function favorite(Request $request){
        try{
            $favorite = new Favorite($request->all());
            $favorite->user_id = $request->user()->id;
            $favorite->save();
            return response()->json(['message' => 'Success'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }
    public function contact(Request $request){
        $request->validate([
            'name'    => 'required',
            'email'    => 'required',
            'message'    => 'required',
        ]);
        try{
            $mail = new Mail($request->all());
            $mail->user_id = $request->user()->id;
            $mail->save();
            return response()->json(['message' => 'Success'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error'], 500);
        }
    }
}
