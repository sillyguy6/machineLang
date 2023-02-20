<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;

class UserController extends Controller
{
    function user($id){
        // Logger($id);
        $user = User::with('posts')->select('id', 'name')->whereId($id)->first();
        // Logger($user);
        // $user->loadMissing('posts');
        return $user;
    }
    function list(){
        return User::with('posts')->select('id', 'name')->get();
    }
}
