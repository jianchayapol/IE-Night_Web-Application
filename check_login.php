<?php
if (!isset($_SESSION["cus_user"])) {
    header("refresh: 0; url = login.php");
}
?>