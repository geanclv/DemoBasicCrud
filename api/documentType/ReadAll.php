<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/ConfigDatabase.php';
include_once '../../class/DocumentType.php';

$database = new Database();
$db = $database->getConnection();

$items = new DocumentType($db);
$stmt = $items->getDocumentTypeAll();
$itemCount = $stmt->rowCount();

echo json_encode($itemCount);

if($itemCount > 0){
	$documentTypeArr = array();
	$documentTypeArr["body"] = array();
	$documentTypeArr["itemCount"] = $itemCount;
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		$e = array(
			"id" => $id,
			"name" => $name,
			"status" => $status
		);
		array_push($documentTypeArr["body"], $e);
	}
	echo json_encode($documentTypeArr);
} else{
	http_response_code(404);
	
	echo json_encode(
		array("message" => "No record found.")
	);
}