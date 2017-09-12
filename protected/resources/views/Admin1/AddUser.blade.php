
@include('Admin.AdminHead')

@extends('Admin.Template')
@section('section')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add New User</div>
                <div class="panel-body">
                <div class="container">
                    <div class="row">
                        <h3>Data Diri</h3>
                    </div>
                </div>
                    <form id="myform" class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
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
                            <select name="jenis_kelamin" class="selectpicker">
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
                            <input id="phone_number" type="text" class="form-control" name="password" required>
                        </div>
                    </div>
						
					<div class="form-group">
                        <label for="datePicker" class="col-md-4 control-label">Birth Date</label>
                        <div class="col-md-6 date">
                            <div class="input-group input-append date" id="datePicker">
                                <input type="text" class="form-control" name="date" />
                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                        </div>
                    </div>

						
					<div class="form-group">
                        <label for="alamat" class="col-md-4 control-label">Adrress</label>

                        <div class="col-md-6">
                            <textarea rows="4" col="50" id="password" type="password" class="form-control" name="alamat" required style="resize: none;"></textarea>
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
                            <select name="level_position" class="selectpicker">
                                <option value="1">Staff</option>
                                <option value="0">Senior Manager</option>
                            </select><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="department" class="col-md-4 control-label">Department</label>                                     
                        <div class="col-md-6">
                            <select name="department" class="selectpicker">
                                <option value="1">IT</option>
                                <option value="0">HC</option>
                            </select><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="unit" class="col-md-4 control-label">Unit</label>                                     
                        <div class="col-md-6">
                            <select name="unit" class="selectpicker">
                                <option value="1">ACS Cengkareng</option>
                                <option value="0">ACS Surabaya</option>
                            </select><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="section" class="col-md-4 control-label">Section</label>                                     
                        <div class="col-md-6">
                            <select name="section" class="selectpicker">
                                <option value="1">ACS Cengkareng</option>
                                <option value="0">ACS Surabaya</option>
                            </select><br>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="divisi" class="col-md-4 control-label">Divition</label>                                     
                        <div class="col-md-6">
                            <select name="divisi" class="selectpicker">
                                <option value="1">ACS Cengkareng</option>
                                <option value="0">ACS Surabaya</option>
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
</div>
@endsection

<script>
$(document).ready(function() {
    $('#datePicker')
        .datepicker({
            format: 'mm/dd/yyyy'
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
                        format: 'MM/DD/YYYY',
                        message: 'The date is not a valid'
                    }
                }
            }
        }
    });


     $('#myform')
            .bootstrapValidator({
                message: 'This value is not valid',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    username: {
                        validators: {
                            notEmpty: {
                                message: 'The gender is required'
                            }
                        }
                    },
                    'username': {
                        validators: {
                            notEmpty: {
                                message: 'Please specify at least one browser you use daily for development'
                            }
                        }
                    },
                    'editors[]': {
                        validators: {
                            notEmpty: {
                                message: 'The editor names are required'
                            }
                        }
                    }
                }
            })
            .on('error.field.bv', function(e, data) {
                console.log('error.field.bv -->', data);
            })
            .on('status.field.bv', function(e, data) {
                console.log('status.field.bv -->', data);

                var $form = $(e.target);
                // I don't want to add has-success class to valid field container
                data.element.parents('.form-group').removeClass('has-success');

                // I want to enable the submit button all the time
                $form.data('bootstrapValidator').disableSubmitButtons(false);
            });
});
</script>
