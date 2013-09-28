<?php
 
require('../config_file/config.php');
require('../config_file/functions.php');
 
$dbh = connectDb();

$sql = "select max(seq)+1 from items where chk_type != 'delete'";

$seq = $dbh->query($sql)->fetchColumn();

$sql = "insert into items 
        (name, seq ,nums, created, modified) 
        values 
        (:name, :seq ,:nums, now(), now())";
$stmt = $dbh->prepare($sql);
$stmt->execute(array(
    ":seq" => $seq,
    ":name" => $_POST['name'],
    ":nums" => $_POST['nums'],
));

echo $dbh->lastInsertId();


