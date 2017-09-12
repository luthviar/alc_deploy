<?php

namespace App\Http\Controllers;

use App\StrukturOrganisasi;
use App\Department;
use App\Section;
use App\Unit;
use App\JobFamily;
use App\Divisi;
use DB;
use Illuminate\Http\Request;

class StrukturOrganisasiController extends Controller
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
        
        $struktur = StrukturOrganisasi::distinct()->get(['id_divisi']);
        $divisi = array();
        foreach ($struktur as $key => $value) {
            $new_divisi    = Divisi::where('id_divisi',$value->id_divisi)->first();
            array_push($divisi, $new_divisi);
        }
        foreach ($divisi as $key => $value) {
            $value['unit'] = StrukturOrganisasi::where('id_divisi', $value->id_divisi)->distinct()->get(['id_unit']);

            foreach ($value['unit'] as  $unit) {
                $unit['department'] = StrukturOrganisasi::where('id_divisi', $value->id_divisi)->where('id_unit', $unit->id_unit)->distinct()->get(['id_department']);

                foreach ($unit['department'] as $key => $department) {
                    $department['section'] = StrukturOrganisasi::where('id_divisi', $value->id_divisi)->where('id_unit', $unit->id_unit)->where('id_department', $department->id_department)->distinct()->get(['id_section']);
                }
            }
        }

        $units = Unit::all();
        $departments = Department::all();
        $sections = Section::all();
        $job_family = JobFamily::all();


        // foreach ($struktur as $key => $value) {

        //     $value['department']    = Department::where('id_department',$value->id_department)->first();
        //     $value['divisi']        = Divisi::where('id_divisi',$value->id_divisi)->first();
        //     $value['unit']          = Unit::where('id_unit', $value->id_unit)->first();
        //     $value['section']       = Section::where('id_section',$value->id_section)->first();
            
        // }
        return view('list-struktur')
            ->with('struktur',$struktur)
            ->with('divisi',$divisi)
            ->with('units', $units)
            ->with('departments', $departments)
            ->with('sections', $sections)
            ->with('job_family', $job_family);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisi     = Divisi::all();
        $unit       = Unit::all();
        $department = Department::all();
        $section    = Section::all();

        return view('add-struktur')
            ->with('divisi', $divisi)
            ->with('unit',$unit)
            ->with('department',$department)
            ->with('section', $section);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //        list of variable : typeadd , iddiv , idunit , iddept , idsect , nametypeadd
//        $struktur = StrukturOrganisasi::where('id_divisi', $request->id_divisi)->where('id_unit', $request->id_unit)->where('id_department', $request->id_department)->where('id_section', $request->id_section)->first();



            if ($request->typeadd == 'unit') {
                $storeunit= new Unit();
                $storeunit->nama_unit = $request->nametypeadd;
                $storeunit->save();

                $idlast = DB::table('units')->orderBy('id_unit','desc')->first();
                $checkunit = DB::table('struktur_organisasis')
                    ->orderBy('id','desc')
                    ->where('id_divisi',$request->iddiv)
                    ->where('id_unit',null)
                    ->get()->count();
                if($checkunit==0) {
                    $storeorg = new StrukturOrganisasi();
                    $storeorg->id_divisi = $request->iddiv;
                    $storeorg->id_unit = $idlast->id_unit;
                    $storeorg->save();
                } else {
                    DB::table('struktur_organisasis')
                        ->where('id_divisi', $request->iddiv)
                        ->update(
                            [
                                'id_unit' => $idlast->id_unit
                            ]
                        );
                }

            } elseif ($request->typeadd == 'department') {
                $storedept= new Department();
                $storedept->nama_departmen = $request->nametypeadd;
                $storedept->id_job_family = $request->id_job_family;
                $storedept->save();

                $idlast = DB::table('departments')->orderBy('id_department','desc')->first();
                $checkdept = DB::table('struktur_organisasis')
                    ->orderBy('id','desc')
                    ->where('id_divisi',$request->iddiv)
                    ->where('id_unit',$request->idunit)
                    ->where('id_department', null)
                    ->get()->count();

                if($checkdept==0) {
                    $storeorg = new StrukturOrganisasi();
                    $storeorg->id_divisi = $request->iddiv;
                    $storeorg->id_unit = $request->idunit;
                    $storeorg->id_department = $idlast->id_department;
                    $storeorg->save();
                } else {
                    DB::table('struktur_organisasis')
                        ->where('id_divisi', $request->iddiv)
                        ->where('id_unit',$request->idunit)
                        ->update(
                            [
                                'id_department' => $idlast->id_department
                            ]
                        );
                }
            } elseif ($request->typeadd == 'section') {

                $storesect = new Section();
                $storesect->nama_section = $request->nametypeadd;
                $storesect->save();

                $idlast = DB::table('sections')->orderBy('id_section','desc')->first();
                $checksect = DB::table('struktur_organisasis')
                    ->orderBy('id','desc')
                    ->where('id_divisi',$request->iddiv)
                    ->where('id_unit',$request->idunit)
                    ->where('id_department',$request->iddept)
                    ->where('id_section',null)
                    ->get()->count();

                if($checksect==0) {
                    $storeorg = new StrukturOrganisasi();
                    $storeorg->id_divisi = $request->iddiv;
                    $storeorg->id_unit = $request->idunit;
                    $storeorg->id_department = $request->iddept;
                    $storeorg->id_section = $idlast->id_section;
                    $storeorg->save();
                }  else {
                    DB::table('struktur_organisasis')
                        ->where('id_divisi', $request->iddiv)
                        ->where('id_unit',$request->idunit)
                        ->where('id_department',$request->iddept)
                        ->update(
                            [
                                'id_section' => $idlast->id_section
                            ]
                        );
                }
            } elseif ($request->typeadd == 'divisi') {

                $storediv = new Divisi();
                $storediv->nama_divisi = $request->nametypeadd;
                $storediv->save();

                $idlast = DB::table('divisis')->orderBy('id_divisi','desc')->first();

                    $storeorg = new StrukturOrganisasi();
                    $storeorg->id_divisi = $idlast->id_divisi;
                    $storeorg->save();

            }

//            $new_struktur               = new StrukturOrganisasi;
//            $new_struktur->id_divisi    = $request->id_divisi;
//            $new_struktur->id_unit      = $request->id_unit;
//            $new_struktur->id_department= $request->id_department;
//            $new_struktur->id_section   = $request->id_section;
//            $new_struktur->save();

        return redirect('struktur');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StrukturOrganisasi  $strukturOrganisasi
     * @return \Illuminate\Http\Response
     */
    public function show(StrukturOrganisasi $strukturOrganisasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StrukturOrganisasi  $strukturOrganisasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        dd($request->name);
        return 'berhasil';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StrukturOrganisasi  $strukturOrganisasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!empty($request->nametype)) {
            if ($request->type == 'divisi') {
                DB::table('divisis')
                    ->where('id_divisi', $request->id_type)
                    ->update(
                        [
                            'nama_divisi' => $request->nametype
                        ]
                    );
            } elseif ($request->type == 'unit') {
                DB::table('units')
                    ->where('id_unit', $request->id_type)
                    ->update(
                        [
                            'nama_unit' => $request->nametype
                        ]
                    );
            } elseif ($request->type == 'department') {
                DB::table('departments')
                    ->where('id_department', $request->id_type)
                    ->update(
                        [
                            'nama_departmen' => $request->nametype
                        ]
                    );
            } elseif ($request->type == 'section') {
                DB::table('sections')
                    ->where('id_section', $request->id_type)
                    ->update(
                        [
                            'nama_section' => $request->nametype
                        ]
                    );
            }

        }
        return redirect('struktur');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StrukturOrganisasi  $strukturOrganisasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(StrukturOrganisasi $strukturOrganisasi)
    {
        //
    }

    public function get_unit(Request $request){

        $id_divisi = $request->id_divisi;
        $struktur = StrukturOrganisasi::where('id_divisi',$id_divisi)->distinct()->get(['id_unit']);
        $unit = array();
        foreach ($struktur as $key => $value) {
            $new_unit = Unit::where('id_unit', $value->id_unit)->first();
            array_push($unit, $new_unit);
        }

        return response()->json(['units'=>$unit]);
        
    }

    public function get_department(Request $request){

        $id_divisi  = $request->id_divisi;
        $id_unit    = $request->id_unit;
        $struktur   = StrukturOrganisasi::where('id_unit',$id_unit)->where('id_divisi',$id_divisi)->distinct()->get(['id_department']);
        $departments = array();
        foreach ($struktur as $key => $value) {
            $new_department = Department::where('id_department', $value->id_department)->first();
            array_push($departments, $new_department);
        }

        return response()->json(['departments'=>$departments]);
        
    }

    public function get_section(Request $request){

        $id_divisi      = $request->id_divisi;
        $id_unit        = $request->id_unit;
        $id_department  = $request->id_department;
        $struktur   = StrukturOrganisasi::where('id_department',$id_department)->where('id_unit',$id_unit)->where('id_divisi',$id_divisi)->distinct()->get(['id_section']);
        $sections = array();
        foreach ($struktur as $key => $value) {
            $new_section = Section::where('id_section', $value->id_section)->first();
            array_push($sections, $new_section);
        }

        return response()->json(['sections'=>$sections]);
        
    }
}
