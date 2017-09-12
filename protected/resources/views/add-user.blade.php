@include('Admin.AdminHead')
@extends('Admin.Template')
@section('section')

<button type="button" id="ajax" class="btn">Click me!</button>
<p class="text">Replace me!!</p>
<input type="hidden" name="" id="struktur" value="{{json_encode($struktur)}}">
<input type="hidden" name="" id="listUnit" value="{{json_encode($unit)}}">
<input type="hidden" name="" id="listDept" value="{{json_encode($department)}}">

        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Add New User</div>
                <div class="panel-body">
                <div class="container">
                    <div class="row">
                        <h3>User Profile</h3>
                    </div>
                </div>
                    <form id="myform" class="form-horizontal" role="form" method="POST" action="{{ URL::action('PersonnelController@store') }}">
                        {{ csrf_field() }}


                    
                    <div class="form-group">
                        <label for="username" class="col-md-4 control-label">Username</label>

                        <div class="col-md-6">
                            <input id="username" type="text" class="form-control" name="username" required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-md-4 control-label">Password</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required>
                        </div>
                    </div>
					
                    <div class="form-group">
                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>
						
					<div class="form-group">
                        <label for="fname" class="col-md-4 control-label">First Name</label>

                        <div class="col-md-6">
                            <input id="fname" type="text" class="form-control" name="fname"  required autofocus>
                        </div>
                    </div>
						
					<div class="form-group">
                        <label for="lname" class="col-md-4 control-label">Last Name</label>

                        <div class="col-md-6">
                            <input id="lname" type="text" class="form-control" name="lname"  required autofocus>
                        </div>
                    </div>

					<div class="form-group">
                        <label for="jenis_kelamin" class="col-md-4 control-label">Gender</label>                                     
                        <div class="col-md-6">
                            <select name="jenis_kelamin" class="form-control">
                                <option value="1">Laki - Laki</option>
                                <option value="0">Perempuan</option>
                            </select><br>
                        </div>
                    </div>
						
					<div class="form-group">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" required>
                        </div>
                    </div>
									
						
					<div class="form-group">
                        <label for="phone_number" class="col-md-4 control-label">Phone Number</label>

                        <div class="col-md-6">
                            <input id="phone_number" type="text" class="form-control" name="no_hp" required>
                        </div>
                    </div>
						
					<div class="form-group">
                        <label for="datePicker" class="col-md-4 control-label">Birth Date</label>
                        <div class="col-md-6 date">
                            <div class="input-group input-append date" id="datePicker">
                                <input type="text" class="form-control" name="tanggal_lahir" />
                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                        </div>
                    </div>

						
					<div class="form-group">
                        <label for="alamat" class="col-md-4 control-label">Adrress</label>

                        <div class="col-md-6">
                            <textarea id="froala-editor" rows="4" col="50" id="alamat" type="text" class="form-control" name="alamat" required style="resize: none;"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="is_admin" class="col-md-4 control-label">User Category</label>                                     
                        <div class="col-md-6">
                            <select name="is_admin" class="selectpicker">
                                <option value="1">Admin</option>
                                <option value="0">User</option>
                            </select><br>
                        </div>
                    </div>

                    <!-- Data Karyawan-->
                    <div class="container">
                        <div class="row">
                            <h3>Data Karyawan</h3>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="nik" class="col-md-4 control-label">Employee Number</label>

                        <div class="col-md-6">
                            <input id="nik" type="text" class="form-control" name="nik">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="level_position" class="col-md-4 control-label">Level Position</label>                                     
                        <div class="col-md-6">
                            <select name="level_position" class="form-control">
                                @foreach($level as $pos)
                                <option value="{{$pos->id}}">{{$pos->nama_level}}</option>
                                @endforeach
                            </select><br>
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label for="divisi" class="col-md-4 control-label">Divition</label>                                     
                        <div class="col-md-6">
                            <select name="id_divisi" class="form-control" id="MyDivisi">
                                <option value="">..</option>
                                @foreach($divisi as $div)
                                <option value="{{$div->id_divisi}}">{{$div->nama_divisi}}</option>
                                @endforeach
                                
                            </select><br>
                        </div>
                    </div>
                    <div class="form-group" id="Unit">
                        <label for="divisi" class="col-md-4 control-label">Unit</label>                                     
                        <div class="col-md-6">
                            <select name="id_unit" class="form-control" id="MyUnit">
                                <option value="0">...</option>
                            </select><br>
                        </div>
                    </div>
                    <div class="form-group" id="Department">
                        <label for="divisi" class="col-md-4 control-label">Department</label>
                        <div class="col-md-6">
                            <select name="id_department" class="form-control" id="MyDepartment">
                                <option value="0">...</option>
                            </select><br>
                        </div>
                         
                    </div>
                    <div class="form-group">
                        <label for="section" class="col-md-4 control-label">Section</label>                                     
                        <div class="col-md-6">
                            <select name="id_section" class="form-control" id="MySection">
                                <option value="0">...</option>
                            </select><br>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Add User
                            </button>
                        </div>
                    </div>
                    </form>


                    
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
$(document).ready(function() {
    $('#datePicker')
        .datepicker({
            format: 'yyyy-mm-dd'
        })
        .on('changeDate', function(e) {
            // Revalidate the date field
            $('#eventForm').formValidation('revalidateField', 'date');
        });

    $('#eventForm').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'The name is required'
                    }
                }
            },
            date: {
                validators: {
                    notEmpty: {
                        message: 'The date is required'
                    },
                    date: {
                        format: 'YYYY-MM-DD',
                        message: 'The date is not a valid'
                    }
                }
            }
        }
    });


    
});
</script>
<script type="text/javascript">



    $('#MyDivisi').click(function() {
      var id_divisi = $('#MyDivisi').val();
      $.ajax({
        type:"POST",
        url:"/get-unit",
        dataType: 'json',
        data:{id_divisi:id_divisi,_token: '{{csrf_token()}}'},
        beforeSend: function (xhr) {
            var token = $('meta[name="csrf_token"]').attr('content');

            if (token) {
                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
            }
        },
        success: function(units) {
            var html = '';
            $.each(units.units, function(key, value){
                html += '<option value="'+value.id_unit+'">'+value.nama_unit+'</option>';               
                
            });
            $('#MyUnit').html(html);        
            
            
        },
        error: function(data){
            console.log(data);
        },
      });
      
    });


    
    

</script>

<script type="text/javascript">


    $('#MyUnit').click(function() {
      var id_divisi = $('#MyDivisi').val();
      var id_unit = $('#MyUnit').val();
      $.ajax({
        type:"POST",
        url:"/get-department",
        dataType: 'json',
        data:{id_unit:id_unit,id_divisi:id_divisi,_token: '{{csrf_token()}}'},
        beforeSend: function (xhr) {
            var token = $('meta[name="csrf_token"]').attr('content');

            if (token) {
                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
            }
        },
        success: function(departments) {
            var html = '';
            $.each(departments.departments, function(key, value){               
                html += '<option value="'+value.id_department+'">'+value.nama_departmen+'</option>';
                
            });
            $('#MyDepartment').html(html);  
                
            
            
        },
        error: function(data){
            console.log(data);
        },
      });
      
    });


    
    

</script>

<script type="text/javascript">


    $('#MyDepartment').click(function() {
      var id_divisi = $('#MyDivisi').val();
      var id_unit = $('#MyUnit').val();
      var id_department = $('#MyDepartment').val();
      $.ajax({
        type:"POST",
        url:"/get-section",
        dataType: 'json',
        data:{id_department:id_department,id_unit:id_unit,id_divisi:id_divisi,_token: '{{csrf_token()}}'},
        beforeSend: function (xhr) {
            var token = $('meta[name="csrf_token"]').attr('content');

            if (token) {
                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
            }
        },
        success: function(sections) {
            var html = '';
            $.each(sections.sections, function(key, value){             
                html += '<option value="'+value.id_section+'">'+value.nama_section+'</option>';
                
            });
            $('#MySection').html(html); 
                
            
            
        },
        error: function(data){
            console.log(data);
        },
      });
      
    });


    
    

</script>