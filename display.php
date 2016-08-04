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
    	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    	<title>View</title>

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
</html>
<?php
	require("dbconn.php");
	if(isset($_POST['submitview']))
	{
		$fname = $_POST['submitview'];
		$fid = $_POST['hidden'];

		$query = 'SELECT * from file WHERE fid = "'.$fid.'";';
		$result = mysql_query($query);
		$row = mysql_fetch_assoc($result);
/*
		echo '
      	<table>
        	<tr>
          		<td> 
            		Case No: '.$row['fid'].'<br>Filename: '.$row['filename'].'<br>Advocate Name: '.$row['advname'].'<br>Year: '.$row['year'].'<br>Company Name: '.$row['cname'].'<br>Company Type: '.$row['ctype'].' 
          		</td>
        	</tr>
      	</table>';
*/
		$form = $fname;
		$file = 'uploads/'.$form.'.pdf';
		$filename = $form.'.pdf';
		/*header('Content-type: application/pdf');
		header('Content-Disposition: inline; filename="' . $filename . '"');
  		header('Content-Transfer-Encoding: binary');
  		header('Accept-Ranges: bytes');
  		@readfile($file);*/
  		echo "<iframe src=\"".$file."\" width=\"100%\" style=\"height:80%\"></iframe>";
	}
?>