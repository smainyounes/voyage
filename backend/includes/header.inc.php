<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo(PUBLIC_URL) ?>vendor/bootstrap/css/bootstrap.min.css">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

    <!-- custom css -->
    <link rel="stylesheet" href="<?php echo(PUBLIC_URL) ?>css/custom.css">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo(PUBLIC_URL) ?>vendor/jquery/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="<?php echo(PUBLIC_URL) ?>vendor/bootstrap/js/bootstrap.min.js"></script>

    <title>BoxDZ | Voyage</title>
  </head>
  <body class="d-flex flex-column bg-light">
    <?php if(isset($_SESSION['user'])): ?>
      <?php 
        $control = new controller_users();
        $check = $control->CheckAdmin();
       ?>
      <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow">
        <a class="navbar-brand" href="<?php echo(PUBLIC_URL) ?>">Admin</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo(PUBLIC_URL) ?>">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo(PUBLIC_URL) ?>trips">Trips</a>
            </li>
            <?php if($check): ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo(PUBLIC_URL) ?>users">Users</a>
            </li>
            <?php endif; ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo(PUBLIC_URL) ?>settings">Settings</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-secondary" href="<?php echo(PUBLIC_URL) ?>dc">Disconnect</a>
            </li>
          </ul>
        </div>
      </nav>
    <?php else: ?>
      
      <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow">
        <a class="navbar-brand" href="<?php echo(PUBLIC_URL) ?>">
          <img src="<?php echo(PUBLIC_URL.'img/boxdzlogo.png') ?>" class="img-fluid" width="60px">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo(PUBLIC_URL) ?>">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo(PUBLIC_URL) ?>trips">Trips</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo(PUBLIC_URL) ?>contact">Contact</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-secondary" href="<?php echo(PUBLIC_URL) ?>login">Login</a>
            </li>
          </ul>
        </div>
      </nav>
    <?php endif; ?>
    <div class="container bg-soft-dark" id="page-content">
    