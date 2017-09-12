@include('Admin.AdminHead')
@extends('Admin.Template')
@section('section')

<!--Detail Trainning-->
<link rel="stylesheet" href="{{ URL::asset('css/EditProfile.css')}}" />
<script type="text/javascript" src="js/EditProfile.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<script type="text/javascript">
    $(document).ready(function() {
        $('.detailTable').DataTable();
    });
</script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Trainning Overview</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <!-- Info training -->
                <div class=" col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 "> 
                    <table class="table table-user-information">
                        <tbody>
                            <tr>
                                <td width="30%">Trainning Name</td>
                                <td width="70%">Procuremenet</td>
                            </tr>
                            <tr>
                                <td >Modul</td>
                                <td>Functional Module</td>
                            </tr>
                            <tr>
                                <td>Department</td>
                                <td>Finance</td>
                            </tr>
                            <tr>
                                <td>Positition</td>
                                <td>Staff</td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</td>
                            </tr>
                        </tbody>
                    </table>
                    <div style="text-align: center;">
                        <a href="" class="btn btn-warning">Edit Training Info</a>
                    </div>
                    <br>
                </div>
                <!-- Info Pre Test Training -->
                <div class=" col-md-6  col-lg-6">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                          <h4>Pre Test Overview</h4>
                        </div>
                        <div class="panel-body">
                            
                            <table class="table ">
                                <tbody>
                                    <tr>
                                        <td>Tot. Questions</td>
                                        <td>40</td>
                                    </tr>
                                    <tr>
                                        <td>Time (minutes)</td>
                                        <td>20</td>
                                    </tr>
                                </tbody>
                            </table>
                            <h4>Question List</h4>
                            <div class = "main-table">
                                <table  class="table table-striped detailTable">
                                    <thead>
                                        <tr>
                                            <th>Question</th>
                                            <th>Answer</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum</td>
                                            <td>A. QuestionDetail</td>
                                            <td><span class="glyphicon glyphicon-trash"></span>Edit </a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Post Test Training -->
                <div class=" col-md-6  col-lg-6">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                          <h4>Post Test Overview</h4>
                        </div>
                        <div class="panel-body">
                            
                            <table class="table ">
                                <tbody>
                                    <tr>
                                        <td>Tot. Questions</td>
                                        <td>40</td>
                                    </tr>
                                    <tr>
                                        <td>Time (minutes)</td>
                                        <td>20</td>
                                    </tr>
                                </tbody>
                            </table>
                            <h4>Question List</h4>
                            <div class = "main-table">
                                <table  class="table table-striped detailTable">
                                    <thead>
                                        <tr>
                                            <th>Question</th>
                                            <th>Answer</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum</td>
                                            <td>A. QuestionDetail</td>
                                            <td><span class="glyphicon glyphicon-trash"></span>Edit </a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Info Post Test Training -->
                <div class=" col-md-12  col-lg-12"> 
                    <div class="panel panel-info">
                        <div class="panel-heading">
                          <h4>Content Learning Overview</h4>
                        </div>
                        <div class="panel-body">
                            
                            <div class = "main-table">
                                <table  class="table table-striped detailTable">
                                    <thead>
                                        <tr>
                                            <th>Question</th>
                                            <th>Answer</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum</td>
                                            <td>A. QuestionDetail</td>
                                            <td><span class="glyphicon glyphicon-trash"></span>Edit </a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



@endsection