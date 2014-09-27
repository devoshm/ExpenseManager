<?php

$db = new PDO('mysql:host=localhost;dbname=expensereport;charset=utf8', 'root', 'root123');

if (!$db) {
	die('Could not connect: ' . mysql_error());
}