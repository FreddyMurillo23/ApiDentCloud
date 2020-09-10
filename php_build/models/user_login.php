<?php
	class user_login {
		public $connection = null;
        public $user_email = 0;
        public $password = 0;
        public $confirm_password = 0;
        
		function insert(){
			$data = array(
                'user_email' => $this->user_email,
                'password' => $this->password,
                'confirm_password' => $this->confirm_password
			);
			$sql = 'INSERT INTO user_login (user_email, password, confirm_password) VALUES (:user_email, :password, :confirm_password)';
			$stmt= $this->connection->prepare($sql);
			if( $stmt->execute($data) ){ return true; }
			return false;
		}

		function update(){
			$sql = 'UPDATE user_login SET password = ?, confirm_password = ? WHERE user_email = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->password, $this->confirm_password, $this->user_email) ) ){ return true; }
			return false;
		}

		function delete(){$sql = 'DELETE FROM user_login WHERE user_email = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->user_email) ) ){ return true; }
			return false;
		}

		

		function findOne(){
			$sql = 'SELECT * FROM user_login WHERE user_email = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->user_email) ) ){ return $stmt; }
			return null;
		}

		function findAll(){
			$sql = 'SELECT * FROM user_login';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute()) { return $stmt; }
			return null;
		}

		function findAllPaginated($index, $cant){
			$sql = 'SELECT * FROM user_login LIMIT ? OFFSET ?';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute( array($cant,($index*$cant)) ) ) { return $stmt; }
			return null;
		}
	}
?>