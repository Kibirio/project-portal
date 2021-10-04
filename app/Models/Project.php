<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
         'regno', 'user_id','title', 'language', 'project_type', 'description', 
         'status', 'comment', 'presentation_date', 'room', 'isAwarded', 'isFixed'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
