<?php
require 'product.php';
session_start();
$id = $_GET['id'];
$product = new product();
$product->delete($id);