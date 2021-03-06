<?php 

	/**
	 * users
	 */
	class controller_trips
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
			$this->db->query("SELECT * FROM trips ORDER BY date_aller ASC");
			return $this->db->resultSet();
		}
		
		public function GetById($id_trip)
		{
			$this->db->query("SELECT * FROM trips WHERE id_trip = :id");
			$this->db->bind(":id", $id_trip);
			return $this->db->single();
		}

		public function Complet($id_trip)
		{
			$res = $this->Stat($id_trip);

			return ($res->max <= $res->nbr);
		}

		public function Stat($id_trip)
		{
			$this->db->query("SELECT nbrplace AS max, COUNT(clients.id_client) AS nbr FROM trips, clients WHERE trips.id_trip = :id AND clients.id_trip = :id");
			$this->db->bind(":id", strip_tags($id_trip));
			return $this->db->single();

		}

		public function Exists($id_trip)
		{
			$this->db->query("SELECT id_trip FROM trips WHERE id_trip = :id");
			$this->db->bind(":id", strip_tags($id_trip));
			$res = $this->db->single();

			if ($res) {
				return true;
			}else{
				return false;
			}

		}

		public function Search($val)
		{
			if ($val === '') {
				return $this->GetAll();
			}

			$this->db->query("SELECT * FROM trips WHERE nom LIKE :val OR infos LIKE :val ORDER BY date_aller ASC");
			$this->db->bind(":val", "%{$val}%");
			return $this->db->resultSet();
		}


		/**
		 * Setters
		 */

		public function AddTrip()
		{

			if (empty($_POST['prix'])) {
				$_POST['prix'] = -1;
			}

			// verify all inputs are not empty
			foreach($_POST as $key => $value){
		    	if(empty(trim($value))){
		        	return false;
		    	}
			}
			
			if (!isset($_FILES['pic'])) {
				return false;
			}

			$img = UploadPic($_FILES['pic']);
			$sql = "INSERT INTO trips(`nom`, `prix`, `date_aller`, `date_retour`, `nbrplace`, `infos`, `img`) 
				VALUES(:nom, :prix, :aller, :retour, :nbr, :info, :img)";
			$this->db->query($sql);
			$this->db->bind(":nom", strip_tags($_POST['nom']));
			$this->db->bind(":prix", strip_tags($_POST['prix']));
			$this->db->bind(":aller", strip_tags($_POST['aller']));
			$this->db->bind(":retour", strip_tags($_POST['retour']));
			$this->db->bind(":nbr", strip_tags($_POST['nbr']));
			$this->db->bind(":info", strip_tags($_POST['infos']));
			$this->db->bind(":img", $img);

			try {
				$this->db->execute();
				return true;
			} catch (Exception $e) {
				return false;
			}

		}

		public function Delete($id_trip)
		{
			// get pic link
			$this->db->query("SELECT img FROM trips WHERE id_trip = :id");
			$this->db->bind(":id", $id_trip);
			$res = $this->db->single();

			$check = true;
			// delete pic
			if ($res) {
				$check = DeletePic("img/$res->img");
			}

			if ($check) {
				// delete infos
				$this->db->query("DELETE FROM trips WHERE id_trip = :id");
				$this->db->bind(":id", $id_trip);
				try {
					$this->db->execute();
					return true;
				} catch (Exception $e) {
					return false;
				}
			}
			
			return false;

		}


		public function Edit($id_trip)
		{
			if (empty($_POST['prix'])) {
				$_POST['prix'] = -1;
			}

			// verify all inputs are not empty
			foreach($_POST as $key => $value){
		    	if(empty(trim($value))){
		        	return false;
		    	}
			}

			$conc = "";

			if ($_FILES['pic']['name'] != "") {
				// get old pic link
				$this->db->query("SELECT img FROM trips WHERE id_trip = :id");
				$this->db->bind(":id", $id_trip);
				$res = $this->db->single();

				// delete old pic
				DeletePic("img/$res->img");
				$img = UploadPic($_FILES['pic']);
				$conc = ", img = '".$img."'";
			}

			$this->db->query("UPDATE trips SET nom = :nom, prix = :prix, date_aller = :aller, date_retour = :retour, nbrplace = :nbr, infos = :infos $conc WHERE id_trip = :id");

			$this->db->bind(":nom", strip_tags($_POST['nom']));
			$this->db->bind(":prix", strip_tags($_POST['prix']));
			$this->db->bind(":aller", strip_tags($_POST['aller']));
			$this->db->bind(":retour", strip_tags($_POST['retour']));
			$this->db->bind(":nbr", strip_tags($_POST['nbr']));
			$this->db->bind(":infos", strip_tags($_POST['infos']));
			$this->db->bind(":id", $id_trip);

			try {
				$this->db->execute();
				return true;
			} catch (Exception $e) {
				DeletePic("img/$img");
				return false;
			}

		}

	}

 ?>