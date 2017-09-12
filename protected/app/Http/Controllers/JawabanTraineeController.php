<?php

namespace App\Http\Controllers;

use App\Module;
use App\JawabanTrainee;
use App\Test;
use App\Question;
use App\OpsiJawaban;
use App\UserTest;
use App\SectionTraining;
use App\Training;
use Illuminate\Http\Request;

class JawabanTraineeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

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
        $this -> validate($request, [
            'id_user' => 'required',
            'id_test' => 'required',
        ]);

        $question = Question::where('id_test', $request->id_test)->get();
        $test = Test::find($request->id_test);
        $section = SectionTraining::find($test->id_section_training);
        $benar = 0;
        foreach ($question as $key => $value) {
            $jawaban = new JawabanTrainee;
            $jawaban->id_user = $request->id_user;
            $jawaban->id_question = $value->id;
            $jawaban->isi_jawaban = $request->$value['id'];
            $opsi = OpsiJawaban::find($jawaban->isi_jawaban);
            if (empty($opsi) or $opsi->is_true == 0) {
                $jawaban->skor = 0;
            }else{
                $jawaban->skor = 1;
                $benar += 1;
                
            }
            $jawaban->save();
        }
        if ($test->jumlah_soal == 0) {
            $skor = null;    
        }else{
            $skor = ($benar/$test->jumlah_soal)*100;    
        }
        
        if ($section->id_type == 1) {

            $user_test = UserTest::where('id_user',$request->id_user)->where('id_training',$section->id_training)->first();
            $user_test->pre_test_score = $skor;
            $user_test->close_pre_test = 1;
            $user_test->save();

            $user_test_db  = UserTest::where('id_user',$request->id_user)->where('id_training',$section->id_training)->first();
            $skor          = $user_test_db->pre_test_score; 

            //sent to view
            $module = Module::all();
            $training = Training::find($section->id_training);
            $modul_section = SectionTraining::where('id_training',$section->id_training)->where('id_type',2)->first();
            $next_section = SectionTraining::where('id_training',$section->id_training)->where('id_type',$section->id_type +1)->first();
            // return view('test-result')->with('module',$module)->with('training',$training)->with('id_section',$section->id)->with('skor_pre_test',$skor)->with('next_section',$next_section);
            return redirect('/section-training/'.$next_section->id);
        }elseif ($section->id_type ==3) {
            $user_test = UserTest::where('id_user',$request->id_user)->where('id_training',$section->id_training)->first();
            $user_test->id_post_test = $request->id_test;
            $user_test->post_test_score = $skor;
            $user_test->save();

            $user_test_db  = UserTest::where('id_user',$request->id_user)->where('id_training',$section->id_training)->first();
            $skor          = $user_test_db->post_test_score; 

            //sent to view
            $module = Module::all();
            $training = Training::find($section->id_training);
            $modul_section = SectionTraining::where('id_training',$section->id_training)->where('id_type',2)->first();
            return view('test-result')->with('module',$module)->with('training',$training)->with('id_section',$section->id)->with('skor_post_test',$skor)->with('skor_pre_test',$user_test->pre_test_score);
        }
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JawabanTrainee  $jawabanTrainee
     * @return \Illuminate\Http\Response
     */
    public function show(JawabanTrainee $jawabanTrainee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JawabanTrainee  $jawabanTrainee
     * @return \Illuminate\Http\Response
     */
    public function edit(JawabanTrainee $jawabanTrainee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JawabanTrainee  $jawabanTrainee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JawabanTrainee $jawabanTrainee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JawabanTrainee  $jawabanTrainee
     * @return \Illuminate\Http\Response
     */
    public function destroy(JawabanTrainee $jawabanTrainee)
    {
        //
    }
}
