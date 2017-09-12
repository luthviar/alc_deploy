@include('Admin.AdminHead')
@extends('Admin.Template')
@section('section')
<div class="col-md-12 ">
	<div class="panel panel-success">
	    <div class="panel-heading">
	    	<h4>Slider List</h4>
	    </div>
	    <div class="panel-body">
	    		<span class="pull-right" style="color: green;">
					<a href="/slider/create"><i class="glyphicon glyphicon-plus">New_Slider</i>
					 </a>
				</span><br><br>
				<div>
					<h4 style="color: red;">*Maximum slider active is 5</h4><br>
				</div>
		  
			<div class = "main-table">
			<table id= "detailTable" class="table table-striped">
			  <thead>
				<tr>
				  <th>Slider</th>
				  <th>Status</th>
				  <th>Created_at</th>
				  <th>Edit</th>
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
        	"order": [[ 2, "desc" ]],
        	"processing": true,
            "serverSide": true,
            "ajax":{
                url :"ajax_datatables/list_slider.php", // json datasource
                type: "post",  // method  , by default get
                error: function(){  // error handling
                    $("#detailTable").html("");
                    
                }
            }
        });
    });
</script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>		


@endsection
