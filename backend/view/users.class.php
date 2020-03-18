<?php 

	/**
	 * 
	 */
	class view_users
	{
		
		private $users;

		function __construct()
		{
			$this->users = new controller_users();
		}

		public function LoadUsers()
		{

			$data = $this->users->GetAll();

			?>

			<div class="h1 text-center mt-2 font-weight-bold text-white">Users</div>
			<div class="container text-center my-4 px-0">
			  <a class="btn btn-primary btn-lg btn-block" href="<?php echo(PUBLIC_URL."adduser") ?>">Ajouter</a>
			</div>
			<table class="table table-hover table-bordered bg-light">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Nom</th>
			      <th scope="col">Address</th>
			      <th scope="col">Type</th>
			      <th scope="col">Action</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php foreach($data as $user): ?>
			    <tr>
			      <th scope="row"><?php echo $user->id_user; ?></th>
			      <td><?php echo $user->username; ?></td>
			      <td><?php echo $user->address; ?></td>
			      <td><?php echo $user->type; ?></td>
			      <?php if($user->id_user != $_SESSION['user']) :?>
			      <td><button class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter" data-id="<?php echo($user->id_user) ?>">Delete</button></td>
			  	  <?php endif; ?>
			    </tr>
			    <?php endforeach; ?>
			  </tbody>
			</table>

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
			        are u sure u want to delete user?
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <form method="POST">
			        	<input type="number" name="user" id="user" hidden>
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
				  $('#user').val(id);
				});
			</script>

			<?php
		}

		public function AddForm($msg)
		{
			?>

			<div class="h1 text-center my-4 font-weight-bold text-white">Add new user</div>
			<?php if(isset($msg)): ?>
				<?php include '../backend/includes/alert.inc.php'; ?>
			<?php endif; ?>
			<form class="border p-4 font-weight-bold text-white" method="POST">
				<div class="row">
					<div class="col">
						<div class="form-group">
						  <label for="username">username</label>
						  <input type="text" class="form-control" id="username" placeholder="username" name="username" required>
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							<label for="type">Type</label>
							<select class="form-control" name="type" id="type">
								<option value="user">User</option>
								<option value="admin">Admin</option>
							</select>
						</div>
						
					</div>
				</div>
			  

			  <div class="form-group">
			    <label for="address">Adress</label>
			    <input type="text" class="form-control" id="address" placeholder="address" name="address" required>
			  </div>

			  <div class="row">
			    <div class="col">
			      <div class="form-group">
			        <label for="pass1">Password</label>
			        <input type="password" class="form-control" id="pass1" name="pass1" required>
			      </div>
			    </div>
			    <div class="col">
			      <div class="form-group">
			        <label for="pass2">Repeat password</label>
			        <input type="password" class="form-control" id="pass2" name="pass2" required>
			      </div>
			    </div>
			  </div>

			  <div class="form-group text-center">
			    <button class="btn btn-primary">Submit</button>
			  </div>

			</form>

			<?php
		}

	}

 ?>