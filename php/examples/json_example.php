<?php
//Get and convert
$JSON = $_POST['data'];
$JSONarray = json_decode($JSON);
var_dump($JSONarray);

//Increment
$JSON[0][1].age++;
var_dump($JSON);

//Convert to JSON
echo json_encode($JSONarray);
?>