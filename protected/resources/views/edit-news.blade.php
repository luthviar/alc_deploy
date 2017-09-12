@include('Admin.AdminHead')
@extends('Admin.Template')
@section('section')
        <div class="col-md-12">
            <div class="panel panel-success">
                <div class="panel-heading">Edit News</div>
                <div class="panel-body">
                
                    <form id="myform" class="form-horizontal" role="form" method="POST" action="/news/submit" enctype="multipart/form-data">
                        {{ csrf_field() }}
                    
                    <input type="hidden" class="form-control" name="id_news" value="{{$news->id}}" required autofocus>
                    <input type="hidden" class="form-control" name="id_user" value="{{$news->id_user}}" required autofocus>

                    <div class="form-group">
                        <label for="title" class="col-md-4 control-label">Title</label>

                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control" name="title" required autofocus value="{{$news->title}}">
                        </div>
                    </div>
					
					<div class="form-group">
                        <label for="image" class="col-md-4 control-label">Image</label>

                        <div class="col-md-6">
                            @if(empty($slider->image))
                                Belum ada image
                            @else
                             <img src="{{URL::asset($slider->image)}}" style="width: 100%;height: 100%;">
                            @endif
                        </div>
                    </div>
					
					<div class="form-group">
                        <label for="image" class="col-md-4 control-label">Upload News Image</label>
                        <div class="col-md-6">
                             <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-default btn-file">
                                        Browse… <input type="file" id="imgInp" name="image" accept="image/gif, image/jpeg, image/png"/>
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
							<textarea id ="summernote" name="content">{{$news->content}}</textarea>
                        </div>
                    </div>

                    


                    <div class="form-group">
                        <label for="can_reply" class="col-md-4 control-label">Can Reply</label>                                     
                        <div class="col-md-2">
                            <select name="can_reply" class="form-control">
                                @if($news->can_reply == 1)
                                <option value="1" selected>Yes</option>
                                <option value="0">No</option>
                                @else
                                <option value="1">Yes</option>
                                <option value="0" selected>No</option>
                                @endif
                            </select><br>
                        </div>
                    </div>

					<div class="form-group">
                        <label for="image" class="col-md-4 control-label">Attachment(s)</label>

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
                                </span>
                                 <input type="text" class="form-control" value="select file(s)" readonly>
                            </div></br>
                            <div class='file-uploaded'>
                                <p>
                                    <div id="fileList"></div>
                                </p>
                                @foreach($news['file_pendukung'] as $file)
								<a href="{{URL::asset($file->url)}}"><i class="fa fa-paperclip" aria-hidden="true"></i>  {{$file->name}}</a>       <span><a href="/news_attachment_delete/{{$file->id}}" style="color: red;"><i class="fa fa-trash" aria-hidden="true"></i>delete</a></span><br>
								@endforeach
							</div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Update News
                            </button>
                        </div>
                    </div>
                    </form>


                    
                </div>
            </div>
        </div>
    </div>
@endsection

<link rel="stylesheet" href="{{ URL::asset('css/Upload.css')}}" />
<script type="text/javascript" src="{{ URL::asset('js/UpoladImg.js')}}"></script>
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