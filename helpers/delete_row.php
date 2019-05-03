<?php

include_once '..db.php';

$id = $_POST['id'];
$table = $_POST['table'];

$con = DB::getConnection();
$sql = "DELETE FROM $table WHERE id = $id";
$result = $con->query($sql);
$con = null;

echo 'success';
