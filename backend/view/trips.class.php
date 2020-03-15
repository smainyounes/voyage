<?php 

	/**
	 * users
	 */
	class view_trips 
	{

		private $trips;
		private $user;

		function __construct()
		{
			$this->trips = new controller_trips();
			$this->user = new controller_users();
		}

		/**
		 * components
		 */

		
		private function TripCard($data)
		{
			?>

			<div class="col-lg-4 col-md-6 my-2">
			  <div class="card mx-auto h-100">
			    <span class="notify-badge">Complet</span>
			    <a href="<?php echo(PUBLIC_URL) ?>tripinfo/<?php echo($data->id_trip) ?>">
			      <img class="card-img-top" src="<?php echo(PUBLIC_URL.'img/'.$data->img) ?>" alt="Card image cap">
			    </a>
			    <div class="card-body">
			      <h5 class="card-title"><?php echo $data->nom; ?></h5>
			      <p class="card-text"><?php echo shortenText($data->infos) ?></p>
			      <h5 class=""><?php echo $data->prix; ?></h5>
			    </div>
			    <div class="card-footer font-weight-bold text-center">
			        <?php echo "du $data->date_aller à $data->date_retour"; ?>
			    </div>
			  </div>
			</div>

			<?php
		}

		public function LoadTrips()
		{
			?>
			<div class="row"></div>
			<?php

			$all = $this->trips->GetAll();

			if ($all) {
				foreach ($all as $data) {
					$this->TripCard($data);
				}
			}else{
				$this->Nothing();
			}			

			?>
			</div>
			<?php
		}

		public function TripsHead()
		{
			?>

			<div class="h1 text-center mt-2">Trips</div>
			<?php if($this->user->CheckAdmin()): ?>

			<div class="container text-center my-4 px-0">
			   <a class="btn btn-primary btn-lg btn-block" href="<?php echo(PUBLIC_URL.'addtrip') ?>">Ajouter</a>
			</div>

			<?php endif; ?>

			<?php
		}

		public function TripInfoHead($msg = null)
		{
			# code...
		}

		private function Nothing()
		{
			?>

			<div class="h1 text-center mt-5">No trips Found</div>

			<?php
		}

	}

 ?>