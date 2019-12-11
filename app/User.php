<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "id",
        "department_id", 
        "role_id", 
        "full_name", 
        "mobile_no", 
        "email_id", 
        "password", 
        "dob",
        "doj", 
    ];

    protected $table = 'users';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function departments() {
        return $this->hasOne('App\Departments', 'id', 'department_id')->select();
    }

    public function salary() {
        return $this->hasOne('App\Salary', 'user_id', 'id')->select();
    }
}
