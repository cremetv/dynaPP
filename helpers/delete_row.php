<?php

include_once '../db.php';

$table = $_POST['table'];
$condition = $_POST['condition'];

$con = DB::getConnection();
$sql = "DELETE FROM $table WHERE $condition";
$result = $con->query($sql);
$con = null;

echo 'success';
