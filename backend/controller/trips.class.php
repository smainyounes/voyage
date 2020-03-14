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
			$this->db->query("SELECT * FROM trips");
			return $this->db->resultSet();
		}
		
		public function GetById($id_trip)
		{
			$this->db->query("SELECT * FROM trips WHERE id_trip = :id");
			$this->db->bind(":id", $id_trip);
			return $this->db->single();
		}

		/**
		 * Setters
		 */

		public function AddTrip()
		{
			// verify all inputs are not empty
			foreach($_POST as $key => $value){
		    	if(empty(trim($value))){
		        	return false;
		    	}
			}

			$img = UploadPic($_FILES['pic']);
			$sql = "INSERT INTO trips(`nom`, `prix`, `date-aller`, `date-retour`, `nbrplace`, `infos`, `img`) 
				VALUES(:nom, :prix, :aller, :retour, :nbr, :info, $img)";
			$this->db->query($sql);
			$this->db->bind(":nom", strip_tags($_POST['nom']));
			$this->db->bind(":prix", strip_tags($_POST['prix']));
			$this->db->bind(":aller", strip_tags($_POST['aller']));
			$this->db->bind(":retour", strip_tags($_POST['retour']));
			$this->db->bind(":nbr", strip_tags($_POST['nbr']));
			$this->db->bind(":info", strip_tags($_POST['infos']));

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


	}

 ?>