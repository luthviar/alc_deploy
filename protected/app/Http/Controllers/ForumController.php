<?php

namespace App\Http\Controllers;

use App\Forum;
use Auth;
use Carbon\Carbon;
use DB;
use App\Module;
use App\Personnel;
use App\FileForum;
use App\JobFamily;
use App\Employee;
use App\Replie;
use App\StrukturOrganisasi;
use App\Department;
use App\FileReplie;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => [
            'show'
        ]]);

        $this->middleware('checkRole', ['except' => [
            'editUser','updateUser','index','show', 'create', 'store'
        ]]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //user information
        $id_user = Auth::user()->id;
        $personnel = Personnel::where('id_user',$id_user)->first();
        $employee = Employee::where('id_personnel',$personnel->id)->first();
        $struktur = StrukturOrganisasi::find($employee->struktur);
        $department = Department::where('id_department', $struktur->id_department)->first();
        $job_family = JobFamily::find($department->id_job_family);

        $forum_umum = Forum::where('id_department', null)->where('id_job_family', null)->get();
        foreach ($forum_umum as $key => $value) {
            $value['personnel'] = Personnel::where('id_user',$value->id_user)->first();
            $value['replie'] = Replie::where('id_forum',$value->id)->get();
            if(empty($value['replie'][0])){
                $value['last_reply'] = null;
            }else{
                $value['last_reply'] = DB::table('replies')->where('id_forum',$value->id)->orderBy('id', 'desc')->take(1)->get();
                $value['last_reply_personnel'] = Personnel::where('id_user', $value['last_reply'][0]->id_user)->first();
            }
        }
        $forum_department = Forum::where('id_department',$department->id_department)->get();
        foreach ($forum_department as $key => $value) {
            $value['personnel'] = Personnel::where('id_user',$value->id_user)->first();
            $value['replie'] = Replie::where('id_forum',$value->id)->get();
            if(empty($value['replie'][0])){
                $value['last_reply'] = null;
            }else{
                $value['last_reply'] = DB::table('replies')->where('id_forum',$value->id)->orderBy('id', 'desc')->take(1)->get();
                $value['last_reply_personnel'] = Personnel::where('id_user', $value['last_reply'][0]->id_user)->first();
            }
        }
        $forum_job_family = Forum::where('id_job_family',$department->id_job_family)->get();
        foreach ($forum_job_family as $key => $value) {
            $value['personnel'] = Personnel::where('id_user',$value->id_user)->first();
            $value['replie'] = Replie::where('id_forum',$value->id)->get();
            if(empty($value['replie'][0])){
                $value['last_reply'] = null;
            }else{
                $value['last_reply'] = DB::table('replies')->where('id_forum',$value->id)->orderBy('id', 'desc')->take(1)->get();

                $value['last_reply_personnel'] = Personnel::where('id_user', $value['last_reply'][0]->id_user)->first();

            }
        }

        $module = Module::all();
        return view('view-forum')
            ->with('module',$module)
            ->with('forum_umum', $forum_umum)
            ->with('forum_department',$forum_department)
            ->with('forum_job_family',$forum_job_family)
            ->with('department',$department)
            ->with('job_family',$job_family);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $module = Module::all();
        return view('Admin/edit-forum')->with('module',$module);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_user = Auth::user()->id;
        
        $content = "";
        if ($request->id_department != null) {
            $content = $request->content3;
        }elseif($request->id_job_family != null){
            $content = $request->content2;
        }else{
            $content = $request->content;
        }
        
        $id_forum = DB::table('forums')-> insertGetId(array(
            'id_user' => $id_user,
            'title' => $request->title,
            'content' => $content,
            'can_reply' => $request->can_reply,
            'id_department' => $request->id_department,
            'id_job_family' => $request->id_job_family,
            'created_at' => Carbon::now('Asia/Jakarta'),
        ));

        $file_pendukung = $request->file('file_pendukung');
        if (!empty($file_pendukung)) {

            foreach ($file_pendukung as $key => $file) {
                $destinationPath = 'Uploads';
                $movea = $file->move($destinationPath,$file->getClientOriginalName());
                $url_file = "Uploads/{$file->getClientOriginalName()}";

                $new_file_pendukung = new FileForum;
                $new_file_pendukung->id_forum = $id_forum;
                $new_file_pendukung->name = $file->getClientOriginalName();
                $new_file_pendukung->url = $url_file;
                $new_file_pendukung->save();
            }
        }

        return redirect('forum');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function show($id_forum)
    {
        $forum = Forum::find($id_forum);
        if (empty($forum)) {
            return view('404');
        }
        $forum['personnel'] = Personnel::where('id_user',$forum->id_user)->first();
        $forum['replie'] = Replie::where('id_forum',$id_forum)->get();
        foreach ($forum['replie'] as $key => $value) {
            $value['personnel'] = Personnel::where('id_user',$value->id_user)->first();
            $value['file_pendukung'] = FileReplie::where('id_reply', $value->id)->get();
        }
        $recent = DB::table('forums')->where('id_department',$forum->id_department)->where('id_job_family',$forum->id_job_family)->orderBy('id', 'desc')->take(6)->get();
        $forum['file_pendukung'] = FileForum::where('id_forum', $id_forum)->get();
        $module = Module::all();
        return view('detail-forum')->with('forum',$forum)->with('recent',$recent)->with('module',$module);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function edit(Forum $forum)
    {
        //
    }

    public function editUser($id_forum) {
        $module = Module::all();
        $forum = Forum::find($id_forum);
        $forum['file_pendukung'] = FileForum::where('id_forum', $id_forum)->get();

        return view('edit-forum')
            ->with('module',$module)
            ->with('forum',$forum);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function update($id_forum)
    {
        //
    }

    public function updateUser(Request $request) {
        $this -> validate($request, [
            'title' => 'required',
            'content' => 'required',
        ]);

        $file = $request->file('image');
        if (empty($file)) {
            $forum = Forum::find($request->id_forum);
            $forum->title = $request->title;
            $forum->content = $request->content;
            $forum->can_reply = $request->can_reply;
            $forum->save();

            $file_pendukung = $request->file('file_pendukung');
            if (!empty($file_pendukung)) {

                foreach ($file_pendukung as $key => $file) {
                    $destinationPath = 'Uploads';
                    $movea = $file->move($destinationPath,$file->getClientOriginalName());
                    $url_file = "Uploads/{$file->getClientOriginalName()}";

                    $new_file_pendukung = new FileForum();
                    $new_file_pendukung->id_forum = $request->id_forum;
                    $new_file_pendukung->name = $file->getClientOriginalName();
                    $new_file_pendukung->url = $url_file;
                    $new_file_pendukung->save();
                }
            }
        }else{
            $destinationPath = 'uploads';
            $movea = $file->move($destinationPath,$file->getClientOriginalName());
            $url = "uploads/{$file->getClientOriginalName()}";

            $forum = Forum::find($request->id_forum);
            $forum->title = $request->title;
            $forum->content = $request->content;
            $forum->can_reply = $request->can_reply;
            $forum->image = $url;
            $forum->save();

            $file_pendukung = $request->file('file_pendukung');
            if (!empty($file_pendukung)) {

                foreach ($file_pendukung as $key => $file) {
                    $destinationPath = 'Uploads';
                    $movea = $file->move($destinationPath,$file->getClientOriginalName());
                    $url_file = "Uploads/{$file->getClientOriginalName()}";

                    $new_file_pendukung = new FileForum();
                    $new_file_pendukung->id_forum = $request->id_forum;
                    $new_file_pendukung->name = $file->getClientOriginalName();
                    $new_file_pendukung->url = $url_file;
                    $new_file_pendukung->save();
                }
            }
        }


        return redirect('forum');
    }

    public function updateUser2(Request $request) {

        DB::table('forums')
            ->where('id', $request->id_forum_edit)
            ->update(
                [
                    'title' => $request->title,
                    'can_reply' => $request->can_reply,
                    'content' => $request->content_edit,
                    'updated_at' => Carbon::now('Asia/Jakarta')
                ]
            );

        return redirect('forum');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Forum $forum)
    {
        //
    }

    public function list_forum(){
        $forum_umum = Forum::where('id_department', null)->where('id_job_family', null)->get();
            foreach ($forum_umum as $key => $value) {
                $value['personnel'] = Personnel::where('id_user',$value->id_user)->first();
                $value['replie'] = Replie::where('id_forum',$value->id)->get();
                if(empty($value['replie'][0])){
                    $value['last_reply'] = null;
                }else{
                    $value['last_reply'] = DB::table('replies')->where('id_forum',$value->id)->orderBy('id', 'desc')->take(1)->get();
                    $value['last_reply_personnel'] = Personnel::where('id_user', $value['last_reply'][0]->id_user)->first();
                }
            }
        $job_family = JobFamily::all();
        $department = Department::all();
        return view('list-forum')->with('forums', $forum_umum)->with('job_family', $job_family)->with('department',$department)->with('id_department', 0)->with('id_job_family', 0);
    }

    public function get_forum(Request $request){

        if ($request->id_category == 1) {
            $forum_umum = Forum::where('id_department', null)->where('id_job_family', null)->get();
            foreach ($forum_umum as $key => $value) {
                $value['personnel'] = Personnel::where('id_user',$value->id_user)->first();
                $value['replie'] = Replie::where('id_forum',$value->id)->get();
                if(empty($value['replie'][0])){
                    $value['last_reply'] = null;
                }else{
                    $value['last_reply'] = DB::table('replies')->where('id_forum',$value->id)->orderBy('id', 'desc')->take(1)->get();
                    $value['last_reply_personnel'] = Personnel::where('id_user', $value['last_reply'][0]->id_user)->first();
                }
            }
            return response()->json(['forums'=>$forum_umum]);

        }elseif($request->id_category == 3){
            $forum_department = Forum::where('id_department',$request->id_department)->get();
            foreach ($forum_department as $key => $value) {
                $value['personnel'] = Personnel::where('id_user',$value->id_user)->first();
                $value['replie'] = Replie::where('id_forum',$value->id)->get();
                if(empty($value['replie'][0])){
                    $value['last_reply'] = null;
                }else{
                    $value['last_reply'] = DB::table('replies')->where('id_forum',$value->id)->orderBy('id', 'desc')->take(1)->get();
                    $value['last_reply_personnel'] = Personnel::where('id_user', $value['last_reply'][0]->id_user)->first();
                }
            }
            return response()->json(['forums'=>$forum_department]);

        }else{
            $forum_job_family = Forum::where('id_job_family',$request->id_job_family)->get();
            foreach ($forum_job_family as $key => $value) {
                $value['personnel'] = Personnel::where('id_user',$value->id_user)->first();
                $value['replie'] = Replie::where('id_forum',$value->id)->get();
                if(empty($value['replie'][0])){
                    $value['last_reply'] = null;
                }else{
                    $value['last_reply'] = DB::table('replies')->where('id_forum',$value->id)->orderBy('id', 'desc')->take(1)->get();

                    $value['last_reply_personnel'] = Personnel::where('id_user', $value['last_reply'][0]->id_user)->first();

                }
            }   
            return response()->json(['forums'=>$forum_job_family]);
        }


    }


    public function delete_forum(Request $request){

        $replie = Replie::where('id_forum', $request->id_forum)->get();
        foreach ($replie as $key => $value) {
            DB::table('replies')->delete($value->id);
        }

        if ($request->id_category == 1) {
            DB::table('forums')->delete($request->id_forum);

            $forum_umum = Forum::where('id_department', null)->where('id_job_family', null)->get();
            foreach ($forum_umum as $key => $value) {
                $value['personnel'] = Personnel::where('id_user',$value->id_user)->first();
                $value['replie'] = Replie::where('id_forum',$value->id)->get();
                if(empty($value['replie'][0])){
                    $value['last_reply'] = null;
                }else{
                    $value['last_reply'] = DB::table('replies')->where('id_forum',$value->id)->orderBy('id', 'desc')->take(1)->get();
                    $value['last_reply_personnel'] = Personnel::where('id_user', $value['last_reply'][0]->id_user)->first();
                }
            }
            $job_family = JobFamily::all();
            $department = Department::all();
            return view('list-forum')->with('forums', $forum_umum)->with('job_family', $job_family)->with('department',$department)->with('id_department', 0)->with('id_job_family', 0);

        }elseif($request->id_category == 3){
            $forum = Forum::find($request->id_forum);
            $id_department = $forum->id_department;
            DB::table('forums')->delete($request->id_forum);

            $forum_department = Forum::where('id_department',$id_department)->get();
            foreach ($forum_department as $key => $value) {
                $value['personnel'] = Personnel::where('id_user',$value->id_user)->first();
                $value['replie'] = Replie::where('id_forum',$value->id)->get();
                if(empty($value['replie'][0])){
                    $value['last_reply'] = null;
                }else{
                    $value['last_reply'] = DB::table('replies')->where('id_forum',$value->id)->orderBy('id', 'desc')->take(1)->get();
                    $value['last_reply_personnel'] = Personnel::where('id_user', $value['last_reply'][0]->id_user)->first();
                }
            }
            
            $job_family = JobFamily::all();
            $department = Department::all();
            return view('list-forum')->with('forums', $forum_department)->with('job_family', $job_family)->with('department',$department)->with('id_department', $id_department)->with('id_job_family', 0);

        }else{
            $forum = Forum::find($request->id_forum);
            $id_job_family = $forum->id_job_family;
            DB::table('forums')->delete($request->id_forum);

            $forum_job_family = Forum::where('id_job_family',$id_job_family)->get();
            foreach ($forum_job_family as $key => $value) {
                $value['personnel'] = Personnel::where('id_user',$value->id_user)->first();
                $value['replie'] = Replie::where('id_forum',$value->id)->get();
                if(empty($value['replie'][0])){
                    $value['last_reply'] = null;
                }else{
                    $value['last_reply'] = DB::table('replies')->where('id_forum',$value->id)->orderBy('id', 'desc')->take(1)->get();

                    $value['last_reply_personnel'] = Personnel::where('id_user', $value['last_reply'][0]->id_user)->first();

                }
            }   

            $job_family = JobFamily::all();
            $department = Department::all();
            return view('list-forum')->with('forums', $forum_job_family)->with('job_family', $job_family)->with('department',$department)->with('id_department', 0)->with('id_job_family', $id_job_family);
        }
    }
}
