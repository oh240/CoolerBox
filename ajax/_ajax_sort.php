<?php
 
require('../config_file/config.php');
require('../config_file/functions.php');
 
$dbh = connectDb();

parse_str($_POST['item']);

//var_dump($items);

foreach ($item as $key => $val) {
	
	$sql = "update items set seq = :seq where id = :id";
	$stmt = $dbh->prepare($sql);
  $stmt->execute(array(
		":seq" => $key,
		":id" => $val
	));
	
}