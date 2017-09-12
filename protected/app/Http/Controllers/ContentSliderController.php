<?php

namespace App\Http\Controllers;

use App\ContentSlider;
use DB;
use App\FileSlider;
use App\Module;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContentSliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => [
            'show'
        ]]);

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
        
        return view('list-slider');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add-slider');
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
            'title' => 'required',
            'content' => 'required',
        ]);
        if (empty($file = $request->file('image'))) {

            //add slider to database
            $id_slider = DB::table('content_sliders')-> insertGetId(array(
                'is_activ'      => 0,
                'title'         => $request->title,
                'content'       => $request->content,
                'created_at'    => Carbon::now('Asia/Jakarta'),
                'updated_at'    => Carbon::now('Asia/Jakarta')
            ));

            //get attachment of slider
            $file_pendukung = $request->file('file_pendukung');
            if (!empty($file_pendukung)) {

                foreach ($file_pendukung as $key => $file) {
                    $destinationPath    = 'Uploads';
                    $movea              = $file->move($destinationPath,$file->getClientOriginalName());
                    $url_file           = "Uploads/{$file->getClientOriginalName()}";

                    $new_file_pendukung             = new FileSlider;
                    $new_file_pendukung->id_slider  = $id_slider;
                    $new_file_pendukung->name       = $file->getClientOriginalName();
                    $new_file_pendukung->url        = $url_file;
                    $new_file_pendukung->save();
                }
            }

        }else{
            //upload image to server
            $file               = $request->file('image');
            $destinationPath    = 'uploads';
            $movea              = $file->move($destinationPath,$file->getClientOriginalName());
            $url                = "uploads/{$file->getClientOriginalName()}";

            //add slider to database
            $id_slider = DB::table('content_sliders')-> insertGetId(array(
                'is_activ'      => 0,
                'title'         => $request->title,
                'content'       => $request->content,
                'image'         => $url,
                'created_at'    => Carbon::now('Asia/Jakarta'),
                'updated_at'    => Carbon::now('Asia/Jakarta')
            ));

            //get attachment of slider
            $file_pendukung = $request->file('file_pendukung');
            if (!empty($file_pendukung)) {

                foreach ($file_pendukung as $key => $file) {
                    $destinationPath    = 'Uploads';
                    $movea              = $file->move($destinationPath,$file->getClientOriginalName());
                    $url_file           = "Uploads/{$file->getClientOriginalName()}";

                    $new_file_pendukung             = new FileSlider;
                    $new_file_pendukung->id_slider  = $id_slider;
                    $new_file_pendukung->name       = $file->getClientOriginalName();
                    $new_file_pendukung->url        = $url_file;
                    $new_file_pendukung->save();
                }
            }

        }

        return redirect('slider');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContentSlider  $contentSlider
     * @return \Illuminate\Http\Response
     */
    public function show($id_contentSlider)
    {
        $slider = ContentSlider::find($id_contentSlider);
        if (empty($slider)) {
            return view('404');
        }
        $slider['file_pendukung'] = FileSlider::where('id_slider', $id_contentSlider)->get();
        $module = Module::all();
        return view('view-slider')->with('slider', $slider)->with('module',$module);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContentSlider  $contentSlider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = ContentSlider::find($id);
        if (empty($slider)) {
            return view('404');
        }
        $slider['file_pendukung'] = FileSlider::where('id_slider',$id)->get();
        return view('edit-slider')->with('slider',$slider);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContentSlider  $contentSlider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this -> validate($request, [
            'title' => 'required',
            'content' => 'required',
        ]);

        $file = $request->file('image');
        if (empty($file)) {
            $slider = ContentSlider::find($request->id_slider);
            $slider->is_activ = $request->is_activ;
            $slider->title = $request->title;
            $slider->content = $request->content;
            $slider->save();    

            //get attachment of slider
            $file_pendukung = $request->file('file_pendukung');
            if (!empty($file_pendukung)) {

                foreach ($file_pendukung as $key => $file) {
                    $destinationPath    = 'Uploads';
                    $movea              = $file->move($destinationPath,$file->getClientOriginalName());
                    $url_file           = "Uploads/{$file->getClientOriginalName()}";

                    $new_file_pendukung             = new FileSlider;
                    $new_file_pendukung->id_slider  = $request->id_slider;
                    $new_file_pendukung->name       = $file->getClientOriginalName();
                    $new_file_pendukung->url        = $url_file;
                    $new_file_pendukung->save();
                }
            }
        }else{
            $destinationPath = 'uploads';
            $movea = $file->move($destinationPath,$file->getClientOriginalName());
            $url = "uploads/{$file->getClientOriginalName()}";
            
            $slider = ContentSlider::find($request->id_slider);
            $slider->is_activ = $request->is_activ;
            $slider->title = $request->title;
            $slider->content = $request->content;
            $slider->image = $url;
            $slider->save();    

            //get attachment of slider
            $file_pendukung = $request->file('file_pendukung');
            if (!empty($file_pendukung)) {

                foreach ($file_pendukung as $key => $file) {
                    $destinationPath    = 'Uploads';
                    $movea              = $file->move($destinationPath,$file->getClientOriginalName());
                    $url_file           = "Uploads/{$file->getClientOriginalName()}";

                    $new_file_pendukung             = new FileSlider;
                    $new_file_pendukung->id_slider  = $request->id_slider;
                    $new_file_pendukung->name       = $file->getClientOriginalName();
                    $new_file_pendukung->url        = $url_file;
                    $new_file_pendukung->save();
                }
            }
        }
        

        return redirect('slider');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContentSlider  $contentSlider
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContentSlider $contentSlider)
    {
        //
    }

    public function active($id){
        $slider = ContentSlider::find($id);
        $slider->is_activ = 1;
        $slider->save();

        return redirect('slider');
    }

    public function nonactive($id){
        $slider = ContentSlider::find($id);
        $slider->is_activ = 0;
        $slider->save();

        return redirect('slider');
    }

    public function get_slider_ajax(Request $request){



        $slider = DB::table('content_sliders')->skip($request['start']-1)->take($requestData['length'])->get();
        $can_activ = true;
        $slider_aktif = ContentSlider::where('is_activ', 1)->get();
        if (count($slider_aktif) >= 5) {
            $can_activ = false;
        }

        $data = array();
        foreach ($slider as $key => $slid) {
            $nestedData=array(); 

            $nestedData[] = $slid["title"];
            $nestedData[] = "asda";
            $nestedData[] = "asddas";
            $nestedData[] = "asddas";
            
            $data[] = $nestedData;
        }
        
        return response()->json(['data'=>$data]);
    }

    public function delete_attachment($id){
        $news_attachment = FileSlider::find($id);
        $news_attachment->delete();

        return back();
    }
}
