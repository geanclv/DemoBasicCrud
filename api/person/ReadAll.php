<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/ConfigDatabase.php';
include_once '../../class/Person.php';

$database = new Database();
$db = $database->getConnection();

$items = new Person($db);
$stmt = $items->getPersonAll();
$itemCount = $stmt->rowCount();

echo json_encode($itemCount);

if($itemCount > 0){
	$personArr = array();
	$personArr["body"] = array();
	$personArr["itemCount"] = $itemCount;
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		$e = array(
			"id" => $id,
			"document_type_id" => $document_type_id,
			"document" => $document,
			"name" => $name,
			"last_name" => $last_name,
			"phone" => $phone,
			"picture_url" => $picture_url,
			"status" => $status,
			"doc_name" => $doc_name
		);
		array_push($personArr["body"], $e);
	}
	echo json_encode($personArr);
} else{
	http_response_code(404);
	
	echo json_encode(
		array("message" => "No record found.")
	);
}