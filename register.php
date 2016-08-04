<?php
	require("dbconn.php");
	if(isset($_POST['submit']))
	{
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$username = $_POST['username'];
		$password = mysql_real_escape_string($_POST['pass1']);
		$hash = crypt($password);
		$admin = 0;
		$sqlq = "INSERT INTO user (fname, lname, username, password, admin) VALUES('".$fname."', '".$lname."', '".$username."', '".$hash."', '".$admin."');";
		$result = mysql_query($sqlq);
		if(!$result)
		{
			die("Fatal Error: Unable to insert into database");
		}
	}
?>
<html>
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <link rel="icon" href="../../favicon.ico">

	    <!-- Bootstrap core CSS -->
	    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

	    <!-- Custom styles for this template -->
    	<link href="justified-nav.css" rel="stylesheet">
	    <link href="signin.css" rel="stylesheet">

	    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
	    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    	<script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
   	 	<!--[if lt IE 9]>
      	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    	<![endif]-->
		<title> Register </title>
	</head>
	<body>
		<div class="container">

      <!-- The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->
      <div class="masthead">
        <h3 class="text-muted">BCP Associates</h3>
        <nav>
          <ul class="nav nav-justified">
            <li><a href="index.php">Home</a></li>
            <li class = "active"><a href="#">Register</a></li>
          </ul>
        </nav>
      </div>
      <br><br>

      <div class="container">
		<form class = "form-signin" action = "" method = "POST" name = "register">
			<h2 class="form-signin-heading">Register</h2><br>
			<label class="sr-only"> First Name </label>
			<input type = "text" class = "form-control" placeholder = "First Name" name = "fname" required>
			<label class="sr-only"> Last Name </label>
			<input type = "text" class = "form-control" placeholder = "Last Name"  name = "lname" required>
			<label class="sr-only"> Username </label>
			<input type = "text" class = "form-control" placeholder = "Username" name = "username" required>
			<label class="sr-only"> Password </label>
			<input type = "password" class = "form-control" placeholder = "Password" name = "pass1" required>
			<label class="sr-only"> Re-enter password </label>
			<input type = "password" class = "form-control" placeholder = "Re-enter Password" name = "pass2" required>
			<button class="btn btn-lg btn-primary btn-block" type="submit" name = "submit">Register</button>
		</form>
	</div>
	</body>
</html>