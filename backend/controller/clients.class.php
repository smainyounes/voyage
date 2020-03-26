<?php 

	/**
	 * users
	 */
	class controller_clients
	{
		private $db;

		function __construct()
		{
			$this->db = new model_database();
		}

		/**
		 * Getters
		 */

		public function GetByTrip($id_trip)
		{
			$this->db->query("SELECT * FROM clients INNER JOIN users ON clients.id_user = users.id_user WHERE id_trip = :id");
			$this->db->bind(":id", $id_trip);

			return $this->db->resultSet();
		}

		public function GetByUser($id_user)
		{
			$this->db->query("SELECT * FROM clients WHERE id_user = :id");
			$this->db->bind(":id", $id_user);

			return $this->db->resultSet();
		}

		public function GetByTripUser($id_trip, $id_user = null)
		{
			if (!isset($id_user)) {
				$id_user = $_SESSION['user'];
			}
			$this->db->query("SELECT * FROM clients WHERE id_trip = :idtrip AND id_user = :iduser");
			$this->db->bind(":iduser", $id_user);
			$this->db->bind(":idtrip", $id_trip);

			return $this->db->resultSet();
		}

		public function Owner($id_client)
		{
			$this->db->query("SELECT id_client FROM clients WHERE id_client = :client AND id_user = :user");
			$this->db->bind(":client", $id_client);
			$this->db->bind(":user", $_SESSION['user']);

			return $this->db->single();
		}

		
		/**
		 * Setters
		 */

		public function AddClient($id_trip)
		{

			// verify all inputs are not empty
			foreach($_POST as $key => $value){
		    	if(empty(trim($value))){
		        	return false;
		    	}
			}

			$this->db->query("INSERT INTO clients(id_user, id_trip, nom, prenom, phone, infos) VALUES(:user, :trip, :nom, :prenom, :phone, :infos)");

			$this->db->bind(":user", $_SESSION['user']);
			$this->db->bind(":trip", strip_tags($id_trip));
			$this->db->bind(":nom", strip_tags($_POST['nom']));
			$this->db->bind(":prenom", strip_tags($_POST['prenom']));
			$this->db->bind(":phone", strip_tags($_POST['phone']));
			$this->db->bind(":infos", strip_tags($_POST['infos']));

			try {
				$this->db->execute();
				return true;
			} catch (Exception $e) {
				return false;
			}

		}


		public function Delete($id_client)
		{
			$this->db->query("DELETE FROM clients WHERE id_client = :id");
			$this->db->bind(":id", $id_client);
			try {
				$this->db->execute();
				return true;
			} catch (Exception $e) {
				return false;
			}
		}

	}

 ?>