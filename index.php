<?php
ini_set('display_errors', 1);
header("Content-type: application/json; charset=utf-8");
# if (!isset($_SESSION)) {session_start();}
include('app/per/db.php');
include('app/dom/class/alumno.php');

$class = new alumno;
$data = $class->getAll();
$json = json_encode($data, JSON_PRETTY_PRINT);
print_r($json);