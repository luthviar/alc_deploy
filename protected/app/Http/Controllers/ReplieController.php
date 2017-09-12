<?php

namespace App\Http\Controllers;

use DB;
use App\Replie;
use App\FileReplie;
use Illuminate\Http\Request;

class ReplieController extends Controller
{
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
        

        $id_reply = DB::table('replies')-> insertGetId(array(
            'id_user' => $request->id_user,
            'id_forum' => $request->id_forum,
            'title' => $request->title,
            'content' => $request->content,
        ));

        $file_pendukung = $request->file('file_pendukung');
        if (!empty($file_pendukung)) {

            foreach ($file_pendukung as $key => $file) {
                $destinationPath = 'Uploads';
                $movea = $file->move($destinationPath,$file->getClientOriginalName());
                $url_file = "Uploads/{$file->getClientOriginalName()}";

                $new_file_pendukung = new FileReplie;
                $new_file_pendukung->id_reply = $id_reply;
                $new_file_pendukung->name = $file->getClientOriginalName();
                $new_file_pendukung->url = $url_file;
                $new_file_pendukung->save();
            }
        }


        return redirect()->action(
            'ForumController@show', ['id' => $request->id_forum]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Replie  $replie
     * @return \Illuminate\Http\Response
     */
    public function show(Replie $replie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Replie  $replie
     * @return \Illuminate\Http\Response
     */
    public function edit(Replie $replie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Replie  $replie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Replie $replie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Replie  $replie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Replie $replie)
    {
        //
    }
}
