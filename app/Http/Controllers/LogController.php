<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * Just Users Logged in
     *
     * @return void
     */
    public function __construct(){
        $this->middleware("auth");
    }

    public function index(){
    	$logs = \Auth::user()->logs;

    	return view('logros.index', compact('logs'));
    }
}
