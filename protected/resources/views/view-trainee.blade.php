@include('Admin.AdminHead')
@extends('Admin.Template')
@section('section')
<div class="col-md-12 ">
  <div class="panel panel-success">
      <div class="panel-heading">
        <h4>List trainee - {{$training->title}}</h4>
      </div>
      <div class="panel-body">
          
      <div class = "main-table">
      <table id= "detailTable" class="table table-striped">
        <thead>
        <tr>
          <th>Name</th>
          <th>Pre-Test Score</th>
          <th>Post-Test Score</th>
          <th>Time</th>
          <th>Count_see_training</th>
        </tr>
        </thead>
        <tbody>
          @foreach($test_training as $value)
          <tr>
            <td><a href="/personnel/{{$value['personnel']->id}}">{{$value['personnel']->fname}} {{$value['personnel']->lname}}</a></td>
            <td>{{$value->pre_test_score or '-'}}</td>
            <td>{{$value->post_test_score or '-'}}</td>
            <td>{{$value->created_at}}</td>
            <td>{{$value->count}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    </div>
  </div>
</div>

 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<script type="text/javascript">
    $(document).ready(function() {
        $('#detailTable').DataTable();
    });
</script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>   


@endsection
