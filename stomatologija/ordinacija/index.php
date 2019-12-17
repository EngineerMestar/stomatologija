<?php

require('../util/db.php');
require('../frontend/header.php');
require('../frontend/footer.php');

$stmt = $db->query('SELECT * FROM ordinacija');
$rows = $stmt->fetchAll();

echo $header;
?>
<div class="container">
	<table class="table">
	  <thead>
		<tr>
		  <th scope="col">Id</th>
          <th scope="col">Naziv</th>
          <th scope="col">Grad_ID</th>
		</tr>
	  </thead>
	  <tbody>
		<?php foreach($rows as $row) { ?>
		<tr>
		  <th scope="row"><?php echo $row['ID']; ?></th>
		  <td><?php echo $row['Naziv']; ?></td>
          <td><?php echo $row['Grad_ID'];?></td>
		</tr>
		<?php } ?>
	  </tbody>
	</table>
</div>


<?php
echo $footer;
?>

