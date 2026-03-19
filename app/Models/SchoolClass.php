<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    /** @use HasFactory<\Database\Factories\SchoolClassFactory> */
    use HasFactory;

    protected $fillable = [
        'class_name',
        'stream',
    ];

    public function classTeacher(){
        return $this->belongsTo(User::class, 'teacher_id');
    }
}
