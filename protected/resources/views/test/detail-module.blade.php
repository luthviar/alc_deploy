@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      @include('test.admin-nav')
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

				<h4>{{ $modul['nama'] }}</h4>
				
				<p>{{ $modul['description'] }}</p>

				<div class="row">
					@if($modul->id == 3)
						<ul>
						@foreach($department as $dep)
							<li>{{ $dep->nama_departmen}}</li>
							<ul>
								@foreach($training as $trains)
									@if($trains->id_department == $dep->id_department)
										<li><a href="/training/{{$trains->id}}">{{$trains->title}}</a></li>
									@endif
								@endforeach		
							</ul>
						@endforeach
						</ul>
					@else

					@endif

				</div>

				

		    </div>
        </div>
    </div>
</div>

@endsection