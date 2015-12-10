<?php
require_once dirname(__FILE__) . '/initialize.php';

class User extends BrowsePdo
{
	public function getEquipment($loc)
    {
	   	$connected = BrowsePdo::connect();
        $sql       = "SELECT * FROM laptops WHERE owner = '{$loc}' ORDER BY sort_order,title ASC";
        $query     = BrowsePdo::query($sql);
       if ($query->rowCount() > 0) {
	    $results   = array();
	     foreach ($query as $item) {
            $results[] = $item;
        }
        return $results;
	    } else {   
			return false;
        }
    }
    
    public function updateEquipment($data)
    {
	   $connected = BrowsePdo::connect();
	   $sql       = "UPDATE laptops set title = ?, sort_order = ? WHERE id = ?";
       $update    = BrowsePdo::query($sql, array(
            $data["title"],
            $data["sort"],
            $data["id"]
        ));
    }
    
    public function addEquipment($data)
    {
	   $connected = BrowsePdo::connect();
	   $sql       = "INSERT INTO laptops (id, title, owner, sort_order) VALUES (?,?,?,?)";
       $update    = BrowsePdo::query($sql, array(
            $data["new_id"],
            $data["new_title"],
            $data["new_owner"],
            $data["new_sort"]
        ));
    }
    
    public function deleteEquipment($data)
    {
	   $connected = BrowsePdo::connect();
	   $sql       = "DELETE FROM laptops where id = ?";
       $update    = BrowsePdo::query($sql, array(
            $data["id"]
        ));
    }
	        
}