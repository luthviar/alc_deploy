@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      @include('test.admin-nav')
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">


				@foreach ($module as $modul)
				  <a href="/module/{{$modul->id}}"><h4>{{$modul->nama}}</h4></a>
				<hr>
				@endforeach

		    </div>
        </div>
    </div>
</div>

@endsection