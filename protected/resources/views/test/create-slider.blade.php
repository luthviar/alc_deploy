@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
      @include('test.admin-nav')
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">


                <h2>Create Berita</h2>


                <form class="" action="{{ URL::action('ContentSliderController@store') }}" method="post">
                  
                  Title : <br>
                  <input type="text" name="title" ><br>
                  Content : <br>
                  <input type="text" name="content" ><br>
                  Is Active : <br>
                  <select name="is_active">
                      <option value="1">Yes</option>
                      <option value="0">No</option>
                  </select><br>
                  Url image : <br>
                  <input type="text" name="image" ><br>
                
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  
                  <input type="submit"  value="submit">
                </form>

          </div>
        </div>
    </div>
</div>

@endsection