<?php
session_start();
unset($_SESSION['autenticado']);
session_destroy();
header('Location: store.php');
exit;
