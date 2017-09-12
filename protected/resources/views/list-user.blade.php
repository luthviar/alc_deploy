@include('Admin.AdminHead')
@extends('Admin.Template')
@section('section')
<div class="col-md-12">
   <div class ="portlet box">
	<div class="portlet-title">
       <div class="caption">
			<i class="fa fa-globe"></i>User List </div>
            <div class="tools"> </div>
       </div>
		<div class ="portlet-body">
			<span class="pull-right" style="color: green;">
				<a href="/personnel/create"><i class="glyphicon glyphicon-plus">New_User</i>
				 </a>
			</span><br><br>
		   <div class = "main-table">
			<table id= "detailTable" class="table table-striped">
			  <thead>
				<tr>
				  <th>Name</th>
				  <th>Position</th>
				  <th>Divisi</th>
				  <th>Department</th>
				  <th>Created_at</th>
				  <th>Authority</th>
				  <th>Status</th>
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
        	"processing": true,
            "serverSide": true,
            "ajax":{
                url :"ajax_datatables/list_personnels.php", // json datasource
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
