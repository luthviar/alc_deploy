@extends('Admin.Template')
@section('section')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
<script type="text/javascript">
    $(document).ready(function() {
        $('#detailTable').DataTable();
    });
</script>
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

<!-- Question List -->
<div class = "PageContainer">
    <div class="quick-press">
		<h3>Question List</h3>
		<div class = "main-table">
			<table id= "detailTable" class="table table-striped">
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
				  <td><button  data-toggle="modal" data-target="#Edit">Add More Question</button>
				  <span class="glyphicon glyphicon-trash"></span>Edit </a></td>
				</tr>
				<tr>
				  <td>Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum</td>
				  <td>A. QuestionDetail</td>
				  <td><button  data-toggle="modal" data-target="#Edit">Add More Question</button>
				  <span class="glyphicon glyphicon-trash"></span>Edit </a></td>
				</tr>
				<tr>
				  <td>Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum</td>
				  <td>A. QuestionDetail</td>
				  <td><button  data-toggle="modal" data-target="#Edit">Add More Question</button>
				  <span class="glyphicon glyphicon-trash"></span>Edit </a></td>
				</tr>
				<tr>
				  <td>Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum</td>
				  <td>A. QuestionDetail</td>
				  <td><button  data-toggle="modal" data-target="#Edit">Add More Question</button>
				  <span class="glyphicon glyphicon-trash"></span>Edit </a></td>
				</tr>
				<tr>
				  <td>Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum</td>
				  <td>A. QuestionDetail</td>
				  <td><button  data-toggle="modal" data-target="#Edit">Add More Question</button>
				  <span class="glyphicon glyphicon-trash"></span>Edit </a></td>
				</tr>
			  </tbody>
			</table>
		</div>
	</div>
</div>
		


@endsection
