<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function create_tree_select($tree, $ParentID, $lvl, $c_parent = "", $c_id = "")
{
    if (!isset($tree[$ParentID])) return;

    foreach($tree[$ParentID] as $item) {
    	if($c_id != "" && $c_id == $item->id) continue;
    	
        if($lvl > 0) 
        {
        	echo '<option value="'.$item->id.'"';
        	if ($c_parent == $item->id) echo " selected ";
        	echo '>';
        	for($i=0; $i<($lvl*2); $i++) echo "&nbsp;";
        	echo "-&nbsp;";
        	echo $item->title.'</option>';
        } else {
        	echo '<option value="'.$item->id.'"';
        	if ($c_parent == $item->id) echo " selected ";
        	echo '>'.$item->title.'</option>';
        }
        create_tree_select($tree, $item->id, $lvl+1, $c_parent, $c_id);
    }
}

// Creates an array where sub elements are stored in array[id][sub]
function create_tree_array($tree, $ParentID, $lvl)
{
	$return = array();
	if (!isset($tree[$ParentID])) return $return;
	foreach($tree[$ParentID] as $key => $item) {
		$return[$key] = $item;
		$return[$key]->sub = $this->_create_tree($tree, $item->id, $lvl+1);
	}
	return $return;
}

?>