<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CreateCustumerAction{

    public static function handle($request): User
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'contact' => 'required|string|max:12',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip_code' => 'required|string|max:7',
        ]);

       $user= User::firstOrCreate([
            'email'=>$request->input('email')
        ],
        [
            'password'=>Hash::make(Str::random(12)),
            'name'=>$request->input('name'),
            'address'=>$request->input('email'),
            'contact'=>$request->input('contact'),
            'city'=>$request->input('city'),
            'state'=>$request->input('state'),
            'zip_code'=>$request->input('zip_code'),
            'admoo'=>0,
        ]
        );

            return $user;
    }
}