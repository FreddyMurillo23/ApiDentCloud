<?php
	class services {
		public $connection = null;
        public $service_id = 0;
        public $service_description = 0;
        public $service_duration = 0;
        public $service_cost = 0;
        public $service_url_image = 0;
        
		function insert(){
			$data = array(
                'service_id' => $this->service_id,
                'service_description' => $this->service_description,
                'service_duration' => $this->service_duration,
                'service_cost' => $this->service_cost,
                'service_url_image' => $this->service_url_image
			);
			$sql = 'INSERT INTO services (service_id, service_description, service_duration, service_cost, service_url_image) VALUES (:service_id, :service_description, :service_duration, :service_cost, :service_url_image)';
			$stmt= $this->connection->prepare($sql);
			if( $stmt->execute($data) ){ return true; }
			return false;
		}

		function update(){
			$sql = 'UPDATE services SET service_description = ?, service_duration = ?, service_cost = ?, service_url_image = ? WHERE service_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->service_description, $this->service_duration, $this->service_cost, $this->service_url_image, $this->service_id) ) ){ return true; }
			return false;
		}

		function delete(){$sql = 'DELETE FROM services WHERE service_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->service_id) ) ){ return true; }
			return false;
		}

		

		function findOne(){
			$sql = 'SELECT * FROM services WHERE service_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->service_id) ) ){ return $stmt; }
			return null;
		}

		function findAll(){
			$sql = 'SELECT * FROM services';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute()) { return $stmt; }
			return null;
		}

		function findAllPaginated($index, $cant){
			$sql = 'SELECT * FROM services LIMIT ? OFFSET ?';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute( array($cant,($index*$cant)) ) ) { return $stmt; }
			return null;
		}
	}
?>