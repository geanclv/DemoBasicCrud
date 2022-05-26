<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/ConfigDatabase.php';
include_once '../../class/Person.php';

$database = new Database();
$db = $database->getConnection();

$item = new Person($db);
$item->id = isset($_GET['id']) ? $_GET['id'] : die();

$item->getPersonById();
if($item->name != null){
	// create array
	$emp_arr = array(
		"id" =>  $item->id,
		"document_type_id" => $item->document_type_id,
		"document" => $item->document,
		"name" => $item->name,
		"last_name" => $item->last_name,
		"phone" => $item->phone,
		"picture_url" => $item->picture_url,
		"status" => $item->status,
		"doc_name" => $item->doc_name
	);
  
	http_response_code(200);
	echo json_encode($emp_arr);
}
  
else{
	http_response_code(404);
	echo json_encode("Person not found.");
}