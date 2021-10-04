<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;

    protected $fillable = ['regno', 'marks', 'remarks'];

    public function project(){
        return $this->belongsTo(Project::class);
    }
}
