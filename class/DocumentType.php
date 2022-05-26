<?php
class DocumentType{
	// Connection
	private $conn;
	// Tables
	private $table_document_type = "document_type";
	// Columns
	public $id;
	public $name;
	public $status;
	
	// Db connection
	public function __construct($db){
		$this->conn = $db;
	}
	
	// CREATE
	public function createDocumentType(){
		$sqlQuery = "INSERT INTO ". $this->table_document_type
			." SET
				name = :name, 
				status = :status";
	
		$stmt = $this->conn->prepare($sqlQuery);
	
		// sanitize
		$this->name=htmlspecialchars(strip_tags($this->name));
		$this->status=htmlspecialchars(strip_tags($this->status));
	
		// bind data
		$stmt->bindParam(":name", $this->name);
		$stmt->bindParam(":status", $this->status);
	
		if($stmt->execute()){
		   return true;
		}
		return false;
	}
	
	// READ ALL
	public function getDocumentTypeAll(){
		$sqlQuery = "SELECT d.id, d.name, d.status "
			. "FROM " . $this->table_document_type . " d ";
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->execute();
		return $stmt;
	}
	
	// READ BY ID
	public function getDocumentTypeById(){
		$sqlQuery = "SELECT d.id, d.name, d.status "
			. "FROM ". $this->table_document_type . " d "
			. "WHERE d.id = ? "
			. "LIMIT 1";
		$stmt = $this->conn->prepare($sqlQuery);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		$dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->name = $dataRow['name'];
		$this->status = $dataRow['status'];
	}
	
	// UPDATE
	public function updateDocumentType(){
		$sqlQuery = "UPDATE ". $this->table_document_type
			." SET
				name = :name, 
				status = :status
			WHERE 
				id = :id";
	
		$stmt = $this->conn->prepare($sqlQuery);
	
		// sanitize
		$this->name=htmlspecialchars(strip_tags($this->name));
		$this->status=htmlspecialchars(strip_tags($this->status));
		$this->id=htmlspecialchars(strip_tags($this->id));
	
		// bind data
		$stmt->bindParam(":name", $this->name);
		$stmt->bindParam(":status", $this->status);
		$stmt->bindParam(":id", $this->id);
	
		if($stmt->execute()){
		   return true;
		}
		return false;
	}
	
	// DELETE
	function deleteDocumentType(){
		$sqlQuery = "DELETE FROM " . $this->table_document_type . " WHERE id = ?";
		$stmt = $this->conn->prepare($sqlQuery);
	
		$this->id=htmlspecialchars(strip_tags($this->id));
	
		$stmt->bindParam(1, $this->id);
	
		if($stmt->execute()){
			return true;
		}
		return false;
	}
}