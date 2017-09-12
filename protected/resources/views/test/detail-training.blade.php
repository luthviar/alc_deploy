@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      @include('test.admin-nav')
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

				<h4>{{ $training['title'] }}</h4>
				
				
				<p>{{ $training['description'] }}</p>

				

		    </div>
        </div>
    </div>
</div>

@endsection