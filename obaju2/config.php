<?php
$dbhost= 'localhost';
$dbuser= 'root';
$dbpass='iti';
$dbname='ecommerce';
// open connection
$mysqli = new mysqli($dbhost, $dbuser,$dbpass);
$mysqli->select_db($dbname);
 ?>
