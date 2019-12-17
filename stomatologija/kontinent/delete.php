<?php

require('../util/db.php');

$countryId = $_GET['id'];
$sql = 'DELETE FROM kontinent WHERE id = :id';
$stmt = $db->prepare($sql);
$stmt->execute(['id' => $countryId]);

header('Location: /stomatologija/kontinent/index.php');

?>
