<?php
	class works {
		public $connection = null;
        public $user_data = 0;
        public $business_ruc = 0;
        public $role = 0;
        
		function insert(){
			$data = array(
                'user_data' => $this->user_data,
                'business_ruc' => $this->business_ruc,
                'role' => $this->role
			);
			$sql = 'INSERT INTO works (user_data, business_ruc, role) VALUES (:user_data, :business_ruc, :role)';
			$stmt= $this->connection->prepare($sql);
			if( $stmt->execute($data) ){ return true; }
			return false;
		}

		function update(){
			$sql = 'UPDATE works SET role = ? WHERE user_data = ?business_ruc = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->role, $this->user_data, $this->business_ruc) ) ){ return true; }
			return false;
		}

		function delete(){$sql = 'DELETE FROM works WHERE user_data = ?business_ruc = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->user_data$this->business_ruc) ) ){ return true; }
			return false;
		}

		

		function findOne(){
			$sql = 'SELECT * FROM works WHERE user_data = ?business_ruc = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->user_data$this->business_ruc) ) ){ return $stmt; }
			return null;
		}

		function findAll(){
			$sql = 'SELECT * FROM works';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute()) { return $stmt; }
			return null;
		}

		function findAllPaginated($index, $cant){
			$sql = 'SELECT * FROM works LIMIT ? OFFSET ?';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute( array($cant,($index*$cant)) ) ) { return $stmt; }
			return null;
		}
	}
?>