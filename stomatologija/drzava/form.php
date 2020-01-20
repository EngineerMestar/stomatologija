<?php

require('../util/db.php');
require('../frontend/header.php');
require('../frontend/footer.php');

// ako postoji ID u URL-u, znači da je uređujemo zapis
$isEditing = isset($_GET['id']);

// dohvati kontinente koje će biti u dropdownu
$stmt = $db->query('SELECT * FROM kontinent');
$continents = $stmt->fetchAll();

// stisnuo uredivanje
if(isset($_POST['name']) && is_numeric($_POST['id'])) {
	
	// dohvati podatke sa frontenda
	$countryName = $_POST['name'];
	$countryId = $_POST['id'];
	$continentId = $_POST['continent_id'];
	
	// upit na bazu za UPDATE
	$sql = 'UPDATE drzava SET country_name = :name, continent_id = :continent_name WHERE id = :id';
	$stmt = $db->prepare($sql);
	$stmt->execute(['name' => $countryName, 'continent_id' => $continentId, 'id' => $countryId]);
	
	// redirect
	header('Location: /stomatologija/drzava/index.php');

// stisnuo dodavanje
} else if(isset($_POST['name']) && isset($_POST['continent_id'])) {
	
	// dohvati podatke sa frontenda
	$countryName = $_POST['name'];
	$continentId = $_POST['continent_id'];
	
	// upit na bazu i dodavanje
	$sql = 'INSERT INTO drzava (country_name, continent_id) VALUES (:name, :continent_id)';
	$stmt = $db->prepare($sql);
	$stmt->execute(['name' => $countryName, 'continent_id' => $continentId]);
	header('Location: /stomatologija/drzava/index.php');
}

// ako je uređivanje, potrebno dohvatiti zapis iz baze
// te ga prikazati na frontendu
if($isEditing) {
	$id = $_GET['id']; // dohvaćanje ID-a iz URL-a
	$sql = 'SELECT * FROM drzava WHERE id = :id';
	$stmt = $db->prepare($sql);
	$stmt->execute(['id' => $id]);
	$country = $stmt->fetch();
}

echo $header;
?>

<div class="container">
	<div class="row">
		<div class="col-sm-6 mx-auto mt-5">
			<form action="/stomatologija/drzava/form.php" method="POST">
				<input type="hidden" name="id" value="<?= @$country['id'] ?>" />
				<div class="form-group">
					<label for="name">Ime drzave</label>
					<input value="<?= @$country['country_name'] ?>" name="name" type="text" class="form-control" id="name" placeholder="Ime drzave">
				</div>
				<div class="form-group">
					<label for="name">Kontinent</label>
					<select name="continent_id" class="custom-select">
					<?php foreach($continents as $continent) { ?>
						
						<option value="<?php echo $continent['id']; ?>"
							<?php if(isset($country) && $continent['id'] == $country['continent_id']) echo 'selected'; // select posebnog elementa u dropdownu ?>>
						<?php echo $continent['continent_name']; ?>
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

