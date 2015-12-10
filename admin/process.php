<?php
require_once dirname(__FILE__) . '/../Application/initialize.php';
$user = new User();
switch ($_GET['action']) 
{
	case 'getRecords':
	$location = $_GET["loc"];
	$set = $user->getEquipment($location);
	$results = array();
	
	
	if($set !== false) {
	foreach($set as $item) {
		$local = '../images/'.$item["id"].'.jpg';
		if (file_exists($local)) {
			$image = '<i class="fa fa-check-circle-o text-success"></i>';
		} else {
			$image = '<i class="fa fa-times-circle-o text-danger"></i>';
		}			
		$results[] = array(
		'id' =>  $item["id"],
		'title'  => $item["title"],
		'owner' => $item["owner"],
		'sort'  => $item["sort_order"],
		'results' => 'true',
		'image' => $image
	);
	}	
	} else {
		$results[] = array(
		 'loc' => $location,
		 'result' => 'false',
		);
	}
	header('Content-Type: application/json; charset=utf-8');
	echo json_encode($results, true);  
	break;	
	
	case 'updateRecords':
	$update = $user->updateEquipment($_POST);
	$results = array(
		'id' => $_POST["id"],
		'loc' => $_POST["owner"]
	);
	header('Content-Type: application/json; charset=utf-8');
	echo json_encode($results, true);  
	break;	
	
	case 'addRecords':
	$add = $user->addEquipment($_POST);
	$results = array(
		'id' => $_POST["new_id"],
		'loc' => $_POST["new_owner"]
	);
	header('Content-Type: application/json; charset=utf-8');
	echo json_encode($results, true);
	break;
	
	case 'deleteRecords':
	$add = $user->deleteEquipment($_POST);
	$results = array(
		'id' => $_POST["id"],
		'loc' => $_POST["owner"]
	);
	header('Content-Type: application/json; charset=utf-8');
	echo json_encode($results, true);
	break;
}

?>	