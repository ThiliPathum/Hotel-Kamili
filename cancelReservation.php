<?php
session_start();

require '../classes/DbConnector.php';
require '../classes/Reservation.php';

use classes\Reservation;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reservation_id = intval($_POST['reservation_id']);

    $dbConnector = new \classes\DbConnector();
    $con = $dbConnector->getConnection();

    if (Reservation::cancelReservation($con, $reservation_id)) {
        $_SESSION['message'] = "Reservation cancelled successfully!";

    } else {
        $_SESSION['errors'] = "Failed to cancel reservation."; 
    }

} else {
    $_SESSION['errors']= "Invalid request method.";
}

header("Location: Admin.php");
exit;
?>