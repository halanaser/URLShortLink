<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class AuthTokenController extends Controller
{

    public function index(Request $request)
    {
        return $request->user()->tokens;
    }
    public function store(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required',
            'device_name'=>'required'
        ]);
        $user=User::Where('email','=',$request->email)->first();
        if($user && Hash::check($request->password,$user->password)){
            $token = $user->createToken($request->device_name,['*']);

            return Response::json([
            'token' => $token->plainTextToken,
            'user' => $user,
        ], 201);
    }
    
    return Response::json([
        'message' => 'Invald credentials',
    ], 401);


    }
    public function destroy($id)
    {
        $user = Auth::guard('sanctum')->user();
        $user->tokens()->findOrFail($id)->delete();
        return [
            'message' => 'Token deleted'
        ];
    }

}
