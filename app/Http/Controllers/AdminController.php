<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    public function index() : View {
        return view('admin.dashboard');
    }

    public function parameters() : View {
        return view('admin.parameter.index');
    }
}
