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

		public function GetInfos()
		{
			$this->db->query("SELECT * FROM contact");
			return $this->db->single();
		}

	}

 ?>