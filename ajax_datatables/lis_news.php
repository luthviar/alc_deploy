<?php

/* Database connection start */
include 'connect_database.php';
/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 =>'title', 
	1 => 'can_reply',
	2 =>'replies_count', 
	3 => 'created_at',
	4 => 'flag_aktif',
	5 => 'edit'
);

// getting total number records without any search
$sql = "SELECT * ";
$sql.=" FROM beritas  ";
$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT * ";
$sql.=" FROM beritas WHERE 1=1 ";
if( !empty($requestData['search']['value']) and strlen($requestData['search']['value']) > 3) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( title LIKE '%".$requestData['search']['value']."%' )";    
	
}
$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
$query=mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 

	$nestedData[] = "<a href='/news/".$row["id"]."'>".$row["title"]."</a>";
	if ($row["can_reply"] == 1) {
		$nestedData[] = "Yes <span><a class='btn btn-danger' href='/news/".$row["id"]."/nonactive'>Deactive</a></span>";
		$sql2 = "SELECT id ";
		$sql2.="FROM news_replies where id_news = ".$row["id"]."";
		$query2=mysqli_query($conn, $sql2);
		$totalData2 = mysqli_num_rows($query2);
		$nestedData[] = $totalData2;
	}else{
		$nestedData[] = "<span style='opacity: 0.5;''>No </span><span><a class='btn btn-warning' href='/news/".$row["id"]."/active'>Activicate</a></span>";
		$nestedData[] = "-";
	}

	$nestedData[] = $row['created_at'];
	if ($row['flag_aktif'] == 1) {
		$nestedData[] = "aktif <span><a href='/berita/".$row['id']."/nonactive' class='btn btn-default btn-flat'>nonactive</a></span>";
	}else{
		$nestedData[] = "non aktif <span><a href='/berita/".$row['id']."/active' class='btn btn-success btn-flat'>active</a></span>";
	}
	$nestedData[] = "<a class='btn btn-default' href='/news/".$row["id"]."/edit'>edit</a></span>";
	
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
