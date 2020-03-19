<?php 

	/**
	 * 
	 */
	class controller_contact
	{
		private $db;

		function __construct()
		{
			$this->db = new model_database();
		}

		/**
		 * Getters
		 */

		public function GetInfos()
		{
			$this->db->query("SELECT * FROM contact");
			return $this->db->single();
		}

		/**
		 * Setters
		 */

		public function UpdateInfos()
		{
			// verify all inputs are not empty
			foreach($_POST as $key => $value){
		    	if(empty(trim($value))){
		        	return false;
		    	}
			}

			$this->db->query("UPDATE contact SET email = :email, phone = :phone, address = :address");
			$this->db->bind(":email", strip_tags($_POST['email']));
			$this->db->bind(":phone", strip_tags($_POST['phone']));
			$this->db->bind(":address", strip_tags($_POST['address']));

			try {
				$this->db->execute();
				return true;
			} catch (Exception $e) {
				return false;
			}
		}

	}

 ?>