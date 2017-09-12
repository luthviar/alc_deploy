@include('Admin.AdminHead')
@extends('Admin.Template')
@section('section')

    
        <div class="col-md-12">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h4>Process Access</h4>
                </div>
                <div class="panel-body">
                
                    <form id="myform" class="form-horizontal" role="form" method="POST" action="/process-access/submit">
                        {{ csrf_field() }}
                    
                    <input type="hidden" class="form-control" name="id_user" value="{{$user->id}}" >

                    <div class="form-group">
                        <label for="password" class="col-md-4 control-label">New Password</label>

                        <div class="col-md-6">
                            <input id="new_pass" type="password" class="form-control" name="newpassword" >
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                        <div class="col-md-6">
                            <input id="confirm_pass" type="password" class="form-control" >
                        </div>
                        <div id="message"></div>
                    </div>

                    <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" id="btn-sub" class="btn btn-primary">
                                            Reset Password
                                        </button>
                                    </div>
                                </div>      
                </form>


                    
                </div>
            </div>
        </div>

@endsection

<script type="text/javascript">
    $(document).ready(function(){



        $('#confirm_passa').on('input',function(e){
            var new_pass = $('#new_pass').val();
            var confirm_pass = $('#confirm_pass').val();

            if (new_pass === confirm_pass) {
                $('#message').html('*correct');
                $(':input[type="submit"]').prop('disabled', false);

            }else{
                $('#message').html('*your password is false');
                $(':input[type="submit"]').prop('disabled', true);
            }
        });

        $('#new_passa').on('input',function(e){
            var new_pass = $('#new_pass').val();
            var confirm_pass = $('#confirm_pass').val();

            if (confirm_pass !== "") {
                if (new_pass === confirm_pass) {
                    $('#message').html('*correct');
                    $(':input[type="submit"]').prop('disabled', false);

                }else{
                    $('#message').html('*your password is false');
                    $(':input[type="submit"]').prop('disabled', true);
                }
            }
        });





    });
</script>

