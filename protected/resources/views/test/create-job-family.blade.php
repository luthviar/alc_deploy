@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
      @include('test.admin-nav')
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">


                <h2>Create Job Family</h2>


                <form class="" action="/job-family" method="post">
                  Name : <br>
                  <input type="text" name="name" ><br>
                
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  
                  <input type="submit"  value="submit">
                </form>

          </div>
        </div>
    </div>
</div>

@endsection