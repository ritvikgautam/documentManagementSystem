<?php
  session_start();
  if(!isset($_SESSION["login"]))
  {
    header("Location: index.php");
  }
?>
<html>
	<head>
		<meta charset="utf-8">
      	<meta http-equiv="X-UA-Compatible" content="IE=edge">
      	<meta name="viewport" content="width=device-width, initial-scale=1">
      
      	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">  

      
      	<link href="justified-nav.css" rel="stylesheet"> 
      	<link href="signin.css" rel="stylesheet">

	    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    	<title> Admin Portal </title>
	</head>
	<body>
		<div class="container">

      <!-- The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->
      <div class="masthead">
        <h3 class="text-muted">BCP Associates</h3>
        <nav>
          <ul class="nav nav-justified">
            <li class = "active"><a href="index.php">Home</a></li>
            <li><a href="scantest.php">Scan & Upload</a></li>
            <li><a href="view.php">Search & View</a></li>
            <li><a href="adminsettings.php">Settings</a></li>
            <li><a href="help.php">Help & Support</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </nav>
      </div>

      <?php
      echo '<br>
      	<h1 class = "form-signin-heading">Hi, '.$_SESSION['fname'].'!</h2><br>
      ';
      ?>
	</body>
</html>