<?php
	class frequent_questions {
		public $connection = null;
        public $frequent_questions_id = 0;
        public $frequent_questions_
description = 0;
        public $frequent_questions_reply = 0;
        
		function insert(){
			$data = array(
                'frequent_questions_id' => $this->frequent_questions_id,
                'frequent_questions_
description' => $this->frequent_questions_
description,
                'frequent_questions_reply' => $this->frequent_questions_reply
			);
			$sql = 'INSERT INTO frequent_questions (frequent_questions_id, frequent_questions_
description, frequent_questions_reply) VALUES (:frequent_questions_id, :frequent_questions_
description, :frequent_questions_reply)';
			$stmt= $this->connection->prepare($sql);
			if( $stmt->execute($data) ){ return true; }
			return false;
		}

		function update(){
			$sql = 'UPDATE frequent_questions SET frequent_questions_
description = ?, frequent_questions_reply = ? WHERE frequent_questions_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->frequent_questions_
description, $this->frequent_questions_reply, $this->frequent_questions_id) ) ){ return true; }
			return false;
		}

		function delete(){$sql = 'DELETE FROM frequent_questions WHERE frequent_questions_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->frequent_questions_id) ) ){ return true; }
			return false;
		}

		

		function findOne(){
			$sql = 'SELECT * FROM frequent_questions WHERE frequent_questions_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->frequent_questions_id) ) ){ return $stmt; }
			return null;
		}

		function findAll(){
			$sql = 'SELECT * FROM frequent_questions';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute()) { return $stmt; }
			return null;
		}

		function findAllPaginated($index, $cant){
			$sql = 'SELECT * FROM frequent_questions LIMIT ? OFFSET ?';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute( array($cant,($index*$cant)) ) ) { return $stmt; }
			return null;
		}
	}
?>