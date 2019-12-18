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
	<a href="/stomatologija/grad/form.php" class="btn btn-primary mt-3 mb-3 float-right">Add</a>
	<table class="table">
	  <thead>
		<tr>
		  <th scope="col">Id</th>
		  <th scope="col">Naziv</th>
      	<th scope="col">Drzava_ID</th>
		</tr>
	  </thead>
	  <tbody>
		<?php foreach($rows as $row) { ?>
		<tr>
		  <th scope="row"><?php echo $row['id']; ?></th>
		  <td><?php echo $row['city_name']; ?></td>
		  <td><?php echo $row['country_id']; ?></td>
		  <td>
		  
		  <a class="btn btn-primary" href="/stomatologija/grad/form.php?id=<?php echo $row['id']; ?>">Puce Edit</a>
		  
		  <a class="btn btn-danger" href="/stomatologija/grad/delete.php?id=<?php echo $row['id']; ?>">Puce Delete</a>
		  
		  </td>
		</tr>
		<?php } ?>
	  </tbody>
	</table>
</div>


<?php
echo $footer;
?>

