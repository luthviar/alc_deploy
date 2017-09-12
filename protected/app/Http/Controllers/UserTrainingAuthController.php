<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Auth;
use DB;
use App\User;
use App\UserTrainingAuth;
use App\Personnel;
use App\Employee;
use App\PasswordReset;
use App\StrukturOrganisasi;
use App\Department;
use App\Training;
use Mail;

use App\Http\Requests;

class UserTrainingAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('checkRole', ['except' => [
            'request_access' 
        ]]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_auth = UserTrainingAuth::all();
        foreach ($user_auth as $key => $value) {
            //get personnel and departmen
            $value['personnel'] = Personnel::where('id_user',$value->id_user)->first();
            $employee = Employee::where('id_personnel', $value['personnel']->id)->first();
            $struktur = StrukturOrganisasi::find($employee->struktur);
            $value['personnel-department'] = Department::where('id_department',$struktur->id_department)->first();
            //get training
            $value['training'] = Training::find($value->id_training);
            $value['training-department'] = Department::where('id_department',$value['training']->id_department)->first();
        }

        $password_auth = PasswordReset::all();
        
        foreach ($password_auth as $key => $value) {
            $usr = User::where('username', $value->username)->first();
            if (empty($usr)) {
                $value['valid'] = 0;
            }else{
                $psnl = Personnel::where('email', $value->email)->first();
                if (empty($psnl)) {
                    $value['valid'] = 0;
                }else{
                    $value['valid'] = 1;
                    $value['user'] = $usr;
                }
            }
        }
        return view('user-training-auth')->with('user_auth',$user_auth)->with('password_auth', $password_auth);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserTrainingAuth  $userTrainingAuth
     * @return \Illuminate\Http\Response
     */
    public function show(UserTrainingAuth $userTrainingAuth)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserTrainingAuth  $userTrainingAuth
     * @return \Illuminate\Http\Response
     */
    public function edit(UserTrainingAuth $userTrainingAuth)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserTrainingAuth  $userTrainingAuth
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserTrainingAuth $userTrainingAuth)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserTrainingAuth  $userTrainingAuth
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserTrainingAuth $userTrainingAuth)
    {
        //
    }

    public function active($id){
        $user_auth = UserTrainingAuth::find($id);
        $user_auth->auth = 1;
        $user_auth->save();

        return redirect('access');
    }

    public function nonactive($id){
        $user_auth = UserTrainingAuth::find($id);
        $user_auth->auth = 0;
        $user_auth->save();

        return redirect('access');
    }

    public function request_access($id_training){
        
        $id_user = Auth::user()->id;
        $user_auth = new UserTrainingAuth;
        $user_auth->id_user = $id_user;
        $user_auth->id_training = $id_training;
        $user_auth->auth = 0;
        $user_auth->save();

        return redirect()->action(
            'TrainingController@show', ['id' => $id_training]
        );
    }

    public function process($id){
        $user = User::find($id);

        return view('process-access')->with('user', $user);
    }

    public function process_submit($id_user){

        $pinrandom = mt_rand(100, 999)
             . mt_rand(100, 999);
        // shuffle the result
        $newpass = str_shuffle($pinrandom);


        $user = User::find($id_user);
        $user->password = bcrypt($newpass);
        $user->save();

        $personnel = Personnel::where('id_user',$user->id)->first();
        $password = PasswordReset::where('username',$user->username)->where('email',$personnel->email)->where('is_process', 0)->first();
        $password->is_process = 1;
        $password->save();

        $dataEmail = array(
            'fname'=>$personnel->fname,
            'lname'=>$personnel->lname,
            'newpass'=>$newpass,
        );

        Mail::send(['html'=>'email-content.password-reset'], $dataEmail, function($message) use($personnel) {
            $message->to($personnel->email, $personnel->fname.' '.$personnel->lname)->subject
            ('[ALC] Informasi Ganti Password');
            $message->from('luthviar.a@gmail.com','Admin ALC');
        });

        return redirect('access');
    }

}
