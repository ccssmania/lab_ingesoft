<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Course;
use Auth;
use App\Examen;
use App\UserTest;
use App\Result;
use App\Log;
use App\UserCourse;

class ExamenController extends Controller
{

    /**
     * Just Users Logged in
     *
     * @return void
     */
    public function __construct(){
        $this->middleware("auth");
    }


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
        $count = 0;
        if(\Auth::user()->role()->first()->name === 'Admin'){
            $examenes = Examen::all();
        }else{
            $examenes = [];
            $all_users_exam = \Auth::user()->exams;
            foreach ($all_users_exam as $user_exam) {
                $examenes[] = $user_exam;
                if(Log::where('user_id', \Auth::user()->id)->where('examen_id', $user_exam->id)->first() == null){
                    break;
                }else{
                    $count++;
                }
            }
        }
        $progress_bar = ($count * 100) / (count(\Auth::user()->exams) > 0 ? count(\Auth::user()->exams) : 1);
        //}
        if (count($examenes) == 0) {
            \Session::flash('examen', 'No hay examenes disponibles');
        } /*else {
            foreach ($examenes as $examen) {
                $examen->author = User::find($examen->user_id);
            }
        }*/
        return view('examen', compact('examenes', 'progress_bar'));
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

    public function save_exam(Request $request){
        $recomendaciones = '<br/><strong>Recomendaciones</strong><br/>';
        $examen = Examen::find($request->examen_id);
        $respuesta_preguntas = $request->all();
        $rights = 0;
        $message = '';
        $questions = $examen->questions;
        foreach ($questions as $question) {
            if(isset($respuesta_preguntas['respuesta_pregunta_'.$question->id_pregunta])){
                if($respuesta_preguntas['respuesta_pregunta_'.$question->id_pregunta] == $question->respuesta_correcta)
                    $rights += 1;
                else
                    $recomendaciones .= 'Se recomienda estudiar más de: ' . $question->question_type . '<br></br>';
            }
        }
        $score = ($rights * 5) / count($questions);
        
        $result = new Result;

        $result->score = $score;
        $result->user_id = \Auth::user()->id;
        $result->examen_id = $examen->id;

        if($result->save()){
            $message .= 'Examen Enviado! ' . 'NOTA FINAL: '. $score;
            $last_result = Result::where('examen_id', $examen->id)->where( 'user_id', \Auth::user()->id)->orderBy('score', 'Desc')->first();
            if(isset($last_result)){
                if($last_result->score < $score){
                    $logro = new Log;
                    $logro->name = 'Nota mas alta: ' . $score;
                    $logro->description = 'Ha alcanzado una nota mas alta en el examen: '. $examen->titulo_examen;
                    $logro->user_id = \Auth::user()->id;
                    $logro->save();
                }

                if($score > 3 and Log::where('user_id', \Auth::user()->id)->where('examen_id', $examen->id)->first() == null){
                    $new_exam = new Log;
                    $new_exam->name = 'Ha superado el examen';
                    $new_exam->description = 'El siguiente examen ya esta disponible';
                    $new_exam->user_id = \Auth::user()->id;
                    $new_exam->examen_id = $examen->id;
                    $new_exam->save();
                    $message .= '<br></br> Ha superado el examen. ';
                }
                $new_achivement = $score == $last_result->score ? '<br></br> Nuevo logro: NOTA MAS ALTA' : '';
            }
            else{
                $logro = new Log;
                $logro->name = 'Nota mas alta: ' . $score;
                $logro->description = 'Ha alcanzado una nota mas alta en el examen: '. $examen->titulo_examen;
                $logro->user_id = \Auth::user()->id;
                $logro->save();

                if($score > 3 and Log::where('user_id', \Auth::user()->id)->where('examen_id', $examen->id)->first() == null){
                    $new_exam = new Log;
                    $new_exam->name = 'Ha superado el examen';
                    $new_exam->description = 'El siguiente examen ya esta disponible';
                    $new_exam->user_id = \Auth::user()->id;
                    $new_exam->examen_id = $examen->id;
                    $new_exam->save();
                    $message .= '<br></br> Ha superado el examen. ';
                }
                $new_achivement = '<br></br> Nuevo logro: NOTA MAS ALTA ---- ';
            }

            if($score >= 3){
                $course = $examen->course;
                $count = 0;
                $user_id = \Auth::user()->id;
                foreach ($course->exams as $exam) {
                    $examen_id = $exam->id;
                    if(Log::where('user_id', $user_id)->where('examen_id', $examen_id)->first() !== null){
                        $count++;
                    }else{
                        break;
                    }
                }
                if($count == count($course->exams)){
                    $user_course = UserCourse::where('course_id', $course->id)->where('user_id', $user_id)->first();
                    $user_course->course_completed = 1;
                    $user_course->save();
                }
            }
            $message .=  $new_achivement . '<br/>' . $recomendaciones;
            \Session::flash('flash_message', $message);
            //dd(\Session::has('flash_message'), \Session::get('flash_message'));
            return redirect('/home');
        }else{
            \Session::flash('errorMessage', 'algo salio mal');
            return redirect('/home');
        }
    }
}