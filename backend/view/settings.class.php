<?php 

	/**
	 * settings class
	 */
	class view_settings 
	{
		private $user;	


		function __construct($msg)
		{
			$this->user = new controller_users();
			$this->Settings($msg);
		}


		public function Settings($msg)
		{
			// get username
			$data = $this->user->GetInfo();

			if (isset($msg)) {
				include '../backend/includes/alert.inc.php';
			}

			?>

			<div class="container" id="page-content">
				<div class="container p-4 my-5 shadow">
				      <nav >
				        <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
				          <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Home</a>
				          <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a>
				        </div>
				      </nav>
				      <div class="tab-content" id="nav-tabContent">
				        <div class="tab-pane fade show active pt-3" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
				          <h3 class="text-center">Changer Nom d'utilisateur</h3>
				          <form class="text-center" method="POST">
				            <div class="form-group w-75 text-center mx-auto">
				              <input type="text" class="form-control text-center" name="username" required placeholder="<?php echo($data->username) ?>">
				            </div>
				            <button class="btn btn-primary">Confirmer</button>
				          </form>
				        </div>
				        <div class="tab-pane fade pt-3" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
				          <form class="text-center" method="POST">
				            <h3 class="text-center">Changer Mot de passe</h3>
				            <div class="form-group w-75 text-center mx-auto">
				              <input type="password" class="form-control text-center my-2" placeholder="Old Password" name="old" required>
				              <input type="password" class="form-control text-center my-2" placeholder="New Password" name="pass1" required>
				              <input type="password" class="form-control text-center my-2" placeholder="Confirm Password" name="pass2" required>

				            </div>
				            <button class="btn btn-primary">Confirmer</button>
				          </form>
				        </div>
				      </div>
				</div>
			</div>
			

			<?php
		}


	}


 ?>