<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterApiController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterRequest $request)
    {

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
        ]);

        return response([
            "status"=> true,
            "message"=> "Account created successfully"
        ],201);


    }
}

/*
Encryption keys generated successfully.
Personal access client created successfully.
Client ID: 1
Client secret: Fy22oi6P6r67quIywLMIuOqT4dSsNM5Z3mdxIkDc
Password grant client created successfully.
Client ID: 2
Client secret: Q61QwQhB3ACV81pgFwDYx4HYBOXrrR6nakTAZqtc
*/
