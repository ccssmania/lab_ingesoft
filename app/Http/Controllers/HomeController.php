<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\User;
use App\Role;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$courses = Course::all();
        //foreach ($courses as $course) {
            //$course->author = User::find($course->user_id);
        //}
        //if ($courses->isEmpty()) {
            //\Session::flash('course', 'No Hay Cursos Disponibles');
        //}
        return view('home', compact('home'));
    }

    public function create_roles(){
        $role = new Role();
        $role->name = 'Admin';
        $role->save();

        $role = new Role();
        $role->name = 'Author';
        $role->save();

        $role = new Role();
        $role->name = 'Student';
        $role->save();


    }
    public function remove($id){
        var_dump(User::all());
        User::find($id)->delete();
    }
}
