<?php

require('../util/db.php');

$countryId = $_GET['id'];
$sql = 'DELETE FROM ordinacija WHERE id = :id';
$stmt = $db->prepare($sql);
$stmt->execute(['id' => $countryId]);

header('Location: /stomatologija/ordinacija/index.php');

?>
