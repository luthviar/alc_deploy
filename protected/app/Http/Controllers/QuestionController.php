<?php

namespace App\Http\Controllers;

use App\Question;
use App\OpsiJawaban;
use App\JawabanTrainee;
use App\SectionTraining;
use App\Test;
use App\Training;
use DB;
use Illuminate\Http\Request;

class QuestionController extends Controller
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
        $id_test = $request->id_test;
        $id_question = DB::table('questions')-> insertGetId(array(
            'id_test' => $request->id_test,
            'pertanyaan' => $request->question,
        ));
        $count= 0;
        foreach ($request->opsi as $key => $value) {
            if ($count == $request->isTrue) {
                $opsi = new OpsiJawaban;
                $opsi->id_question = $id_question;
                $opsi->isi_opsi = $value;
                $opsi->is_true = 1;
                $opsi->save();
            }else{
                $opsi = new OpsiJawaban;
                $opsi->id_question = $id_question;
                $opsi->isi_opsi = $value;
                $opsi->is_true = 0;
                $opsi->save();
            }
            $count +=1;
        }
        $test = Test::find($request->id_test);
        $test->jumlah_soal +=  1;
        $test->save(); 

        $question = Question::where('id_test',$request->id_test)->get();
        foreach ($question as $key => $value) {
            $value['opsi'] = OpsiJawaban::where('id_question',$value->id)->get();
        }
        $section = SectionTraining::find($test->id_section_training);
        if ($section->id_type == 1) {
            return view('add-question')
                ->with('id_test', $id_test)
                ->with('questions',$question)
                ->with('time',$request->time)
                ->with('id_training',$request->id_training);
        }else{
            return view('add-question-post-test')
                ->with('id_test', $id_test)
                ->with('questions',$question)
                ->with('time',$request->time)
                ->with('id_training',$request->id_training);
        }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit($id_question)
    {
        $question = Question::find($id_question);
        $question['opsi'] = OpsiJawaban::where('id_question',$id_question)->get();
        return view('edit-question')->with('question',$question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $question = Question::find($request->id_question);
        $question->pertanyaan = $request->id_test;
        $question->pertanyaan = $request->question;
        $question->save();

        //delete saved option
        $opsi = OpsiJawaban::where('id_question',$request->id_question)->get();
        $jawaban_trainee = JawabanTrainee::where('id_question',$request->id_question)->get();
        foreach ($jawaban_trainee as $key => $value) {
            DB::table('jawaban_trainees')->delete($value->id);
        }
        foreach ($opsi as $key => $value) {
            DB::table('opsi_jawabans')->delete($value->id);
        }
        //save new option
        $count= 0;
        foreach ($request->opsi as $key => $value) {
            if ($count == $request->isTrue) {
                $opsi = new OpsiJawaban;
                $opsi->id_question = $request->id_question;
                $opsi->isi_opsi = $value;
                $opsi->is_true = 1;
                $opsi->save();
            }else{
                $opsi = new OpsiJawaban;
                $opsi->id_question = $request->id_question;
                $opsi->isi_opsi = $value;
                $opsi->is_true = 0;
                $opsi->save();
            }
            $count +=1;
        }

        $test = Test::find($question->id_test);
        $section = SectionTraining::find($test->id_section_training);
        $training = Training::find($section->id_training);

        return redirect()->action(
                'TrainingController@view', ['id' => $training->id]
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id_question )
    {
        $opsi_jawabans = OpsiJawaban::where('id_question', $id_question)->get();
        $jawaban_trainee = JawabanTrainee::where('id_question',$id_question)->get();
        foreach ($jawaban_trainee as $key => $value) {
            DB::table('jawaban_trainees')->delete($value->id);
        }
        foreach ($opsi_jawabans as $key => $value) {
            DB::table('opsi_jawabans')->delete($value->id);
        }
        
        $question = Question::find($id_question);
        
        $test = Test::find($question->id_test);
        $test->jumlah_soal = $test->jumlah_soal - 1;
        $test->save();

        $section = SectionTraining::find($test->id_section_training);
        $training = Training::find($section->id_training);

        DB:: table('questions')->delete($id_question);

        return redirect()->action(
                'TrainingController@view', ['id' => $training->id]
            );
    }

    public function submit (Request $request){
        $training       = Training::find($request->id_training);
        $id_test        = $request->id_test;
        $id_question    = DB::table('questions')-> insertGetId(array(
            'id_test' => $request->id_test,
            'pertanyaan' => $request->question,
        ));
        $count  = 0;
        foreach ($request->opsi as $key => $value) {
            if ($count == $request->isTrue) {
                $opsi = new OpsiJawaban;
                $opsi->id_question  = $id_question;
                $opsi->isi_opsi     = $value;
                $opsi->is_true      = 1;
                $opsi->save();
            }else{
                $opsi = new OpsiJawaban;
                $opsi->id_question  = $id_question;
                $opsi->isi_opsi     = $value;
                $opsi->is_true      = 0;
                $opsi->save();
            }
            $count += 1;
        }
        $test   = Test::find($request->id_test);
        $test->jumlah_soal +=  1;
        $test->save(); 

        return redirect()->action(
                'TrainingController@view', ['id' => $training->id]
            );
    }
}
