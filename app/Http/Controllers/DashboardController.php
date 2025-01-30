<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view("dashboard.index");
    }

    public function users()
    {
        $users = User::all();
        return view("dashboard.user.index", compact('users'));
    }
}
