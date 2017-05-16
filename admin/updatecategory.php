<?php
require 'category.php';
session_start();
$id = $_GET['id'];
$category = new category();
$category->delete($id);