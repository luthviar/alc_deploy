<?php

namespace App\Http\Controllers;

use App\JobFamily;
use Illuminate\Http\Request;

class JobFamilyController extends Controller
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
        $jobFamily = JobFamily::all();
        return view('test.view-job-family')->with('jobFamily', $jobFamily);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('test.create-job-family');
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
            'name' => 'required'
        ]);

        $jobFamily = new JobFamily;
        $jobFamily->name = $request->name;
        $jobFamily->save();

        return redirect('job-family');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JobFamily  $jobFamily
     * @return \Illuminate\Http\Response
     */
    public function show(JobFamily $jobFamily)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JobFamily  $jobFamily
     * @return \Illuminate\Http\Response
     */
    public function edit(JobFamily $jobFamily)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JobFamily  $jobFamily
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobFamily $jobFamily)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JobFamily  $jobFamily
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobFamily $jobFamily)
    {
        //
    }
}
