<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    function isMe($id){
        return $id == Auth::user()->id;
    }

    function register(){
        $validator = validator(request()->all(), [
            'email' => 'required|email|unique:users,email',
            'name' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password'
        ]);

        // Logger(request()->all());

        if ($validator->fails()) {
            return $validator->getMessageBag();
        }

        $user = User::create([
            'email' => request()->email,
            'name' => request()->name,
            'password' => Hash::make(request()->password),
        ]);


        Auth::login($user);

        return [
            'status' => 'success',
            'id' => $user->id,
        ];
    }


    public function login(Request $request){
        $validator = validator(request()->all(), [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Logger(request()->all());

        if ($validator->fails()) {
            return $validator->getMessageBag();
        }

        // Auth::regiser()

        if (Auth::attempt(request()->all())) {
            $request->session()->regenerate();
            // Logger('succes');

            return [
                'status' => 'success'
            ];
        }

        return [
            'status' => 'fail',
            'error' => 'wrong credentials'
        ];
    }

    public function api_login(Request $request){
        $validator = validator(request()->all(), [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if ($validator->fails()) {
            return $validator->getMessageBag();
        }

        if (Auth::attempt(request()->all())) {
            $token = request()->user()->createToken('API TOKEN')->plainTextToken;

            return [
                'status' => 'success',
                'token' => $token
            ];
        }

        return [
            'status' => 'fail',
            'error' => 'wrong credentials'
        ];
    }

    public function create(Request $request)
    {

        // dd($request);


        Validator::make($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => $this->passwordRules(),
            'password' => ['required'],
        ])->validate();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return $this->login($request);


    }

    function logout(){
        Auth::logout();
        return true;
    }

    function api_logout(){
        auth()->user()->tokens()->delete();
        return true;
    }

    function user(){
        return request()->user();
    }
}
