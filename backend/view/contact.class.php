<?php 

	/**
	 * 
	 */
	class view_contact
	{
		
		private $contact;

		function __construct()
		{
			$this->contact = new controller_contact();
		}


		public function ContactInfo()
		{
			$data = $this->contact->GetInfos();

			?>

			<h1 class="text-center font-weight-bold text-white">Contactez-Nous</h1>
					<div class="row my-2 py-4">
						<div class="col-md-6">
							<div class="h2 text-center font-weight-bold text-white">Map</div>
                    		<iframe width="100%" height="80%" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12829.021188116936!2d2.8610017!3d36.499699!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x366fff7331a6cabc!2sFirmwareDZ!5e0!3m2!1sfr!2sdz!4v1575897518342!5m2!1sfr!2sdz" style="border:0;" allowfullscreen=""></iframe>
						</div>

						<div class="col-md-6 pt-5 mt-5 font-weight-bold text-white">
							<table class="mb-5" width="100%">
							  <tr>
							    <td align="center" rowspan="3" valign="top" width="20%"><i class="fa fa-paper-plane fa-2x text-primary"></i></td>
							    <td class="h2 pb-2">Nos Contact</td>
							  </tr>
							  <tr>
							    <td>Email: <?php echo $data->email; ?></td>
							  </tr>
							  <tr>
							    <td>Telephone: <?php echo $data->phone; ?></td>
							  </tr>
							</table>
							<table class="mb-5" width="100%">
							  <tr>
							    <td align="center" rowspan="3" valign="top" width="20%"><i class="fa fa-map-marker-alt fa-2x text-primary"></i></td>
							    <td class="h2 pb-2">Address</td>
							  </tr>
							  <tr>
							    <td><?php echo $data->address; ?></td>
							  </tr>
							</table>
						</div>
					</div>

			<?php
		}


	}

 ?>