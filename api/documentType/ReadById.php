<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/ConfigDatabase.php';
include_once '../../class/DocumentType.php';

$database = new Database();
$db = $database->getConnection();

$item = new DocumentType($db);
$item->id = isset($_GET['id']) ? $_GET['id'] : die();

$item->getDocumentTypeById();
if($item->name != null){
	// create array
	$documentTypeArr = array(
		"id" =>  $item->id,
		"name" => $item->name,
		"status" => $item->status
	);
  
	http_response_code(200);
	echo json_encode($documentTypeArr);
}
  
else{
	http_response_code(404);
	echo json_encode("Document type not found.");
}