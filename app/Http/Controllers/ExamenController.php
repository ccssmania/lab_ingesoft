<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Course;
use Auth;
use App\Examen;
use App\UserTest;

class ExamenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**if (Auth::check()) {
            $usercourse = UserCourse::where('user_id', '=', Auth::id())
                                    ->get();
            $courses = [];
            foreach ($usercourse as $row) {
                $courses[] = $row->course;
            }
            $courses = collect($courses);
        } else {*/
            $examenes= Examen::all();
        //}
        if ($examenes->isEmpty()) {
            \Session::flash('examen', 'No hay examenes disponibles');
        } /*else {
            foreach ($examenes as $examen) {
                $examen->author = User::find($examen->user_id);
            }
        }*/
        return view('examen', compact('examenes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $submitbuttontext = "Crear";
        //$courses = Course::lists('name','id')->all();
        $courses = Course::select('id','title')->get();
        

        return view('examenes.create', compact('submitbuttontext','courses'));
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
        $input['course_id'] = $request['course'];
        $examen = Examen::create($input);
        //dd($request['course']);
        /*$examen = Examen::create([
            'course_id' => $request['course'],
            'user_id' => $input['user_id'],
            'titulo_examen' => $request['titulo_examen'],
            'cantidad' => $request['cantidad'],
        ]);*/
        
        \Session::flash('flash_message', 'Un nuevo examen ha sido creado!');
        $author = User::find($examen->user_id);
        return redirect(route('home'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */
    public function show(Examen $examen)
    {
        $user = Auth::user();
        //$text = Examen::where('examen_id', '=', $examen->id)->get()->first();
        //$author = User::find($examen->user_id);
        return view('examenes.singleexamen', compact('examen'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */
    public function edit(Examen $examen)
    {
        $submitbuttontext = "Editar examen";
        return view('examenes.edit', compact('examen', 'submitbuttontext'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\r  $r
     * @return \Illuminate\Http\Response
     */
    public function update(Examen $examen, Request $request)
    {
        $input = $request->all();
        //$input['thumbnail'] = $request->file('thumbnail')->store('images');
        $examen->update($input);
        \Session::flash('flash_message', 'El examen ha sido modificado!');
        return redirect(route('examenes.edit',[$examen['id']]));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int \App\id  $r
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $examen = Examen::find($id);
        $examen->delete();
        \Session::flash('flash_message', 'Examen Eliminado!');
        // dd($examen);
        return redirect(route('examen.index'));
    }
}