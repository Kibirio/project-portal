<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\User;

class Supervisor extends Model
{
    use HasFactory;

    protected $fillable = ['regno', 'name', 'department', 'gender', 'email','password', 'type'];
    protected $table = 'supervisors';
    
    public function student() {
        return $this->hasMany(Student::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
