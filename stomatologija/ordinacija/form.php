<?php

require('../util/db.php');
require('../frontend/header.php');
require('../frontend/footer.php');

// ako postoji ID u URL-u, znači da je uređujemo zapis
$isEditing = isset($_GET['id']);

$stmt = $db->query('SELECT * FROM grad');
$cities = $stmt->fetchAll();

// stisnuo uredivanje
if(isset($_POST['ordination_name']) && is_numeric($_POST['id'])) {
	
	// dohvati podatke sa frontenda
	$ordinationName = $_POST['ordination_name'];
	$ordinationCityID = $_POST['city_id'];
	$ordinationID = $_POST['id'];
	
	// upit na bazu za UPDATE
	$sql = 'UPDATE ordinacija SET ordination_name = :ordination_name, city_id = :city_id WHERE id = :id';
	$stmt = $db->prepare($sql);
	$stmt->execute(['id' => $ordinationID, 'ordination_name' => $ordinationName, 'city_id' => $ordinationCityID]);
	
	
	// redirect
	header('Location: /stomatologija/ordinacija/index.php');

// stisnuo dodavanje
} else if(isset($_POST['ordination_name']) && isset($_POST['id'])) {
	
	// dohvati podatke sa frontenda
	$ordinationName = $_POST['ordination_name'];
	$ordinationCityID = $_POST['city_id'];
	$ordinationID = $_POST['id'];
	
	// upit na bazu i dodavanje
	$sql = 'INSERT INTO ordinacija (id, ordination_name, city_id) VALUES (:id, :ordination_name, :city_id)';
	$stmt = $db->prepare($sql);
	$stmt->execute(['id' => $ordinationID, 'ordination_name' => $ordinationName, 'city_id' => $ordinationCityID]);
	header('Location: /stomatologija/ordinacija/index.php');
}

// ako je uređivanje, potrebno dohvatiti zapis iz baze
// te ga prikazati na frontendu
if($isEditing) {
	$id = $_GET['id']; // dohvaćanje ID-a iz URL-a
	$sql = 'SELECT * FROM ordinacija WHERE id = :id';
	$stmt = $db->prepare($sql);
	$stmt->execute(['id' => $id]);
	$ordination = $stmt->fetch();
}

echo $header;
?>

<div class="container">
	<div class="row">
		<div class="col-sm-6 mx-auto mt-5">
			<form action="/stomatologija/ordinacija/form.php" method="POST">
				<input type="hidden" name="id" value="<?= @$ordination['id'] ?>" />
				<div class="form-group">
					<label for="name">Ime Ordinacije</label>
					<input value="<?= @$ordination['ordination_name'] ?>" name="ordination_name" type="text" class="form-control" id="ordination_name" placeholder="Ime ordinacije">
				</div>
				<div class="form-group">
					<label for="name">Grad</label>
					
					<select name="city_id" class="custom-select">
					<?php foreach($cities as $city) { ?>
						
						<option value="<?php echo $city['id']; ?>"
							<?php if(isset($ordination) && $city['id'] == $ordination['city_id']) echo 'selected'; // select posebnog elementa u dropdownu ?>>
						<?php echo $city['city_name']; ?>
						</option>
						<?php } ?>
					</select>
					</div>
				<button type="submit" class="btn btn-primary">Spremi</button>
			</form>
		
	</div>
</div>
<?php
echo $footer;
?>