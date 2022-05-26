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

$data = json_decode(file_get_contents("php://input"));

$item->id = $data->id;

// Person values
$item->document_type_id = $data->document_type_id;
$item->document = $data->document;
$item->name = $data->name;
$item->last_name = $data->last_name;
$item->phone = $data->phone;
$item->picture_url = $data->picture_url;
$item->status = $data->status;

if($item->updatePerson()){
	echo json_encode("Person data updated.");
} else{
	echo json_encode("Person could not be updated");
}