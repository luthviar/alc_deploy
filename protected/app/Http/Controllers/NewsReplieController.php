<?php

namespace App\Http\Controllers;

use DB;
use App\NewsReplie;
use App\FileNewsReplie;
use Illuminate\Http\Request;

class NewsReplieController extends Controller
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
        $id_news_reply = 0;
        if (empty($request->content)) {
           $id_news_reply = DB::table('news_replies')-> insertGetId(array(
                'id_news' => $request->id_news,
                'id_user' => $request->id_user,
                'title' => $request->title,
                'content' => "",
               
            ));
        }else{
            $id_news_reply = DB::table('news_replies')-> insertGetId(array(
                'id_news' => $request->id_news,
                'id_user' => $request->id_user,
                'title' => $request->title,
                'content' => $request->content,
               
            ));
        }
        

        $file_pendukung = $request->file('file_pendukung');
        if (!empty($file_pendukung)) {

            foreach ($file_pendukung as $key => $file) {
                $destinationPath = 'Uploads';
                $movea = $file->move($destinationPath,$file->getClientOriginalName());
                $url_file = "Uploads/{$file->getClientOriginalName()}";

                $new_file_pendukung = new FileNewsReplie;
                $new_file_pendukung->id_news_reply = $id_news_reply;
                $new_file_pendukung->name = $file->getClientOriginalName();
                $new_file_pendukung->url = $url_file;
                $new_file_pendukung->save();
            }
        }
        return redirect()->action(
            'BeritaController@show', ['id' => $request->id_news]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NewsReplie  $newsReplie
     * @return \Illuminate\Http\Response
     */
    public function show(NewsReplie $newsReplie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NewsReplie  $newsReplie
     * @return \Illuminate\Http\Response
     */
    public function edit(NewsReplie $newsReplie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NewsReplie  $newsReplie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NewsReplie $newsReplie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NewsReplie  $newsReplie
     * @return \Illuminate\Http\Response
     */
    public function destroy(NewsReplie $newsReplie)
    {
        //
    }
}
