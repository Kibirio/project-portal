<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Project;
use App\Models\Supervisor;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function admin(){
        return view('home');
    }

    // Fetche All projects
    public function projects() {
        $projects = Project::all()->count();
        $pending = Project::where('status', 'pending')->count();
        $cancelled = Project::where('status', 'rejected')->count();
        $approved = Project::where('status', 'approved')->count();

        $java = Project::where('language', 'Java')->count();
        $python = Project::where('language', 'Python')->count();
        $c = Project::where('language', 'C')->count();
        $cpp = Project::where('language', 'C++')->count();
        $csharp = Project::where('language', 'C#')->count();
        $php = Project::where('language', 'PHP')->count(); 
        $js = Project::where('language', 'JS')->count();

        $iot = Project::where('project_type', 'IOT')->count();
        $desktop = Project::where('project_type', 'Desktop Application')->count();
        $apps = Project::where('project_type', 'Mobile Application')->count();
        $ml = Project::where('project_type', 'Machine Learning')->count();
        $ds = Project::where('project_type', 'Data Science')->count();
        $network = Project::where('project_type', 'Networking')->count();
        $web =  Project::where('project_type', 'Web Applications')->count();

        $project_list = DB::table('users')
            ->join('projects', 'users.id', '=', 'projects.user_id')
            ->select('users.name', 'users.email', 'projects.*')
            ->get();

        return [
            'projects'=> $projects, 'list' => $project_list, 'pending' => $pending, 'cancelled' => $cancelled, 'approved' => $approved,
            'java' => $java, 'python' =>$python, 'c' => $c, 'cpp' => $cpp, 'csharp' => $csharp, 'php' => $php, 'js' => $js,
            'iot' => $iot, 'ml' => $ml, 'ds' => $ds, 'apps' => $apps, 'network' => $network, 'desktop' => $desktop, 'web' => $web,
        ];
    }

 public function pending() {   
         $pending_list = DB::table('users')
            ->join('projects', 'users.id', '=', 'projects.user_id')
            ->select('users.name', 'users.email', 'projects.*')
            ->where('status', 'pending')
            ->get();                                          

        return ['list' => $pending_list];
    }

    public function approved() {
        $approved_list = DB::table('users')
            ->join('projects', 'users.id', '=', 'projects.user_id')
            ->select('users.name', 'users.email', 'projects.*')
            ->where('status', 'approved')
            ->get();                                          

        return ['list' => $approved_list];
    }

    public function cancelled() {
        $pending_list = DB::table('users')
            ->join('projects', 'users.id', '=', 'projects.user_id')
            ->select('users.name', 'users.email', 'projects.*')
            ->where('status', 'rejected')
            ->get();                                          

        return ['list' => $pending_list];
    }
}
