@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
      @include('test.admin-nav')
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">


                <h2>Create Department</h2>


                <form class="" action="/department" method="post">
                  ID Department : <br>
                  <input type="text" name="id_department" ><br>
                  Nama Department : <br>
                  <input type="text" name="nama_department" ><br>
                  Job Family : <br>
                  <select name="job_family">
                  @foreach ($jobFamily as $jobs)
                      <option value="{{$jobs->id}}">{{ $jobs->name }}</option>
                  @endforeach
                  </select><br>
                
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  
                  <input type="submit"  value="submit">
                </form>

          </div>
        </div>
    </div>
</div>

@endsection