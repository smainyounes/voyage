<?php 

	/**
	 * settings class
	 */
	class view_settings 
	{
		private $user;
		private $contact;
		private $check;

		function __construct($msg)
		{
			$this->user = new controller_users();
			$this->check = $this->user->CheckAdmin();

			if ($this->check) {
				$control = new controller_contact();
				$this->contact = $control->GetInfos();
			}
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

				<div class="container p-4 my-5 shadow">
				      <nav >
				        <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
				          <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Home</a>
				          <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Password</a>
				          <?php if($this->check): ?>
				          	<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a>
				          <?php endif; ?>
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
				        <?php if($this->check): ?>
				        	<div class="tab-pane fade active pt-3" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
				        	  <h3 class="text-center">Contact Infos</h3>
				        	  <form class="text-center" method="POST">
				        	    <div class="form-group w-75 text-center mx-auto">
				        	    	<label>Email</label>
				        	      	<input type="email" class="form-control text-center" name="email" value="<?php echo($this->contact->email) ?>" required>
				        	      	<label>Phones</label>
				        	      	<input type="text" class="form-control text-center" name="phone" value="<?php echo($this->contact->phone) ?>" required>
				        	      	<label>Address</label>
				        	      	<textarea class="form-control" rows="3" name="address" required><?php echo $this->contact->address; ?></textarea>
				        	    </div>
				        	    <button class="btn btn-primary">Confirmer</button>
				        	  </form>
				        	</div>
				        <?php endif; ?>
				      </div>
				</div>
			

			<?php
		}


	}


 ?>