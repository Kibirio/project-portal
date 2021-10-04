<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }

    // Select individual student details
    public function profile(){
        $id = Auth::id();
        $profile = DB::select('select * from students where students.user_id = ?', [$id]);
        // $q = (object) $profile;
        // $s = $q->json();
        // $s = Student::where('user_id', $id);
        // dd($;
        // dd(gettype($profile));
        // return response()->json($profile[0]);
        return ['profile' => $profile];
        
    }

    public function updateProfile(Request $request){
        $id = Auth::id(); 
        $this->validate($request, [
            'student_name' => 'required|max:255',
            'regno' => 'required|string|max:191|unique:users,regno,'.$id,
            'email' => 'required|email|string|max:191|unique:users,email,'.$id,
            'password' => 'required|sometimes',
            'school' => 'required|string',
            'department' => 'required|string',
        ]);
        if(!empty($request->password)){
            $request->merge(['password' => Hash::make($request['password'])]);
        }

        //  $user->update($request->all());
        // return ['message' => 'success'];

        $student_name = $request->input('student_name');
        $regno = $request->input('regno');
        $email = $request->input('email');
        $password = $request->input('password');
        $school = $request->input('school');
        $department = $request->input('department');

        DB::update('update students set student_name = ?, regno =?, email=?, password=?, school=?, department=? where id = ?', 
                [$student_name, $regno, $email, $password, $school, $department, $id]);
    }

    public function index(){      
        // SIK
        $sp = DB::select('select projects.status from projects INNER JOIN students on projects.user_id = students.user_id 
                where projects.status =? and students.department = ?', ['Pending', 'SIK']);
        $sa = DB::select('select projects.status, students.department from projects INNER JOIN students on projects.user_id = students.user_id 
                where projects.status =? and students.department = ?', ['Approved', 'SIK']);
        $sr = DB::select('select projects.status from projects INNER JOIN students on projects.user_id = students.user_id 
                where projects.status =? and students.department = ?', ['Rejected', 'SIK']);

        // ETS
        $ep = DB::select('select projects.status from projects INNER JOIN students on projects.user_id = students.user_id 
                where projects.status =? and students.department = ?', ['Pending', 'ETS']);
        $ea = DB::select('select projects.status from projects INNER JOIN students on projects.user_id = students.user_id 
                where projects.status =? and students.department = ?', ['Approved', 'ETS']);
        $er = DB::select('select projects.status, students.department from projects INNER JOIN students on projects.user_id = students.user_id 
                where projects.status =? and students.department = ?', ['Rejected', 'ETS']);

        // SIT
        $stp = DB::select('select projects.status from projects INNER JOIN students on projects.user_id = students.user_id 
                where projects.status =? and students.department = ?', ['pending', 'Information Technology']);
        $sta = DB::select('select projects.status from projects INNER JOIN students on projects.user_id = students.user_id 
                where projects.status =? and students.department = ?', ['Approved', 'Information Technology']);
        $str = DB::select('select projects.status, students.department from projects INNER JOIN students on projects.user_id = students.user_id 
                where projects.status =? and students.department = ?', ['Rejected', 'Information Technology']);

        //  BCS
        $bp = DB::select('select projects.status from projects INNER JOIN students on projects.user_id = students.id 
                where projects.status =? and students.department = ?', ['Pending', 'SIK']);
        $ba = DB::select('select projects.status from projects INNER JOIN students on projects.user_id = students.id 
                where projects.status =? and students.department = ?', ['Approved', 'SIK']);
        $br = DB::select('select projects.status, students.department from projects INNER JOIN students on projects.user_id = students.id 
                where projects.status =? and students.department = ?', ['Rejected', 'SIK']);


        return view('departments.student', [
            'sikp' => $sp, 'sika' => $sa, 'sikr' => $sr,
            'etsp' => $ep, 'etsa' => $ea, 'etsr' => $er,
            'sitp' => $stp, 'sita' => $sta, 'sitr' => $str,
            'bcsp' => $bp, 'bcsa' => $ba, 'bcsr' => $br,
        ]);
    }

    // Fetch all individual student projects
    public function  projects(){
         $user_id = Auth::user()->id;
        $student_projects = DB::select('select * from projects where projects.user_id = ?', [$user_id]);
        return $student_projects;
    }

    // Fetch all registerd students
    public function allStudents(){
        $student_list = DB::table('users')
            ->join('students', 'users.id', '=', 'students.user_id')
            ->select('users.gender', 'students.*')
            ->get();                                          

        return ['students' => $student_list];
    }
}
