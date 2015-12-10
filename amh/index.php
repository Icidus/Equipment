<!DOCTYPE html>
<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);
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
        <link rel="shortcut icon" href="" />
        <meta name="author" content="Rob O'Connell">
        <link rel="shortcut icon" href="" type="image/x-icon" />
        <title>Amherst Library Laptop Availability</title>
		<link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
		<link rel="stylesheet" href="../css/local.css">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Libre+Baskerville' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    </head>
    <body>
	<div class="header">
		<h1>Amherst College Library</h1>
		<h3>Laptop Computer Status</h3>
	</div>    
	<div class="container-fluid" style="margin: auto;">      
		<div class="row main">
		<?php if($user->getEquipment('AM') == false) { ?>
			<h4 style="text-align: center;">No Equipment set.  Add some in the admin</h4>
		<?php } else { ?>	
		<?php foreach($user->getEquipment('AM') as $item) { ?>
		  <div class="col-xs-12 col-sm-6 col-md-4 item_load" data-sort="<?php echo $item["sort_order"]; ?>">
			<div class="card card-block com" id="record<?php echo $item["id"]; ?>" style="background-color: #fff;">
				<img class="card-img-top image" src="../images/<?php echo $item["id"]; ?>.jpg"/>
					<div class="card-block">
						<h5 class="card-title"><?php echo $item["title"]; ?></h5>
						<h6 class="card-text text-muted loan_period<?php echo $item["id"]; ?>" style="height: 24px; line-height: 24px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"></h6>
						<p class="card-text larger" style="height: 1.5em; line-height: 26px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">There are currently <span class="computer<?php echo $item["id"]; ?>"><i class="fa fa-spinner fa-spin"></i></span> of <span class="total<?php echo $item["id"]; ?>"> </span> <?php echo $item["title"]; ?> available.</p>
						<p class="card-text medium"><span class="computer<?php echo $item["id"]; ?>"><i class="fa fa-spinner fa-spin"></i></span> of <span class="total<?php echo $item["id"]; ?>"> </span> <?php echo $item["title"]; ?> available.</p>
						<p class="card-text smaller"><span class="computer<?php echo $item["id"]; ?>"><i class="fa fa-spinner fa-spin"></i></span> of <span class="total<?php echo $item["id"]; ?>"><i class="fa fa-spinner fa-spin"></i></span> available</p>			
						<p class="card-text" style="height: 26px;"><small class="text-muted time"></small></p>
					</div>
				</div>
		  </div>
		<?php } ?>
		<?php } ?>
		</div>
	</div>
<!--
		<footer>
		<div class="container">
		<ul class="list-unstyled">
		</ul>
		</div>
	</footer>
-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.isotope/2.2.1/isotope.pkgd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/3.2.0/imagesloaded.pkgd.min.js"></script>  	
<script type="text/javascript"> 	    
$(window).load(function(){ 
  var msnry = $('.main').isotope({
    itemSelector: '.item_load',
    masonry: {
      gutter: 0 
    }
  });    
	msnry.imagesLoaded().progress( function() {
		msnry.fadeIn(1000).isotope('layout');
  	}); 
});	
</script>
<script type="text/javascript" src="../js/load.js"></script>
    </body>
</html>
