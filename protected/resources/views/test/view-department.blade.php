@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      @include('test.admin-nav')
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">


				@foreach ($department as $dep)
				  <h4>{{$dep->id_department}} - {{$dep->nama_departmen}}</h4>
				<hr>
				@endforeach

		    </div>
        </div>
    </div>
</div>

@endsection