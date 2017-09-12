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

<!-- Trainning List -->
<div class = "PageContainer">
    <div class="quick-press">
		<h3>Trainning List</h3>
		<div class = "main-table">
			<table id= "detailTable" class="table table-striped">
			  <thead>
				<tr>
				  <th>Nama Trainning</th>
				  <th>Modul</th>
				  <th>Jumlah Peserta</th>
				  <th>Info</th>
				  <th>Create Date</th>
				</tr>
			  </thead>
			  <tbody>
				<tr>
				  <td>Procurement</td>
				  <td>Functional</td>
				  <td>62</td>
				  <td><a href="TrainningInfo">Detail</td>
				  <td>2017/10/12</td> 
				</tr>
				<tr>
				  <td>Procurement</td>
				  <td>Functional</td>
				  <td>62</td>
				  <td><a href="TrainningInfo">Detail</td>
				  <td>2017/10/12</td> 
				</tr>
				<tr>
				  <td>Procurement</td>
				  <td>Functional</td>
				  <td>62</td>
				  <td><a href="TrainningInfo">Detail</td>
				  <td>2017/10/12</td> 
				</tr>
				<tr>
				  <td>Procurement</td>
				  <td>Functional</td>
				  <td>62</td>
				  <td><a href="TrainningInfo">Detail</td>
				  <td>2017/10/12</td> 
				</tr>
				<tr>
				  <td>Procurement</td>
				  <td>Functional</td>
				  <td>62</td>
				  <td><a href="TrainningInfo">Detail</td>
				  <td>2017/10/12</td> 
				</tr>
				<tr>
				  <td>Procurement</td>
				  <td>Functional</td>
				  <td>62</td>
				  <td><a href="TrainningInfo">Detail</td>
				  <td>2017/10/12</td> 
				</tr>
			  </tbody>
			</table>
		</div>
	</div>
</div>
		


@endsection
