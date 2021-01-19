<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserRole;


class UserRoleController extends Controller
{
    public function index()
    {
        return  UserRole::all();
    }

}
