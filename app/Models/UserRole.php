<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'user_role';

    protected $fillable = ['id,role_name'];

    public function User()
    {
        return $this->belongsTo('App\Models\UserRole');
    }
}
