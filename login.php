
<?php
	if(isset($_POST['submit']))
	{
		require("dbconn.php");
		$inuser = $_POST['username'];
		$inpass = mysql_real_escape_string($_POST['password']);
		$query = 'SELECT * from user WHERE username = "'.$inuser.'";';
		$result = mysql_query($query);
		$resultarray = mysql_fetch_array($result);
		$realpass = $resultarray['password'];
		if(password_verify($inpass,$realpass))
		{
			session_start();
      $_SESSION['login'] = 1;
      $_SESSION['username'] = $resultarray['username'];
      $_SESSION['fname'] = $resultarray['fname'];
      $_SESSION['lname'] = $resultarray['lname'];
      $_SESSION['admin'] = $resultarray['admin'];
      if($resultarray['admin'] == 1)
			  header('Location:admin.php');
      else
        header('Location:user.php');
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Login</title>

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
            <li class = "active"><a href="#">Login</a></li>
          </ul>
        </nav>
      </div>
      <br><br>

    <div class="container">

      <form class="form-signin" action = "" method = "POST">
        <h2 class="form-signin-heading">Login</h2><br>
        <label for="inputEmail" class="sr-only">Username</label>
        <input type="text" id="inputEmail" name="username" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" name = "submit" type="submit">Sign in</button> <br>
       </form>
       <form action="register.php" class="form-signin" method="POST">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
