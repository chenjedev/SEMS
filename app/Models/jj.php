<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    /** @use HasFactory<\Database\Factories\MarkFactory> */
    use HasFactory;

     protected $fillable = [
       'student_id',
        'subject_id',
        'class_id',
        'test_1',
        'test_2',
        'ca',
        'terminal',
        'final',
        'total',
        'grade',
        'remarks'
    ];
}
