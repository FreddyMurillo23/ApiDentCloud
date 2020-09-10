<?php
	class documents {
		public $connection = null;
        public $document_id = 0;
        public $document_url = 0;
        public $document_date = 0;
        public $document_description = 0;
        public $document_type = 0;
        public $appointment_id = 0;
        
		function insert(){
			$data = array(
                'document_id' => $this->document_id,
                'document_url' => $this->document_url,
                'document_date' => $this->document_date,
                'document_description' => $this->document_description,
                'document_type' => $this->document_type,
                'appointment_id' => $this->appointment_id
			);
			$sql = 'INSERT INTO documents (document_id, document_url, document_date, document_description, document_type, appointment_id) VALUES (:document_id, :document_url, :document_date, :document_description, :document_type, :appointment_id)';
			$stmt= $this->connection->prepare($sql);
			if( $stmt->execute($data) ){ return true; }
			return false;
		}

		function update(){
			$sql = 'UPDATE documents SET document_url = ?, document_date = ?, document_description = ?, document_type = ?, appointment_id = ? WHERE document_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->document_url, $this->document_date, $this->document_description, $this->document_type, $this->appointment_id, $this->document_id) ) ){ return true; }
			return false;
		}

		function delete(){$sql = 'DELETE FROM documents WHERE document_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->document_id) ) ){ return true; }
			return false;
		}

		

		function findOne(){
			$sql = 'SELECT * FROM documents WHERE document_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->document_id) ) ){ return $stmt; }
			return null;
		}

		function findAll(){
			$sql = 'SELECT * FROM documents';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute()) { return $stmt; }
			return null;
		}

		function findAllPaginated($index, $cant){
			$sql = 'SELECT * FROM documents LIMIT ? OFFSET ?';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute( array($cant,($index*$cant)) ) ) { return $stmt; }
			return null;
		}
	}
?>