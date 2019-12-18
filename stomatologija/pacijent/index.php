<?php

require('../util/db.php');
require('../frontend/header.php');
require('../frontend/footer.php');

$stmt = $db->query('SELECT * FROM ordinacija INNER JOIN pacijent ON pacijent.ordination_id = ordinacija.id');
$rows = $stmt->fetchAll();

echo $header;
?>
<div class="container">
<a href="/stomatologija/pacijent/form.php" class="btn btn-primary mt-3 mb-3 float-right">Add</a>

	<table class="table">
	  <thead>
		<tr>
		  <th scope="col">id</th>
          <th scope="col">oib</th>
          <th scope="col">first_name</th>
          <th scope="col">last_name</th>
          <th scope="col">ordination_id</th>


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
		  <a class="btn btn-primary" href="/stomatologija/pacijent/form.php?id=<?php echo $row['id']; ?>">Puce Edit</a>
		  <a class="btn btn-danger" href="/stomatologija/pacijent/delete.php?id=<?php echo $row['id']; ?>">Puce Delete</a>
		  </td>

		</tr>
		<?php } ?>
	  </tbody>
	</table>
</div>


<?php
echo $footer;
?>

