<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'role',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function isTeacher()
    {
        return $this->role === config('constant.role.teacher') || $this->role === config('constant.role.admin');
    }

    public function isPending()
    {
        return $this->status === config('constant.status.pending');
    }

    public function progress()
    {
        return $this->hasMany(Progress::class);
    }
    
    public function isAdmin()
    {
        return $this->role === config('constant.role.admin');
    }

    public function getAvatarAttribute($value)
    {
        return $value ? getMediaUrl('images', $value) : asset('images/avt.png');
    }
}
