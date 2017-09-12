<?php

namespace App\Http\Controllers;

use App\ScoreSummary;
use App\Personnel;
use App\Employee;
use App\StrukturOrganisasi;
use App\Department;
use App\Divisi;
use App\Section;
use App\Unit;
use App\JobFamily;
use App\LevelPosition;
use App\UserTest;
use App\Training;
use App\Module;
use App\User;
use Illuminate\Http\Request;

class ScoreSummaryController extends Controller
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
        return view('list-score-summary');
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
    

        $file = $request->file('score');
        $destinationPath = 'raports';
        $movea = $file->move($destinationPath,$file->getClientOriginalName());
        $url = "/ViewerJS/index.html#../raports/{$file->getClientOriginalName()}";

        $score = new ScoreSummary;
        $score->id_user = $request->id_user;
        $score->file_name = $file->getClientOriginalName();
        $score->url_file_pdf = $url;
        $score->save();

        return redirect('raport');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ScoreSummary  $scoreSummary
     * @return \Illuminate\Http\Response
     */
    public function show($id_user)
    {
        $personnel = Personnel::where('id_user',$id_user)->first();
        if (empty($personnel)) {
            return view('404');
        }
        $id_personnel = $personnel->id;
        $user = User::find($personnel->id_user);
        $personnel['user'] = $user;
        $employee = Employee::where('id_personnel',$id_personnel)->first();
        $personnel['employee'] = $employee;
        if (empty($employee)) {
            $personnel['struktur'] = null;
        }else{
            $struktur = StrukturOrganisasi::find($employee->struktur);
            if (!empty($struktur)) {
                $personnel['struktur'] = $struktur;
                $personnel['level'] = LevelPosition::find($employee->level_position);
                $personnel['divisi'] = Divisi::where('id_divisi',$struktur->id_divisi)->first();
                $personnel['section'] = Section::where('id_section',$struktur->id_section)->first();
                $personnel['department'] = Department::where('id_department',$struktur->id_department)->first();
                $personnel['unit'] = Unit::where('id_unit',$struktur->id_unit)->first();
                $personnel['job_family'] = JobFamily::find($personnel['department']->id_job_family);
            }
        }
        $personnel['score'] = ScoreSummary::where('id_user',$personnel->id_user)->get();
        $personnel['training'] = UserTest::where('id_user',$personnel->id_user)->get();
        foreach ($personnel['training'] as $key => $value) {
            $value['info'] = Training::find($value->id_training);
        }

        $raport = ScoreSummary::where('id_user',$id_user)->orderBy('id','desc')->first();
        $module = Module::all();
        return view('view-raport')->with('module',$module)->with('raport',$raport)->with('personnel',$personnel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ScoreSummary  $scoreSummary
     * @return \Illuminate\Http\Response
     */
    public function edit(ScoreSummary $scoreSummary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ScoreSummary  $scoreSummary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScoreSummary $scoreSummary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ScoreSummary  $scoreSummary
     * @return \Illuminate\Http\Response
     */
    public function destroy(ScoreSummary $scoreSummary)
    {
        //
    }

    public function add_raport($id_user)
    {
        //
    }
}
