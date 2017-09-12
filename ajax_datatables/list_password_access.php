<?php

/* Database connection start */
include 'connect_database.php';
/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 	=>	'email', 
	1	=>	'username',
	2 	=> 	'created_at',
	3 	=>	'is_process', 
	4 	=> 	'email'
);

// getting total number records without any search
$sql = "SELECT 	u.id 								as user_id,
				pr.email 							as email,
				pr.username 			  			as username, 
				pr.created_at 						as created_at, 
				pr.is_process 						as is_process,
				u.username 							as username_valid,
				p.email 							as email_valid ";

$sql.=" FROM 	password_resets pr 
				LEFT OUTER JOIN personnels p 		ON pr.email = p.email 
				LEFT OUTER JOIN users u 			ON pr.username = u.username ";

$query=mysqli_query($conn, $sql) or die("list_password_access.php: get users");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT 	u.id 								as user_id,
				pr.email 							as email,
				pr.username 			  			as username, 
				pr.created_at 						as created_at, 
				pr.is_process 						as is_process, 
				u.username 							as username_valid,
				p.email 							as email_valid ";

$sql.=" FROM 	password_resets pr 
				LEFT OUTER JOIN personnels p 		ON pr.email = p.email 
				LEFT OUTER JOIN users u 			ON pr.username = u.username			
				WHERE 1=1 ";

if( !empty($requestData['search']['value']) and strlen($requestData['search']['value']) > 3) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( 	pr.email 			LIKE '%".$requestData['search']['value']."%' 	";    
	$sql.=" OR 		pr.username 		LIKE '%".$requestData['search']['value']."%' 	";
	$sql.=" OR 		pr.is_process	 	LIKE '%".$requestData['search']['value']."%' )	";
	
}

$query=mysqli_query($conn, $sql) or die("list_password_access.php: get users");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
$query=mysqli_query($conn, $sql) or die("list_password_access.php: get users");

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 

	
	$nestedData[] = $row['username'];
	$nestedData[] = $row['email'];
	$nestedData[] = $row['created_at'];
	if (!empty($row['username_valid']) and !empty($row['email_valid'])) {
		$nestedData[] = "valid account";
		if ($row['is_process'] == 1) {
			$nestedData[] = "success";
			$nestedData[] = "<a class='btn btn-default btn-flat' disabled='true'>process</a>";
		}else{
			$nestedData[] = "<span style='opacity: 0.5'>no action</span>";
			$nestedData[] = "<a href='/process-access/submit/".$row['user_id']."' class='btn btn-default btn-flat'>process</a>";
		}
	}else{
		$nestedData[] = "non valid account";
		$nestedData[] = "<span style='opacity: 0.5'>no action</span>";
		$nestedData[] = "<a class='btn btn-default btn-flat' disabled='true'>process</a>";
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
