<?php

namespace App\Http\Controllers;

use App\Module;
use App\Berita;
use DB;
use App\ContentSlider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     
    public function __construct()
    {
        $this->middleware('auth');
    }
    */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $module = Module::all();
        $berita = DB::table('beritas')->where('flag_aktif',1)->orderBy('id', 'desc')->take(6)->get();
        $slider = ContentSlider::where('is_activ',1)->get();
        return view('home')->with('module',$module)->with('berita',$berita)->with('slider',$slider);
    }
}
