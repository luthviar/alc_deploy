@include('Admin.AdminHead')
@extends('Admin.Template')
@section('section')
<div class="col-md-12 ">
	<div class="panel panel-success">
	    <div class="panel-heading">
	    	<h4>Employee Raport</h4>
	    </div>
	    <div class="panel-body">
			<div class = "main-table">
				<table id="detailTable" class="table table-striped">
				  <thead>
					<tr>
					  <th>Name</th>
					  <th>Raport</th>
					  <th>Created_At</th>
					  <th>Update Raport</th>
					</tr>
				  </thead>
				  
				</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
	  		<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Add New Raport</h4>
		  	</div>
			<div class="modal-body">
				<form id="myform" class="form-horizontal" role="form" method="POST" action="/raport/submit" enctype="multipart/form-data">
					{{ csrf_field() }}

				<input type="hidden" class="form-control" id="id_user" name="id_user">
				
				<div class="form-group">				
					<label for="question" class="col-md-4 control-label">Upload File</label>
					<div class="col-md-6">
						<div class="input-group">
							<span class="input-group-btn">
								<span class="btn btn-default btn-file">
									Browse… <input type="file" name="score" id="imgInp" name="image" accept="Application/pdf">
								</span>
							</span>
							<input type="text" class="form-control" readonly>
						</div></br>
					</div>
				</div>
				<div class="modal-footer">
					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<button type="submit" class="btn btn-primary">
								Update
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
</div>



<link rel="stylesheet" href="{{ URL::asset('css/Upload.css')}}" />
<script type="text/javascript" src="{{ URL::asset('js/UpoladImg.js')}}"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#detailTable').DataTable({
        	"processing": true,
            "serverSide": true,
            "ajax":{
                url :"ajax_datatables/list_score_summary.php", // json datasource
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
	function msg($id) {
	    $("#id_user").val($id);
	    $('#modal').modal("show");
	}
</script>
@endsection
