<?php

require('../util/db.php');

$countryId = $_GET['id'];
$sql = 'DELETE FROM grad WHERE id = :id';
$stmt = $db->prepare($sql);
$stmt->execute(['id' => $countryId]);

header('Location: /stomatologija/grad/index.php');

?>
