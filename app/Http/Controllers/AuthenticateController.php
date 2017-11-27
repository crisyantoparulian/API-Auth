<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\http\Requests;
use JWTAuth;
use App\User;
use Hash;

class AuthenticateController extends Controller
{
    public function __construct(User $user)
    {
    	$this->user = $user;
    }

    public function login(Request $request)
    {
    	$credential = $request->only(['email','password']);

    	if(!$token = JWTAuth::attempt($credential)){
    		return response()->json(['error', 'Invalid credential'], 401);
    	}
    	return response()->json(compact('token'));
    }

    public function register(Request $request)
    {
    	$credential = $request->only(['name','email','password']);
    	$credential = [
    		'name'=>$credential['name'],
    		'email'=>$credential['email'],
    		'password'=>Hash::make($credential['password'])
    	];
    	try{
    		$user = $this->user->create($credential);
    	}catch(Exception $e){
    		return response()->json(['error'=>'User Already Exist'], 409);
    	}
    	$token = JWTAuth::fromUser($user);

      //  $usr = JWTAuth::toUser($token);
    	return response()->json(compact('token','usr'));
    }
}
