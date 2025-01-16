
<?php
session_start();

function check_login() {
    if (!isset($_SESSION['staff_id'])) {
        header("Location: unauthorized.php");
        exit();
    }
}
?>
