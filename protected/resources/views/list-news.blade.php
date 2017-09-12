@include('Admin.AdminHead')
@extends('Admin.Template')
@section('section')
<div class="col-md-12 ">
	<div class="panel panel-success">
	    <div class="panel-heading"> 
	    	<h4>News List</h4>
	    </div>
	    <div class="panel-body">
	    	<span class="pull-right" style="color: green;">
					<a href="/news/create"><i class="glyphicon glyphicon-plus">New_News</i>
					 </a>
				</span><br><br>
			
			 <div class = "main-table">
			  <table id= "detailTable" class="table table-striped">
			  <thead>
				<tr>
				  <th>News Title</th>
				  <th>Can Reply</th>
				  <th>Replies Count</th>
				  <th>Created At</th>
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
<script type="text/javascript" language="javascript" >
            $(document).ready(function() {
                var dataTable = $('#detailTable').DataTable( {
                	"order": [[ 3, "desc" ]],
                    "processing": true,
                    "serverSide": true,
                    "ajax":{
                        url :"ajax_datatables/lis_news.php", // json datasource
                        type: "post",  // method  , by default get
                        error: function(){  // error handling
                            $("#detailTable").html("");
                            
                        }
                    }
                } );
            } );
        </script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>		


@endsection
