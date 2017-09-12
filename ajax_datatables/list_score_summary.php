<?php

/* Database connection start */
include 'connect_database.php';
/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 =>'name', 
	1 =>'score', 
	2 =>'created_at', 
	3 =>'name', 
	
);

// getting total number records without any search
$sql = "SELECT 	concat(fname,' ', lname) 		as name, 
				p.id 							as id_personnel,
				u.id 							as id_user
				 ";
$sql.=" FROM 	employees 						e 
				join 			personnels 		p 	on 	e.id_personnel 	= p.id 
				join 			users 			u 	on 	p.id_user 		= u.id 
				 ";

$query 				=	mysqli_query($conn, $sql) or die("list_score_summary.php: get employees");
$totalData 			= 	mysqli_num_rows($query);
$totalFiltered 		= 	$totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT 	concat(fname,' ', lname) 		as name, 
				p.id 							as id_personnel,
				u.id 							as id_user
				 ";
$sql.=" FROM 	employees 						e 
				join 			personnels 		p 	on 	e.id_personnel 	= p.id 
				join 			users 			u 	on 	p.id_user 		= u.id 
				WHERE 1=1 ";

if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( 	concat(fname,' ',lname) 	LIKE '%".$requestData['search']['value']."%' 	";    
	$sql.=" OR 		lname 						LIKE '%".$requestData['search']['value']."%' )	";
	
	
}

$query 			=	mysqli_query($conn, $sql) or die("list_score_summary.php: get employees");
$totalFiltered 	=	mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 

$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
$query 			=	mysqli_query($conn, $sql) or die("list_score_summary.php: get employees");

$data 			= 	array();
while( $row 	=	mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData	=	array(); 

	
	$nestedData[] = "<strong><a href='/personnel/".$row['id_personnel']."'>".$row['name']."</a></strong>";

	//get score summary
	$newsql 		= 	"SELECT * FROM score_summaries WHERE id_user = ".$row['id_user']." ORDER BY id DESC LIMIT 1";
	$newquery 		=	mysqli_query($conn, $newsql);

	if(empty($newquery)){
	  	$nestedData[] 	= "-";
	  	$nestedData[] 	= "-";
	}else{
		$score_data 	= 	mysqli_fetch_array($newquery);
	  	$nestedData[]	=	"<a href='".$score_data['url_file_pdf']."'>".$score_data['file_name']."</a>";
	  	$nestedData[]	= 	$score_data['created_at'];
	}
	$nestedData[] = "<input type='button' class='btn btn-default btn-flat' value='Edit' onclick='msg(".$row['id_user'].")'>";
	
	
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
