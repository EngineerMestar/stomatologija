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
	<a href="/stomatologija/stomatolog/form.php" class="btn btn-primary mt-3 mb-3 float-right">Add</a>
	<table class="table">
	  <thead>
		<tr>
		  <th scope="col">Id</th>
		  <th scope="col">OIB</th>
		  <th scope="col">First Name</th>
		  <th scope="col">Last Name</th>
		</tr>
	  </thead>
	  <tbody>
		<?php foreach($rows as $row) { ?>
		<tr>
		  <th scope="row"><?php echo $row['id']; ?></th>
		  <td><?php echo $row['oib']; ?></td>
		  <td><?php echo $row['first_name']; ?></td>
		  <td><?php echo $row['last_name']; ?></td>

		  <td>
		  <a class="btn btn-primary" href="/stomatologija/stomatolog/form.php?id=<?php echo $row['id']; ?>">Puce Edit</a>
		  <a class="btn btn-danger" href="/stomatologija/stomatolog/delete.php?id=<?php echo $row['id']; ?>">Puce Delete</a>
		  </td>
		</tr>
		<?php } ?>
	  </tbody>
	</table>
</div>


<?php
echo $footer;
?>

