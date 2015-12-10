<!DOCTYPE html>
<?php 
require_once dirname(__FILE__) . '/../Application/initialize.php';
$user = new User();
?>
<html lang="en">
  <head>
    	<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
   	 	<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name=apple-mobile-web-app-capable content=yes>
        <meta name=apple-mobile-web-app-status-bar-style content=black>
        <meta name="author" content="Rob O'Connell">
        <link rel="shortcut icon" href="" type="image/x-icon" />
        <title>Equipment Status Admin</title>
		<link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
		<link rel="stylesheet" href="../css/local.css">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Libre+Baskerville' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    </head>
    <body>
	<div class="container-fluid" style="margin: auto; margin-top: 40px;">      
		<div class="row main">
			<div class="col-md-3" style="margin-top: 60px;">
			<button type="button" id="SM" class="btn btn-primary btn-lg btn-block location">Smith College</button>
			<button type="button" id="MH" class="btn btn-primary btn-lg btn-block location">Mount Holyoke College</button>
			<button type="button" id="AM" class="btn btn-primary btn-lg btn-block location">Amherst College</button>
			<button type="button" id="HA" class="btn btn-primary btn-lg btn-block location">Hampshire College</button>
			<button type="button" id="UM" class="btn btn-primary btn-lg btn-block location">UMass</button>
			<form id="upload" method="post" action="upload/upload.php" enctype="multipart/form-data">
			<div id="drop">
				Images must be the system ID (9 digits) in the following format: xxxxxxxxx.jpg <br/><br/>
				You may drag and drop multiple images into this box <br />
				<a>Browse</a>
				<input type="file" name="upl" multiple />
			</div>

			<ul> </ul>
		</form>
		</div>
		<div class="col-md-9" style="border-bottom: 1px solid #eeeeee;">
		<div class="header">
			<h1 class="pull-left" style="margin-left: 20px;">Equipment Status Admin</h1>
			<h5 class="pull-right"><a href="logout.php">Log out</a></h5>
			<h5 class="pull-right" style="margin-right: 20px;"><?php echo $_SERVER["givenName"]; ?></h5>
		</div>  
		</div>		
		<div class="col-md-9">	  
		<div class="data container-fluid" style="margin: auto 0;"><p class="lead">Select a campus from the panel on the left</p></div>
		</div>
		</div>
	</div>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>	
	<script type="text/javascript" src="../js/jquery.knob.js"></script>
	<script type="text/javascript" src="../js/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="../js/jquery.iframe-transport.js"></script>
	<script type="text/javascript" src="../js/jquery.fileupload.js"></script>
	<script type="text/javascript" src="../js/script.js"></script>
	<script type="text/javascript" src="../js/admin.js"></script>	
    </body>
</html>
