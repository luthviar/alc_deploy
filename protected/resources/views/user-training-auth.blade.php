@include('Admin.AdminHead')
@extends('Admin.Template')
@section('section')
<div class="col-md-12 ">
	<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#training" aria-controls="home" role="tab" data-toggle="tab">Training Request</a></li>
    <li role="presentation"><a href="#password" aria-controls="profile" role="tab" data-toggle="tab">Password Request</a></li>
</div>
<br><br><br>
<div class="col-md-12 ">
	 <div class="tab-content">
	 <div role="tabpanel" class="tab-pane active" id="training">
	<div class="panel panel-success">
	    <div class="panel-heading">
	    	<h4>Training Request List</h4>
	    </div>
	    <div class="panel-body">
		<div class = "main-table">
			<table id="tableTraining" class="table table-striped">
			  <thead>
				<tr>
				  <th>Name</th>
				  <th>User Department</th>
				  <th>Training</th>
				  <th>Training for Department</th>
				  <th>Request Date</th>
				  <th>Auth</th>
				  <th>Action</th>
				</tr>
			  </thead>
			  <tbody>
			  	@foreach($user_auth as $auth)
				<tr>
				  <td>{{$auth['personnel']->fname}} {{$auth['personnel']->lname}}</td>
				  <td>{{$auth['personnel-department']->nama_departmen}}</td>
				  <td>{{$auth['training']->title}}</td>
				  <td>{{$auth['training-department']->nama_departmen or 'All Department'}}</td>
				  <td>{{ \Carbon\Carbon::parse($auth->created_at)->format('l jS \\of F Y')}}</td>
				  @if($auth->auth == 1 )
				  <td>Open</td>
				  <td><a href="/access/{{$auth->id}}/nonactive" class="btn btn-warning">close</a></td>
				  @else
				  <td>Close</td>
				  <td><a href="/access/{{$auth->id}}/active" class="btn btn-default">open</a></td>
				  @endif
				</tr>
				@endforeach
				
			  </tbody>
			</table>
		</div>
		</div>
	</div>
	</div>
	<div role="tabpanel" class="tab-pane" id="password">
	<div class="panel panel-success">
	    <div class="panel-heading">
	    	<h4>Request Password Reset List</h4>
	    </div>
	    <div class="panel-body">
		<div class = "main-table">
			<table  id="passwordTable" class="table table-striped">
			  <thead>
				<tr>
				  <th>Username</th>
				  <th>Email</th>
				  <th>Create_at</th>
				  <th>Valid Account</th>
				  <th>Process</th>
				  <th>Action</th>
				</tr>
			  </thead>
			  
			</table>
		</div>
		</div>
		</div>
	</div>
	</div>
</div>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<script type="text/javascript">
    $(document).ready(function() {
        $('#tableTraining').DataTable({
        	"order": [[ 4, "desc" ]],
        	"processing": true,
            "serverSide": true,
            "ajax":{
                url :"ajax_datatables/list_request_training.php", // json datasource
                type: "post",  // method  , by default get
                dataType: "json",
                error: function(){  // error handling
                    $("#detailTable").html("");
                    
                }
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#passwordTable').DataTable({
        	"order": [[ 2, "desc" ]],
        	"processing": true,
            "serverSide": true,
            "ajax":{
                url :"ajax_datatables/list_password_access.php", // json datasource
                type: "post",  // method  , by default get
                dataType: "json",
                error: function(){  // error handling
                    $("#detailTable").html("");
                    
                }
            }
        });
    });
</script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" href="{{ URL::asset('css/Upload.css')}}" />
<script type="text/javascript" src="{{ URL::asset('js/UpoladImg.js')}}"></script>

		
@endsection
