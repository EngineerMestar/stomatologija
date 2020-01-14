<?php

require('../util/session.php');
require('../util/db.php');
require('../frontend/header.php');
require('../frontend/footer.php');

// ako nisi prijavljen, redirect
if(!isset($_SESSION['user'])) {
	header('Location: /stomatologija/login/index.php');
}

$stmt = $db->query('SELECT * FROM stomatolog');
$rows = $stmt->fetchAll();

echo $header;
?>
<div class="container">
	<a href="/stomatologija/stomatolog/form.php" class="btn btn-primary mt-3 mb-3 float-right">Dodaj</a>
	<table class="table">
	<thead class="thead-dark">
		  <th scope="col">Id</th>
		  <th scope="col">OIB</th>
		  <th scope="col">Ime</th>
		  <th scope="col">Prezime</th>
		  <th scope="col">Ordinacija_ID</th>
		  <th scope="col"></th>
		</tr>
	  </thead>
	  <tbody>
		<?php foreach($rows as $row) { ?>
		<tr>
		  <th scope="row"><?php echo $row['id']; ?></th>
		  <td><?php echo $row['oib']; ?></td>
		  <td><?php echo $row['first_name']; ?></td>
		  <td><?php echo $row['last_name']; ?></td>
		  <td><?php echo $row['ordination_id']; ?></td>

		  <td>
		  <a class="btn btn-primary" href="/stomatologija/stomatolog/form.php?id=<?php echo $row['id']; ?>">Uredi</a>
		  <a class="btn btn-danger" href="/stomatologija/stomatolog/delete.php?id=<?php echo $row['id']; ?>">Izbrisi</a>
		  </td>
		</tr>
		<?php } ?>
	  </tbody>
	</table>
</div>


<?php
echo $footer;
?>

