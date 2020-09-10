<?php
	class user_disease {
		public $connection = null;
        public $user_email = 0;
        public $disease_id = 0;
        
		function insert(){
			$data = array(
                'user_email' => $this->user_email,
                'disease_id' => $this->disease_id
			);
			$sql = 'INSERT INTO user_disease (user_email, disease_id) VALUES (:user_email, :disease_id)';
			$stmt= $this->connection->prepare($sql);
			if( $stmt->execute($data) ){ return true; }
			return false;
		}

		function update(){
			$sql = 'UPDATE user_disease SET  WHERE user_email = ?disease_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array(, $this->user_email, $this->disease_id) ) ){ return true; }
			return false;
		}

		function delete(){$sql = 'DELETE FROM user_disease WHERE user_email = ?disease_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->user_email$this->disease_id) ) ){ return true; }
			return false;
		}

		

		function findOne(){
			$sql = 'SELECT * FROM user_disease WHERE user_email = ?disease_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->user_email$this->disease_id) ) ){ return $stmt; }
			return null;
		}

		function findAll(){
			$sql = 'SELECT * FROM user_disease';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute()) { return $stmt; }
			return null;
		}

		function findAllPaginated($index, $cant){
			$sql = 'SELECT * FROM user_disease LIMIT ? OFFSET ?';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute( array($cant,($index*$cant)) ) ) { return $stmt; }
			return null;
		}
	}
?>