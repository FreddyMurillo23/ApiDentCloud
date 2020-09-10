<?php
	class doctor {
		public $connection = null;
        public $user_email = 0;
        public $profession = 0;
        
		function insert(){
			$data = array(
                'user_email' => $this->user_email,
                'profession' => $this->profession
			);
			$sql = 'INSERT INTO doctor (user_email, profession) VALUES (:user_email, :profession)';
			$stmt= $this->connection->prepare($sql);
			if( $stmt->execute($data) ){ return true; }
			return false;
		}

		function update(){
			$sql = 'UPDATE doctor SET profession = ? WHERE user_email = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->profession, $this->user_email) ) ){ return true; }
			return false;
		}

		function delete(){$sql = 'DELETE FROM doctor WHERE user_email = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->user_email) ) ){ return true; }
			return false;
		}

		

		function findOne(){
			$sql = 'SELECT * FROM doctor WHERE user_email = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->user_email) ) ){ return $stmt; }
			return null;
		}

		function findAll(){
			$sql = 'SELECT * FROM doctor';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute()) { return $stmt; }
			return null;
		}

		function findAllPaginated($index, $cant){
			$sql = 'SELECT * FROM doctor LIMIT ? OFFSET ?';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute( array($cant,($index*$cant)) ) ) { return $stmt; }
			return null;
		}
	}
?>