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


<?php

echo $footer;

?>