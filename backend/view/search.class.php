<?php 

	/**
	 * search
	 */
	class view_search
	{
		
		function __construct($page, $val = null)
		{
			$this->SearchDiv($page, $val);
		}


		public function SearchDiv($page, $val)
		{
			?>
			<?php if($page === 'home'): ?>
			<div class="d-flex h-100">
			    <div class="justify-content-center align-self-center w-100">
			      <div class="container-fluid pb-4">
			        <div class="container text-center" style="max-width: 500px">
			          <img src="<?php echo(PUBLIC_URL.'img/boxdzlogo.png') ?>" class="img-fluid">
			        </div>
			        <form method="GET" action="search/">			        	
				        <div class="input-group input-group-lg mx-auto w-75" style="max-width: 900px;">
				          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" placeholder="Exemple: Taghit" name="search">
				          <div class="input-group-append">
				            <span class="input-group-text fas fa-search" id="inputGroup-sizing-lg"></span>
				          </div>
				        </div>
				        <div class="text-center my-3">
				          <button class="btn btn-primary btn-lg px-4">Search
				            <span class="fas fa-search"></span>
				          </button>
				        </div>
			        </form>
			      </div>
			    </div>
			</div>
			<?php else: ?>
			    <div class="justify-content-center align-self-center w-100">
			      <div class="container-fluid py-4">
			        <form method="GET" action="search/">			        	
				        <div class="input-group input-group-lg mx-auto w-75" style="max-width: 900px;">
				          <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" placeholder="Exemple: Taghit" name="search" value="<?php if(isset($val)) echo($val); ?>">
				          <div class="input-group-append">
				            <span class="input-group-text fas fa-search" id="inputGroup-sizing-lg"></span>
				          </div>
				        </div>
				        <div class="text-center my-3">
				          <button class="btn btn-primary btn-lg px-4">Search
				            <span class="fas fa-search"></span>
				          </button>
				        </div>
			        </form>
			      </div>
			    </div>
			<?php endif; ?>
			<?php
		}

	}


 ?>