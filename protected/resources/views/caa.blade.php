<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
      	
      	<!-- Tab menu -->
      	<ul id="myTab" class="nav nav-tabs nav-tabs-responsive" role="tablist">
      		@php
      			$count = 0;
      		@endphp
      		@foreach($divisi as $org_struk)
      			@if($count == 0)
		        	<li role="presentation"  class="active">
		          		<a href="#divisi{{$org_struk->id_divisi}}" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">
		            	<span class="text">{{$org_struk->nama_divisi}}</span>
		          		</a>
		        	</li>
		        	@php
		        		$count += 1;
		        	@endphp
        		@else
        			<li role="presentation" >
		          		<a href="#divisi{{$org_struk->id_divisi}}" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">
		            	<span class="text">{{$org_struk->nama_divisi}}</span>
		          		</a>
		        	</li>
        		@endif
        	@endforeach
      	</ul>

      	<!-- Content of tab menu-->

      	<div id="myTabContent" class="tab-content">
      		@php
      			$hitung = 0;
      		@endphp

      		@foreach($divisi as $org_struk)
      			@if($hitung == 0)
		        	<div role="tabpanel" class="tab-pane fade in active" id="divisi{{$org_struk->id_divisi}}" aria-labelledby="home-tab">
		        		<br>
		        		@foreach($org_struk['unit'] as $value)
			          		<div class="col-md-4 col-lg-4" style="text-align: center; padding-top: 5px;">
			          			<div class="panel panel-info">
			          				@foreach($units as $unit)
				          				@if($value->id_unit == $unit->id_unit)
									  		<div class="panel-heading">{{$unit->nama_unit}}</div>
									  	@endif
								  	@endforeach

								  	<div class="panel-body">
								    	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

								     	@foreach($value['department'] as $department)
									  		<div class="panel panel-success">
									    		<div class="panel-heading" role="tab" id="headingOne">
									      			<h4 class="panel-title">
									        		<a role="button" data-toggle="collapse" data-parent="#accordion" href="#unit{{$value->id_unit}}department{{$department->id_department}}" aria-expanded="true" aria-controls="collapseOne">
											          @foreach($departments as $deps)
											          	@if($deps->id_department == $department->id_department)
											          		{{$deps->nama_departmen}}
											          	@endif
											          @endforeach
									        		</a>
									      			</h4>
									    		</div>
									    		<div id="unit{{$value->id_unit}}department{{$department->id_department}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
										      		<div class="panel-body">
										      		<!-- List of section -->
										        		<div class="list-group">
										        			@foreach($department['section'] as $section)
										        				@if(!empty($section))
										        					@foreach($sections as $sect)
										        						@if($sect->id_section == $section->id_section)
																  		<button type="button" class="list-group-item">
																  		{{$sect->nama_section}}</button>
													  					@endif
													  				@endforeach
													  			@endif
													  			
												  			@endforeach
														</div>
										      		</div>
									    		</div>
									  		</div>
									  	@endforeach
										
										</div>
								  	</div>
								</div>
			          		</div>

			          		@php
			          			$hitung +=1
			          		@endphp

		          		@endforeach
		          	</div>
		        @else
		          	<div role="tabpanel" class="tab-pane fade" id="divisi{{$org_struk->id_divisi}}" aria-labelledby="home-tab">
		        		<br>
		        		@foreach($org_struk['unit'] as $value)
			          		<div class="col-md-4 col-lg-4" style="text-align: center; padding-top: 5px;">
			          			<div class="panel panel-info">
			          				@foreach($units as $unit)
				          				@if($value->id_unit == $unit->id_unit)
									  		<div class="panel-heading">{{$unit->nama_unit}}</div>
									  	@endif
								  	@endforeach

								  	<div class="panel-body">
								    	<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

								     	@foreach($value['department'] as $department)
									  		<div class="panel panel-success">
									    		<div class="panel-heading" role="tab" id="headingOne">
									      			<h4 class="panel-title">
									        		<a role="button" data-toggle="collapse" data-parent="#accordion" href="#unit{{$value->id_unit}}department{{$department->id_department}}" aria-expanded="true" aria-controls="collapseOne">
											          @foreach($departments as $deps)
											          	@if($deps->id_department == $department->id_department)
											          		{{$deps->nama_departmen}}
											          	@endif
											          @endforeach
									        		</a>
									      			</h4>
									    		</div>
									    		<div id="unit{{$value->id_unit}}department{{$department->id_department}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
										      		<div class="panel-body">
										      		<!-- List of section -->
										        		<div class="list-group">
										        			@foreach($department['section'] as $section)
										        				@if(!empty($section))
										        					@foreach($sections as $sect)
										        						@if($sect->id_section == $section->id_section)
																  		<button type="button" class="list-group-item">
																  		{{$sect->nama_section}}</button>
													  					@endif
													  				@endforeach
													  			@endif
												  			@endforeach
														</div>
										      		</div>
									    		</div>
									  		</div>
									  	@endforeach
										
										</div>
								  	</div>
								</div>
			          		</div>
		          		@endforeach
		          	</div>
		        @endif
		    @endforeach
      	</div>
    </div>