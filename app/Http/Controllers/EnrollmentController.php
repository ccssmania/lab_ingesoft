<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\UserCourse;
use App\Enrollments;
use App\User;
use Auth;

class EnrollmentController extends Controller
{
    public function approve(User $user, Course $course)
    {
        $usercourse = UserCourse::create(
            [
                'user_id' => $user->id,
                'course_id' => $course->id,
                'course_enrolled' => 1,
                'course_completed' => 0
            ]
        );
        $usercourse->save();
        $enroll = Enrollments::where('user_id', '=', $user->id)
                    ->where('course_id', '=', $course->id)->first();
        $enroll->status = 1;
        //dd($enroll);
        $enroll->save();
        \Session::flash('flash_message', 'La inscripcion ha sido aprobada');
        return redirect(route('dashboard'));
    }

    public function disapprove(User $user, Course $course)
    {
        $enrollment = Enrollments::where('user_id', '=', $user->id)
                    ->where('course_id', '=', $course->id)
                    ->delete();
        \Session::flash('flash_message', 'La inscripcion no ha sido aprobada!');
        return redirect(route('dashboard'));
    }

    public function dashboard()
    {
        $user = Auth::user();
        $courses = Course::where('user_id', '=', $user->id);
        $courses = $courses->pluck('id')->all();
        $enrollments = Enrollments::where('status',0)->get();
        //dd($enrollments);
        return view('dashboard', compact('enrollments'));
    }
}
