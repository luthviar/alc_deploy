@include('Admin.AdminHead')
@extends('Admin.Template')
@section('section')
<link rel="stylesheet" href="{{ URL::asset('css/Upload.css')}}" />
<script type="text/javascript" src="{{ URL::asset('js/UpoladImg.js')}}"></script>
        <div class="col-md-12">
            <div class="panel panel-success">
                <div class="panel-heading">Add New News</div>
                <div class="panel-body">


                    <form id="myform" class="form-horizontal" role="form" method="POST" action="{{ URL::action('BeritaController@store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <input type="hidden" name="id_user" value="{{Auth::user()->id}}"><br>
                    
                    <div class="form-group">
                        <label for="title" class="col-md-4 control-label">Title</label>

                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control" name="title" required autofocus>
                        </div>
                    </div>
					
					
                    <div class="form-group">
                        <label for="image" class="col-md-4 control-label">Upload News Image</label>

                        <div class="col-md-6">
                             <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-default btn-file">
                                        Browse… <input type="file" id="imgInp" name="image" accept="image/gif, image/jpeg, image/png" />
                                    </span>
                                </span>
                                <input type="text" class="form-control" readonly>
                            </div>
                            <img id='img-upload'/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="content" class="col-md-4 control-label">Content</label>

                        <div class="col-md-6">
							<textarea id ="summernote" name ="content"></textarea>
                        </div>
                    </div>
					
					
                    <div class="form-group">
                        <label for="image" class="col-md-4 control-label">Upload attachment</label>

                        <div class="col-md-6">
                             <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-default btn-file">
                                       Browse..
                                            <input type="file"
                                                   id="file"
                                                   onchange="javascript:updateList()"
                                                   name="file_pendukung[]"
                                                   multiple/>
                                            </span>
                                    </span>
                                 <input type="text" class="form-control" value="select file(s)" readonly>
                            </div></br>
                            <div class='file-uploaded'>
                                <p>
                                    <div id="fileList"></div>
                                </p>
							</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="can_reply" class="col-md-4 control-label">Can Reply</label>                                     
                        <div class="col-md-2">
                            <select name="can_reply" class="form-control">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select><br>
                        </div>
                    </div>
					
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Create News
                            </button>
                        </div>
                    </div>
                    </form>


                    
                </div>
            </div>
        </div>
@endsection

<script>
    updateList = function() {
        var input = document.getElementById('file');
        var output = document.getElementById('fileList');

        output.innerHTML = 'Selected file(s) <br><ul>';
        for (var i = 0; i < input.files.length; ++i) {
            output.innerHTML += '<li>' + input.files.item(i).name + '</li>';

        }
        output.innerHTML += '</ul>';
    }
</script>