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

    	<title> Help & Support </title>
	</head>
	<body>
	<?php
    if($_SESSION['admin'])
      {
        echo '
      <div class="container">

      <!-- The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->
      <div class="masthead">
        <h3 class="text-muted">BCP Associates</h3>
        <nav>
          <ul class="nav nav-justified">
            <li><a href="index.php">Home</a></li>
            <li><a href="scantest.php">Scan & Upload</a></li>
            <li><a href="view.php">Search & View</a></li>
            <li><a href="adminsettings.php">Settings</a></li>
            <li class = "active"><a href="help.php">Help & Support</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </nav>
      </div>
      ';
      }
      else
        echo'
      <div class="container">

      <!-- The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->
      <div class="masthead">
        <h3 class="text-muted">BCP Associates</h3>
        <nav>
          <ul class="nav nav-justified">
            <li><a href="index.php">Home</a></li>
            <li><a href="view.php">Search & View</a></li>
            <li class = "active"><a href="help.php">Help & Support</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </nav>
      </div>
      ';
      ?>
	</body>
</html>