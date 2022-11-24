<?php
if (!isset($_SESSION["admin_user"])) {
    header("refresh: 0; url = admin_login.php");
}
?>