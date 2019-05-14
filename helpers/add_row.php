<?php

include_once '../db.php';

$table = $_POST['table'];
$condition = $_POST['condition'];

$keys = [];
$values = [];
foreach ($condition as $key => $val) {
  array_push($keys, $key);
  array_push($values, $val);
}
$keys1 = join(', ', $keys);
$values1 = join(', ', $values);

$con = DB::getConnection();
$sql = "INSERT INTO $table ($keys1) VALUES ($values1)";
$result = $con->query($sql);
$con = null;

echo 'success';
