@include('Admin.AdminHead')
@extends('Admin.Template')
@section('section')

<!-- Trainning List -->
<div class="col-md-12">
	<div class="panel panel-success">
		<div class="panel-heading">
			<strong><h4>Training List</h4></strong>
		</div>
		<div class ="panel-body">
			<span class="pull-right" style="color: green;">
				<a href="/training/create"><i class="glyphicon glyphicon-plus">New_Training</i>
				 </a>
			</span><br><br>
			
			<div class = "main-table">
				<table id= "detailTable" class="table table-striped">
				  	<thead>
						<tr>
							<th>Nama Trainning</th>
							<th>Modul</th>
							<th>Department</th>
							<th>Create Date</th>
							<th>Publish</th>
							<th>Action</th>
						</tr>
				  	</thead>
				  	
				</table>
			</div>
		</div>
	</div>
</div>
		
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<script type="text/javascript">
    $(document).ready(function() {
        $('#detailTable').DataTable({
        	"order": [[ 3, "desc" ]],
        	"processing": true,
            "serverSide": true,
            "ajax":{
                url :"ajax_datatables/list_training.php", // json datasource
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



@endsection
