<?php

include_once '../db.php';

$table = $_POST['table'];
$values = $_POST['values'];
$condition = $_POST['condition'];

$valueString = '';
$comma = '';

foreach ($values as $key => $val) {
  // (is_int($val)) ? $value = $val : $value = '"' . $val . '"';
  (is_numeric($val)) ? $value = (int)$val : $value = '"' . $val . '"';
  $valueString = $valueString . $comma . $key . '=' . $value;
  $comma = ',';
}
$statement = "UPDATE $table SET $valueString WHERE $condition";

// $con = DB::getConnection();
// $sql = "UPDATE $table SET $valueString WHERE $condition";
// $result = $con->query($sql);
// $con = null;

echo 'success<br>';
echo $statement;
