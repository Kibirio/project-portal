<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function index(){
        // $projects = DB::table('projects')->select('department')->count();

        // $status = DB::select('select COUNT(status) from projects where status = ?' , ['pending']);
        
        // SIK
        $sp = DB::select('select projects.status from projects INNER JOIN users on projects.user_id = users.id 
                where projects.status =? and users.department = ?', ['Pending', 'SIK']);
        $sa = DB::select('select projects.status, users.department from projects INNER JOIN users on projects.user_id = users.id 
                where projects.status =? and users.department = ?', ['Approved', 'SIK']);
        $sr = DB::select('select projects.status from projects INNER JOIN users on projects.user_id = users.id 
                where projects.status =? and users.department = ?', ['Rejected', 'SIK']);

        // ETS
        $ep = DB::select('select projects.status from projects INNER JOIN users on projects.user_id = users.id 
                where projects.status =? and users.department = ?', ['Pending', 'ETS']);
        $ea = DB::select('select projects.status from projects INNER JOIN users on projects.user_id = users.id 
                where projects.status =? and users.department = ?', ['Approved', 'ETS']);
        $er = DB::select('select projects.status, users.department from projects INNER JOIN users on projects.user_id = users.id 
                where projects.status =? and users.department = ?', ['Rejected', 'ETS']);

        // SIT
        $stp = DB::select('select projects.status from projects INNER JOIN users on projects.user_id = users.id 
                where projects.status =? and users.department = ?', ['pending', 'Information Technology']);
        $sta = DB::select('select projects.status from projects INNER JOIN users on projects.user_id = users.id 
                where projects.status =? and users.department = ?', ['Approved', 'Information Technology']);
        $str = DB::select('select projects.status, users.department from projects INNER JOIN users on projects.user_id = users.id 
                where projects.status =? and users.department = ?', ['Rejected', 'Information Technology']);

        //  BCS
        $bp = DB::select('select projects.status from projects INNER JOIN users on projects.user_id = users.id 
                where projects.status =? and users.department = ?', ['Pending', 'SIK']);
        $ba = DB::select('select projects.status from projects INNER JOIN users on projects.user_id = users.id 
                where projects.status =? and users.department = ?', ['Approved', 'SIK']);
        $br = DB::select('select projects.status, users.department from projects INNER JOIN users on projects.user_id = users.id 
                where projects.status =? and users.department = ?', ['Rejected', 'SIK']);

        
        return view('departments.departments', [
            'sikp' => $sp, 'sika' => $sa, 'sikr' => $sr,
            'etsp' => $ep, 'etsa' => $ea, 'etsr' => $er,
            'sitp' => $stp, 'sita' => $sta, 'sitr' => $str,
            'bcsp' => $bp, 'bcsa' => $ba, 'bcsr' => $br,
        ]);
    }
}
