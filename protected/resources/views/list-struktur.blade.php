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

	<style type="text/css">
		/* Hazır */

		.fordtreeview{
			width: 100%;
			/*border-color: 1px solid green;*/
		}
		.fordtreeview ul{
			display:none;
			margin: 15px -16px;
			list-style:none;
		}

		.fordtreeview ul.expanded{
			display:block;
		}

		.fordtreeview ul li{
			left:30px;
			margin-right:40px;
			color: #333;
		}

		.fordtreeview > li:first-child{
			display:block !important;
		}

		.fordtreeview li,
		.fordtreeview a{
			color: #333;
			text-decoration:none;
			cursor:pointer;
		}

		.fordtreeview i.glyphicon{
			margin-right:5px;
		}

		.subactivated,
		.fordtreeview > li:not(:first-child):hover{
			background-color: #deeed4;
		}

		.highlight {
			color: yellow;
		}

		.list-group-item {
			border: 1px solid #828282;
		}
	</style>
	<script type="text/javascript">
        $(document).ready(function () {
            $('.hasSub').click(function () {
                $(this).parent().toggleClass('subactivated');
                $(this).parent().children('ul:first').toggle();


            });

            $(".menufilter").keyup(function () {
                //$(this).addClass('hidden');

                var searchTerm = $(".menufilter").val();
                var listItem = $('.fordtreeview').children('li');

                var searchSplit = searchTerm.replace(/ /g, "'):containsi('")

                //extends :contains to be case insensitive
                $.extend($.expr[':'], {
                    'containsi': function(elem, i, match, array)
                    {
                        return (elem.textContent || elem.innerText || '').toLowerCase()
                                .indexOf((match[3] || "").toLowerCase()) >= 0;
                    }
                });

                $(".fordtreeview li").not(":containsi('" + searchSplit + "')").each(function(e)   {
                    $(this).hide();
//                    $(this).show().children('ul:first').toggle(false);
//                    $(this).show().parent('li:first').toggle();
                });

                $(".fordtreeview li:containsi('" + searchSplit + "')").each(function(e) {
                    $(this).show();
//                    $(this).show().toggleClass('subactivated').toggle();

//                    $(this).show().children('ul:first').toggle();
                });

            });
        });
	</script>

	<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
			<div id="narrow-browser-alert" class="alert alert-success text-center">
				<strong><h4>Organization Structure of Aerofood ACS</h4></strong>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
			<ul class="fordtreeview list-group col-md-2 semula">
				<li class="list-group-item">
					<label for="ORGSearch">Organization Structure Search</label>
					{{--<input type="text" name="ORGSearch" id="FAQSearch" /><input type="submit" id="SearchFAQ" value="search" />--}}
					<input type="text" class="form-control menufilter" placeholder="Search..."/>
				</li>

				<li class="list-group-item" style="cursor:default;">
					<div class="row">
						<div class="col-lg-12">
							<button
									onclick="msg2(
											null,
											null,
											null,
											null,
											'divisi');"
									class="btn btn-info btn-lg"
									type="submit">
								<i class="glyphicon glyphicon-plus"></i>
								<i class="glyphicon glyphicon-globe"></i>
								add divisi
							</button>
						</div>
					</div>
				</li>
				@foreach($divisi as $org_struk)
					<li class="list-group-item">

						<span class="hasSub">
							<i class="glyphicon glyphicon-globe"></i>
							Divisi {{$org_struk->nama_divisi}}
								<button
										onclick="msg('{{ $org_struk->id_divisi}}','divisi','{{$org_struk->nama_divisi}}');"
										class="text-right"
										type="submit">
											<i class="glyphicon glyphicon-globe"></i>
											edit Divisi
								</button>
								<button
									onclick="msg2(
									    	'{{ $org_struk->id_divisi }}',
											null,
											null,
											null,
											'unit');"
									class="text-right"
									type="submit">
											<i class="fa fa-plus-circle" aria-hidden="true"></i>
											add Unit
								</button>
						</span>

						<ul class="list-group">
							@foreach($org_struk['unit'] as $value)
								<li class="list-group-item">
									@foreach($units as $unit)
										@if($value->id_unit == $unit->id_unit)
											<span class="hasSub"><i class="glyphicon glyphicon-map-marker"></i> Unit {{$unit->nama_unit}}
												<button
														onclick="msg('{{ $unit->id_unit}}','unit','{{$unit->nama_unit}}');"
														class="text-right"
														type="submit">
													<i class="glyphicon glyphicon-map-marker"></i>
													edit Unit
												</button>
												<button
														onclick="msg2(
																'{{ $org_struk->id_divisi }}',
																'{{ $unit->id_unit}}',
																null,
																null,
																'department');"
														class="text-right"
														type="submit">
													<i class="fa fa-plus-circle" aria-hidden="true"></i>
															add Department
												</button>
											</span>
										@endif
									@endforeach
									<ul class="list-group">
										@foreach($value['department'] as $department)
											<li class="list-group-item">
												@foreach($departments as $deps)
													@if($deps->id_department == $department->id_department)
															<span class="hasSub"><i class="glyphicon glyphicon-adjust"></i> Department {{$deps->nama_departmen}}
																<input value="department" name="name" hidden>
																<button
																		onclick="msg('{{ $deps->id_department}}','department','{{$deps->nama_departmen}}');"
																		class="text-right"
																		type="submit">
																	<i class="glyphicon glyphicon-adjust"></i>
																	edit Department
																</button>
																<button
																		onclick="msg2(
																				'{{ $org_struk->id_divisi }}',
																				'{{ $value->id_unit}}',
																				'{{ $deps->id_department}}',
																				null,
																				'section');"
																		class="text-right"
																		type="submit">
																	<i class="fa fa-plus-circle" aria-hidden="true"></i>
																			add Section
																</button>
															</span>

													@endif
												@endforeach

												<!-- List of section -->
												<ul class="list-group">
													@foreach($department['section'] as $section)
														@if(!empty($section))
															@foreach($sections as $sect)
																@if($sect->id_section == $section->id_section)

																		<li class="list-group-item">
																			<i class="glyphicon glyphicon-tint"></i>
																			{{$sect->nama_section}}
																			<input value="section" name="name" hidden>
																			<button
																					onclick="msg('{{ $sect->id_section}}','section','{{$sect->nama_section}}');"
																					class="text-right"
																					type="submit">
																				<i class="glyphicon glyphicon-tint"></i>
																				edit Section
																			</button>
																		</li>

																	{{--<button type="button" class="list-group-item">--}}
																		{{--{{$sect->nama_section}}</button>--}}
																@endif
															@endforeach
														@elseif(empty($section))
																	<li class="list-group-item">
																		tidak memiliki section
																	</li>
														@endif
													@endforeach
												</ul>

												{{--<ul class="list-group">--}}
													{{--<li class="list-group-item"><i class="glyphicon glyphicon-tint"></i> Section A2a1</li>--}}
													{{--<li class="list-group-item"><i class="glyphicon glyphicon-tint"></i> Section A2a2</li>--}}
												{{--</ul>--}}
											</li>
										@endforeach
									</ul>
								</li>
							@endforeach
						</ul>
					</li>
				@endforeach
			</ul>
		</div>
	</div>

	{{-- start modal --}}
	<script type="text/javascript">
        function msg($id,$type,$nametype) {
            $("#id_type").val($id);
            $("#type").val($type);
            $("#nametype").val($nametype);
            
            document.getElementById('type2').innerHTML = 'Nama ' +$type;
            $('#modal').modal("show");
        }

        function msg2($iddiv,$idunit,$iddept,$idsect,$type) {
            $("#iddiv").val($iddiv);
            $("#idunit").val($idunit);
            $("#iddept").val($iddept);
            $("#idsect").val($idsect);
            if($type.valueOf() != "department") {
            	$('#job_family').hide();
            }
            $("#typeadd").val($type);

            document.getElementById('typeaddname').innerHTML = 'Nama ' +$type;
            $('#modaladd').modal("show");
        }
	</script>
	<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script><link rel="stylesheet" href="{{ URL::asset('css/Upload.css')}}" />
	<script type="text/javascript" src="{{ URL::asset('js/UpoladImg.js')}}"></script>


	<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Edit</h4>
				</div>
				<div class="modal-body">
					<form id="myform" class="form-horizontal" role="form" method="POST" action="/struktur/update" enctype="multipart/form-data">
						{{ csrf_field() }}

						<input type="hidden" class="form-control" id="id_type" name="id_type">
						<input type="hidden" class="form-control" id="type" name="type">

						<div class="form-group">
							<label for="nametype" class="col-md-4 control-label" id="type2">Nama </label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="nametype" name="nametype" required>
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
		{{-- end of modal --}}

	{{--start modaladd--}}
	<div class="modal fade" id="modaladd" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add new</h4>
				</div>
				<div class="modal-body">
					<form id="myform" class="form-horizontal" role="form" method="POST" action="{{ action('StrukturOrganisasiController@store') }}" enctype="multipart/form-data">
						{{ csrf_field() }}

						<input type="hidden" class="form-control" id="iddiv" name="iddiv">
						<input type="hidden" class="form-control" id="idunit" name="idunit">
						<input type="hidden" class="form-control" id="iddept" name="iddept">
						<input type="hidden" class="form-control" id="idsect" name="idsect">
						<input type="hidden" class="form-control" id="typeadd" name="typeadd">

						<div class="form-group">
							<label for="nametype" class="col-md-4 control-label" id="typeaddname">Nama </label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="nametypeadd" name="nametypeadd" required>
							</div>
						</div>
						<div class="form-group" id="job_family">
							<label for="nametype" class="col-md-4 control-label" id="type2">Job Family </label>
							<div class="col-md-6">
								<select name="id_job_family" class="form-control">
	                                @foreach($job_family as $jobs)
	                                <option value="{{$jobs->id}}">{{$jobs->name}}</option>
	                                @endforeach
	                                
	                            </select><br>
							</div>
						</div>
						<div class="modal-footer">
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="submit" class="btn btn-primary">
										Add
									</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	{{--end of modal2--}}
	{{--<script>--}}
	{{--$('#SearchFAQ').click(function () {--}}
	{{--$('#FAQ').children('div.TopicContents').hide().children('div.Answer').hide();--}}
	{{--if ($('#FAQSearch').val() != '') {--}}
	{{--$('div.Answer:Contains(' + $('#FAQSearch').val().toUpperCase() + ')').show().parent().show(300);--}}
	{{--try {--}}
	{{--$('.highlight').removeClass("highlight");--}}
	{{--$('div.Answer:Contains(' + $('#FAQSearch').val().toUpperCase() + ')').each(function () {--}}
	{{--$(this).html(--}}
	{{--$(this).html().replace(--}}
	{{--new RegExp($('#FAQSearch').val(), "ig"),--}}
	{{--function(match) {--}}
	{{--return '<span class="highlight">' + match + '</span>';--}}
	{{--}--}}
	{{--)--}}
	{{--)--}}
	{{--});--}}
	{{--}--}}
	{{--catch (err) {--}}
	{{--}--}}
	{{--}--}}
	{{--return false;--}}
	{{--});--}}
	{{--</script>--}}

@endsection
