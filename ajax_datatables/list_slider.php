<?php

/* Database connection start */
include 'connect_database.php';
/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 =>'title', 
	1 => 'is_activ',
	2 =>'created_at', 
	3 => 'id'
);

// getting total number records without any search
$sql = "SELECT * ";
$sql.=" FROM content_sliders ";
$query=mysqli_query($conn, $sql);
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT * ";
$sql.=" FROM content_sliders WHERE 1=1";
if( !empty($requestData['search']['value']) and strlen($requestData['search']['value']) > 3) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( title LIKE '%".$requestData['search']['value']."%' )";    
	
}
$query=mysqli_query($conn, $sql);
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
$query=mysqli_query($conn, $sql);

$sql2 = "SELECT id ";
$sql2.="FROM content_sliders where is_activ = 1";
$query2=mysqli_query($conn, $sql2);
$totalData2 = mysqli_num_rows($query2);

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 

	$nestedData[] = $row["title"];
	if ($row['is_activ'] == 1) {
		$nestedData[] = "active <span><a class='btn btn-danger' href='/slider/".$row['id']."/nonactive'>Deactive</a></span>";
	}else{
		if ($totalData2 <= 5) {
			$nestedData[] = "<span style='opacity: 0.5;''>not active </span>
					  <span><a class='btn btn-warning' href='/slider/".$row["id"]."/active'>Activicate</a></span>";
		}else{
			$nestedData[] = "<span style='opacity: 0.5;'>not active </span>
					  <span><a class='btn btn-warning' disabled='true' >Activicate</a></span>";
		}
	}
	$nestedData[] = $row['created_at'];
	$nestedData[] = "<span><a class='btn btn-default' href='/slider/".$row["id"]."/edit'>edit</a></span>";
	
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
