<?php 
/*
error_reporting(E_ALL);
ini_set("display_errors", 1);
*/
switch ($_GET['action']) 
{
	case 'getComputers':
	  $id = $_GET["id"];
	  $results = array();
	  foreach($id as $ids) {
      	$set = file_get_contents("http://fcaa.library.umass.edu:1891/rest-dlf/record/FCL01$ids/items?view=full"); 
	  	$xml = simplexml_load_string($set, "SimpleXMLElement", LIBXML_NOCDATA);
	  	$json = json_encode($xml);
	  	$array = json_decode($json,TRUE);
	  	$avail = array();
	  	$title = array();
	  	$loan = array();
	  	$computers = array();
	  	$data = array();
	  	$data = $array["items"]["item"];
	  	if(!isset($data[0])) {
		  	$title[] = $data["z13"]['z13-title'];
		  	$loan[] = $data["z30"]["z30-item-status"];
		  	$avail[] = $data["z13"]['z13-title'] . " " . $data["status"];
	  		$computers[] = $data["z30-sub-library-code"];
	  		$sub = $data["z30-sub-library-code"];
	  	} else {
	  	
	  	foreach($data as $key=>$datas) {
		  	$title[] = $datas["z13"]['z13-title'];
		  	$loan[] = $datas["z30"]["z30-item-status"];
		  	$avail[] = $datas["z13"]['z13-title'] . " " . $datas["status"];
	  		$computers[] = $datas["z30-sub-library-code"];
		} 
		$sub = $data["0"]["z30-sub-library-code"];
		}
	  	//$data = $array["items"]["item"];
	  	//foreach($data as $items) {
		$arraycount = array_filter($loan, function ($n) {
			return $n !== 'Billed and Paid';
		}); 
		$total = count($arraycount); 
		 	
      	$count_comp  = array_count_values($computers);
	  	$count_avail = array_count_values($avail);
	  	
	  	//$total = $count_comp[$sub];
	  	
	  	foreach($title as $d) {
		  	if(isset($count_avail[$d .  " Available"])) {
			  	$avail_count = $count_avail[$d .  " Available"];
		  	} else {
			  	$avail_count = 0;
		  	}
		  	
		  	if(isset($count_avail[$d .  " Reshelving"])){
			  	$reshelving_count = $count_avail[$d .  " Reshelving"];
		  	} else {
			  	$reshelving_count = 0;
		  	}
		  	
	  		$available  =  array(
		  		 'count' => $avail_count + $reshelving_count,	  		 
	  		);
	  	}
	  	
/*
	  	foreach($title as $r) {
		  	$reshelving = array(
			  	'count' =>  $count_avail[$d .  " Reshelving"]	
			  )	
	  	}
*/

/*
	  	if(isset($count_avail["Reshelving"])) {
      		$shelving = $count_avail["Reshelving"];
	  		$results[] = array(
		  		'id'    => $ids, 	
		  		'count' => $available + $shelving,
		  		'total' => $total
	  		);
      	} else {
*/ 	
		$exclude = array('Missing', 'On Repair');
		foreach($loan as $loans)
		{
			if(!in_array($exclude, $loans)) {
				$l = $loans;
			}
		}
		
		foreach($available as $j) {
	      	$results[] = array(
		    'title' => $title[0], 
		    'loan' => $l, 	
	      	'id' => $ids,
	      	'count' => $j,
		  	'total' => $total
	      );
	      }	
//       	}  
/*
	  	if($results == null){
	      	$results[] = array(
	      		'id' => $ids,
	      		'count' => 0,
		  		'total' => $total
	      	);
      	//}
      }	
*/
      }
      header('Content-Type: application/json; charset=utf-8');
      echo json_encode($results, true);
      break;
     
/*
    case 'getDells':
      $set = file_get_contents("http://fcaa.library.umass.edu:1891/rest-dlf/record/FCL01004288042/items?view=full"); 
      $xml = simplexml_load_string($set, "SimpleXMLElement", LIBXML_NOCDATA);
      $json = json_encode($xml);
      $array = json_decode($json,TRUE);
      $data = $array["items"]["item"];
      $avail = array();
      foreach($data as $items) {
      	$avail[] = $items["status"];
      }
      $count_avail = array_count_values($avail);
	  
      $results = $count_avail["Available"];
      if($results == null){
	      $results = 0;
      }
      header('Content-Type: application/json; charset=utf-8');
      echo json_encode($results, true);
      break;  
*/
}

function error($value) {
	print '<pre>';
	print_r($value);
	print '</pre>';
}

?>	