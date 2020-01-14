<?php

require('./util/session.php');

session_destroy();
header('Location: /stomatologija/login/index.php');
