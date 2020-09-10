<?php
	class business_data {
		public $connection = null;
        public $business_ruc = 0;
        public $business_name = 0;
        public $business_phone = 0;
        public $province = 0;
        public $canton = 0;
        public $business_location = 0;
        
		function insert(){
			$data = array(
                'business_ruc' => $this->business_ruc,
                'business_name' => $this->business_name,
                'business_phone' => $this->business_phone,
                'province' => $this->province,
                'canton' => $this->canton,
                'business_location' => $this->business_location
			);
			$sql = 'INSERT INTO business_data (business_ruc, business_name, business_phone, province, canton, business_location) VALUES (:business_ruc, :business_name, :business_phone, :province, :canton, :business_location)';
			$stmt= $this->connection->prepare($sql);
			if( $stmt->execute($data) ){ return true; }
			return false;
		}

		function update(){
			$sql = 'UPDATE business_data SET business_name = ?, business_phone = ?, province = ?, canton = ?, business_location = ? WHERE business_ruc = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->business_name, $this->business_phone, $this->province, $this->canton, $this->business_location, $this->business_ruc) ) ){ return true; }
			return false;
		}

		function delete(){$sql = 'DELETE FROM business_data WHERE business_ruc = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->business_ruc) ) ){ return true; }
			return false;
		}

		

		function findOne(){
			$sql = 'SELECT * FROM business_data WHERE business_ruc = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->business_ruc) ) ){ return $stmt; }
			return null;
		}

		function findAll(){
			$sql = 'SELECT * FROM business_data';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute()) { return $stmt; }
			return null;
		}

		function findAllPaginated($index, $cant){
			$sql = 'SELECT * FROM business_data LIMIT ? OFFSET ?';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute( array($cant,($index*$cant)) ) ) { return $stmt; }
			return null;
		}
	}
?>