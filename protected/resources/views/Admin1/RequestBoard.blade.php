@include('Admin.AdminHead')
@extends('Admin.Template')
@section('section')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#detailTable').DataTable();
    });
</script>
<script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">Pasword Request List</div>
				<div class ="panel-body">
                    <div id="exTab1">
                        <div class="tab-content">
                            <div class="tab-pane active" id="passwordrequest">
								<table id="detailTable" class="table table-striped">
								<thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Name</th>
									<th>Email</th>
									<th>Phone</th>
                                    <th>Reset Password</th>
                                </tr>
                                </thead>
                                    <tbody>
                                        <tr>
                                            <td>130291831412</td>
                                            <td>Rohmat Taufik</td>
                                            <td>Rohmat.taufik@bla.com</td>
                                            <td>08726182718</td>
                                            <td><span><a class="btn btn-info" data-toggle="modal" data-target="#myModal">Reset</a></span></td>
                                        </tr>                                   
                                     </tbody>
								</table>
                            </div>
						</div>
		</div>
	</div>
	
	<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog modal-lg" role="document">
								<div class="modal-content">
								  <div class="modal-header"><h4>Reset User Password </h4>
									  <a class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span></a>
									  <hr>
								  </div>
									<div class="modal-body">
										 <form id="myform" class="form-horizontal" role="form" method="POST" >
											{{ csrf_field() }}
											

											<div class="form-group">				
												<label for="question" class="col-md-4 control-label">Enter New Password</label>
												<div class="col-md-6">
													<input id="username" placeholder="New Password" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>
													@if ($errors->has('username'))
														<span class="help-block">
															<strong>{{ $errors->first('username') }}</strong>
														</span>
													@endif 
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



@endsection