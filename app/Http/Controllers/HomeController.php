<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laratrust\LaratrustFacade;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (LaratrustFacade::hasRole('admin')) {
            return $this->adminDashboard();
        }

        if (LaratrustFacade::hasRole('member')) {
            return $this->memberDashboard();
        }

        return view('home');
    }

    public function adminDashboard()
    {
        return view('dashboard.admin');
    }

    public function memberDashboard()
    {
        return view('dashboard.member');
    }
}
