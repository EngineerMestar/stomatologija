<?php

require('../util/db.php');
require('../frontend/header.php');
require('../frontend/footer.php');

$stmt = $db->query('SELECT * FROM pacijent');
$rows = $stmt->fetchAll();

echo $header;
?>
<div class="container">
	<table class="table">
	  <thead>
		<tr>
		  <th scope="col">Id</th>
          <th scope="col">OIB</th>
          <th scope="col">Ime</th>
          <th scope="col">Prezime</th>
          <th scope="col">Ordinacija_ID</th>


		</tr>
	  </thead>
	  <tbody>
		<?php foreach($rows as $row) { ?>
		<tr>
		  <th scope="row"><?php echo $row['ID']; ?></th>
		  <td><?php echo $row['OIB']; ?></td>
          <td><?php echo $row['Ime'];?></td>
          <td><?php echo $row['Prezime'];?></td>
          <td><?php echo $row['Ordinacija_ID'];?></td>


		</tr>
		<?php } ?>
	  </tbody>
	</table>
</div>


<?php
echo $footer;
?>

