<?php

require('./util/session.php');
require('./frontend/header.php');
require('./frontend/footer.php');

if(!isset($_SESSION['user'])) {
	header('Location: /stomatologija/login/index.php');
	die;
}


echo $header;
?>
<h1>Dobro došli na web aplikaciju "Stomatologija"</h1>

<?php

echo $footer;

?>