<?php

namespace App\Http\Controllers;

use App\User;
use DB;
use App\Berita;
use App\Personnel;
use App\NewsReplie;
use App\FileNewsReplie;
use App\FileBerita;
use App\Module;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth', ['except' => [
            'readMore', 'show'
        ]]);

        $this->middleware('checkRole', ['except' => [
            'readMore' , 'show'
        ]]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function readMore()
    {
        $news = Berita::where('flag_aktif', 1)->orderBy('created_at', 'desc')->get();
        $module = Module::all();
        return view('newsboard')->with('berita',$news)->with('module',$module);
    }

    public function index()
    {
        return view('list-news');
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add-news');
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
            'id_user' => 'required',
            'can_reply' => 'required',
        ]);
        $file = $request->file('image');
        if (!empty($file)) {
            $file = $request->file('image');
            $destinationPath = 'Uploads';
            $movea = $file->move($destinationPath,$file->getClientOriginalName());
            $url = "Uploads/{$file->getClientOriginalName()}";

            $id_news = DB::table('beritas')-> insertGetId(array(
                'id_user' => $request->id_user,
                'title' => $request->title,
                'content' => $request->content,
                'can_reply' => $request->can_reply,
                'image' => $url,
            ));

            $file_pendukung = $request->file('file_pendukung');
            if (!empty($file_pendukung)) {

                foreach ($file_pendukung as $key => $file) {
                    $destinationPath = 'Uploads';
                    $movea = $file->move($destinationPath,$file->getClientOriginalName());
                    $url_file = "Uploads/{$file->getClientOriginalName()}";

                    $new_file_pendukung = new FileBerita;
                    $new_file_pendukung->id_berita = $id_news;
                    $new_file_pendukung->name = $file->getClientOriginalName();
                    $new_file_pendukung->url = $url_file;
                    $new_file_pendukung->save();
                }
            }
        }else{
            $id_news = DB::table('beritas')-> insertGetId(array(
                'id_user' => $request->id_user,
                'title' => $request->title,
                'content' => $request->content,
                'can_reply' => $request->can_reply,
                'image' => null,
            ));

            $file_pendukung = $request->file('file_pendukung');
            if (!empty($file_pendukung)) {

                foreach ($file_pendukung as $key => $file) {
                    $destinationPath = 'Uploads';
                    $movea = $file->move($destinationPath,$file->getClientOriginalName());
                    $url_file = "Uploads/{$file->getClientOriginalName()}";

                    $new_file_pendukung = new FileBerita;
                    $new_file_pendukung->id_berita = $id_news;
                    $new_file_pendukung->name = $file->getClientOriginalName();
                    $new_file_pendukung->url = $url_file;
                    $new_file_pendukung->save();
                }
            }

        }
        
        return redirect('news');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function show($id_berita)
    {
        $berita = Berita::find($id_berita);
        if (empty($berita)) {
            return view('404');
        }
        $berita['user'] = Personnel::where('id_user',$berita->id_user)->first();
        $replies = null;
        if ($berita->can_reply == 1) {
            $replies = NewsReplie::where('id_news',$id_berita)->get();
            if (empty($replies)) {
                # code...
            }else{
                foreach ($replies as $key => $value) {
                    $value['user'] = Personnel::where('id_user',$value->id_user)->first();
                    $value['file_pendukung'] = FileNewsReplie::where('id_news_reply', $value->id)->get();
                }
            }
        }
        $berita['file_pendukung'] = FileBerita::where('id_berita', $id_berita)->get();
        $recent = DB::table('beritas')->orderBy('id', 'desc')->take(6)->get();
        $module = Module::all();
        return view('view-news')->with('module',$module)->with('news',$berita)->with('replies',$replies)->with('beritas',$recent);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function edit($id_berita)
    {
        $berita = Berita::find($id_berita);
        if (empty($berita)) {
            return view('404');
        }
        $berita['file_pendukung'] = FileBerita::where('id_berita', $id_berita)->get();
        return view('edit-news')->with('news',$berita);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Berita  $berita
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
            $berita = Berita::find($request->id_news);
            $berita->id_user = $request->id_user;
            $berita->title = $request->title;
            $berita->content = $request->content;
            $berita->can_reply = $request->can_reply;    
            $berita->save();

            $file_pendukung = $request->file('file_pendukung');
            if (!empty($file_pendukung)) {

                foreach ($file_pendukung as $key => $file) {
                    $destinationPath = 'Uploads';
                    $movea = $file->move($destinationPath,$file->getClientOriginalName());
                    $url_file = "Uploads/{$file->getClientOriginalName()}";

                    $new_file_pendukung = new FileBerita;
                    $new_file_pendukung->id_berita = $request->id_news;
                    $new_file_pendukung->name = $file->getClientOriginalName();
                    $new_file_pendukung->url = $url_file;
                    $new_file_pendukung->save();
                }
            }
        }else{
            $destinationPath = 'uploads';
            $movea = $file->move($destinationPath,$file->getClientOriginalName());
            $url = "uploads/{$file->getClientOriginalName()}";
            
            $berita = Berita::find($request->id_news);
            $berita->id_user = $request->id_user;
            $berita->title = $request->title;
            $berita->content = $request->content;
            $berita->can_reply = $request->can_reply;
            $berita->image = $url;    
            $berita->save();    

            $file_pendukung = $request->file('file_pendukung');
            if (!empty($file_pendukung)) {

                foreach ($file_pendukung as $key => $file) {
                    $destinationPath = 'Uploads';
                    $movea = $file->move($destinationPath,$file->getClientOriginalName());
                    $url_file = "Uploads/{$file->getClientOriginalName()}";

                    $new_file_pendukung = new FileBerita;
                    $new_file_pendukung->id_berita = $request->id_news;
                    $new_file_pendukung->name = $file->getClientOriginalName();
                    $new_file_pendukung->url = $url_file;
                    $new_file_pendukung->save();
                }
            }
        }
        

        return redirect('news');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function destroy(Berita $berita)
    {
        //
    }

    public function active($id){
        $berita = Berita::find($id);
        $berita->can_reply = 1;
        $berita->save();

        return redirect('news');
    }

    public function nonactive($id){
        $berita = Berita::find($id);
        $berita->can_reply = 0;
        $berita->save();

        return redirect('news');
    }

    public function delete_attachment($id){
        $news_attachment = FileBerita::find($id);
        $news_attachment->delete();

        return back();
    }

    public function status_active($id){
        $berita = Berita::find($id);
        $berita->flag_aktif = 1;
        $berita->save();

        return redirect('news');
    }

    public function status_nonactive($id){
        $berita = Berita::find($id);
        $berita->flag_aktif = 0;
        $berita->save();

        return redirect('news');
    }
}
