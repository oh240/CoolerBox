<?php
 
require('../config_file/config.php');
require('../config_file/functions.php');
 
$dbh = connectDb();
 
$sql = "update items set chk_type = 'delete', modified = now() where id = :id";
$stmt = $dbh->prepare($sql);
$stmt->execute(array(":id" => (int)$_POST['id']));