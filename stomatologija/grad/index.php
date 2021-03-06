<?php

require('../util/session.php');
require('../util/db.php');
require('../frontend/header.php');
require('../frontend/footer.php');

if(!isset($_SESSION['user'])) {
	header('Location: /stomatologija/login/index.php');
}

$stmt = $db->query('SELECT * FROM drzava INNER JOIN grad ON grad.country_id = drzava.id');
$rows = $stmt->fetchAll();


echo $header;
?>
<div class="container">
	<a href="/stomatologija/grad/form.php" class="btn btn-primary mt-3 mb-3 float-right">Dodaj</a>
	<table class="table">
	  <thead class="thead-dark">
		<tr>
		  <th scope="col">ID</th>
		  <th scope="col">Naziv</th>
      	<th scope="col">Drzava ID</th>
		  <th scope="col"></th>
		</tr>
	  </thead>
	  <tbody>
		<?php foreach($rows as $row) { ?>
		<tr>
		  <th scope="row"><?php echo $row['id']; ?></th>
		  <td><?php echo $row['city_name']; ?></td>
		  <td><?php echo $row['country_name']; ?></td>
		  <td>
		  
		  <a class="btn btn-primary" href="/stomatologija/grad/form.php?id=<?php echo $row['id']; ?>">Uredi</a>
		  
		  <a class="btn btn-danger" href="/stomatologija/grad/delete.php?id=<?php echo $row['id']; ?>">Izbrisi</a>
		  
		  </td>
		</tr>
		<?php } ?>
	  </tbody>
	</table>
</div>


<?php
echo $footer;
?>

