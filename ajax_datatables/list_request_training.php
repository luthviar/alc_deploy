<?php

/* Database connection start */
include 'connect_database.php';
/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 	=>	'name', 
	1	=>	'nama_deps',
	2 	=> 	'title',
	3 	=>	'training_for', 
	4 	=> 	'created_at',
	5 	=> 	'auth',
	6 	=> 	'name',
);

// getting total number records without any search
$sql = "SELECT 	concat(fname,' ',lname)	as name,
				uta.id 					as auth_id,
				d.nama_departmen		as nama_deps,
				t.id_department			as training_for,
				t.title 				as title,
				uta.created_at			as created_at,
				uta.auth 				as auth	
				 ";

$sql.=" FROM user_training_auths 					uta 
			LEFT OUTER JOIN users 					u 		ON uta.id_user = u.id 
			LEFT OUTER JOIN trainings 				t 		ON uta.id_training = t.id 
			LEFT OUTER JOIN personnels 				p	 	ON p.id_user = u.id
            LEFT OUTER JOIN employees 				em		ON em.id_personnel = p.id
            LEFT OUTER JOIN struktur_organisasis 	st 		ON st.id = em.struktur
            LEFT OUTER JOIN departments 			d 		ON d.id_department = st.id_department ";

$query=mysqli_query($conn, $sql) or die("list_password_access.php: get users");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT concat(fname,' ',lname)	as name,
				uta.id 					as auth_id,
				d.nama_departmen		as nama_deps,
				t.id_department			as training_for,
				t.title 				as title,
				uta.created_at			as created_at,
				uta.auth 				as auth	
				";

$sql.=" FROM user_training_auths 					uta 
			LEFT OUTER JOIN users 					u 		ON uta.id_user = u.id 
			LEFT OUTER JOIN trainings 				t 		ON uta.id_training = t.id 
			LEFT OUTER JOIN personnels 				p	 	ON p.id_user = u.id
            LEFT OUTER JOIN employees 				em		ON em.id_personnel = p.id
            LEFT OUTER JOIN struktur_organisasis 	st 		ON st.id = em.struktur
            LEFT OUTER JOIN departments 			d 		ON d.id_department = st.id_department
				WHERE 1=1 ";

if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( 	concat(fname,' ',lname)		LIKE '%".$requestData['search']['value']."%' 	";    
	$sql.=" OR 		lname						LIKE '%".$requestData['search']['value']."%' 	";
	$sql.=" OR 		d.nama_departmen 			LIKE '%".$requestData['search']['value']."%' 	";
	$sql.=" OR 		uta.created_at 				LIKE '%".$requestData['search']['value']."%' 	";
	$sql.=" OR 		t.title	 					LIKE '%".$requestData['search']['value']."%' )	";
	
}

$query=mysqli_query($conn, $sql) or die("list_password_access.php: get users");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
$query=mysqli_query($conn, $sql) or die("list_password_access.php: get users");

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 

	
	$nestedData[] = $row['name'];
	
	if (empty($row['nama_deps'])) {
		$nestedData[] = "-";
	}else{
		$nestedData[] = $row['nama_deps'];
	}
	$nestedData[] = $row['title'];

	if (empty($row['training_for'])) {
		$nestedData[] = "All departments";	
	}else{
		$newsql = "SELECT nama_departmen FROM departments  WHERE id_department=".$row['training_for']."";
		$newquery=mysqli_query($conn, $newsql);
		$totalData2 = mysqli_fetch_array($newquery)['nama_departmen'];
		$nestedData[] = $totalData2;
	}
	
	$nestedData[] = $row['created_at'];

	if ($row['auth'] == 1) {
		$nestedData[] = "Open";
		$nestedData[] = "<a href='/access/".$row['auth_id']."/nonactive' class='btn btn-warning'>close</a>";
	}else{
		$nestedData[] = "Close";
		$nestedData[] = "<a href='/access/".$row['auth_id']."/active' class='btn btn-default'>open</a>";
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
