<?php

namespace App\Http\Controllers;

use App\Examen;
use App\User;
use Illuminate\Http\Request;
use App\Test;
use Auth;
use App\UserTest;
use Illuminate\Contracts\Session\Session;
use Illuminate\Foundation\Console\Presets\React;
use Symfony\Component\CssSelector\Node\SelectorNode;

class TestController extends Controller
{
    public function index()
    {

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
        if (Auth::check()) {
            $usertest = UserTest::where('user_id', '=', Auth::id())
                                    ->get();
            $tests = [];
            foreach ($usertest as $row) {
                $tests[] = $row->test;
            }
            $tests = collect($tests);
        } else {
            */
            $tests = Test::all();
        //}
        if ($tests->isEmpty()) {
            \Session::flash('test', 'No se ha encontrado examenes para realizar');
        } else {
            foreach ($tests as $test) {
                $test->author = User::find($test->user_id);
            }
        }
        return view('tests', compact('tests'));
    }
    /*
    public function account(Test $_test)
    {
        $_test = Test::find(Auth::id());
        $submitbuttontext = "Actualizar";
        return view('_test.edit', compact('submitbuttontext', '_test'));
    }
    */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $submitbuttontext = "Crear";
        //$cantidad = DB::table('examenes')->select('cantidad')->where('id','=',$test->examen_id)->first();
        // completos hace referencia a los examenes que ya tienen preguntas asignadas
        $completos = Test::select('examen_id')->get();
        $arreglo[] = "";
        foreach ($completos as $completo) {
            array_push($arreglo,$completo->examen_id);
        }
        //dd($arreglo);
        $examenes = Examen::select('cantidad','titulo_examen','id')->whereNotIn('id',$completos)->get();
        //dd($examenes);
        $variable = 'Elija un examen';
        return view('tests.create', compact('submitbuttontext','examenes','variable'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*for ($i=0; $i < $request->cantidad; $i++) { 
            # code...
            Test::create([
                ''
            ]);
        }*/
        $input =$request->all();
        $user = \Auth::user();
        for ($i=1; $i < $input['cantidad']+1; $i++) { 
            $titulo = 'pregunta_'.$i;
            Test::create([
                'examen_id' => $input['id_examen'],
                'id_pregunta' => $i,
                'pregunta' => $input['pregunta_'.$i],
                'respuesta_1' => $input['respuesta_1_'.$i],
                'respuesta_2' => $input['respuesta_2_'.$i],
                'respuesta_3' => $input['respuesta_3_'.$i],
                'respuesta_4' => $input['respuesta_4_'.$i],
                'respuesta_correcta' => $input['respuesta_correcta_'.$i],
                'imagen' => "esto_funca.jpg",
                'user_id' => $user->id
            ]);
        }


        //$input['thumbnail'] = $request->file('thumbnail')->store('imagen');
        //$test = Test::create($input);
        //Session::flash('flash_message', 'Una nueva pregunta ha sido creada!');
        //$author = User::find($test->user_id);
        return redirect(route('home'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test)
    {
        $user = Auth::user();
        //$text = UserTest::where('user_id' , '=', $user->id)->where('test_id', '=', $test->id)->get()->first();
        $text = Test::where('id', '=', $test->id)->get()->first();
        //$enroll = (isset($text))?$text->course_enrolled:'';
        //$comp = UserCourse::where('user_id', '=', $user->id)->where('course_id', '=', $course->id)->get()->first();
        //$complete = (isset($comp) && $comp->course_completed == 1)?$comp->course_completed:false;
        $cantidad_preguntas = Examen::select('cantidad')->where('id','=',$test->examen_id)->first();
        //$author = User::find($test->user_id);
        return view('tests.singletest', compact('test'));
    }
    
    public function presentar_examen(Request $request){
        $preguntas = Test::select()->where('examen_id',$request['examen_id'])->get();
        $examen_id = $request['examen_id'];
        return view('tests.singletest', compact('preguntas', 'examen_id'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test)
    {
        $submitbuttontext = "Editar";
        return view('tests.edit', compact('test','submitbuttontext'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Test $test, Request $request)
    {
        $input = $request->all();
        //$input['thumbnail'] = $request->file('thumbnail')->store('imagen');
        $test->update($input);
        \Session::flash('flash_message', 'La pregunta ha sido modificada!');
        return redirect(route('test.edit',[$test['id']]));
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $test = Test::find($id);
        $test->delete();
        \Session::flash('flash_message', 'Pregunta Eliminada!');
        // dd($course);
        return redirect(route('test.index'));
    }



    //-----------------------------------------------------------
    
}
