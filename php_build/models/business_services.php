<?php
	class business_services {
		public $connection = null;
        public $business_ruc = 0;
        public $service_id = 0;
        
		function insert(){
			$data = array(
                'business_ruc' => $this->business_ruc,
                'service_id' => $this->service_id
			);
			$sql = 'INSERT INTO business_services (business_ruc, service_id) VALUES (:business_ruc, :service_id)';
			$stmt= $this->connection->prepare($sql);
			if( $stmt->execute($data) ){ return true; }
			return false;
		}

		function update(){
			$sql = 'UPDATE business_services SET  WHERE business_ruc = ?service_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array(, $this->business_ruc, $this->service_id) ) ){ return true; }
			return false;
		}

		function delete(){$sql = 'DELETE FROM business_services WHERE business_ruc = ?service_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->business_ruc$this->service_id) ) ){ return true; }
			return false;
		}

		

		function findOne(){
			$sql = 'SELECT * FROM business_services WHERE business_ruc = ?service_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->business_ruc$this->service_id) ) ){ return $stmt; }
			return null;
		}

		function findAll(){
			$sql = 'SELECT * FROM business_services';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute()) { return $stmt; }
			return null;
		}

		function findAllPaginated($index, $cant){
			$sql = 'SELECT * FROM business_services LIMIT ? OFFSET ?';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute( array($cant,($index*$cant)) ) ) { return $stmt; }
			return null;
		}
	}
?>