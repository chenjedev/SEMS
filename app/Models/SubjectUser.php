<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SubjectUser extends Pivot
{
    public function schoolClass(){
        return $this->belongsTo(Schoolclass::class, 'school_class_id');
    }
}
