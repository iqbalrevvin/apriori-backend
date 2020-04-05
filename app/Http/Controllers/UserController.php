<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
  //    	$request->validate([
		//     'username' => 'bail|required|unique:posts|max:255',
		//     'password' => 'required',
		// ]);
		if($request->email == '' || $request->password == ''){
			return response([
				'status' => 'error',
    			'message' => ['Email and password must be filled']
    		], 404);
		}else{
			$user = User::where('email', $request->email)->first();
	    	if(!$user || !Hash::check($request->password, $user->password)){
	    		return response([
	    			'status' => 'error',
	    			'message' => ['These credentials do not match our records.']
	    		], 404);
	    	}
	    	$token = $user->createToken('MyToken')->plainTextToken;
	    	$response = [
	    		'status' => 'Success',
	    		'user' => $user,
	    		'token' => $token
	    	];
		}
    	
    	

    	return response($response, 201);
    }
}
