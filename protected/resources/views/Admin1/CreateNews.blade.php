@include('Admin.AdminHead')
@extends('Admin.Template')
@section('section')

<link rel="stylesheet" href="{{ URL::asset('css/Upload.css')}}" />
<script type="text/javascript" src="js/UpoladImg.js"></script>


<script>
$(document).ready(function(){
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
});
</script>
		<div class="row">
		 <div class="col-md-8 col-md-offset-2">
		  <div class="panel panel-default">
		   <div class="panel-heading">Create News</div>
			<div class="panel-body">
			  <ul class="nav nav-tabs">
     			<li class="active"><a href="#Internal">Create Internal News</a></li>
	    		<li><a href="#External">Create External News</a></li>
		      </ul>

		    <div class="tab-content">
			 <div id="Internal" class="tab-pane fade in active">
			   <h3>Internal News</h3><form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input id="username" placeholder="Departement Name" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">News Desc</label>

                            <div class="col-md-6">
                                <textarea rows="4" col="50" id="username"  type="text" class="form-control" name="username" >

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
								</textarea>
                            </div>
                        </div>
						
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label"></label>

                            <div class="col-md-6">
                                <form>
								<label class="radio-inline">
								  <input type="radio" value="">Repliable
								</label>
								<label class="radio-inline">
								  <input type="radio" value="">Cannot be Reply
								</label>
							  </form>
                            </div>
						
						<br><br><br>
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Upload Image</label>

                            <div class="col-md-6">
                                 <div class="input-group">
									<span class="input-group-btn">
										<span class="btn btn-default btn-file">
											Browse… <input type="file" id="imgInp">
										</span>
									</span>
									<input type="text" class="form-control" readonly>
								</div></br>
								<img id='img-upload'/>
                            </div>
                        </div>
						
							
							<br><br>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Post
                                </button>
                            </div>
                        </div>
                        </div>
						</div>
			 
			 <div id="External" class="tab-pane fade">
			   <h3>External News</h3><form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input id="username" placeholder="Departement Name" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">News Desc</label>

                            <div class="col-md-6">
                                <textarea rows="4" col="50" id="username"  type="text" class="form-control" name="username" >

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
								</textarea>
                            </div>
                        </div>
						
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label"></label>

                            <div class="col-md-6">
                                <form>
								<label class="radio-inline">
								  <input type="radio" value="">Repliable
								</label>
								<label class="radio-inline">
								  <input type="radio" value="">Cannot be Reply
								</label>
							  </form>
                            </div>
						
						<br><br><br>
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Upload Image</label>

                            <div class="col-md-6">
                                 <div class="input-group">
									<span class="input-group-btn">
										<span class="btn btn-default btn-file">
											Browse… <input type="file" id="imgInp">
										</span>
									</span>
									<input type="text" class="form-control" readonly>
								</div></br>
								<img id='img-upload'/>
                            </div>
                        </div>
						
							
							<br><br>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Post
                                </button>
                            </div>
                        </div>
                        </div>
			 </div>
			 
			</div>
			
	        </div>
           </div>
          </div>
		</div>
     </div>
</div>

@endsection