@include('Admin.AdminHead')
@extends('Admin.Template')
@section('section')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-success">
            <div class="panel-heading">
                Edit Training Info
            </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="/training/update">
                    {{ csrf_field() }}

                    <input type="hidden" id="last_module_id" value="{{$training->id_module}}">
                    <input type="hidden" name="id_training" value="{{$training->id}}">

                    <div class="form-group">
                        <label for="module" class="col-md-4 control-label">Module</label>                                     
                        <div class="col-md-6">
							<select name="module" id="MySelect" onchange="changeFunc();" class="form-control" >
								@foreach($module as $modul)
                                    @if($training->id_module == $modul->id)
                                        <option value="{{$modul->id}}" selected="true">{{$modul->nama}}</option>
                                    @else
                                        <option value="{{$modul->id}}">{{$modul->nama}}</option>
                                    @endif
                                @endforeach
							</select>
                        </div>

                    </div>
					
					<div class="form-group">
                        <label for="title" class="col-md-4 control-label">Trainning Title</label>

                        <div class="col-md-6">
                            <input id="title" placeholder="Trainning Title" type="text" class="form-control" name="title" value="{{$training->title}}" required>
                        </div>
                    </div>
					
					<div class="form-group">
                        <label for="description" class="col-md-4 control-label">Trainning Description</label>

                        <div class="col-md-6">
							<textarea id="summernote" name="description"></textarea>
                        </div>
                    </div>
					
					
					
                    <div id="Optionals" class="form-group">
                        <label for="department" class="col-md-4 control-label">Select Departement</label>
						<div class="col-md-6">
							<select name="department" class="form-control" data-live-search="true">
                            @if($training->id_module == 3)
                                @foreach($department as $dept)
                                    @if($training->id_department == $dept->id_department)
								    <option selected="true" value="{{$dept->id_department}}">{{$dept->nama_departmen}}</option>
                                    @else
                                    <option value="{{$dept->id_department}}">{{$dept->nama_departmen}}</option>
                                    @endif
                                @endforeach
                            @else
                                @foreach($department as $dept)
                                <option value="{{$dept->id_department}}">{{$dept->nama_departmen}}</option>
                                @endforeach
                            @endif
							</select><br>
                        </div>
                    </div>
						
					<div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $('#Optionals').hide(); 
    var last_module = $('#last_module_id').val();
    var last_module = JSON.parse(last_module);
    if (last_module == 3) {
        $('#Optionals').show();  
    }
});

$(function() {
    

    
    $('#MySelect').change(function(){
        if($('#MySelect').val() == '3') {
            $('#Optionals').show(); 
        } else {
            $('#Optionals').hide(); 
        } 
    });

});
</script>
	

@endsection