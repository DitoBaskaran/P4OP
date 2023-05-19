<?php
session_start();

if (isset($_SESSION['data_session'])) {
    session_destroy();
    header('location: login.php');
}

?>