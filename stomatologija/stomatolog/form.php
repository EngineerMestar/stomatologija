<?php

require('../util/db.php');
require('../frontend/header.php');
require('../frontend/footer.php');

// ako postoji ID u URL-u, znači da je uređujemo zapis
$isEditing = isset($_GET['id']);

$stmt = $db->query('SELECT * FROM ordinacija');
$ordinations = $stmt->fetchAll();

// stisnuo uredivanje
if(isset($_POST['oib']) && is_numeric($_POST['id'])) {
	
	// dohvati podatke sa frontenda
	$stomatologName = $_POST['first_name'];
	$stomatologLName = $_POST['last_name'];
	$stomatologId = $_POST['id'];
	$stomatologOIB = $_POST['oib'];
	$ordination_ID = $_POST['ordination_id'];

	
	// upit na bazu za UPDATE
	$sql = 'UPDATE stomatolog SET oib = :oib, first_name = :first_name, last_name = :last_name, ordination_id = :ordination_id WHERE id = :id';
	$stmt = $db->prepare($sql);
	$stmt->execute(['id' => $stomatologId, 'oib' => $stomatologOIB, 'first_name' => $stomatologName, 'last_name' => $stomatologLName, 'ordination_id' => $ordination_ID]);
	
	// redirect
	header('Location: /stomatologija/stomatolog/index.php');

// stisnuo dodavanje
} else if(isset($_POST['first_name']) && isset($_POST['id'])) {
	
	// dohvati podatke sa frontenda
	$stomatologName = $_POST['first_name'];
	$stomatologLName = $_POST['last_name'];
	$stomatologId = $_POST['id'];
	$stomatologOIB = $_POST['oib'];
	$ordination_ID = $_POST['ordination_id'];
	
	// upit na bazu i dodavanje
	$sql = 'INSERT INTO stomatolog (id, oib, first_name, last_name, ordination_id) VALUES (:id, :oib, :first_name, :last_name, :ordination_id)';
	$stmt = $db->prepare($sql);
	$stmt->execute(['id' => $stomatologId, 'oib' => $stomatologOIB, 'first_name' => $stomatologName, 'last_name' => $stomatologLName, 'ordination_id' => $ordination_ID]);
	header('Location: /stomatologija/stomatolog/index.php');
}

// ako je uređivanje, potrebno dohvatiti zapis iz baze
// te ga prikazati na frontendu
if($isEditing) {
	$id = $_GET['id']; // dohvaćanje ID-a iz URL-a
	$sql = 'SELECT * FROM stomatolog WHERE id = :id';
	$stmt = $db->prepare($sql);
	$stmt->execute(['id' => $id]);
	$stomatolog = $stmt->fetch();
}

echo $header;
?>

<div class="container">
	<div class="row">
		<div class="col-sm-6 mx-auto mt-5">
			<form action="/stomatologija/stomatolog/form.php" method="POST">
				<input type="hidden" name="id" value="<?= @$stomatolog['id'] ?>" />
				<div class="form-group">
					<label for="oib">OIB</label>
					<input value="<?= @$stomatolog['oib'] ?>" name="oib" type="text" class="form-control" id="oib" placeholder="123456789">
				</div>
				<div class="form-group">
					<label for="first_name">Ime</label>
					<input value="<?= @$stomatolog['first_name'] ?>" name="first_name" type="text" class="form-control" id="first_name" placeholder="Ime">
				</div>
				<div class="form-group">
					<label for="last_name">Prezime</label>
					<input value="<?= @$stomatolog['last_name'] ?>" name="last_name" type="text" class="form-control" id="last_name" placeholder="Prezime">
				</div>
				<div class="form-group">
					<label for="name">Ordinacija</label>
					<select name="ordination_id" class="custom-select">
					<?php foreach($ordinations as $ordination) { ?>
						<option value="<?php echo $ordination['id']; ?>"
							<?php if(isset($stomatolog) && $ordination['id'] == $stomatolog['ordination_id']) echo 'selected'; // select posebnog elementa u dropdownu ?>>
						<?php echo $ordination['ordination_name']; ?>
						</option>
					<?php } ?>
					</select>
				</div>
				<button type="submit" class="btn btn-primary">Spremi</button>
			</form>
		</div>
	</div>
</div>
<?php
echo $footer;
?>

