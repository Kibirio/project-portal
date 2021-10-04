<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Supervisor;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    public function index(){
        return view('auth3.register');
    }

    public function root(){
        return view('auth3.root');
    }

    public function storeRoot(){
       $web =  User::create([
            'name' => 'root',
            'gender' => 'Male',
            'regno' => 'ROOT/01/2021',
            'email' => 'root@scihub.ac.ke',
            'password' => Hash::make('root@scihub2021'),
            'type' => 'admin',
        ]);
       // return redirect()->route('home')->with('status', 'Registration was successful');
    }

    public function createRoot(Request $request){
        $this->validate($request, [
            'name' => 'required|max:255',
            'gender' => 'required',
            'regno' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed',
        ]);

         // Store the user
        $user = User::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'regno' => $request->regno,
            'type' => 'admin',
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // return redirect()->route('home')->with('status', 'Registration was successful');
    }

    // Student creation
    public function store(Request $request) {
        // validate
        $this->validate($request, [
            'name' => 'required|max:255',
            'gender' => 'required',
            'regno' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed',
        ]);

         // Store the user
        $user = User::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'regno' => $request->regno,
            'type' => 'student',
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Then create a new student
        $type = $user->type;

        if ($type == 'student') {
            $user->student()->create([
                'regno' => $request->regno,
                'student_name' => $request->name,
                'gender' => $request->gender,
                'email' => $request->email,
                'type' => $request->type,
                'password' => Hash::make($request->password)
            ]);

        }

        // If not student create supervisor
        if ($type == 'supervisor') {
            Supervisor::create([
                'regno' => $request->regno,
                'name' => $request->name,
                'gender' => $request->gender,
                'email' => $request->email,
                'type' => $request->type,
                'password' => Hash::make($request->password)
            ]);
        }
       


        // Signin user
        // auth()->attempt($request->only('email', 'password'));

        if (!auth()->attempt($request->only('regno', 'password'))) {
            return back()->with('status', 'Error occured!! Please try again');
        }

        if (Auth::user()->type == 'admin' || Auth::user()->type == 'supervisor'){
            return redirect()->route('home')->with('status', 'Registration was successful');
        }
        return redirect()->route('home')->with('status', 'Registration was successful');

    }
}