<?php

namespace App\Http\Controllers;

use App\Module;
use Auth;
use App\JobFamily;
use App\Personnel;
use App\StrukturOrganisasi;
use App\Employee;
use App\UserTrainingAuth;
use App\LevelPosition;
use App\Department;
use App\Training;
use Illuminate\Http\Request;

class ModuleController extends Controller
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
        $module = Module::all();
        return view('test.view-module')->with('module',$module);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('test.create-module');
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
            'nama' => 'required',
            'desc' => 'required',
        ]);

        $module = new Module;
        $module->short_name = $request->short_name;
        $module->nama = $request->nama;
        $module->description = $request->desc;
        $module->save();

        return redirect('module');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $module             = Module::all();
        $modul              = Module::find($id);
        if (empty($modul)) {
            return view('404');
        }
        $department         = Department::all();
        $training           = Training::where('id_module',$id)->where('is_publish', 1)->get();

        //get user information
        $id_user            = Auth::user()->id;
        $personnel          = Personnel::where('id_user',$id_user)->first();
        $employee           = Employee::where('id_personnel',$personnel->id)->first();
        $job_family_user    = null;

        if (empty($employee)) {
            
        }else{
            $struktur = StrukturOrganisasi::find($employee->struktur);

            if (!empty($struktur)) {
                $department_user = Department::where('id_department',$struktur->id_department)->first();
                $job_family_user = JobFamily::find($department_user->id_job_family);
            }
        }

        foreach ($training as $key => $value) {
            if (empty($value->id_job_family)) {
                if ($value->id_module == 4 ) {
                    $user_auth = UserTrainingAuth::where('id_training',$value->id)->where('id_user',$id_user)->first();
                    if ($employee->level_position >= 6) {
                        $value['open'] = 1;
                    }else{
                        if (empty($user_auth)) {
                            $value['open'] = 0;
                        }else{
                            if($user_auth->auth == 1){
                                $value['open'] = 1;
                            }else{
                                $value['open'] = 2;
                            }
                        }
                    }
                }elseif ($value->id_module == 5) {
                    $user_auth = UserTrainingAuth::where('id_training',$value->id)->where('id_user',$id_user)->first();
                    if (empty($user_auth)) {
                        $value['open'] = 0;
                    }else{
                        if($user_auth->auth == 1){
                            $value['open'] = 1;
                        }else{
                            $value['open'] = 2;
                        }
                    }
                }else{
                    $value['open'] = 1;
                }
            }else {
                if( $employee->level_position == 11){
                    $value['open'] = 1;
                }elseif ($value->id_module ==3 and $value->id_job_family == $job_family_user->id) {
                    $value['open'] = 1;
                }elseif ($value->id_module ==3 and $value->id_job_family != $job_family_user->id) {
                    $user_auth = UserTrainingAuth::where('id_training',$value->id)->where('id_user',$id_user)->first();
                    if($employee->level_position == 11){
                        $value['open'] = 1;
                    }elseif (empty($user_auth)) {
                        $value['open'] = 0;
                    }else{
                        if($user_auth->auth == 1){
                            $value['open'] = 1;
                        }else{
                            $value['open'] = 2;
                        }
                    }
                }
            }
        }
        return view('module')->with('module',$module)->with('aktif_modul',$modul)->with('department',$department)->with('training',$training);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function edit(Module $module)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Module $module)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function destroy(Module $module)
    {
        //
    }
}
