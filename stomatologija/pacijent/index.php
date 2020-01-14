<?php

require('../util/db.php');
require('../frontend/header.php');
require('../frontend/footer.php');

$stmt = $db->query('SELECT * FROM pacijent');
$rows = $stmt->fetchAll();

echo $header;
?>
<div class="container">
<a href="/stomatologija/pacijent/form.php" class="btn btn-primary mt-3 mb-3 float-right">Dodaj</a>

	<table class="table">
	<thead class="thead-dark">
		<tr>
		  <th scope="col">ID</th>
          <th scope="col">OIB</th>
          <th scope="col">Ime</th>
          <th scope="col">Prezime</th>
          <th scope="col">Ordinacija ID</th>
		  <th scope="col"></th>


		</tr>
	  </thead>
	  <tbody>
		<?php foreach($rows as $row) { ?>
		<tr>
		  <th scope="row"><?php echo $row['id']; ?></th>
		  <td><?php echo $row['oib']; ?></td>
          <td><?php echo $row['first_name'];?></td>
          <td><?php echo $row['last_name'];?></td>
          <td><?php echo $row['ordination_id'];?></td>
		  <td>
		  <a class="btn btn-primary" href="/stomatologija/pacijent/form.php?id=<?php echo $row['id']; ?>">Uredi</a>
		  <a class="btn btn-danger" href="/stomatologija/pacijent/delete.php?id=<?php echo $row['id']; ?>">Izbrisi</a>
		  </td>

		</tr>
		<?php } ?>
	  </tbody>
	</table>
</div>


<?php
echo $footer;
?>

