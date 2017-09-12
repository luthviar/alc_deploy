@include('Admin.AdminHead')
@extends('Admin.Template')
@section('section')
<!-- Trainning List -->
<div class="col-md-12 col-lg-12">
 <div class="panel panel-success">
  <div class="panel-heading">
   <strong><h4>Forum</h4></strong>
  </div>
  <div class ="panel-body">
   <div></div>
   <div class = "main-table">
    <div class="row">
     <div class="col-md-12 col-lg-12">
      <form class="form-inline">
         <div class="form-group">
           <label for="exampleInputName2">Forum's Category</label>
           <select class="form-control" id="category">
            <option value="1">General Forum</option>
           <option value="2">Job Family Forum</option>
           <option value="3">Department Forum</option>
        </select>
         </div>
         <div class="form-group" id="deps">
           <label for="exampleInputEmail2">Department</label>
           <select class="form-control" id="department">
            
            @foreach($department as $deps)
             <option value="{{$deps->id_department}}">{{$deps->nama_departmen}}</option>
            
           @endforeach
        </select>
         </div>
         <div class="form-group" id="jobs">
           <label for="exampleInputEmail2">Job Family</label>
           <select class="form-control" id="job_family">
            
           @foreach($job_family as $jobs)
            <option value="{{$jobs->id}}">{{$jobs->name}}</option>
           @endforeach
        </select>
         </div>
         
      </form>
     </div>
    </div>
    <div id="result">
     <table id= "detailTable" class="table table-striped">
        <thead>
       <tr>
        <th>Creator</th>
        <th>Title</th>
        <th>Created_at</th>
        <th>Replies</th>
        <th>Last Reply</th>
        <th>Action</th>
       </tr>
        </thead>
        <tbody>
         @foreach($forums as $el)
         <tr>
         <td>{{$el['personnel']->fname}} {{$el['personnel']->lname}}</td>
         <td><a href="/forum/{{$el->id}}">{{$el->title}}</a></td>
         <td>{{$el->created_at}}</td>
         <td>{{count($el->reply)}}</td>
         @if (count($el->reply) > 0)
        <td>{{$el['last_reply_personnel']->fname}} {{$el['last_reply_personnel']->lname}}</td>
       @else
        <td>-</td>
       @endif
         <td>
             <form
                     class="forms"
                     action="/delete-forum" method="post">

                 {{ csrf_field() }}
                 <input type="hidden" name="id_forum" value="{{$el->id}}">
                 <input type="hidden" name="id_category" value="'+1+'">
                 <button class="btnsub" type="submit">delete</button>

             </form>
         </td>
         @endforeach
         </tr>
        </tbody>
     </table>
    </div>
   </div>
  </div>
 </div>
</div>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<script type="text/javascript">
    $(document).ready(function() {
        $('#detailTable').DataTable({
          "order": [[ 2, "desc" ]],
        });
    });
</script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

@endsection

<script type="text/javascript">
$(document).ready(function(){
 $('#jobs').hide();
 $('#deps').hide();
 
 $('#category').change(function(){
  if ($('#category').val() == 1) {
   $('#jobs').hide();
   $('#deps').hide();
   var id_category = parseInt($('#category').val());
   $.ajax({
       type:"POST",
       url:"/get-forum",
       dataType: 'json',
       data:{id_category:id_category,_token: '{{csrf_token()}}'},
       beforeSend: function (xhr) {
              var token = $('meta[name="csrf_token"]').attr('content');

              if (token) {
                    return xhr.setRequestHeader('X-CSRF-TOKEN', token);
              }
          },
       success: function(forums) {

     var data = jQuery.map(forums.forums, function(el, i) {
      var name = el.personnel.fname + ' ' + el.personnel.lname;
      var title = '<a href="/forum/'+el.id+'">'+el.title+'</a>';
      var create = el.created_at;
      var count_reply = el.replie.length;
      var last_reply = '-';
      if (count_reply > 0) {
       last_reply = el.last_reply_personnel.fname +' ' + el.last_reply_personnel.lname;
      }
      var del = '<form class="forms" action="/delete-forum" method="post">{{ csrf_field() }}<input type="hidden" name="id_forum" value="'+el.id+'"><input type="hidden" name="id_category" value="'+1+'"><button class="btnsub" type="submit">delete</button></form>';
       return [[name, title, create, count_reply, last_reply, del]];
     });
     jQuery('#detailTable').dataTable().fnDestroy(); 
        $('#detailTable').DataTable( {
          "order": [[ 2, "desc" ]],
         paging: true,
         searching: true,
         retrieve : true,
      destroy : true,
            "processing": true,
            "data": data,
            "columns": [
                { "title": "Creator" },
                { "title": "Title" },
                { "title": "Created_at" },
                { "title": "Replies" },
                { "title": "Last Reply" },
                { "title": "Action" }
            ]
        } );
        $('#detailTable').DataTable().draw();
        
       },
       error: function(forums){
        console.log(JSON.stringify(forums));
          },
      });
  }
  if ($('#category').val() == 2) {
   $('#jobs').show();
   $('#deps').hide();
  }
  if ($('#category').val() == 3) {
   $('#deps').show();
   $('#jobs').hide();
  }
 });
});
</script>

<script type="text/javascript">
$(document).ready(function(){
 $('#department').click(function(){

  var id_category = parseInt($('#category').val());
  var id_department = $('#department').val();
  $.ajax({
      type:"POST",
      url:"/get-forum",
      dataType: 'json',
      data:{id_category:id_category,id_department:id_department,_token: '{{csrf_token()}}'},
      beforeSend: function (xhr) {
             var token = $('meta[name="csrf_token"]').attr('content');

             if (token) {
                   return xhr.setRequestHeader('X-CSRF-TOKEN', token);
             }
         },
      success: function(forums) {

    var data = jQuery.map(forums.forums, function(el, i) {
     var name = el.personnel.fname + ' ' + el.personnel.lname;
     var title = '<a href="/forum/'+el.id+'">'+el.title+'</a>';
     var create = el.created_at;
     var count_reply = el.replie.length;
     var last_reply = '-';
     if (count_reply > 0) {
      last_reply = el.last_reply_personnel.fname +' ' + el.last_reply_personnel.lname;
     }
     var del = '<form class="forms" action="/delete-forum" method="post">{{ csrf_field() }}<input type="hidden" name="id_forum" value="'+el.id+'"><input type="hidden" name="id_category" value="'+1+'"><button class="btnsub" type="submit">delete</button></form>';
      return [[name, title, create, count_reply, last_reply, del]];
    });
    jQuery('#detailTable').dataTable().fnDestroy(); 
       $('#detailTable').DataTable( {
        "order": [[ 2, "desc" ]],
        paging: true,
     searching: true,
     retrieve : true,
     destroy : true,
           "processing": true,
           "data": data,
           "columns": [
               { "title": "Creator" },
               { "title": "Title" },
               { "title": "Created_at" },
               { "title": "Replies" },
               { "title": "Last Reply" },
               { "title": "Action" }
           ]
       } );
       $('#detailTable').DataTable().draw();
       
      },
      error: function(forums){
       console.log(JSON.stringify(forums));
         },
     });
  
 });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
 $('#job_family').click(function(){

  var id_category = parseInt($('#category').val());
  var id_job_family = $('#job_family').val();
  $.ajax({
      type:"POST",
      url:"/get-forum",
      dataType: 'json',
      data:{id_category:id_category,id_job_family:id_job_family,_token: '{{csrf_token()}}'},
      beforeSend: function (xhr) {
             var token = $('meta[name="csrf_token"]').attr('content');

             if (token) {
                   return xhr.setRequestHeader('X-CSRF-TOKEN', token);
             }
         },
      success: function(forums) {

    var data = jQuery.map(forums.forums, function(el, i) {
     var name = el.personnel.fname + ' ' + el.personnel.lname;
     var title = '<a href="/forum/'+el.id+'">'+el.title+'</a>';
     var create = el.created_at;
     var count_reply = el.replie.length;
     var last_reply = '-';
     if (count_reply > 0) {
      last_reply = el.last_reply_personnel.fname +' ' + el.last_reply_personnel.lname;
     }
     var del = '<form class="forms" action="/delete-forum" method="post">{{ csrf_field() }}<input type="hidden" name="id_forum" value="'+el.id+'"><input type="hidden" name="id_category" value="'+1+'"><button class="btnsub" type="submit">delete</button></form>';
      return [[name, title, create, count_reply, last_reply, del]];
    });
    jQuery('#detailTable').dataTable().fnDestroy(); 
       $('#detailTable').DataTable( {
        "order": [[ 2, "desc" ]],
        paging: true,
     searching: true,
     retrieve : true,
     destroy : true,
           "processing": true,
           "data": data,
           "columns": [
               { "title": "Creator" },
               { "title": "Title" },
               { "title": "Created_at" },
               { "title": "Replies" },
               { "title": "Last Reply" },
               { "title": "Action" }
           ]
       } );
       $('#detailTable').DataTable().draw();
       
      },
      error: function(forums){
       console.log(JSON.stringify(forums));
         },
     });
  
 });
});
</script>