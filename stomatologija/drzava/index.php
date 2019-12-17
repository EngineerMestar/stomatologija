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
	<a href="/stomatologija/drzava/form.php" class="btn btn-primary mt-3 mb-3 float-right">Add</a>
	<table class="table">
	  <thead>
		<tr>
		  <th scope="col">Id</th>
		  <th scope="col">Country name</th>
		  <th scope="col">Continent id</th>
		  <th>Actions</th>
		</tr>
	  </thead>
	  <tbody>
		<?php foreach($rows as $row) { ?>
		<tr>
		  <th scope="row"><?php echo $row['id']; ?></th>
		  <td><?php echo $row['country_name']; ?></td>
		  <td><?php echo $row['continent_id']; ?></td>
		  <td>
		  <a class="btn btn-primary" href="/stomatologija/drzava/form.php?id=<?php echo $row['id']; ?>">Puce Edit</a>
		  <a class="btn btn-danger" href="/stomatologija/drzava/delete.php?id=<?php echo $row['id']; ?>">Puce Delete</a>
		  </td>
		</tr>
		<?php } ?>
	  </tbody>
	</table>
</div>


<?php
echo $footer;
?>

