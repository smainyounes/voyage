<?php if($msg): ?>

	<div class="container mt-2">
		<div class="alert alert-success alert-dismissible fade show" role="alert">
		  <strong>Holy guacamole!</strong> You should check in on some of those fields below.
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
	</div>

<?php else: ?>

	<div class="container mt-2">
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
		  <strong>Holy guacamole!</strong> You should check in on some of those fields below.
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
	</div>

<?php endif; ?>