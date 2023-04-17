<?php

if(!isset($q)){

$q = "SELECT * FROM $table";

}

$w2 = false;
if(isset($_REQUEST['search']) AND !empty($_REQUEST['search'])){

$search = inp("search");

$w2 = true;
$sql = '';
foreach ($cols AS $keyword)
{
    if ($sql != '')
        $sql .= ' OR ';

    $sql .= "$keyword LIKE '%$search%'";
}

$q .= "  WHERE ($sql) ";

} 

if(isset($w) AND $w){
    
    if($w2)
        $q.= " AND ";
    else 
        $q .= " WHERE ";
    
    $q .= $where;

}

if(isset($final) && strlen($final)){

        $q .= "  ".$final;
}

//echo $q;




$tot =$db->query($q);

if($tot)
$total = $tot->num_rows;
else 
$total = 0;

if(isset($_REQUEST['sort'])){

	$q .= " ORDER BY " . $_REQUEST['sort'] . " ". $_REQUEST['order'];
}

$q .= " LIMIT " .$_REQUEST['offset'] ." , " . $_REQUEST['limit'];

// echo $q;
// die();

$r = $db->query($q);

$data = array();

while($row = $r->fetch_assoc()){

$data[] = $row;

}

echo json_encode( array('total' =>$total , 'rows' => $data ));
//}

?>