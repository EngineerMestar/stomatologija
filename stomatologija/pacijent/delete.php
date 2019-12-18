<?php

require('../util/db.php');

$pacijentID = $_GET['id'];
$sql = 'DELETE FROM pacijent WHERE id = :id';
$stmt = $db->prepare($sql);
$stmt->execute(['id' => $pacijentID]);

header('Location: /stomatologija/pacijent/index.php');

?>
