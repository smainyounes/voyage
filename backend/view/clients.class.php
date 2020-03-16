<?php 

	/**
	 * users
	 */
	class view_clients
	{

		private $clients;
		private $users;
		private $trips;

		function __construct()
		{
			$this->clients = new controller_clients();
			$this->users = new controller_users();
			$this->trips = new controller_trips();

			//$this->LoadClients($id_trip);
		}

		public function LoadClients($id_trip)
		{

			$stat = $this->trips->Stat($id_trip);
			$admin = $this->users->CheckAdmin();
			if ($admin) {
				$data = $this->clients->GetByTrip($id_trip);
			}else{
				$data = $this->clients->GetByTripUser($id_trip);
			}
			

			?>
			<div class="container text-center my-4 px-0">
			   <div class="h1 text-center">Clients</div>
				<?php if(!$this->trips->Complet($id_trip)): ?>
			   <a class="btn btn-primary btn-lg btn-block" href="<?php echo(PUBLIC_URL.'addclient/'.$id_trip) ?>">Ajouter</a>
				<?php endif; ?>
			</div>
			<div class="text-muted">
				<?php echo "Places $stat->nbr / $stat->max"; ?>
			</div>
			<?php if($data): ?>
			<table class="table table-hover table-bordered">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Full Name</th>
			      <th scope="col">Tel</th>
			      <th scope="col">Other Infos</th>
			      <?php if($admin): ?>
			      <th scope="col">User</th>
			      <?php endif; ?>
			      <th scope="col">Action</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php foreach($data as $client): ?>
			    <tr>
			      <th scope="row">
			      	<?php echo "$client->id_client"; ?>
			      </th>
			      <td>
			      	<?php echo "$client->nom $client->prenom"; ?>
			      </td>
			      <td>
			      	<?php echo "$client->phone"; ?>
			      </td>
			      <td>
			      	<?php echo "$client->infos"; ?>
			      </td>
			      <?php if($admin): ?>
			      	<td><?php echo "$client->username"; ?></td>
			      <?php endif; ?>
			      <td><button class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter" data-id="<?php echo($client->id_client) ?>">Delete</button></td>
			    </tr>
			    <?php endforeach; ?>
			  </tbody>
			</table>
			<?php endif; ?>

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
			        are u sure u want to delete client?
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <form method="POST">
			        	<input type="number" name="client" id="client" hidden>
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
				  $('#client').val(id);
				});
			</script>
			
			<?php
		}

		public function AddForm($msg)
		{
			?>

			<div class="h1 text-center my-4">Add Clients</div>

			<?php if(isset($msg)): ?>
				<?php include '../backend/includes/alert.inc.php'; ?>
			<?php endif; ?>

			<form class="border p-4" method="POST">
			  <div class="row">
			    <div class="col">
			      <div class="form-group">
			        <label for="nom">Nom</label>
			        <input type="text" class="form-control" id="nom" placeholder="Nom" name="nom" required>
			      </div>
			    </div>
			    <div class="col">
			      <div class="form-group">
			        <label for="prenom">Prenom</label>
			        <input type="text" class="form-control" id="prenom" placeholder="Prenom" name="prenom" required>
			      </div>
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="Tel">Phone</label>
			    <input type="text" class="form-control" id="phone" placeholder="Phone number" name="phone" required>
			  </div>


			  <div class="form-group">
			    <label for="infos">Other infos</label>
			    <textarea class="form-control" name="infos" id="infos" rows="3"></textarea>
			  </div>
			  <div class="form-group text-center">
			    <button class="btn btn-primary">Submit</button>
			  </div>
			</form>

			<?php
		}


	}

 ?>