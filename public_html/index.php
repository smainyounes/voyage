<?php 


	include '../backend/includes/autoloader.inc.php';

	$page = "trips";
	
	if (isset($_GET['cmd'])) {
		$url = explode('/', $_GET['cmd']);
		$page = $url[0];
	}

	if (!isset($_SESSION['user'])) {
		$page = "login";
	}

	$test = null;

	switch ($page) {
		case 'login':
			include '../backend/includes/header.inc.php';
			new view_login;
			break;

		case 'settings':
			if (!isset($_SESSION['user'])) {
				$page = "login";
			}

			$test = null;

			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			    $user = new controller_users();
			    if (isset($_POST['username'])) {
			    	$test = $user->UpdateUsername();
			    }

			    if (isset($_POST['old'])) {
			    	$test = $user->UpdatePassword();
			    }
			}

			include '../backend/includes/header.inc.php';

			new view_settings($test);
			break;

		case 'trips':
			# code...
			break;

		case 'addtrip':
			# code...
			break;

		case 'users':
			# code...
			break;

		case 'adduser':
			# code...
			break;
		
		default:
			include '../backend/includes/header.inc.php';
			new view_notfound();

			break;
	}

	include '../backend/includes/footer.inc.php';


 ?>