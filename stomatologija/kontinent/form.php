<?php

require('../util/db.php');
require('../frontend/header.php');
require('../frontend/footer.php');

// ako postoji ID u URL-u, znači da je uređujemo zapis
$isEditing = isset($_GET['id']);

/*
// dohvati kontinente koje će biti u dropdownu
$stmt = $db->query('SELECT * FROM kontinent');
$continents = $stmt->fetchAll();*/

// stisnuo uredivanje
if(isset($_POST['name']) && is_numeric($_POST['id'])) {
	
	// dohvati podatke sa frontenda
	$continentName = $_POST['name'];
	$continentId = $_POST['id'];
	
	// upit na bazu za UPDATE
	$sql = 'UPDATE kontinent SET continent_name = :name, id = :id WHERE id = :id';
	$stmt = $db->prepare($sql);
	$stmt->execute(['name' => $continentName, 'id' => $continentId]);
	
	// redirect
	header('Location: /stomatologija/kontinent/index.php');

// stisnuo dodavanje
} else if(isset($_POST['name']) && isset($_POST['id'])) {
	
	// dohvati podatke sa frontenda
	$continentName = $_POST['name'];
	$continentId = $_POST['id'];
	
	// upit na bazu i dodavanje
	$sql = 'INSERT INTO kontinent (continent_name, id) VALUES (:name, :id)';
	$stmt = $db->prepare($sql);
	$stmt->execute(['name' => $continentName, 'id' => $continentId]);
	header('Location: /stomatologija/kontinent/index.php');
}

// ako je uređivanje, potrebno dohvatiti zapis iz baze
// te ga prikazati na frontendu
if($isEditing) {
	$id = $_GET['id']; // dohvaćanje ID-a iz URL-a
	$sql = 'SELECT * FROM kontinent WHERE id = :id';
	$stmt = $db->prepare($sql);
	$stmt->execute(['id' => $id]);
	$continent = $stmt->fetch();
}

echo $header;
?>

<div class="container">
	<div class="row">
		<div class="col-sm-6 mx-auto mt-5">
			<form action="/stomatologija/kontinent/form.php" method="POST">
				<input type="hidden" name="id" value="<?= @$continent['id'] ?>" />
				<div class="form-group">
					<label for="name">Ime kontinenta</label>
					<input value="<?= @$continent['continent_name'] ?>" name="name" type="text" class="form-control" id="name" placeholder="Croatia">
				</div>
<!-- 				<div class="form-group">
					<label for="name">Continent</label>
					
					<select name="continent_id" class="custom-select">
					<?php foreach($continents as $continent) { ?>
						
						<option value="<?php echo $continent['id']; ?>"
							<?php if(isset($country) && $continent['id'] == $country['continent_id']) echo 'selected'; // select posebnog elementa u dropdownu ?>>
						<?php echo $continent['continent_name']; ?>
						</option>
					
					<?php } ?>
					</select>
					
				</div> -->
				<button type="submit" class="btn btn-primary">Spremi</button>
			</form>
		</div>
	</div>
</div>

<?php
echo $footer;
?>

