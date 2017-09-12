@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      @include('test.admin-nav')
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                
                <h2>Create Module</h2>

                <form class="" action="/module" method="post">
                  Short-name :<br> <input type="text" name="short_name" ><br>
                  Name :<br> <input type="text" name="nama"  ><br>
                  Description :<br> <textarea name="desc" rows="8" cols="80" ></textarea><br>
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  
                  <input type="submit" name="name" value="submit">
                </form>

            </div>
        </div>
    </div>
</div>

@endsection