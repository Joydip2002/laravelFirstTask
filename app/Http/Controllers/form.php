<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class form extends Controller
{
    public function form()
    {
        return view('userForm');
    }
    public function register(Request $request){
        echo "<pre>";
        print_r($request->all());
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->gender = $request->input('gender');
        $user->address = $request->input('address');
        
        $user->save();
    }
}