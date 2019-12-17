<?php

require('../util/db.php');
require('../frontend/header.php');
require('../frontend/footer.php');

$stmt = $db->query('SELECT * FROM employees');
$rows = $stmt->fetchAll();

echo $header;
?>
<div class="container">
	<table class="table">
	  <thead>
		<tr>
		  <th scope="col">Id</th>
		  <th scope="col">First name</th>
		  <th scope="col">Last name</th>
		  <th scope="col">VAT</th>
		</tr>
	  </thead>
	  <tbody>
		<?php foreach($rows as $row) { ?>
		<tr>
		  <th scope="row"><?php echo $row['id']; ?></th>
		  <td><?php echo $row['first_name']; ?></td>
		  <td><?= $row['last_name']; ?></td>
		  <td><?= $row['vat_number']; ?></td>
		</tr>
		<?php } ?>
	  </tbody>
	</table>
</div>


<?php
echo $footer;
?>

