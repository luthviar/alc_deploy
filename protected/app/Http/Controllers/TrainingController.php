<?php

namespace App\Http\Controllers;

use App\Module;
use DB;
use Auth;
use App\Department;
use App\JobFamily;
use App\Question;
use App\OpsiJawaban;
use App\Training;
use App\ContentLearning;
use App\Personnel;
use App\Test;
use App\UserTest;
use App\Employee;
use App\UserTrainingAuth;
use App\StrukturOrganisasi;
use App\SectionTraining;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('checkRole', ['except' => [
            'show'
        ]]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //server side
        return view('list-training');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $module = Module::all();
       $jobs = JobFamily::all();
       $department = Department::all();
       return view('add-training')->with('JobFamily', $jobs)->with('module', $module)->with('department',$department);
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
            'module' => 'required',
            'title' => 'required',
        ]);
        $id_training = null;
        if ($request->module == 3) {
            $department = Department::where('id_department',$request->department)->first();
            $job_family = $department->id_job_family;
            $id_training = DB::table('trainings')-> insertGetId(array(
                'title' => $request->title,
                'description' => $request->description,
                'id_module' => $request->module,
                'is_publish' => 0,
                'id_department' => $request->department,
                'id_job_family' => $job_family,
            ));
        }else{
            $id_training = DB::table('trainings')-> insertGetId(array(
                'title' => $request->title,
                'description' => $request->description,
                'id_module' => $request->module,
                'is_publish' => 0,
                
            ));
        }

        $id_section_pre_test = DB::table('section_trainings')-> insertGetId(array(
            'id_training' => $id_training,
            'id_type' => 1
        ));

        $test                       = new Test;
        $test->id_section_training  = $id_section_pre_test;
        $test->time                 = 0;
        $test->jumlah_soal          = 0;
        $test->attemp               = 1;
        $test->publised             = 1;
        $test->save();

        $section_materi                 = new SectionTraining;
        $section_materi->id_training    = $id_training;
        $section_materi->id_type        = 2;
        $section_materi->save();

        $id_section_post_test = DB::table('section_trainings')-> insertGetId(array(
            'id_training' => $id_training,
            'id_type' => 3
        ));

        $test                       = new Test;
        $test->id_section_training  = $id_section_post_test;
        $test->time                 = 0;
        $test->jumlah_soal          = 0;
        $test->attemp               = 1;
        $test->publised             = 1;
        $test->save();
        
        return redirect('/training/view/'.$id_training);
    }

    public function add_post_test($id_training)
    {
        
        return view('add-question-post-test')->with('id_training',$id_training)->with('time',0)->with('questions',null);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $module = Module::all();
        $training = Training::find($id);
        if (empty($training)) {
            return view('404');
        }

        $section = SectionTraining::where('id_training',$id)->where('id_type','1')->first();

        $id_user = Auth::user()->id;
        $personnel = Personnel::where('id_user',$id_user)->first();
        $employee = Employee::where('id_personnel',$personnel->id)->first();
        $job_family_user = null;
        if (empty($employee)) {
            return view('404');
        }else{
            $struktur = StrukturOrganisasi::find($employee->struktur);
            $department_user = Department::where('id_department',$struktur->id_department)->first();
            $job_family_user = JobFamily::find($department_user->id_job_family);
        }
        
        if (empty($training->id_job_family)) {
            $user_auth = UserTrainingAuth::where('id_training',$training->id)->where('id_user',$id_user)->first();
            if ($training->id_module == 4 ) {
                if ($employee->level_position >= 6) {
                    $training['open'] = 1;
                }else{
                    if (empty($user_auth)) {
                        $training['open'] = 0;
                    }else{
                        if($user_auth->auth == 1){
                            $training['open'] = 1;
                        }else{
                            $training['open'] = 2;
                        }
                    }
                }
            }elseif ($training->id_module == 5) {
                
                if (empty($user_auth)) {
                    $training['open'] = 0;
                }else{
                    if($user_auth->auth == 1){
                        $training['open'] = 1;
                    }else{
                        $training['open'] = 2;
                    }
                }
            }else{
                $training['open'] = 1;
            }
            
        }else {
            if ($training->id_module ==3 and $training->id_job_family == $job_family_user->id) {
                $training['open'] = 1;
            }elseif ($training->id_module ==3 and $training->id_job_family != $job_family_user->id) {
                $user_auth = UserTrainingAuth::where('id_training',$training->id)->where('id_user',$id_user)->first();
                if (empty($user_auth)) {
                    $training['open'] = 0;
                }else{
                    if($user_auth->auth == 1){
                        $training['open'] = 1;
                    }else{
                        $training['open'] = 2;
                    }
                    
                }
            }
        }
        $all_section = SectionTraining::where('id_training',$id)->get();
        if (count($all_section) == 1) {
            $section = SectionTraining::where('id_training',$id)->where('id_type','2')->first();    
            
            return view('training')->with('training',$training)->with('module',$module)->with('next_section',$section);
            
        }
        return view('training')->with('training',$training)->with('module',$module)->with('next_section',$section);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function edit( $id_training )
    {
        $training = Training::find($id_training);
        $module = Module::all();
        $department = Department::all();

        return view('edit-training-info')->with('module',$module)->with('department',$department)->with('training',$training);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $training = Training::find($request->id_training);
        $training->title        = $request->title;
        $training->description  = $request->description;
        $training->id_module    = $request->module;
        if ($request->module == 3) {
            $training->id_department = $request->department;
            $department = Department::where('id_department',$request->department)->first();
            $training->id_job_family = $department->id_job_family;
        }
        $training->save();

        return redirect()->action(
                'TrainingController@view', ['id' => $training->id]
            );
    }

    public function view( $id_training ){

        $training = Training::find($id_training);
        if (empty($training)) {
            return view('404');
        }
        $training['module'] = Module::find($training->id_module);
        if (!empty($training->id_department)) {
            $training['department'] = Department::where('id_department',$training->id_department)->first();
        }
        $section = SectionTraining::where('id_training',$id_training)->get();
        foreach ($section as $key => $value) {
            if ($value->id_type == 1) {
                $training['pretest'] = Test::where('id_section_training', $value->id)->first();
                if (empty($training['pretest'])) {
                    $training['pretest-question'] = null;
                }else{
                    $training['pretest-question'] = Question::where('id_test', $training['pretest']->id)->get();
                    if (!empty($training['pretest-question'][0])) {
                        foreach ($training['pretest-question'] as $key => $ques) {
                            $ques['opsi'] = OpsiJawaban::where('id_question', $ques->id)->get();
                        }        
                    }
                }
            }elseif ($value->id_type == 2) {
                $training['content'] = ContentLearning::where('id_section', $value->id)->get();
            }elseif ($value->id_type == 3) {
                $training['posttest'] = Test::where('id_section_training', $value->id)->first();
                if (empty($training['posttest'])) {
                    $training['posttest-question'] = null;
                }else{
                    $training['posttest-question'] = Question::where('id_test', $training['posttest']->id)->get();
                    if (!empty($training['posttest-question'][0])) {
                        foreach ($training['posttest-question'] as $key => $ques) {
                            $ques['opsi'] = OpsiJawaban::where('id_question', $ques->id)->get();
                        }
                    }
                }
            }
        }

        return view('view-training')->with('training', $training);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function destroy(Training $training)
    {
        //
    }

    public function publish ($id_training){
        $training = Training::find($id_training);
        $training->is_publish = 1;
        $training->save();
        return redirect('/training');
    }

    public function deactive ($id_training){
        $training = Training::find($id_training);
        $training->is_publish = 0;
        $training->save();
        return redirect('/training');
    }

    public function see_trainee($id){
        $training = Training::find($id);
        if (empty($training)) {
            return view('404');
        }
        $test_training = UserTest::where('id_training',$id)->get();
        if (!empty($test_training[0])) {
            foreach ($test_training as $key => $value) {
                $value['personnel'] = Personnel::where('id_user',$value->id_user)->first();
            }
        }
        return view('view-trainee')->with('test_training' , $test_training)->with('training',$training);
    }
}
