<?php
 
require('../config_file/config.php');
require('../config_file/functions.php');
 
$dbh = connectDb();
 
$sql = "update items set name = :name ,nums = :nums ,modified = now() where id = :id";

echo $sql;

$stmt = $dbh->prepare($sql);
$stmt->execute(array(
	":id" => (int)$_POST['id'],
	":name" => $_POST['name'],
	":nums" => $_POST['nums'],
));