<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    /** @use HasFactory<\Database\Factories\SubjectFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
    ];

    public function users(){
        return $this->belongsToMany(User::class)->withPivot('class_name', 'stream')->withTimestamps();
    }

    public function getClassNameAttribute()
{
   
    $class = \App\Models\SchoolClass::find($this->pivot->school_class_id);
    return $class ? $class->name : 'N/A';
}
}
