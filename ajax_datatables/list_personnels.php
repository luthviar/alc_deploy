<?php

/* Database connection start */
include 'connect_database.php';
/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 	=>	'name', 
	1	=>	'nama_level',
	2 	=> 	'nama_deps',
	3 	=>	'nama_divisi', 
	4 	=> 	'created_at',
	5 	=> 	'is_admin',
	6 	=> 	'is_aktif',
	7 	=> 	'name'
);

// getting total number records without any search
$sql = "SELECT 	p.id 								as id_personnel,
				concat(fname,' ',lname)  			as name, 
				nama_departmen 						as nama_deps, 
				nama_divisi 						as nama_divisi, 
				u.updated_at 						as created_at, 
				nama_level 							as nama_level, 
				is_aktif 							as is_aktif, 
				is_admin 							as is_admin ";

$sql.=" FROM users u join personnels p 				on u.id = p.id_user 
			LEFT OUTER JOIN employees e 			on e.id_personnel = p.id 
			LEFT OUTER JOIN struktur_organisasis so on so.id = e.struktur 
			LEFT OUTER JOIN level_positions lv 		on lv.id = e.level_position 
			LEFT OUTER JOIN departments d 			on d.id_department = so.id_department 
			LEFT OUTER JOIN divisis dvs 			on dvs.id_divisi = so.id_divisi ";

$query=mysqli_query($conn, $sql) or die("list_personnels.php: get users");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT 	p.id 								as id_personnel,
				concat(fname,' ',lname)  			as name, 
				nama_departmen 						as nama_deps, 
				nama_divisi 						as nama_divisi, 
				u.updated_at 						as created_at, 
				nama_level 							as nama_level, 
				is_aktif 							as is_aktif, 
				is_admin 							as is_admin ";
$sql.=" FROM users u join personnels p 				on u.id = p.id_user 
			LEFT OUTER JOIN employees e 			on e.id_personnel = p.id 
			LEFT OUTER JOIN struktur_organisasis so on so.id = e.struktur 
			LEFT OUTER JOIN level_positions lv 		on lv.id = e.level_position 
			LEFT OUTER JOIN departments d 			on d.id_department = so.id_department 
			LEFT OUTER JOIN divisis dvs 			on dvs.id_divisi = so.id_divisi 
			WHERE 1=1";

if( !empty($requestData['search']['value']) and strlen($requestData['search']['value']) > 3) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.=" AND ( 	fname 			LIKE '%".$requestData['search']['value']."%' 	";    
	$sql.=" OR 		lname 			LIKE '%".$requestData['search']['value']."%' 	";
	$sql.=" OR 		nama_departmen 	LIKE '%".$requestData['search']['value']."%' 	";
	$sql.=" OR 		u.updated_at 	LIKE '%".$requestData['search']['value']."%' 	";
	$sql.=" OR 		is_aktif	 	LIKE '%".$requestData['search']['value']."%' 	";
	$sql.=" OR 		nama_level	 	LIKE '%".$requestData['search']['value']."%' 	";
	$sql.=" OR 		is_admin 		LIKE '%".$requestData['search']['value']."%' )	";
	
}

$query=mysqli_query($conn, $sql) or die("list_personnels.php: get users");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */	
$query=mysqli_query($conn, $sql) or die("list_personnels.php: get users");

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array(); 

	
	$nestedData[] = "<a  href='/personnel/".$row['id_personnel']."'>".$row['name']."</a>";
	
	if (empty($row['nama_level'])) {
		$nestedData[] = "-";
	}else{
		$nestedData[] = $row['nama_level'];
	}

	if (empty($row['nama_divisi'])) {
		$nestedData[] = "-";
	}else{
		$nestedData[] = $row['nama_divisi'];
	}
	
	if (empty($row['nama_deps'])) {
		$nestedData[] = "-";
	}else{
		$nestedData[] = $row['nama_deps'];
	}
	$nestedData[] = $row['created_at'];
	if($row['is_admin'] == 1){
	  $nestedData[] = "Admin";
	}else{
	  $nestedData[] = "User";
	}
	
	if($row['is_aktif'] == 1){
	  $nestedData[] = "Aktif";
	}else{
	  $nestedData[] = "Tidak Aktif";
	}
	
	$nestedData[] = "<span><a class='btn btn-default' href='/personnel/".$row['id_personnel']."/edit'>edit</a></span>";
	

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
