<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'gender',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function subjects()
{
    return $this->belongsToMany(Subject::class)
                ->using(SubjectUser::class) // <--- Tumia hii Pivot Model yetu
                ->withPivot('school_class_id')
                ->withTimestamps();
}

  public function classTeacher(){
    return $this->hasOne(\App\models\SchoolClass::class, 'teacher_id');
  }

  public function managedClass() 
  {
    return $this->hasOne(\App\models\SchoolClass::class, 'teacher_id');
  }
}
