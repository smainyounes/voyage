<?php 

	/**
	 * users
	 */
	class controller_users 
	{
		private $db;

		function __construct()
		{
			$this->db = new model_database();
		}

		/**
		 * Getters
		 */

		public function GetAll()
		{
			$this->db->query("SELECT * FROM users");
			return $this->db->resultSet();
		}

		public function GetInfo($id_user)
		{
			$this->db->query("SELECT * FROM users WHERE id_user = :id");
			$this->db->bind(":id", $id_user);
			return $this->db->resultSet();
		}

		public function CheckAdmin()
		{
			$this->db->query("SELECT type FROM users WHERE id_user = :id");
			$this->db->bind(":id", $_SESSION['user']);
			$res = $this->db->single();

			return $res->type === 'admin';
		}
		
		/**
		 * Setters
		 */

		public function AddUser()
		{
			// verify all inputs are not empty
			foreach($_POST as $key => $value){
		    	if(empty(trim($value))){
		        	return false;
		    	}
			}

			if ($_POST['type'] != "admin" && $_POST['type'] != "user" ) {
				return false;
			}

			if ($_POST['password'] != $_POST['password2']) {
				return false;
			}

			$this->db->query("INSERT INTO users(username, password, address, type) VALUES(:username, :password, :address, :type)");

			$this->db->bind(":username", $_POST['username']);
			$this->db->bind(":password", password_hash($_POST['password'], PASSWORD_DEFAULT));
			$this->db->bind(":address", $_POST['address']);
			$this->db->bind(":type", $_POST['type']);

			try {
				$this->db->execute();
				return true;
			} catch (Exception $e) {
				return false;
			}

		}

		public function Delete($id_user)
		{
			$this->db->query("DELETE FROM users WHERE id_user = :id");
			$this->db->bind(":id", $id_user);

			try {
				$this->db->execute();
				return true;
			} catch (Exception $e) {
				return false;
			}
		}

		public function UpdatePassword($id_user = null)
		{
			// verify all inputs are not empty
			foreach($_POST as $key => $value){
		    	if(empty(trim($value))){
		        	return false;
		    	}
			}

			if (!isset($id_user)) {
				$id_user = $_SESSION['user'];
			}

			//check old pass
			$this->db->query("SELECT * FROM users WHERE id_user = :id");
			$this->db->bind(":id", $id_user);

			$res = $this->db->single();
			if (password_verify($_POST['old'], $res->password)) {
				// password match
				if ($_POST['pass1'] === $_POST['pass2']) {
					$this->db->query("UPDATE users SET password = :password WHERE id_user = :id");
					$this->db->bind(":password", password_hash($_POST['pass1'], PASSWORD_DEFAULT));
					$this->db->bind(":id", $id_user);

					try {
						$this->db->execute();
						return true;
					} catch (Exception $e) {
						return false;
					}
				}
			}else{
				return false;
			}

			

		}

		public function UpdateUsername($id_user)
		{
			$this->db->query("UPDATE users SET username = :username WHERE id_user = :id");
			$this->db->bind(":username", strip_tags($_POST['username']));
			$this->db->bind(":id", $id_user);

			try {
				$this->db->execute();
				return true;
			} catch (Exception $e) {
				return false;
			}

		}

		public function Login()
		{
			$this->db->query("SELECT * FROM users WHERE username = :username");
			$this->db->bind("username", $_POST['username']);
			$res = $this->db->single();
			if ($res) {
				if (password_verify($_POST['password'], $res->password)) {
					$_SESSION['user'] = $res->id_user;
					return true;
				}
			}else{
				return false;
			}
			
		}

		public function Logout()
		{
			// remove all session variables
			session_unset(); 

			// destroy the session
			session_destroy(); 
		}

	}

 ?>