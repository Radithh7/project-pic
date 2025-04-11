<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() : View
    {
        return view('content.admin.dashboard');
    }
}
