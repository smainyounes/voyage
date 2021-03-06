<?php 

	/**
	 * users
	 */
	class view_trips 
	{

		private $trips;
		private $user;
		private $check;

		function __construct()
		{
			$this->trips = new controller_trips();
			$this->user = new controller_users();
			if (isset($_SESSION['user'])) {
				$this->check = $this->user->CheckAdmin();
			}else{
				$this->check = false;
			}
			
		}

		/**
		 * components
		 */

		
		private function TripCard($data)
		{
			?>

			<div class="col-lg-4 col-sm-6 my-2">
			  <div class="card mx-auto h-100">
			  	<?php if($this->trips->Complet($data->id_trip)): ?>
			    <span class="notify-badge">Complet</span>
				<?php endif; ?>
			    <a href="<?php echo(PUBLIC_URL) ?>tripinfo/<?php echo($data->id_trip) ?>">
			      <img class="card-img-top" src="<?php echo(PUBLIC_URL.'img/'.$data->img) ?>" alt="Card image cap">
			    </a>
			    <div class="card-body">
			      <h5 class="card-title"><?php echo $data->nom; ?></h5>
			      <p class="card-text"><?php echo shortenText($data->infos) ?></p>
			      <?php if($data->prix > 0): ?>
			      <h5 class=""><?php echo $data->prix." DA"; ?></h5>
			  	  <?php endif; ?>
			  	  <?php if($this->check): ?>
			      <div class="float-right">
			      	<button class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter" data-id="<?php echo($data->id_trip) ?>">Delete</button>
			      	<a class="btn btn-warning" href="<?php echo(PUBLIC_URL) ?>edit/<?php echo($data->id_trip) ?>">Edit</a>
			      </div>
			  	  <?php endif; ?>
			    </div>
			    <div class="card-footer font-weight-bold text-center">
			        <?php echo "Du $data->date_aller à $data->date_retour"; ?>
			    </div>
			  </div>
			</div>

			<?php
		}

		public function LoadTrips()
		{
			new view_search("trip");
			?>
			<div class="row">
			<?php

			$all = $this->trips->GetAll();

			if ($all) {
				foreach ($all as $data) {
					$date = new DateTime($data->date_aller);
					$now = new DateTime();

					if($this->check || ($date >= $now && !$this->trips->Complet($data->id_trip))) {
						$this->TripCard($data);
					}
				}
			}else{
				$this->Nothing();
			}	

			?>
			</div>
			<?php if($this->check): ?>
			<!-- Modal -->
			<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalCenterTitle">Confirmation</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        are u sure u want to delete this trip?
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <form method="POST">
			        	<input type="number" name="trip" id="trip" hidden>
			        	<button class="btn btn-primary">Yes</button>
			        </form>
			      </div>
			    </div>
			  </div>
			</div>

			<script type="text/javascript">
				$('#exampleModalCenter').on('show.bs.modal', function (event) {
				  var button = $(event.relatedTarget) // Button that triggered the modal
				  var id = button.data('id') 
				  $('#trip').val(id);
				});
			</script>
			<?php endif; ?>
			<?php
		}

		public function Search($val)
		{
			?>
			<div class="h1 text-center font-weight-bold text-white">Result</div>
			<?php if($this->check): ?>

			<div class="container text-center my-4 px-0">
			   <a class="btn btn-primary btn-lg btn-block" href="<?php echo(PUBLIC_URL.'addtrip') ?>">Ajouter</a>
			</div>

			<?php endif; ?>
			
			<?php new view_search('trip', $val) ?>
			<div class="row">
			<?php

			$all = $this->trips->Search($val);

			if ($all) {
				foreach ($all as $data) {
					$date = new DateTime($data->date_aller);
					$now = new DateTime();

					if($this->check || ($date >= $now && !$this->trips->Complet($data->id_trip))) {
						$this->TripCard($data);
					}
				}
			}else{
				$this->Nothing();
			}	

			?>
			</div>
			<?php if($this->check): ?>
			<!-- Modal -->
			<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalCenterTitle">Confirmation</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        are u sure u want to delete this trip?
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <form method="POST">
			        	<input type="number" name="trip" id="trip" hidden>
			        	<button class="btn btn-primary">Yes</button>
			        </form>
			      </div>
			    </div>
			  </div>
			</div>

			<script type="text/javascript">
				$('#exampleModalCenter').on('show.bs.modal', function (event) {
				  var button = $(event.relatedTarget) // Button that triggered the modal
				  var id = button.data('id') 
				  $('#trip').val(id);
				});
			</script>
			<?php endif; ?>
			<?php
		}

		public function TripsHead($msg)
		{
			?>

			<div class="h1 text-center font-weight-bold text-white mt-2">Trips</div>
			<?php if($this->check): ?>

			<div class="container text-center my-4 px-0">
			   <a class="btn btn-primary btn-lg btn-block" href="<?php echo(PUBLIC_URL.'addtrip') ?>">Ajouter</a>
			</div>

			<?php endif; ?>

			<?php

			if (isset($msg)) {
				include '../backend/includes/alert.inc.php';
			}

		}

		public function TripInfoHead($id_trip, $msg = null)
		{

			$data = $this->trips->GetById($id_trip);

			?>

			<div class="h1 text-center font-weight-bold text-white mt-2">
				<?php echo $data->nom; ?>
			</div>
			<div class="row my-4">
			  <div class="col-md-7">
			    <img src="<?php echo(PUBLIC_URL.'img/'.$data->img) ?>" class="img-fluid">
			  </div>
			  <div class="col-md-5 text-white">
			   
			   <div class="row">
			     <div class="col font-weight-bold">
			     	<?php echo "Date Aller: $data->date_aller"; ?>
			     </div>
			     <div class="col font-weight-bold">
			     	<?php echo "Date Retour: $data->date_retour"; ?>
			     </div>
			   </div>
			   <p>
			   	<?php echo $data->infos; ?>
			   </p>
			   <?php if($data->prix > 0): ?>
			   <div class="font-weight-bold">
			   	<?php echo "Prix: $data->prix DA"; ?>
			   </div>
			   <?php endif; ?>
			  </div>
			</div>

			<?php
		}

		public function AddForm($msg)
		{
			?>

			<div class="h1 text-center font-weight-bold text-white my-4">Add new Trip</div>
			
			<?php 
				if (isset($msg)) {
					include '../backend/includes/alert.inc.php';
				}
			 ?>

			<form class="border p-4 font-weight-bold text-white" method="POST" enctype="multipart/form-data">
			  <div class="form-group">
			    <label for="nom">Trip Name</label>
			    <input type="text" class="form-control" id="nom" placeholder="Nom" name="nom" required>
			  </div>
			  <div class="row">
			    <div class="col">
			      <div class="form-group">
			        <label for="aller">date aller</label>
			        <input type="date" min="<?php echo date('Y-m-d'); ?>" class="form-control" id="aller" name="aller" required>
			      </div>
			    </div>
			    <div class="col">
			      <div class="form-group">
			        <label for="retout">date retour</label>
			        <input type="date" min="<?php echo date('Y-m-d'); ?>" class="form-control" id="retout" name="retour" required>
			      </div>
			    </div>
			  </div>
			  <div class="row">
			    <div class="col">
			      <div class="form-group">
			        <label for="prix">Prix</label>
			        <input type="number" class="form-control" id="prix" name="prix">
			      </div>
			    </div>
			    <div class="col">
			      <div class="form-group">
			        <label for="max">Nombre max</label>
			        <input type="number" class="form-control" id="max" name="nbr" required>
			      </div>
			    </div>
			  </div>
			  <div class="form-group custom-file">
			  <input type="file" class="custom-file-input" id="customFile" name="pic" accept="image/*" required>
			  <label class="custom-file-label" for="customFile">Image voyage</label>
			</div>


			  <div class="form-group">
			    <label for="description">Description</label>
			    <textarea class="form-control" id="description" rows="3" name="infos" required></textarea>
			  </div>
			  <div class="form-group text-center">
			    <button class="btn btn-primary">Submit</button>
			  </div>
			</form>

			<?php
		}

		public function EditForm($id_trip, $msg)
		{
			$data = $this->trips->GetById($id_trip);

			?>

			<div class="h1 text-center font-weight-bold text-white my-4">Edit Trip</div>
			
			<?php 
				if (isset($msg)) {
					include '../backend/includes/alert.inc.php';
				}
			 ?>

			<form class="border p-4 font-weight-bold text-white" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-8">
						<img src="<?php echo(PUBLIC_URL.'img/'.$data->img) ?>" class="img-fluid">
					</div>
					<div class="col-md-4">
						<div class="form-group">
						  <label for="nom">Trip Name</label>
						  <input type="text" class="form-control" id="nom" placeholder="Nom" name="nom" value="<?php echo($data->nom) ?>" required>
						</div>

						<div class="row">
						  <div class="col">
						    <div class="form-group">
						      <label for="aller">date aller</label>
						      <input type="date" min="<?php echo date('Y-m-d'); ?>" class="form-control" id="aller" name="aller" value="<?php echo($data->date_aller) ?>" required>
						    </div>
						  </div>
						  <div class="col">
						    <div class="form-group">
						      <label for="retout">date retour</label>
						      <input type="date" min="<?php echo date('Y-m-d'); ?>" class="form-control" id="retout" name="retour" value="<?php echo($data->date_retour) ?>" required>
						    </div>
						  </div>
						</div>

					</div>
				</div>

			  <div class="row">
			    <div class="col">
			      <div class="form-group">
			        <label for="prix">Prix</label>
			        <input type="number" class="form-control" id="prix" name="prix" value="<?php if($data->prix > 0) echo($data->prix); ?>">
			      </div>
			    </div>
			    <div class="col">
			      <div class="form-group">
			        <label for="max">Nombre max</label>
			        <input type="number" class="form-control" id="max" name="nbr" required value="<?php echo($data->nbrplace) ?>">
			      </div>
			    </div>
			  </div>

			  <div class="form-group custom-file">
			  <input type="file" class="custom-file-input" id="customFile" name="pic" accept="image/*">
			  <label class="custom-file-label" for="customFile">Image voyage</label>
			  </div>


			  <div class="form-group">
			    <label for="description">Description</label>
			    <textarea class="form-control" id="description" rows="3" name="infos" required><?php echo $data->infos; ?></textarea>
			  </div>
			  <div class="form-group text-center">
			    <button class="btn btn-primary">Submit</button>
			  </div>
			</form>

			<?php
		}

		private function Nothing()
		{
			?>

			<div class="h1 font-weight-bold text-white text-center mt-5 mx-auto">No trips Found</div>

			<?php
		}

	}

 ?>