<?php

namespace App\Http\Controllers;

use App\Test;
use DB;
use App\SectionTraining;
use App\SectionTrainingType;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('checkRole');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_section_training = DB::table('section_trainings')-> insertGetId(array(
            'id_training' => $request->id_training,
            'id_type' => $request->id_type,
        ));
        $id_test = DB::table('tests')-> insertGetId(array(
            'id_section_training' => $id_section_training,
            'time' => $request->time,
            'jumlah_soal' => 0,
            'attemp' => 1,
            'publised' => 1,
            
        ));
        return view('add-question')->with('id_training',$request->id_training)->with('time',$request->time)->with('id_test',$id_test)->with('questions',null);
    }

    public function store_post_test(Request $request)
    {
        $id_section_training = DB::table('section_trainings')-> insertGetId(array(
            'id_training' => $request->id_training,
            'id_type' => $request->id_type,
        ));
        $id_test = DB::table('tests')-> insertGetId(array(
            'id_section_training' => $id_section_training,
            'time' => $request->time,
            'jumlah_soal' => 0,
            'attemp' => 1,
            'publised' => 1,
            
        ));
        return view('add-question-post-test')->with('id_training',$request->id_training)->with('time',$request->time)->with('id_test',$id_test)->with('questions',null);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Test $test)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test)
    {
        //
    }

    // function for change time pre test and post test
    public function change_time (Request $request){

        if ($request->id_test == null) {
            $section = SectionTraining::where('id_training', $request->id_training)->where('id_type', $request->id_type)->first();

            //if section training not create, create section training
            if (empty($section)) {
                $newsection                = new SectionTraining;
                $newsection->id_training   = $request->id_training;
                $newsection->id_type       = $request->id_type;
                $newsection->save();

                $section = $newsection;
            }

            // add test to section training
            $test                       = new Test;
            $test->id_section_training  = $section->id;
            $test->time                 = $request->time;
            $test->jumlah_soal          = 0;
            $test->attemp               = 1;
            $test->publised             = 1;
            $test->save();

            

            return redirect()->action(
                'TrainingController@view', ['id' => $section->id_training]
            );
            
        }else{

            // find test and change time
            $test       = Test::find($request->id_test);
            $test->time = $request->time;
            $test->save();

            $section = SectionTraining::find($test->id_section_training);

            return redirect()->action(
                'TrainingController@view', ['id' => $section->id_training]
            );
        }
        
    }
}
