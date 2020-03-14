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
			$this->db->query("SELECT * FROM clients WHERE id_trip = :id");
			$this->db->bind(":id", $id_trip);

			return $this->db->resultSet();
		}

		public function GetByUser($id_user)
		{
			$this->db->query("SELECT * FROM clients WHERE id_user = :id");
			$this->db->bind(":id", $id_user);

			return $this->db->resultSet();
		}

		public function GetByTripUser($id_trip, $id_user)
		{
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