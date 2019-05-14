<?php

include_once '../db.php';

$table = $_POST['table'];
$condition = $_POST['condition'];

$values = join(', ', $condition);

$con = DB::getConnection();
$sql = "INSERT INTO $table (clientId, elementId) VALUES ($values)";
$result = $con->query($sql);
$con = null;

echo 'success';
