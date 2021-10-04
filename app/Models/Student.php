<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'regno',
        'supervisor_id',
        'student_name',
        'school',
        'department',
        'email',
        'bio',
        'photo',
        'password',
    ];

    public function supervisor(){
        return $this->belongsTo(Supervisor::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function project(){
        return $this->hasMany(Project::class);
    }
}
