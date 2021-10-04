<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Project;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use DB;
use function PHPUnit\Framework\fileExists;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->authorize('isAdmin');
        if (Gate::allows('isAdmin') || Gate::allows('isSupervisor')){
            return User::oldest()->paginate(10); 
                 
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|email|string|max:191|unique:users',
            'regno' => 'required|max:191|unique:users',
            'department' => 'required|',
            'password' => 'required|min:8|string',
        ]);
        return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'regno' => $request['regno'],
            'department' => $request['department'],
            'type' => $request['type'],
            'photo' => $request['photo'],
            'password' => Hash::make($request['password'])
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function profile(){
        return auth('api')->user();
    }

    public function updateProfile(Request $request){
        $user = auth('api')->user();

        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|email|string|max:191|unique:users,email,'.$user->id,
            'password' => 'sometimes|required|min:8|string'
        ]);

        $currentPhoto = $user->photo;

        if($request->photo != $currentPhoto){
            $name = time(). '.'. explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            Image::make($request->photo)->save(public_path('imgs/profile/').$name);
            $request->merge(['photo' => $name]);

            $oldProfilePicture = public_path('imgs/profile/').$currentPhoto;
            if (fileExists($oldProfilePicture)){
                @unlink($oldProfilePicture);
            }
        }

        if(!empty($request->password)){
            $request->merge(['password' => Hash::make($request['password'])]);
        }
        // else if($request->password == ""){
        //     $request->merge(['password' => $user->password]);
        // }

        $user->update($request->all());
        return ['message' => 'success'];
    } 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        if (Gate::allows('isAdmin') || Gate::allows('isSupervisor')){
            $user = User::findOrFail($id);
            $this->validate($request, [
                'name' => 'required|string|max:191',
                'email' => 'required|email|string|max:191|unique:users,email,'.$user->id,
                'password' => 'sometimes|max:8|string'
            ]);
            $user->update($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }

    public function search() {
        if ($search = \Request::get('q')) {
            $users = User::where(function($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%")
                        ->orWhere('email', 'LIKE', "%$search%")
                        ->orWhere('type', 'LIKE', "%$search%");
            })->paginate(10);
        }else {
            $users = User::latest()->paginate(5);
        }
        return $users;
    }

    public function check(Request $request) {
        $user = auth('api')->user();
        $this->validate($request, [
            'status' => 'required',
            'comment' => 'required|string'
        ]);
       
        $status = $request->input('status');
        $comment = $request->input('comment');
        $id = $request->id;

        DB::update('update projects set status = ?, comment = ? where id = ?', [$status, $comment, $id]);
        

    }
    
}
