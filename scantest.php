<?php
  session_start();
  if(!isset($_SESSION["login"]))
  {
    header("Location: index.php");
  }
?>
<?php
    if(isset($_POST['submit']))
    {
        require("dbconn.php");
        $filename = $_POST['filename'];
        $name = $filename . "." . pathinfo($_FILES['ufile']['name'],PATHINFO_EXTENSION);

        $tmp_name = $_FILES['ufile']['tmp_name']; //was tmp_name
        $error = $_FILES['ufile']['error'];
        if(isset($name)) 
        {
            if(!empty($name)) 
            {
                $location = 'uploads/';

                if(move_uploaded_file($tmp_name, $location.$name))
                {
                    $filename = $_POST['filename'];
                    $filepath = $location.$name;
                    $advname = $_POST['advname'];
                    $year = $_POST['year'];
                    $cname = $_POST['cname'];
                    $ctype = $_POST['ctype'];
                    $sqlq = "INSERT INTO file(filename, filepath, advname, year, cname, ctype) VALUES ('".$filename."','".$filepath."','".$advname."','".$year."','".$cname."','".$ctype."');";
                    $result = mysql_query($sqlq);
                    if(!$result)
                    {
                        die("Error in connecting to database!");
                    }
                }
            } 
        }
    }
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Scan and Upload</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="justified-nav.css" rel="stylesheet">
    <link href="signin.css" rel="stylesheet">

    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript" src="http://direct.asprise.com/scan/javascript/base/scanner.js"></script> <!-- required for scanning -->

    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script> <!-- optional -->

    <script>
        // -------------- Optional status display, depending on JQuery --------------
        function displayStatus(loading, mesg, clear) {
            $('#info').empty(); // jQuery is used
            if(loading) {
                $('#info').html((clear ? '' : $('#info').html()) + '<p><img src="http://asprise.com/legacy/product/_jia/applet/loading.gif" style="vertical-align: middle;" hspace="8"> ' + mesg + '</p>');
            } else {
                $('#info').html((clear ? '' : $('#info').html()) + mesg);
            }
        }
        // -------------- scanning related code: independent of any 3rd JavaScript library --------------
        function scanSimple() {
            displayStatus(true, 'Scanning', true);
            com_asprise_scan_request(myCallBackFunc,
                com_asprise_scan_cmd_method_SIMPLE_SCAN, // simple scan without the applet UI
                com_asprise_scan_cmd_return_IMAGES_AND_THUMBNAILS,
                null);
        }
        function scan() {
            displayStatus(true, 'Scanning', true);
            com_asprise_scan_request(myCallBackFunc,
                com_asprise_scan_cmd_method_SCAN, // normal scan with the applet UI
                com_asprise_scan_cmd_return_IMAGES_AND_THUMBNAILS,
                {
                    'wia-version': 2
                });
        }
        function scanAndSaveToLocal() {
            displayStatus(true, 'Scanning', true);
            com_asprise_scan_request(myCallBackFunc,
                    com_asprise_scan_cmd_method_SCAN, // normal scan with the applet UI
                    com_asprise_scan_cmd_return_IMAGES_AND_THUMBNAILS,
                    {
                        'wia-version': 2,
                        'save-to-folder': 'C:\\tmp\\scanned',
                        'open-folder-after-save': 'true'
                    });
        }
        function scanThenUpload() {
            displayStatus(true, 'Scanning', true);
            com_asprise_scan_request(myCallBackFunc,
                com_asprise_scan_cmd_method_SCAN_THEN_UPLOAD, // scan and then upload directly in the applet UI
                com_asprise_scan_cmd_return_IMAGES_AND_THUMBNAILS,
                {
                    'upload-url': 'http://asprise.com/scan/applet/upload.php?action=upload' // target URL
                    ,'format': 'PDF'
                    ,'upload-cookies': document.cookie
                });
        }
        /** Use this callback function to get notified about the scan result. */
        function myCallBackFunc(success, mesg, thumbs, images) {
            var logText;
            displayStatus(false, '', true);
            logText = 'Callback function invoked: success = ' + success + ", mesg = " + mesg;
            logText += '\nThumbs: ' + (thumbs instanceof Array ? thumbs.length : 0) + ", images: " + (images instanceof Array ? images.length : 0);
            logToConsole(logText, !(success || mesg == 'User cancelled.'));
            displayStatus(false, '<pre>' + logText + '</pre>', true);
            for(var i = 0; (images instanceof Array) && i < images.length; i++) {
                addImage(images[i], document.getElementById('images'));
            }
        }
        /** We use this to track all the images scanned so far. */
        var imagesScanned = [];
        function addImage(imgObj, domParent) {
            imagesScanned.push(imgObj);
            var imgSrc = imgObj.datatype == com_asprise_scan_datatype_BASE64 ?
                    'data:' + imgObj.mimetype + ';base64,' + imgObj.data : imgObj.data;
            var elementImg = createDomElementFromModel(
                {
                    'name': 'img',
                    'attributes': {
                        'class': 'scanned',
                        'src': imgSrc,
                        'height': '100',
                        'class': 'zoom'
                    }
                }
            );
            domParent.appendChild(elementImg);
            // optional UI effect that allows the user to click the image to zoom.
            enableZoom();
        }
        function submitForm1() {
            displayStatus(true, "Submitting in progress, please standby ...", true);
            com_asprise_scan_submit_form_with_images('form1', imagesScanned, function(xhr) {
                if(xhr.readyState == 4) { // 4: request finished and response is ready
                    displayStatus(false, "<h2>Response from the server: </h2>" + xhr.responseText, true);
                }
            });
        }
    </script> 
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
            <li class = "active"><a href="scantest.php">Scan & Upload</a></li>
            <li><a href="view.php">Search & View</a></li>
            <li><a href="adminsettings.php">Settings</a></li>
            <li><a href="help.php">Help & Support</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </nav>
      </div>
      <br>

        <div class = "container">
        <form class = "form-signin" id="form1" name="form1" method="post" action="scantest.php" enctype="multipart/form-data">
        <h2 class="form-signin-heading">Scan & Upload</h2><br>
            <label class="sr-only">File Name</label>
            <input id="filename" name="filename" class = "form-control" placeholder = "File Name" type="text" required/>

            <label class="sr-only">Company Name</label>
            <input id="cname" class = "form-control" placeholder = "Company Name" name = "cname" type="text" required>

            <label class="sr-only">Court Type</label>
            <input id="ctype" type="text" class = "form-control" placeholder = "Court Type" name = "ctype" required>

            <div class="dropdown">
            <select name = "year">
                <option selected = "selected" disabled = "disabled" required> Year </option>
                <?php
                    $year = date('Y');
                    for ($x = 2005; $x <= $year; $x++) 
                    {
                        echo '<option value = '.$x.'>';
                        echo $x;
                        echo '</option>';
                    } 
                ?>
            </select>
            </div>

            
            <select name = "advname" required>
                <option value="" selected = "selected" disabled = "disabled"> Advocate Name </option>
                <option value="Adv 1">Adv 1</option>
                <option value="Adv 2">Adv 2</option>
                <option value="Adv 3">Adv 3</option>
            </select><br>

            <center>
            <label class="sr-only">Scan</label>
            <button type="button" class="btn btn-default" onclick="scanSimple();">Simple Scan</button>
            <button type="button" class="btn btn-info" onclick="scan();">Scan</button><br>

            <label class="sr-only">Upload</label>
            <input type="file" name="ufile" id="ufile"><br>
            </center>
            <button class="btn btn-lg btn-primary btn-block" name = "submit" type="submit" onClick = "submitForm1();">Go</button>
        </form>
    </div>
</body>
</html>