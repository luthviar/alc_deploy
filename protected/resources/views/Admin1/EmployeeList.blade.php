@include('Admin.AdminHead')
@extends('Admin.Template')
@section('section')
 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<script type="text/javascript">
    $(document).ready(function() {
        $('#detailTable').DataTable();
    });
</script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<div class = "PageContainer">
    <div class="quick-press">
		<h3>Employee List</h3>
		<div class = "main-table">
			<table id= "detailTable" class="table table-striped">
			  <thead>
				<tr>
				  <th>Name</th>
				  <th>Position</th>
				  <th>Divisi</th>
				  <th></th>
				</tr>
			  </thead>
			  <tbody>
				<tr>
				  <td>12141241</td>
				  <td>Mark,IT Dept</td>
				  <td>Staff</td>
				  <td><a href="#">View</a><a href="#">Edit</a></td>
				</tr>
				
			  </tbody>
			</table>
		</div>
	</div>
</div>
		


@endsection
