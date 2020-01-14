<?php

require('../util/session.php');
require('../util/db.php');
require('../frontend/header.php');
require('../frontend/footer.php');

// ako nisi prijavljen, redirect
if(!isset($_SESSION['user'])) {
	header('Location: /stomatologija/login/index.php');
}

$stmt = $db->query('SELECT * FROM ordinacija');
$rows = $stmt->fetchAll();

echo $header;
?>
<div class="container">
	<a href="/stomatologija/ordinacija/form.php" class="btn btn-primary mt-3 mb-3 float-right">Dodaj</a>
	<table class="table">
	<thead class="thead-dark">
		<tr>
		  <th scope="col">ID</th>
		  <th scope="col">Ime ordinacije</th>
		  <th scope="col">Grad ID</th>
		  <th scope="col"></th>
		</tr>
	  </thead>
	  <tbody>
		<?php foreach($rows as $row) { ?>
		<tr>
		  <th scope="row"><?php echo $row['id']; ?></th>
		  <td><?php echo $row['ordination_name']; ?></td>
		  <td><?php echo $row['city_id']; ?></td>

		  <td>
		  <a class="btn btn-primary" href="/stomatologija/ordinacija/form.php?id=<?php echo $row['id']; ?>">Uredi</a>
		  <a class="btn btn-danger" href="/stomatologija/ordinacija/delete.php?id=<?php echo $row['id']; ?>">Izbrsi</a>
		  </td>
		</tr>
		<?php } ?>
	  </tbody>
	</table>
</div>


<?php
echo $footer;
?>

