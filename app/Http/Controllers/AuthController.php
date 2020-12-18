<?php
namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Mail;
use DB;
class AuthController extends Controller{
    public function register(Request $request){
        $request->validate([
            'email'    => 'required|string|email|unique:users',
            'password' => 'required|string',
            'role' => 'required',
            'register_type' => 'required',
            'remember_me' => 'boolean',
        ]);
        $user = new User($request->all());
        $user->password = bcrypt($request->password);
        $user->save();        
        
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'], 401);
        }
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type'   => 'Bearer',
            'user'         => $request->user(),
            'expires_at'   => Carbon::parse(
                $tokenResult->token->expires_at)
                    ->toDateTimeString(),
        ]);
    }
    public function login(Request $request){
        $request->validate([
            'email'       => 'required|string|email',
            'password'    => 'required|string',
        ]);
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'], 401);
        }
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->save(); 
         
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type'   => 'Bearer',
            'user'         => $request->user(),
            'expires_at'   => Carbon::parse(
                $tokenResult->token->expires_at)
                    ->toDateTimeString(),
        ]);
    }
    public function logout(Request $request){
        $request->user()->token()->revoke();
        return response()->json(['message' => 
            true]);
    }
    public function user(Request $request){   
        return response()->json($request->user());
    }
    public function login_with_register(Request $request){
        $user= User::where("email", "=", $request->email)->first();
    	if (!is_null($user)){
            $token= $this->login($request);
    	 return response()->json($token, 200);
    	}else{
            $token= $this->register($request);
    	 return response()->json($token, 200);
        }

    }
    public function verify_email(Request $request){
    	$user= User::where("email", "=", $request->email)->first();
    	if (!is_null($user)){
    	 return response()->json(['email' => 1], 200);
    	}else{
    	 return response()->json(['email' => 0], 200);
    	}
    }
    
}