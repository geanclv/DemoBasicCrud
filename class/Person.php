<?php
class Person{
	// Connection
	private $conn;
	// Tables
	private $table_person = "person";
	private $table_document_type = "document_type";
	// Columns
	public $id;
	public $document_type_id;
	public $document;
	public $name;
	public $last_name;
	public $phone;
	public $picture_url;
	public $status;
	public $doc_name;
	
	// Db connection
	public function __construct($db){
		$this->conn = $db;
	}
	
	// CREATE
	public function createPerson(){
		$sqlQuery = "INSERT INTO ". $this->table_person
			." SET
				document_type_id = :document_type_id, 
				document = :document, 
				name = :name, 
				last_name = :last_name, 
				phone = :phone, 
				picture_url = :picture_url, 
				status = :status";
	
		$stmt = $this->conn->prepare($sqlQuery);
	
		// sanitize
		$this->document_type_id=htmlspecialchars(strip_tags($this->document_type_id));
		$this->document=htmlspecialchars(strip_tags($this->document));
		$this->name=htmlspecialchars(strip_tags($this->name));
		$this->last_name=htmlspecialchars(strip_tags($this->last_name));
		$this->phone=htmlspecialchars(strip_tags($this->phone));
		$this->picture_url=htmlspecialchars(strip_tags($this->picture_url));
		$this->status=htmlspecialchars(strip_tags($this->status));
	
		// bind data
		$stmt->bindParam(":document_type_id", $this->document_type_id);
		$stmt->bindParam(":document", $this->document);
		$stmt->bindParam(":name", $this->name);
		$stmt->bindParam(":last_name", $this->last_name);
		$stmt->bindParam(":phone", $this->phone);
		$stmt->bindParam(":picture_url", $this->picture_url);
		$stmt->bindParam(":status", $this->status);
	
		if($stmt->execute()){
		   return true;
		}
		return false;
	}
	
	// READ ALL
	public function getPersonAll(){
		$sqlQuery = "SELECT p.id, p.document_type_id, p.document, p.name, p.last_name, p.phone, p.picture_url, p.status, d.name as doc_name "
			. "FROM " . $this->table_person . " p, " . $this->table_document_type . " d "
			. "WHERE p.document_type_id = d.id";
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		return $stmt;
	}
	
	// READ BY ID
	public function getPersonById(){
		$sqlQuery = "SELECT p.id, p.document_type_id, p.document, p.name, p.last_name, p.phone, p.picture_url, p.status, d.name as doc_name "
			. "FROM ". $this->table_person . " p, " . $this->table_document_type . " d "
			. "WHERE p.document_type_id = d.id "
			. "AND p.id = ? "
			. "LIMIT 1";
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		$dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->document_type_id = $dataRow['document_type_id'];
		$this->document = $dataRow['document'];
		$this->name = $dataRow['name'];
		$this->last_name = $dataRow['last_name'];
		$this->phone = $dataRow['phone'];
		$this->picture_url = $dataRow['picture_url'];
		$this->status = $dataRow['status'];
	}
	
	// UPDATE
	public function updatePerson(){
		$sqlQuery = "UPDATE ". $this->table_person
			." SET
				document_type_id = :document_type_id, 
				document = :document, 
				name = :name, 
				last_name = :last_name, 
				phone = :phone, 
				picture_url = :picture_url, 
				status = :status
			WHERE 
				id = :id";
	
		$stmt = $this->conn->prepare($sqlQuery);
	
		// sanitize
		$this->document_type_id=htmlspecialchars(strip_tags($this->document_type_id));
		$this->document=htmlspecialchars(strip_tags($this->document));
		$this->name=htmlspecialchars(strip_tags($this->name));
		$this->last_name=htmlspecialchars(strip_tags($this->last_name));
		$this->phone=htmlspecialchars(strip_tags($this->phone));
		$this->picture_url=htmlspecialchars(strip_tags($this->picture_url));
		$this->status=htmlspecialchars(strip_tags($this->status));
		$this->id=htmlspecialchars(strip_tags($this->id));
	
		// bind data
		$stmt->bindParam(":document_type_id", $this->document_type_id);
		$stmt->bindParam(":document", $this->document);
		$stmt->bindParam(":name", $this->name);
		$stmt->bindParam(":last_name", $this->last_name);
		$stmt->bindParam(":phone", $this->phone);
		$stmt->bindParam(":picture_url", $this->picture_url);
		$stmt->bindParam(":status", $this->status);
		$stmt->bindParam(":id", $this->id);
	
		if($stmt->execute()){
		   return true;
		}
		return false;
	}
	
	// DELETE
	function deletePerson(){
		$sqlQuery = "DELETE FROM " . $this->table_person . " WHERE id = ?";
		$stmt = $this->conn->prepare($sqlQuery);
	
		$this->id=htmlspecialchars(strip_tags($this->id));
	
		$stmt->bindParam(1, $this->id);
	
		if($stmt->execute()){
			return true;
		}
		return false;
	}
}