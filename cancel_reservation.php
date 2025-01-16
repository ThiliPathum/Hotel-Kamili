<?php
session_start();
// Include the necessary files
use classes\Reservation;

require_once '../classes/DbConnector.php';
require_once '../classes/Reservation.php';

try {
    // Establish database connection
    $dbConnector = new \classes\DbConnector();
    $con = $dbConnector->getConnection();
} catch (PDOException $exc) {
    // Handle database connection error
    die("Error in DbConnection on filtered_room file: " . $exc->getMessage());
}

// Check if form data is set correctly
if (isset($_POST['CancelReservation'])) {
    if (isset($_POST['cancel_reservation_id']) && isset($_POST['reason'])) {
        $reservationId = $_POST['cancel_reservation_id'];
        $cancellationReason = $_POST['reason'];  // Correct field name

        // Call the function to cancel and move to Cancellation table
        $result = Reservation::cancelAndMoveToCancellation($con, $id, $reservationId, $cancellationReason);

        if ($result) {
            $_SESSION['message'] = "Reservation successfully canceled and moved to the Cancellation table.";
        } else {
            $_SESSION['message'] = "Failed to cancel reservation.";
        }
    }
} else {
    $_SESSION['message'] = "Form data missing.";
}

header("Location: Admin.php");
exit;
