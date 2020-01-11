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
	<a href="/stomatologija/ordinacija/form.php" class="btn btn-primary mt-3 mb-3 float-right">Add</a>
	<table class="table">
	  <thead>
		<tr>
		  <th scope="col">id</th>
		  <th scope="col">ordination_name</th>
		  <th scope="col">city_id</th>
		</tr>
	  </thead>
	  <tbody>
		<?php foreach($rows as $row) { ?>
		<tr>
		  <th scope="row"><?php echo $row['id']; ?></th>
		  <td><?php echo $row['ordination_name']; ?></td>
		  <td><?php echo $row['city_id']; ?></td>

		  <td>
		  <a class="btn btn-primary" href="/stomatologija/ordinacija/form.php?id=<?php echo $row['id']; ?>">Puce Edit</a>
		  <a class="btn btn-danger" href="/stomatologija/ordinacija/delete.php?id=<?php echo $row['id']; ?>">Puce Delete</a>
		  </td>
		</tr>
		<?php } ?>
	  </tbody>
	</table>
</div>


<?php
echo $footer;
?>

