<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('home'));
});

Auth::routes();

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/course', 'CourseController@index')->name('course.index');

Route::resource('/course', 'CourseController')->except('index', 'show')->middleware('auth');

Route::get('/course/{course}/enroll', 'CourseController@enroll')->name('course.enroll');

Route::get('/course/{course}/unenroll', 'CourseController@unenroll')->name('course.unenroll');

Route::get('/course/{course}/complete', 'CourseController@complete')->name('course.complete');

Route::get('/course/{course}', 'CourseController@show')->name('course.show');

Route::resource('/user', 'UserController')->except('show')->middleware('auth');

Route::get('/user/{user}/account', 'UserController@account')->name('user.account');

Route::get('/dashboard', 'EnrollmentController@dashboard')->name('dashboard')->middleware('auth');

Route::get('/dashboard/{user}/{course}/approve', 'EnrollmentController@approve')->name('enrollment.approve');

Route::get('/dashboard/{user}/{course}/disapprove', 'EnrollmentController@disapprove')->name('enrollment.disapprove');

Route::get('/test', 'TestController@index')->name('test.index');

Route::resource('/test', 'TestController')->except('index', 'show')->middleware('auth');

Route::get('/test/{test}', 'TestController@show')->name('test.show');

Route::get('/examen', 'ExamenController@index')->name('examen.index');

Route::resource('/examen', 'ExamenController')->except('index', 'show')->middleware('auth');

Route::get('/examen/{examen}', 'ExamenController@show')->name('examen.show');

Route::get('/test.singletest', 'TestController@presentar_examen')->name('test.singletest');

Route::post('/save/exam', 'ExamenController@save_exam');

Route::get('/logros', 'LogController@index');

Route::get('/create_roles', 'HomeController@create_roles');
Route::get('/remove/{id}', 'HomeController@remove');
Route::get('/course/lessons/{id}', 'CourseController@lessons_index');

//Access to storage images

Route::get('/images/{filename}',function($filename){
	$path = storage_path("app/images/$filename");


	if(!\File::exists($path)) abort(404);
	$file = \File::get($path);
	$type = \File::mimeType($path);

	$response = Response::make($file,200);
	$response->header("Content-Type", $type);

	return $response;
});