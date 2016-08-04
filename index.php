<?php
  session_start();
  if(isset($_SESSION["login"]))
  {
    if($_SESSION['admin'])
      header("Location: admin.php");
    else
      header("Location: user.php");
  }
?>
<html>
	<head>
		<meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
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
    <title> Project Title </title>
	</head>
	<body>
		<div class="container">

      <!-- The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->
      <div class="masthead">
        <h3 class="text-muted">BCP Associates</h3>
        <hr style = "border: 2px">
      </div>
       <br><br><br>

      <div class="container">
		<form class = "form-signin" action = "login.php" method = "POST" name = "register">
			<button class="btn btn-lg btn-primary btn-block" type="submit" name = "submitindex">Login</button>
		</form>
		<form class = "form-signin" action = "register.php" method = "POST" name = "register">
			<button class="btn btn-lg btn-primary btn-block" type="submit" name = "submitindex">Register</button>
		</form>
	</div>
	</body>
</html>