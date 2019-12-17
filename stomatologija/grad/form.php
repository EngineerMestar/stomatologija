<?php

require('../util/db.php');
require('../frontend/header.php');
require('../frontend/footer.php');

// ako postoji ID u URL-u, znači da je uređujemo zapis
$isEditing = isset($_GET['id']);

// dohvati zemlje koje će biti u dropdownu
$stmt = $db->query('SELECT * FROM drzava');
$countries = $stmt->fetchAll();

// stisnuo uredivanje
if(isset($_POST['name']) && is_numeric($_POST['id'])) {
	
	// dohvati podatke sa frontenda
	$cityName = $_POST['name'];
	$cityId = $_POST['id'];
	$countryId = $_POST['country_id'];
	
	// upit na bazu za UPDATE
	$sql = 'UPDATE grad SET city_name = :name, country_id = :country_id WHERE id = :id';
	$stmt = $db->prepare($sql);
	$stmt->execute(['name' => $cityName, 'country_id' => $countryId, 'id' => $cityId]);
	
	// redirect
	header('Location: /stomatologija/grad/index.php');

// stisnuo dodavanje
} else if(isset($_POST['name']) && isset($_POST['country_id'])) {
	
	// dohvati podatke sa frontenda
	$cityName = $_POST['name'];
	$countryId = $_POST['country_id'];
	
	// upit na bazu i dodavanje
	$sql = 'INSERT INTO grad (city_name, country_id) VALUES (:name, :country_id)';
	$stmt = $db->prepare($sql);
	$stmt->execute(['name' => $cityName, 'country_id' => $countryId]);
	header('Location: /stomatologija/grad/index.php');
}

// ako je uređivanje, potrebno dohvatiti zapis iz baze
// te ga prikazati na frontendu
if($isEditing) {
	$id = $_GET['id']; // dohvaćanje ID-a iz URL-a
	$sql = 'SELECT * FROM grad WHERE id = :id';
	$stmt = $db->prepare($sql);
	$stmt->execute(['id' => $id]);
	$city = $stmt->fetch();
}

echo $header;
?>

<div class="container">
	<div class="row">
		<div class="col-sm-6 mx-auto mt-5">
			<form action="/stomatologija/grad/form.php" method="POST">
				<input type="hidden" name="id" value="<?= @$city['id'] ?>" />
				<div class="form-group">
					<label for="name">City name</label>
					<input value="<?= @$city['city_name'] ?>" name="name" type="text" class="form-control" id="name" placeholder="Zagreb">
				</div>
				<div class="form-group">
					<label for="name">Country</label>
					
					<select name="country_id" class="custom-select">
					<?php foreach($countries as $country) { ?>
						
						<option value="<?php echo $country['id']; ?>"
							<?php if(isset($city) && $country['id'] == $city['country_id']) echo 'selected'; // select posebnog elementa u dropdownu ?>
						>
						<?php echo $country['country_name']; ?>
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

