	<div class="container">     
		<div class="card">
		<div class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2" style="text-align:center;">
		<img class="card-img-top" style="margin-top:50px;" src="/Elegantic/images/ALS.jpg" alt="Card image cap" width="60%"></div>
        <div id="loginbox"  class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                   
           	<br>
				<hr class="style14">
			<br>
			<div class="panel panel-info" >
                    <div class="panel-heading" style="background-color:green; color:white">
                        <div class="panel-title">Request Password</div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form class="form-horizontal" role="form" method="POST" action="/request-reset-password">
								          
                          {{ csrf_field() }}
								
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        
                                        <input type="text" class="form-control" name="username" placeholder="Username" required >
                    										
                                         @if ($errors->has('username'))
                    											<span class="help-block">
                    												<strong>{{ $errors->first('username') }}</strong>
                    											</span>
                    										@endif
                                    </div>
                                
                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-address-card" aria-hidden="true"></i></span>
                                        <input type="email" class="form-control" name="email" required placeholder="email">
										
                                        @if ($errors->has('password'))
                    											<span class="help-block">
                    												<strong>{{ $errors->first('password') }}</strong>
                    											</span>
                    										@endif
                                    </div>
								
								                    <div style="text-align: center">
                                        <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                            <div class="col-sm-12 controls">
                                                <button type="submit" class="btn btn-primary" style="background-color:green; color:white">
										                              Request Password
									                             </button>

                                            </div>
                                          </div>
								                      </div> 
                            </form>     

					                 </div>

                        </div>                     
                    </div>  
        </div>
    </div>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">   
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 <style>
	hr.style14 { 
  border: 0; 
  height: 1px; 
  background-image: -webkit-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -moz-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -ms-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
  background-image: -o-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0); 
}

 </style>
