<?php 

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

		$arraycount = array_filter($loan, function ($n) {
			return $n !== 'Billed and Paid';
		}); 
		$total = count($arraycount); 
		 	
      	$count_comp  = array_count_values($computers);
	  	$count_avail = array_count_values($avail);
	  		  	
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
      }
      header('Content-Type: application/json; charset=utf-8');
      echo json_encode($results, true);
      break;

}

function error($value) {
	print '<pre>';
	print_r($value);
	print '</pre>';
}

?>	