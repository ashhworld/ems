<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'amount', 'created_at','updated_at'
    ];

    protected $table = 'salary';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
