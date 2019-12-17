<?php

$host = "mysql:host=127.0.0.1;dbname=stomatologija";
$dbUsername = "root";
$dbPassword = "";

$db = new PDO($host, $dbUsername, $dbPassword);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
