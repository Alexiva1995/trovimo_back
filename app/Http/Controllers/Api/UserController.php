<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Recommendation;

class UserController extends Controller
{
 /*   {
        "name":"prueba", 
        "show_name":1, 
        "username":"pruebausername", 
        "email":"fjms93@gmail.com", 
        "password":"123456789",
        "role":1, 
        "phone":{
                "123456789",
                "2532602"
                }, 
        "country":"venezuela",
        "city":"juan griego", 
        "address":{"venezuela/juangriuego",} 
        "postal_code":"0256", 
        "linkedin":"linkedin", 
        "facebook":"facebook", 
        "youtube":"youtube", 
        "twitter":"twitter", 
        "instagram":"instagram", 
        "id_company":"123456", 
        }*/
        
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


}
