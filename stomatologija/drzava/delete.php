<?php

require('../util/db.php');

$countryId = $_GET['id'];
$sql = 'DELETE FROM drzava WHERE id = :id';
$stmt = $db->prepare($sql);
$stmt->execute(['id' => $countryId]);

header('Location: /stomatologija/drzava/index.php');

?>
