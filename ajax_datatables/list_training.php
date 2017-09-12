<?php

/* Database connection start */
include 'connect_database.php';
/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 =>'title', 
	1 => 'nama_module',
	2 =>'nama_deps', 
	3 => 'created_at',
	4 => 'is_publish',
	5 => 'is_publish'
);

// getting total number records without any search
$sql = "SELECT t.id as id , t.title as title, m.nama as nama_module, d.nama_departmen as nama_deps, t.created_at as created_at, t.is_publish as is_publish ";
$sql.=" FROM trainings t join  modules m on t.id_module = m.id left outer join departments d on t.id_department = d.id_department";
$query=mysqli_query($conn, $sql) or die("list_score_summary.php: get employees");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT t.id as id , t.title as title, m.nama as nama_module, d.nama_departmen as nama_deps, t.created_at as created_at, t.is_publish as is_publish ";
$sql.=" FROM trainings t join  modules m on t.id_module = m.id left outer join departments d on t.id_department = d.id_department WHERE 1=1";
if( !empty($requestData['search']['value']) and strlen($requestData['search']['value']) > 3) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( 	title 			LIKE '%".$requestData['search']['value']."%' 	";    
	$sql.=" OR 		m.nama 			LIKE '%".$requestData['search']['value']."%' 	";
	$sql.=" OR 		nama_departmen 	LIKE '%".$requestData['search']['value']."%' 	";
	$sql.=" OR 		t.created_at 	LIKE '%".$requestData['search']['value']."%' 	";
	$sql.=" OR 		is_publish 		LIKE '%".$requestData['search']['value']."%' )	";
	
}
$query=mysqli_query($conn, $sql) or die("list_score_summary.php: get employees");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
$query=mysqli_query($conn, $sql) or die("list_score_summary.php: get employees");

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 

	
	$nestedData[] = "<a href='/training/view/".$row['id']."'>".$row['title']."</a>";
	$nestedData[] = $row['nama_module'];
	if(empty($row['nama_deps'])){
		$nestedData[] = "-";
	}else{
		$nestedData[] = $row['nama_deps'];
		
	}
	$nestedData[] = $row['created_at'];
	if($row['is_publish'] == 1){
		$nestedData[]="<td><div class='text-center'><i class='fa fa-check' aria-hidden='true' style='color:green;''></i></div></td>"; 
		$nestedData[]="<td><a href='/training/deactive/".$row['id']."'>Deactive</a></td>"; 
	}else{
		$nestedData[]="<td><div class='text-center'><i class='fa fa-times' aria-hidden='true' style='color:red;''></i></div></td>"; 
		$nestedData[]="<td><a href='/training/publish/".$row['id']."'>Publish Now</a></td>"; 
	}
	$data[] = $nestedData;
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
