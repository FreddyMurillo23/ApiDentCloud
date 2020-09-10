<?php
	class schedule {
		public $connection = null;
        public $schedule_id = 0;
        public $
schedule_date = 0;
        public $
schedule_start = 0;
        public $
schedule_final = 0;
        public $
schedule_extra = 0;
        
		function insert(){
			$data = array(
                'schedule_id' => $this->schedule_id,
                '
schedule_date' => $this->
schedule_date,
                '
schedule_start' => $this->
schedule_start,
                '
schedule_final' => $this->
schedule_final,
                '
schedule_extra' => $this->
schedule_extra
			);
			$sql = 'INSERT INTO schedule (schedule_id, 
schedule_date, 
schedule_start, 
schedule_final, 
schedule_extra) VALUES (:schedule_id, :
schedule_date, :
schedule_start, :
schedule_final, :
schedule_extra)';
			$stmt= $this->connection->prepare($sql);
			if( $stmt->execute($data) ){ return true; }
			return false;
		}

		function update(){
			$sql = 'UPDATE schedule SET 
schedule_date = ?, 
schedule_start = ?, 
schedule_final = ?, 
schedule_extra = ? WHERE schedule_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->
schedule_date, $this->
schedule_start, $this->
schedule_final, $this->
schedule_extra, $this->schedule_id) ) ){ return true; }
			return false;
		}

		function delete(){$sql = 'DELETE FROM schedule WHERE schedule_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->schedule_id) ) ){ return true; }
			return false;
		}

		

		function findOne(){
			$sql = 'SELECT * FROM schedule WHERE schedule_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->schedule_id) ) ){ return $stmt; }
			return null;
		}

		function findAll(){
			$sql = 'SELECT * FROM schedule';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute()) { return $stmt; }
			return null;
		}

		function findAllPaginated($index, $cant){
			$sql = 'SELECT * FROM schedule LIMIT ? OFFSET ?';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute( array($cant,($index*$cant)) ) ) { return $stmt; }
			return null;
		}
	}
?>