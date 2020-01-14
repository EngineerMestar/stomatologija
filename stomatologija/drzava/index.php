<?php

require('../util/session.php');
require('../util/db.php');
require('../frontend/header.php');
require('../frontend/footer.php');

// ako nisi prijavljen, redirect
if(!isset($_SESSION['user'])) {
	header('Location: /stomatologija/login/index.php');
}

// dohvaćanje svih zemalja iz baze
$stmt = $db->query('SELECT * FROM drzava');
$rows = $stmt->fetchAll();

echo $header;
?>
<div class="container">
	<a href="/stomatologija/drzava/form.php" class="btn btn-primary mt-3 mb-3 float-right">Dodaj</a>
	<table class="table">
	  <thead>
	  <thead class="thead-dark">
		  <th scope="col">ID</th>
		  <th scope="col">Ime drzave</th>
		  <th scope="col">Kontinent ID</th>
		  <th scope="col"></th>
		</tr>
	  </thead>
	  <tbody>
		<?php foreach($rows as $row) { ?>
		<tr>
		  <th scope="row"><?php echo $row['id']; ?></th>
		  <td><?php echo $row['country_name']; ?></td>
		  <td><?php echo $row['continent_id']; ?></td>
		  <td>
		  <a class="btn btn-primary" href="/stomatologija/drzava/form.php?id=<?php echo $row['id']; ?>">Uredi</a>
		  <a class="btn btn-danger" href="/stomatologija/drzava/delete.php?id=<?php echo $row['id']; ?>">Izbrisi</a>
		  </td>
		</tr>
		<?php } ?>
	  </tbody>
	</table>
</div>


<?php
echo $footer;
?>

