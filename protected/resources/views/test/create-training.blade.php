@extends('layouts.head')

@section('content')

<div class="container">
    <div class="row">
      @include('test.admin-nav')
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">


                <h2>Create Training</h2>


                <form class="" action="/training" method="post">
                  Module : <br>
                  <select name="module">
                  @foreach ($module as $modul)
                      <option value="{{$modul->id}}">{{ $modul->nama }}</option>
                  @endforeach
                  </select><br>
                  Training Title :<br>
                  <input type="text" name="title"><br>
                  Training Description :<br>
                  <textarea name="desc" rows="8" cols="80"></textarea><br>
                  Enroll Key (optional) :<br>
                  <input type="text" name="enroll_key"><br>
                  Select Departement :<br>
                  <select name="department">
                    <option value="">All Department</option>
                    @foreach ($department as $deps)
                      <option value="{{$deps->id_department}}">{{ $deps->nama_departmen }}</option>
                    @endforeach
                  </select><br>                  

                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  
                  <input type="submit" name="name" value="post">
                </form>

          </div>
        </div>
    </div>
</div>

@endsection