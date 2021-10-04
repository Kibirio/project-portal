<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\Mark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class ProposeController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }
    public function index() {
        // $projects = Project::latest()->paginate(7);
        // return $projects;

        $projects = DB::table('users')
            ->join('projects', 'users.id', '=', 'projects.user_id')
            ->select('users.name', 'projects.*')
            ->get();
            
            return $projects;
    }
    public function store(Request $request) {
        $this->validate($request, [
            'title' => 'required|max:255',
            'language' => 'required|max:255',
            'project_type' => 'required|max:255',
            'description' => 'required|max:1000',
        ]);

        // Get authenticated user
        $student = $request->user();

        $student->project()->create([
            'regno' => $student->regno,
            'student_name' => $student->name,
            'email' => $student->email,
            'title' => $request->title,
            'language' => $request->language,
            'project_type' => $request->project_type,
            'description' => $request->description,
        ]);
    }

    public function fixPresentation(Request $request){
        $this->validate($request, [
            'presentation_date' => 'required',
            'room' => 'required'
        ]);
       
        $presentation_date = $request->input('presentation_date');
        $room = $request->input('room');
        $isFixed = '1';
        $id = $request->id;

        DB::update('update projects set presentation_date = ?, room = ? , isFixed = ? where id = ?', [$presentation_date, $room, $isFixed, $id]);
    }

    public function getPresentations(){
        $presentations = DB::select('SELECT id, regno, title, project_type, presentation_date, room, isAwarded FROM projects WHERE isFixed =1');
        // return $presentations;
        // $pr = DB::table('projects')
        //         ->leftjoin('marks', 'projects.id', '=', 'marks.project_id')
        //         ->paginate(8);
        //     return $pr;
            // $s = DB::select('select * from projects  
            //         RIGHT JOIN marks 
            //         ON projects.id = marks.project_id AND projects.room = !NULL'
            //     );
            // dd($presentations);
            // return response()->json($presentations[0]);
            return ['presentations' => $presentations];
    }

    // Store project marks i db
    public function awardProject(Request $request){
        $this->validate($request, [
            'marks' => 'required|integer',
            'remarks' => 'required|string',
            'id' => 'unique:marks'
        ]);

        $id = $request->id;
        $marks = $request->marks;
        

        // update project award status
       $q =  DB::update('update projects set isAwarded = 1, marks = ? where id = ?', [$marks, $id]);
       dd($q);
    }
    public function getMarks(){
        $marks = Mark::all();
        return $marks;
    }

}
