@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      @include('test.admin-nav')
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

            <h3>Daftar Job Family</h3>

				@foreach ($jobFamily as $jobs)
				  <h5>{{$jobs->name}}</h5>
				<hr>
				@endforeach

		    </div>
        </div>
    </div>
</div>

@endsection