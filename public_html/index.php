<?php 


	include '../backend/includes/autoloader.inc.php';

	$page = "home";
	
	if (isset($_GET['cmd'])) {
		$url = explode('/', $_GET['cmd']);
		$page = $url[0];
	}

	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		if (isset($_GET['search'])) {
			header("Location: ".PUBLIC_URL."search/".urlencode($_GET['search']));
		}
		
	}

	$test = null;

	if (!isset($_SESSION['user'])) {
		switch ($page) {
			case 'home':
				include '../backend/includes/header.inc.php';
				new view_search($page);

				break;

			case 'trips':
				include '../backend/includes/header.inc.php';
				$trips = new view_trips();

				$trips->TripsHead($test);
				$trips->LoadTrips();
				break;

			case 'login':

				if ($_SERVER['REQUEST_METHOD'] === 'POST') {
					$control = new controller_users();
					if (isset($_POST['token']) && $_POST['token'] === $_SESSION['token'] && $control->Login()) {
						unset($_SESSION['token']);
						header("Location: ".PUBLIC_URL);
					}
				}
				
				$_SESSION['token'] = token();

				include '../backend/includes/header.inc.php';
				new view_login();
				break;

			case 'tripinfo':
				$control = new controller_trips();

				if (!isset($url[1]) || $url[1] == '' || !$control->Exists($url[1])) {
					header("Location: ".PUBLIC_URL."error");
				}

				include '../backend/includes/header.inc.php';
				$trip = new view_trips();
				$trip->TripInfoHead($url[1]);

				$control = new view_contact();
				$control->ContactInfo();

				break;
			
			case 'contact':
				include '../backend/includes/header.inc.php';

				$view = new view_contact();
				$view->ContactInfo();
				break;

			case 'search':
				include '../backend/includes/header.inc.php';
				if (!isset($url[1])) {
					$url[1] = '';
				}
				
				$view = new view_trips();
				$view->Search(urldecode($url[1]));

				break;

			default:
				include '../backend/includes/header.inc.php';
				new view_notfound();

				break;
		}
	}else{
		switch ($page) {
			case 'login':

				if ($_SERVER['REQUEST_METHOD'] === 'POST') {
					$control = new controller_users();
					if ($control->Login()) {
						header("Location: ".PUBLIC_URL);
					}
				}

				include '../backend/includes/header.inc.php';
				new view_login();
				break;

			case 'settings':
				if (!isset($_SESSION['user'])) {
					$page = "login";
				}


				if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				    $user = new controller_users();
				    if (isset($_POST['username'])) {
				    	$test = $user->UpdateUsername();
				    }

				    if (isset($_POST['old'])) {
				    	$test = $user->UpdatePassword();
				    }

				    if (isset($_POST['email'])) {
				    	$control = new controller_contact();
				    	$test = $control->UpdateInfos();
				    }
				}

				include '../backend/includes/header.inc.php';

				new view_settings($test);
				break;
			
			case 'home':
			case 'trips':
				$control = new controller_users();

				if ($_SERVER['REQUEST_METHOD'] === 'POST' && $control->CheckAdmin()) {
					if (isset($_POST['trip'])) {
						$control = new controller_trips();

						if (!$control->Exists($_POST['trip'])) {
							header("Location: ".PUBLIC_URL."error");
						}

						$test = $control->Delete($_POST['trip']);
					}
				}

				include '../backend/includes/header.inc.php';
				$trips = new view_trips();

				$trips->TripsHead($test);
				$trips->LoadTrips();

				break;

			case 'addtrip':
				include '../backend/includes/header.inc.php';


				if ($_SERVER['REQUEST_METHOD'] === 'POST') {
					if (isset($_POST['nom'])) {
						$control = new controller_trips();
						$test = $control->AddTrip();
					}
				}

				$trips = new view_trips();
				$trips->AddForm($test);

				break;

			case 'tripinfo':
				$control = new controller_trips();

				if (!isset($url[1]) || $url[1] == '' || !$control->Exists($url[1])) {
					header("Location: ".PUBLIC_URL."error");
				}

				if ($_SERVER['REQUEST_METHOD'] === 'POST') {
					if (isset($_POST['client'])) {
						$control = new controller_users();
						if ($control->CheckAdmin()) {
							$control = new controller_clients();
							$test = $control->Delete($_POST['client']);
						}else{
							$control = new controller_clients();
							if ($control->Owner($_POST['client'])) {
								$test = $control->Delete($_POST['client']);
							}
						}
						
					}
				}

				include '../backend/includes/header.inc.php';
				$trip = new view_trips();
				$trip->TripInfoHead($url[1]);

				$view = new view_clients();
				$view->LoadClients($url[1]);
				break;
			
			case 'edit':
				$control = new controller_users();
				if (!$control->CheckAdmin()){
					header("Location: ".PUBLIC_URL."error");
				}

				$control = new controller_trips();
				if (!isset($url[1]) || $url[1] == '' || !$control->Exists($url[1])) {
					header("Location: ".PUBLIC_URL."error");
				}

				if ($_SERVER['REQUEST_METHOD'] === 'POST'){
					$test = $control->Edit($url[1]);
				}

				include '../backend/includes/header.inc.php';
				$view = new view_trips();
				$view->EditForm($url[1], $test);

				break;

			case 'addclient':

				$control = new controller_trips();

				if (!isset($url[1]) || $url[1] == '' || !$control->Exists($url[1])) {
					header("Location: ".PUBLIC_URL."error");
				}

				if ($control->Complet($url[1])) {
					header("Location: ".PUBLIC_URL."trip/".$url[1]);
				}

				if ($_SERVER['REQUEST_METHOD'] === 'POST') {
					$control = new controller_clients();
					$test = $control->AddClient($url[1]);
				}
				
				include '../backend/includes/header.inc.php';
				$view = new view_clients($url[1]);
				$view->AddForm($test);
				
				break;

			case 'users':
				$control = new controller_users();
				if ($control->CheckAdmin()) {

					if ($_SERVER['REQUEST_METHOD'] === 'POST') {
						if (isset($_POST['user'])) {
							$test = $control->Delete($_POST['user']);
						}
					}

					include '../backend/includes/header.inc.php';
					$view = new view_users();
					$view->LoadUsers();
				}else{
					header("Location: ".PUBLIC_URL."error");
				}
				break;

			case 'adduser':
				$control = new controller_users();
				if ($control->CheckAdmin()) {

					if ($_SERVER['REQUEST_METHOD'] === 'POST') {
						if (isset($_POST['username'])) {
							$test = $control->AddUser();
						}
					}

					include '../backend/includes/header.inc.php';
					$view = new view_users();
					$view->AddForm($test);
				}else{
					header("Location: ".PUBLIC_URL."error");
				}
				break;

			case 'search':
				include '../backend/includes/header.inc.php';
				if (!isset($url[1])) {
					$url[1] = '';
				}
				
				$view = new view_trips();
				$view->Search(urldecode($url[1]));
				
				break;

			case 'dc':
				$user = new controller_users();
				$user->Logout();
				header("Location: ".PUBLIC_URL);
				break;
				
			default:
				include '../backend/includes/header.inc.php';
				new view_notfound();

				break;
		}
	}




	include '../backend/includes/footer.inc.php';


 ?>