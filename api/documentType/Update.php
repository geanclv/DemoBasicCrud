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

$data = json_decode(file_get_contents("php://input"));

$item->id = $data->id;

// DocumentType values
$item->name = $data->name;
$item->status = $data->status;

if($item->updateDocumentType()){
	echo json_encode("Document type data updated.");
} else{
	echo json_encode("Document type could not be updated");
}