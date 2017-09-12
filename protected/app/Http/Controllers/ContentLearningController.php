<?php

namespace App\Http\Controllers;

use App\Module;
use App\ContentLearning;
use App\SectionTraining;
use App\Training;
use DB;
use Illuminate\Http\Request;

class ContentLearningController extends Controller
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

    public function add_content_learning($id_training)
    {
        $section = SectionTraining::where('id_training',$id_training)->where('id_type',2)->first();
        $id_section = null;
        if (empty($section)) {
            $id_section = DB::table('section_trainings')-> insertGetId(array(
                'id_training' => $id_training,
                'id_type' => 2,
            ));
            return view('add-materi-training')->with('contents',null)->with('id_section',$id_section)->with('id_training',$id_training);
        }else{
            $id_section = $section->id;
            return view('add-materi-training')->with('contents',null)->with('id_section',$id_section)->with('id_training',$id_training);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $file = $request->file('file');
        $destinationPath = 'contents';
        $movea = $file->move($destinationPath,$file->getClientOriginalName());
        $url = "/ViewerJS/index.html#../contents/{$file->getClientOriginalName()}";
        $content = new ContentLearning;
        $content->id_section = $request->id_section;
        $content->file_name = $request->file_name;
        $content->url = $url;
        $content->save();

        return redirect()->action(
                'ContentLearningController@get_content_learning', ['id_section' => $request->id_section]
                );
        
    }

    public function get_content_learning($id_section)
    {
        
        $contents = ContentLearning::where('id_section',$id_section)->get();
        $section = SectionTraining::find($id_section);
        $id_training = $section->id_training;
        return view('add-materi-training')->with('contents',$contents)->with('id_section',$id_section)->with('id_training',$id_training);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContentLearning  $contentLearning
     * @return \Illuminate\Http\Response
     */
    public function show($id_section)
    {
        $module = Module::all();
        $content = ContentLearning::where('id_section',$id_section)->get();
        $section = SectionTraining::find($id_section);
        $training = Training::find($section->id_training);
        return view('content-learning')->with('module',$module)->with('content',$content)->with('training',$training);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContentLearning  $contentLearning
     * @return \Illuminate\Http\Response
     */
    public function edit(ContentLearning $contentLearning)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContentLearning  $contentLearning
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContentLearning $contentLearning)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContentLearning  $contentLearning
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_contentLearning)
    {
        $content    = ContentLearning::find($id_contentLearning);
        $section    = SectionTraining::find($content->id_section);
        $training   =  Training::find($section->id_training);
        //delete content learning
        DB:: table('content_learnings')->delete($id_contentLearning);

        return redirect()->action(
                'TrainingController@view', ['id' => $training->id]
            );
    }

    public function add_content (Request $request){
        $training   = Training::find($request->id_training);
        $section    = SectionTraining::where('id_training', $request->id_training)->where('id_type', 2)->first();

        // check if section empty
        if (empty($section)) {
            $new_section                = new SectionTraining;
            $new_section->id_training   = $request->id_training;
            $new_section->id_type       = 2;
            $new_section->save();

            $section = $new_section;
        }

        // upload file to path
        $file                   = $request->file('file');
        $destinationPath        = 'contents';
        $movea                  = $file->move($destinationPath,$file->getClientOriginalName());
        $url                    = "/ViewerJS/index.html#../contents/{$file->getClientOriginalName()}";
        
        // add content learning
        $content                = new ContentLearning;
        $content->id_section    = $section->id;
        $content->file_name     = $request->file_name;
        $content->description   = $request->description;
        $content->url           = $url;
        $content->save();

        return redirect()->action(
                'TrainingController@view', ['id' => $training->id]
            );
    }

    public function get_content_preview(Request $request){

        $content_learning = ContentLearning::find($request->id_content);
        return response()->json(['content'=>$content_learning]);
    }


}
