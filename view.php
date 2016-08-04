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
      <!-- Bootstrap core CSS -->
      <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">  

      <!-- Custom styles for this template -->
      <link href="justified-nav.css" rel="stylesheet"> 
      <link href="signin.css" rel="stylesheet"> 
      <link href="table.css" rel="stylesheet">

      <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
      <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
      <script src="../../assets/js/ie-emulation-modes-warning.js"></script>
      <script src="table.js"></script>

      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    <title> View </title>
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
            <li class = "active"><a href="view.php">Search & View</a></li>
            <li><a href="adminsettings.php">Settings</a></li>
            <li><a href="help.php">Help & Support</a></li>
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
            <li class = "active"><a href="view.php">Search & View</a></li>
            <li><a href="help.php">Help & Support</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </nav>
      </div>
      ';
      ?>
      <div class = "container">
		<form method = "POST" action = "" class = "form-signin">
      <h2 class = "form-signin-heading"> Search & View </h2><br>
    
			<label class = "sr-only">Filename</label>
			<input name = "filename" style = "white-space : " type = "text" class="form-control" placeholder = "Filename">
    
      <label class = "sr-only">Advocate Name</label>
      <input name = "advname" type = "text" class = "form-control" placeholder = "Advocate Name">
    
			<label class = "sr-only">Year</label>
			<input name = "year" type = "text" class = "form-control" placeholder = "Year">

			<label class = "sr-only">Company Name</label>
			<input name = "cname" type = "text" class = "form-control" placeholder = "Company Name">

			<label class = "sr-only">Court Type</label>
			<input name = "ctype" type = "text" class = "form-control" placeholder = "Court Type">
      <button class="btn btn-lg btn-primary btn-block" type="submit" name = "submit">Go!</button>
 		</form>
  </div>
	</body>
</html>

<?php
	if(isset($_POST['submit'])) 
	{
		require("dbconn.php");
   		// define the list of fields
   		$fields = array('filename', 'advname', 'year', 'cname', 'ctype');
   		$conditions = array();
    		// loop through the defined fields
   		foreach($fields as $field)
		{
       	// if the field is set and not empty
       		if(isset($_POST[$field]) && $_POST[$field] != '') 
       		{
           	// create a new condition while escaping the value inputed by the user (SQL Injection)
           		$conditions[] = "`$field` LIKE '%" . mysql_real_escape_string($_POST[$field]) . "%'";
       		}
   		}
    		// builds the query
   		$query = "SELECT * FROM file ";
   		// if there are conditions defined
   		if(count($conditions) > 0) 
   		{
       	// append the conditions
       		$query .= "WHERE " . implode (' AND ', $conditions); // you can change to 'OR', but I suggest to apply the filters cumulative
   		}
   		$result = mysql_query($query);
       echo '
      <div id="container">
      <table id="keywords" cellspacing="0" cellpadding="0">
      <thead>
        <tr>
          <th><span>Case No.</span></th>
          <th><span>Filename</span></th>
          <th><span>Advocate Name</span></th>
          <th><span>Year</span></th>
          <th><span>Company Name</span></th>
          <th><span>Court Type</span></th>
          <th><span>View File</span></th>
        </tr>
      </thead>
      <tbody>
      ';

   		if (mysql_num_rows($result) > 0) {
    // output data of each row
    while($row = mysql_fetch_assoc($result)) {
     echo '
        <tr>
          <td> 
            '.$row["fid"].'
          </td>
          <td> 
            '.$row["filename"].'
          </td>
          <td> 
            '.$row["advname"].'
          </td>
          <td> 
            '.$row["year"].'
          </td>
          <td> 
            '.$row["cname"].'
          </td>
          <td> 
            '.$row["ctype"].'
          </td>
          <td>
          <a href="uploads/'.$row["filename"].'.pdf" target = "_blank">
            <button class="btn btn-lg btn-primary -btn-block" name = "submitview" value = "'.$row['filename'].'">'.$row['filename'].'</button>
            </a>
            <input type = "hidden" name = "hidden" value = "'.$row['fid'].'">
          </td>
        </tr>
        ';
    }
} else {
    echo "0 results";
}
  echo '
      </tbody>
      </table>
      </div>';
/*
		$form = $row['filename'];
		$file = 'uploads/'.$form.'.pdf';
		$filename = $form.'.pdf';
		/*header('Content-type: application/pdf');
		header('Content-Disposition: inline; filename="' . $filename . '"');
  		header('Content-Transfer-Encoding: binary');
  		header('Accept-Ranges: bytes');
  		@readfile($file);*/
  		//echo "<iframe src=\"".$file."\" width=\"100%\" style=\"height:80%\"></iframe>"; */
  	}
?> 