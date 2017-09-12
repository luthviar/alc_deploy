@extends('Admin.Template')
@section('section')
   <div class="row">	
	<div class="col-md-6">
          <div class="box box-default">
            <div class="box-header with-border">
              <i class="fa fa-bullhorn"></i>
				<h3 class="box-title">Information</h3>
			</div>
				<div class="box-body">
				  <div class="callout callout-info">
					<h4>Personnal Requisition(P-Req)</h4>
					<p>P-Req merupakan pengajuan calon karyawan yang dibutuhkan setiap departement</p>
				  </div>
                </div>
		 </div>
	</div>

	<div class ="col-md-6">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Create P-Req</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
		<label>Select Departement</label>
          <div class="row">
            <div class="col-md-9">
                <select class="form-control select2" style="width:100%;">
                  <option selected="selected">Alabama</option>
                  <option>Alaska</option>
                  <option>California</option>
                  <option>Delaware</option>
                  <option>Tennessee</option>
                  <option>Texas</option>
                  <option>Washington</option>
                </select>
			</div>
			<div class="col-md-3">
            <span class="input-group-btn">
                     <button type="button" onclick="showDiv()" class="btn btn-info btn-flat">Go!</button>
            </span>
            </div>
		  </div>
        </div>
      </div>
     </div>
    </div>			
			
	<div id="tableP"  style="display:none;" class="answer_list" >
		<div class="row">
			<div class="col-md-12">					
				<div class="box">
  				     <div class="box-header with-border">
					    <h3 class="box-title">Select Positition</h3>		 
						 <div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						 </div>
					 </div>
							 
					
								<!-- /.box-header -->
								<div class="box-body">
								  <table id="example2" class="table table-bordered table-striped">
									<thead>
									<tr>
									  <th>Positition</th>
									  <th>MPP</th>
									  <th>Actual</th>
									  <th>Process</th>
									  <th>Choose</th>
									</tr>
									</thead>
									<tbody>
									<tr>
									  <td>Trident</td>
									  <td>10</td>
									  <td>4</td>
									  <td>2</td>
									  <td><input type="radio" name="Choose"></td>
									</tr>
									<tr>
									  <td>Neptune Trident</td>
									  <td>9</td>
									  <td>3</td>
									  <td>1</td>
									  <td><input type="radio" name="Choose"></td>
									</tr>
									<tr>
									  <td>Neptune Webkit Master</td>
									  <td>7</td>
									  <td>0</td>
									  <td>0</td>
									  <td><input type="radio" name="Choose"></td>
									</tr>
									<tr>
									  <td>Webkit Tool Senior Manager</td>
									  <td>9</td>
									  <td>1</td>
									  <td>2</td>
									  <td><input type="radio" name="Choose"></td>
									</tr>
									<tr>
									  <td>Trident</td>
									  <td>10</td>
									  <td>4</td>
									  <td>2</td>
									  <td><input type="radio" name="Choose"></td>
									</tr>
									<tr>
									  <td>Neptune Trident</td>
									  <td>9</td>
									  <td>3</td>
									  <td>1</td>
									  <td><input type="radio" name="Choose"></td>
									</tr>
									<tr>
									  <td>Neptune Webkit Master</td>
									  <td>7</td>
									  <td>0</td>
									  <td>0</td>
									  <td><input type="radio" name="Choose"></td>
									</tr>
									<tr>
									  <td>Webkit Tool Senior Manager</td>
									  <td>9</td>
									  <td>1</td>
									  <td>2</td>
									  <td><input type="radio" name="Choose"></td>
									</tr>
									<tr>
									  <td>Trident</td>
									  <td>10</td>
									  <td>4</td>
									  <td>2</td>
									  <td><input type="radio" name="Choose"></td>
									</tr>
									<tr>
									  <td>Neptune Trident</td>
									  <td>9</td>
									  <td>3</td>
									  <td>1</td>
									  <td><input type="radio" name="Choose"></td>
									</tr>
									<tr>
									  <td>Neptune Webkit Master</td>
									  <td>7</td>
									  <td>0</td>
									  <td>0</td>
									  <td><input type="radio" name="Choose"></td>
									</tr>
									<tr>
									  <td>Webkit Tool Senior Manager</td>
									  <td>9</td>
									  <td>1</td>
									  <td>2</td>
									  <td><input type="radio" name="Choose"></td>
									</tr>
									</tbody>
									<tfoot>
									<tr>
									  <th>Positition</th>
									  <th>MPP</th>
									  <th>Platform(s)</th>
									  <th>Engine version</th>
									  <th>CSS grade</th>
									</tr>
									</tfoot>
								  </table>
								</div>
								<!-- /.box-body -->
							  </div>
						</div>
				</div>
			</div>
			
		 <div class="row">	
			<div class ="col-md-12">
			  <div class="box box-info">
				<div class="box-header with-border">
				  <h3 class="box-title">Request Detail</h3>
				</div>
				<form class="form-horizontal">
				  <div class="box-body">
					<div class ="col-md-6">
					 <div class="form-group">
						<label for="inputEmail3" class="col-sm-3 control-label">Request Date</label>
						<div class="col-sm-6">
						 <div class="input-group date">
						   <div class="input-group-addon">
							 <i class="fa fa-calendar"></i>
						   </div>
						   <input type="text" class="form-control pull-right" id="datepicker">
						 </div>
						</div>
					  </div>
					  
					  <div class="form-group">
						<label class="col-sm-3 control-label">Job Title  <i class="fa fa-info-circle" aria-hidden="true" style="color:green;"></i></label>
						<div class="col-sm-6">
						 <select class="form-control select2" disabled="disabled" style="width: 100%;">
						   <option selected="selected">Neptune Trident</option> 
						   <option>Alaska</option>
						   <option>California</option>
						   <option>Delaware</option>
						   <option>Tennessee</option>
						   <option>Texas</option>
						   <option>Washington</option>
						 </select>
						</div>
					  </div>
					  
					  <div class="form-group">
						<label class="col-sm-3 control-label">Qualification  <i class="fa fa-info-circle" aria-hidden="true" style="color:green;"></i></label>
						<div class="col-sm-9">
						 <textarea class="form-control" rows="4" placeholder=></textarea>
						</div>
					  </div>
					  
					  <div class="form-group">
						<label class="col-sm-3 control-label">Age  <i class="fa fa-info-circle" aria-hidden="true" style="color:green;"></i></label>
						<div class="col-sm-2">
						 <input id="time" type="number" class="form-control" name="time" min="1" required autofocus>
						</div>
					  </div>
					  
					  <div class="form-group">
						<label class="col-sm-3 control-label">Gender  <i class="fa fa-info-circle" aria-hidden="true" style="color:green;"></i></label>
						<div class="col-sm-6">
						 <input type="radio" name="Gender">Male  
						  <input type="radio" name="Gender">Female
						</div>
					  </div>
					  
					  <div class="form-group">
						<label class="col-sm-3 control-label">Education  <i class="fa fa-info-circle" aria-hidden="true" style="color:green;"></i></label>
						<div class="col-sm-2">
						 <input type="checkbox">SD<br>
						 <input type="checkbox">SMP<br>
						 <input type="checkbox">SMA<br>
						 <input type="checkbox">SMK<br>
						</div>
						<div class="col-sm-2">
						 <input type="checkbox">D1<br>
						 <input type="checkbox">D2<br>
						 <input type="checkbox">D3<br>
						 <input type="checkbox">D4<br>
						</div>
						<div class="col-sm-4">
						 <input type="checkbox">S1<br>
						 <input type="checkbox">S2<br>
						 <input type="checkbox">Other<br>
						 <input type="text" class="form-control">
						</div>
					  </div>
					  
					  <div class="form-group">
						<label class="col-sm-3 control-label">Level Of Positition  <i class="fa fa-info-circle" aria-hidden="true" style="color:green;"></i></label>
						<div class="col-sm-6">
						 <select class="form-control select2" style="width: 100%;">
						   <option selected="selected">Neptune Trident</option> 
						   <option>Alaska</option>
						   <option>California</option>
						   <option>Delaware</option>
						   <option>Tennessee</option>
						   <option>Texas</option>
						   <option>Washington</option>
						 </select>
						</div>
					  </div>
					  
					  <div class="form-group">
						<label class="col-sm-3 control-label">Special Skill  <i class="fa fa-info-circle" aria-hidden="true" style="color:green;"></i></label>
						<div class="col-sm-6">
						 <select class="form-control select2" style="width: 100%;">
						   <option selected="selected">Neptune Trident</option> 
						   <option>Alaska</option>
						   <option>California</option>
						   <option>Delaware</option>
						   <option>Tennessee</option>
						   <option>Texas</option>
						   <option>Washington</option>
						 </select><br><br>
						 
						 <div class="input_fields_wrap">
						 </div>
						 <button class="add_field_button">Add More Skill</button>
						 
						</div>
					  </div>
					  
					 </div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="Placementdate" class="col-sm-3 control-label">Placement Date</label>
							<div class="col-sm-6">
							 <div class="input-group date">
							   <div class="input-group-addon">
								 <i class="fa fa-calendar"></i>
							   </div>
							   <input type="text" class="form-control pull-right" id="datepicker">
							 </div>
							</div>
						  </div>
						  
						  <div class="form-group">
							<label class="col-sm-3 control-label">Number Of Requisition<i class="fa fa-info-circle" aria-hidden="true" style="color:green;"></i></label>
							<div class="col-sm-2">
							 <input id="time" type="number" class="form-control" name="time" min="1" required autofocus>
							</div>
						  </div>
						 </div>
				  
				  </div>		  
				</form>
			  </div>
			</div>
			 
			 
			 
			</div>
			
			
	
        
<!-- jQuery 2.2.3 -->
<script src="AdminLTE/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="AdminLTE/bootstrap/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="AdminLTE/plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="AdminLTE/plugins/input-mask/jquery.inputmask.js"></script>
<script src="AdminLTE/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="AdminLTE/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="AdminLTE/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="AdminLTE/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- bootstrap color picker -->
<script src="AdminLTE/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="AdminLTE/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="AdminLTE/plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="AdminLTE/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="AdminLTE/dist/js/app.min.js"></script>
<!-- DataTables -->
<script src="AdminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="AdminLTE/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="AdminLTE/dist/js/demo.js"></script>
<!-- Page script -->

<script>
   function showDiv() {
	 document.getElementById('tableP').style.display = "block";
   }

  $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
  });
  
  
  $(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    var count           = 2;
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><select class="form-control select2"><option selected="selected">Neptune Trident</option><option>Neptune Trident</option></select><a href="#" class="remove_field"><i class="fa fa-times" aria-hidden="true"></i></a><br><br></div>'); //add input box
            count+=1;
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>

@endsection