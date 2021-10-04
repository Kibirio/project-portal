<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Supervisor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Support\Facades\Auth;

class SupervisorController extends Controller
{
    public function __construct(){
        // $this->middleware('auth');
    }
    public function store(Request $request){
        // validate
        $this->validate($request, [
            'regno' => 'required|max:255',
            'name' => 'required|max:255',
            'department' => 'required|max:255',
            'gender' => 'required',
            'type' => 'required',
            'email' => 'required|email|max:255|unique:supervisor',
            'password' => 'required|min:6',
        ]);

        // $e = $request->gender;

        // $type = $request->type;

            $user = User::create([
                'regno' => $request->regno,
                'name' => $request->name,
                'department' => $request->department,
                'type' => $request->type,
                'gender' => $request->gender,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $user->supervisor()->create([
                'regno' => $request->regno,
                'name' => $request->name,
                'department' => $request->department,
                'type' => $request->type,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
    }

    public function supervisors(){
        $supervisors = Supervisor::paginate(3);
        return $supervisors;
    }

    public function update(Request $request){
         // $user = Auth::user();
        $this->validate($request, [
            'super_id' => 'required|max:255',
            'name' => 'required|max:255',
            'department' => 'required|max:255',
            'type' => 'required',
            'email' => 'required|email|max:255|unique:supervisor',
            'password' => 'required|min:6',
        ]);
       
        $super_id = $request->input('super_id');
        $name = $request->input('name');
        $department = $request->input('department');
        $type = $request->input('type');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));
        $id = $request->id;
        // dd($id);

        DB::update('update supervisors set super_id = ?, name = ?, department = ?, type= ?, email =?, password=? where id = ?', 
            [$super_id, $name, $department, $type, $email, $password, $id]);
    }

    public function assign() {
        // Get all supervisors
        $supervisor_id = DB::select('select user_id from supervisors '); //[1,2]
        $student_id = DB::select('select user_id from students '); // [1,2...12]
        

        for ($x = 0; $x <= count($student_id)+1; $x++) {
            $rand_supervisor = (array_rand($supervisor_id, 1));
            DB::update('update students set students.supervisor_id = ? where students.id = ?', [$rand_supervisor + 1, $x + 1]);
        }
    }

    public function assignmentList(){
        // $supervisor_assignment = DB::select('select users.id, users.regno, users.department, users.student_name, supervisors.name 
        //         from users  
        //         INNER JOIN supervisors on users.supervisor_id =  supervisors.id'
        //     );
        // return $supervisor_assignment->paginate(5);

        $supervisors_assignment = DB::table('supervisors')
                ->join('students', 'supervisors.id', '=', 'students.supervisor_id')
                ->select('students.id', 'students.regno', 'students.department', 'students.student_name', 'supervisors.name')
                ->orderBy('students.id', 'asc')
                ->paginate(8);
            return $supervisors_assignment;
    }

    public function studentsForSupervisor(Request $request){
        $id = Auth::id();
        $q = DB::select('select users.id, users.regno, users.department, users.student_name, supervisors.name 
                from users  
                INNER JOIN supervisors on users.supervisor_id = ?', [$id]
            );
        dd($q);
        dd($supervisor);
    }

}
