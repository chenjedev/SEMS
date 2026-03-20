<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'int';

     protected $fillable = [
        'name',
        'admission_number',
        'gender',
        'class_id'
    ];

    public function marks()
{
    
    return $this->hasMany(Mark::class, 'student_id');
}

   public function schoolClass()
{
    return $this->belongsTo(SchoolClass::class, 'class_id'); 
}
}
