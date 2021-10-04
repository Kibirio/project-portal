<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class StudentAuthController extends Controller
{
    public function index(){
        return view('register');
    }

    public function register(){
        return view('auth2.register');
    }

    public function registerStudent(Request $request) {
        $request->validate([
            'registration_number' => 'required|unique:users',
            'name' => 'required',
            'school' => 'required',
            'department' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6|string',
        ]);

        return Student::create([
            'registration_number' => $request['registration_number'],
            'name' => $request['name'],
            'school' => $request['school'],
            'department' => $request['department'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        redirect()->intended('home');
    }

    // public function login(){
    //     if(Auth::check()){
    //         return view('dashboard');
    //     }
    //     return redirect("login")->withSuccess('You are not allowed to access');
    // }

    public function signOut() {

    }

}
