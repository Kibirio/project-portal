<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    
    public function index(){
        return view('auth3.login');
    }

    public function store(Request $request){
        $this->validate($request, [
            'regno' => 'required',
            'password' => 'required|min:8',
        ]);
        // Signin the user
        if (!auth()->attempt($request->only('regno', 'password'), $request->remember)) {
            return back()->with('status', 'Invalid login details');
        }
        if (Auth::user()->type == 'admin' || Auth::user()->type == 'supervisor'){
            return redirect()->route('admin')->with('status', 'Registration was successful');
        }
            return redirect()->route('student1.dashboard')->with('status', 'Registration was successful');
    }
}
