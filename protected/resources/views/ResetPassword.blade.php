@include('layouts.head')
<script type="text/javascript" src="{{URL::asset('js/textarea.js')}}"></script>
<style>
p.big {
    line-height: 300%;
	font-size : 15px;
}
</style>
<body>
    <!-- Header -->
    <div id="wrapper">
        <div class="wrapper-holder">
                 
            @include('layouts.header')
            <section id="main">
						<div class="col-md-12">
							<div class="panel panel-success">
								<div class="panel-heading">Reset Password</div>
								<div class="panel-body">
							  <form id="myform" class="form-horizontal" role="form" method="POST">
							  
								<div class="form-group">
									<label for="password" class="col-md-4 control-label">Old Password</label>

									<div class="col-md-4">
										<input id="password" type="password" class="form-control" name="oldpassword" required>
									</div>
								</div>
								
								<div class="form-group">
									<label for="password" class="col-md-4 control-label">New Password</label>

									<div class="col-md-4">
										<input id="password" type="password" class="form-control" name="newpassword" required>
									</div>
								</div>
								
								<div class="form-group">
									<label for="password-confirm" class="col-md-4 control-label">Confirm New Password</label>

									<div class="col-md-4">
										<input id="password-confirm" type="password" class="form-control"  required>
									</div>
								</div>
								
								<br><br>
								<div class="form-group">
									<div class="col-md-6 col-md-offset-4">
										<button type="submit" class="btn btn-primary">
											Reset Password
										</button>
									</div>
								</div>								
							  </form>
							</div>
							</div>
						</div>
            </section>
        </div>
        <!-- Footer -->
        @include('layouts.footer')
    </div>

    @include('layouts.script')
</body>
</html>