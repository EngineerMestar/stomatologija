<?php

require('../util/db.php');
require('../frontend/header.php');
require('../frontend/footer.php');

// ako postoji ID u URL-u, znači da je uređujemo zapis
$isEditing = isset($_GET['id']);

// dohvati ordinacije koje će biti u dropdownu
$stmt = $db->query('SELECT * FROM ordinacija');
$ordinations = $stmt->fetchAll();

// stisnuo uredivanje
if(isset($_POST['oib']) && is_numeric($_POST['id'])) {
	
	// dohvati podatke sa frontenda
	$patientFname = $_POST['first_name'];
	$patientLname = $_POST['last_name'];
	$patientOib = $_POST['oib'];
	$patientId = $_POST['id'];
	$ordinationId = $_POST['ordination_id'];
	
	// upit na bazu za UPDATE
	$sql = 'UPDATE pacijent SET oib = :oib, first_name = :first_name, last_name = :last_name, ordination_id = :ordination_id WHERE id = :id';
	$stmt = $db->prepare($sql);
	$stmt->execute(['oib' => $patientOib, 'first_name' => $patientFname, 'last_name' => $patientLname, 'id' => $patientId]);
	
	// redirect
	header('Location: /stomatologija/pacijent/index.php');

// stisnuo dodavanje
} else if(isset($_POST['oib']) && isset($_POST['first_name'])) {
	
	// dohvati podatke sa frontenda
	$patientFname = $_POST['first_name'];
	$patientLname = $_POST['last_name'];
	$patientOib = $_POST['oib'];
	$patientId = $_POST['id'];
	$ordinationId = $_POST['ordination_id'];
	
	// upit na bazu i dodavanje
	$sql = 'INSERT INTO pacijent (id, oib, first_name, last_name, ordination_id ) VALUES (:id, :oib, :first_name, :last_name, :ordination_id)';
	$stmt = $db->prepare($sql);
	$stmt->execute(['id' => $patientId, 'oib' => $patientOib, 'first_name' => $patientFname, 'last_name' => $patientLname, 'ordination_id' => $ordinationId]);
	header('Location: /stomatologija/pacijent/index.php');
}

// ako je uređivanje, potrebno dohvatiti zapis iz baze
// te ga prikazati na frontendu
if($isEditing) {
	$id = $_GET['id']; // dohvaćanje ID-a iz URL-a
	$sql = 'SELECT * FROM pacijent WHERE id = :id';
	$stmt = $db->prepare($sql);
	$stmt->execute(['id' => $id]);
	$patient = $stmt->fetch();
}

echo $header;
?>

<div class="container">
	<div class="row">
		<div class="col-sm-6 mx-auto mt-5">
			<form action="/stomatologija/pacijent/form.php" method="POST">
				<input type="hidden" name="id" value="<?= @$patient['id'] ?>" />
				<div class="form-group">
					<label for="oib">OIB</label>
					<input value="<?= @$patient['oib'] ?>" name="oib" type="text" class="form-control" id="oib" placeholder="">
				</div>
				<div class="form-group">
					<label for="first_name">First Name</label>
					<input value="<?= @$patient['first_name'] ?>" name="first_name" type="text" class="form-control" id="first_name" placeholder="">
				</div>
                <div class="form-group">
					<label for="last_name">Last Name</label>
					<input value="<?= @$patient['last_name'] ?>" name="last_name" type="text" class="form-control" id="last_name" placeholder="">
				</div>

					<select name="ordination_id" class="custom-select">
					<?php foreach($ordinations as $ordination) { ?>
						
						<option value="<?php echo $ordination['id']; ?>"
							<?php if(isset($patient) && $ordination['id'] == $patient['ordination_id']) echo 'selected'; // select posebnog elementa u dropdownu ?>>
						<?php echo $ordination['ordination_name']; ?>
						</option>
					
					<?php } ?>
					</select>
					
				</div>
				<button type="submit" class="btn btn-primary">Save</button>
			</form>
		</div>
	</div>
</div>

<?php
echo $footer;
?>

