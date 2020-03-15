<?php 

	/**
	 * users
	 */
	class view_clients
	{

		private $clients;
		private $users;
		private $trips;

		function __construct($id_trip)
		{
			$this->clients = new controller_clients();
			$this->users = new controller_users();
			$this->trips = new controller_trips();

			$this->LoadClients($id_trip);
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
			   <a class="btn btn-primary btn-lg btn-block" href="<?php echo(PUBLIC_URL.'addclient') ?>">Ajouter</a>
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
			      <th scope="row">1</th>
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
			      <td><button class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter" data-whatever="<?php echo($client->id_client) ?>">Delete</button></td>
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
			        <button type="button" class="btn btn-primary">Yes</button>
			      </div>
			    </div>
			  </div>
			</div>
			
			<?php
		}

	}

 ?>