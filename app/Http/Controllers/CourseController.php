<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Course;
use Auth;
use App\UserCourse;
use App\Enrollments;
use App\Lesson;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count = 0;
        if(\Auth::user()->role()->first()->name === 'Admin'){
            $courses = Course::all();
        }else{
            $courses = [];
            $all_users_courses = Course::all();
            foreach ($all_users_courses as $user_course) {
                $courses[] = $user_course;
                $completed = UserCourse::where('user_id', \Auth::user()->id)->where('course_id', $user_course->id)->first();
                if(!isset($completed) or $completed->course_completed == 0){
                    break;
                }else{
                    $count ++;
                }
            }
        }

        $progress = ($count / (count(Course::all()) > 0 ? count(Course::all()) : 1)) * 100;
        if (count($courses) == 0) {
            \Session::flash('course', 'No se encuentra inscrito a ningun nivel');
        }
        return view('courses', compact('courses', 'progress'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $submitbuttontext = "Crear";
        return view('courses.create', compact('submitbuttontext'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        //$input['thumbnail'] = $request->file('thumbnail')->store('images');
        $input['user_id'] = Auth::id();
        $course = new Course($input);
        if($course->save()){
            \Session::flash('flash_message', 'Un nuevo curso ha sido creado!');
            $author = User::find($course->user_id);

            if(isset($request->lessons)){
                foreach ($request->lessons as $key => $title) {
                    if(isset($request->descriptions[$key]) and isset($request->descriptions[$key]) !== ''){
                        $lesson = new Lesson;
                        $lesson->course_id = $course->id;
                        $lesson->titulo = $title;
                        $lesson->contenido = $request->descriptions[$key];
                        $lesson->save();
                    }
                }
            }
            return redirect(route('home'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $text = Enrollments::where('user_id' , '=', $user->id)->where('course_id', '=', $course->id)->get()->first();
            $enroll = isset($text);
            $comp = UserCourse::where('user_id', '=', $user->id)->where('course_id', '=', $course->id)->get()->first();
            $complete = (isset($comp) && $comp->course_completed == 1)?$comp->course_completed:false;
        } else {
            $enroll = false;
            $complete = false;
        }
        $author = User::find($course->user_id);
        return view('courses.singlecourse', compact('course', 'author', 'enroll', 'complete'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $submitbuttontext = "Editar curso";
        return view('courses.edit', compact('course', 'submitbuttontext'));
    }

    public function enroll(Course $course)
    {
        if (Auth::guest()) {
            return redirect(route('login'));
        }
        //add enroll request to admin dashboard
        $enrollment = Enrollments::create([
            'user_id' => Auth::id(),
            'course_id' => $course->id,
            'status' => 0,
        ]);
        $enrollment->save();
        \Session::flash('flash_message', 'Su peticion ha sido enviada, podra ver el contenido del curso una vez sea aprobada !');
        return redirect(route('home'));
    }

    public function unenroll(Course $course)
    {
        //detach record from user-course.
        UserCourse::where('user_id', '=', Auth::id())
                    ->where('course_id', '=', $course->id)
                    ->delete();
        Enrollments::where('user_id', '=', Auth::id())
                    ->where('course_id', '=', $course->id)
                    ->delete();
        \Session::flash('flash_message', 'Se ha dado de baja del curso!');
        return redirect(route('home'));
    }

    public function complete(Course $course)
    {
        UserCourse::where('user_id', '=', Auth::id())
                    ->where('course_id', '=', $course->id)
                    ->update(['course_completed' => 1]);
        \Session::flash('flash_message', 'Curso Completado!');
        return redirect(route('course.show', [$course->id]));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */
    public function update(Course $course, Request $request)
    {
        $input = $request->all();
        //$input['thumbnail'] = $request->file('thumbnail')->store('images');
        $course->update($input);
        if(isset($request->lessons)){
            foreach ($request->lessons as $key => $title) {
                if(isset($request->descriptions[$key]) and isset($request->descriptions[$key]) !== ''){
                    $lesson = new Lesson;
                    $lesson->course_id = $course->id;
                    $lesson->titulo = $title;
                    $lesson->contenido = $request->descriptions[$key];
                    $lesson->save();
                }
            }
        }
        \Session::flash('flash_message', 'El curso ha sido modificado!');
        return redirect(route('course.edit',[$course['id']]));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */
    public function destroy($r)
    {
        $course = Course::find($r);
        $course->delete();
        \Session::flash('flash_message', 'Curso Eliminado!');
        // dd($course);
        return redirect(route('course.index'));
    }

    public function lessons_index($id){
        $lesson = Lesson::find($id);


        return view('courses.lessons', compact('lesson'));
    }
}
