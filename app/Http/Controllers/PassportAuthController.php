<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\RegisterApiController;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class PassportAuthController extends Controller
{
    /**
     * Registration
     */


    public function register(RegisterRequest $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);
        $token = $user->createToken('LaravelAuthApp')->accessToken;


        return response()->json(['token' => $token], 201);
    }

    /**
     * Login
     */
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' =>$request->password
        ];
        if (Auth::attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json(['success' => true,'data'=>[
                'user'=> \auth()->user()->name,
                'token' => $token,
            ], "message"=> "User login successfully."], 200);
        } else {
            return response()->json(['success' => false,'error' => 'Unauthorised'], 401);
        }

    }
}
