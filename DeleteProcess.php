<?php

session_start();
require '../classes/DbConnector.php';
require '../classes/Room.php';
require '../classes/Staff.php';
require '../classes/Reservation.php';

use classes\DbConnector;
use classes\Room;
use classes\Staff;
use classes\Reservation;

$dbConnector = new DbConnector();
$con = $dbConnector->getConnection();
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

include('message.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['deleteItemId']) && isset($_POST['itemType'])) {
        $itemId = $_POST['deleteItemId'];
        $itemType = $_POST['itemType'];
        $reservations = null;

        if (!empty($itemId)) {
            $reservations = Reservation::getAllReservationsByRoomId($con, $itemId);

            if ($reservations != null) {
                $_SESSION['errors'][] = "This room cannot be deleted or cancelled as there are reservations";
            } else {
                // echo "deleted";
                switch ($itemType) {
                    case 'room':
                        if (Room::delete($con, $itemId)) {
                            $_SESSION['message'] = "Room deleted successfully!";
                        } else {
                            $_SESSION['errors'][] = "Failed to delete room.";
                        }
                        break;
                    case 'staff':
                        if (Staff::delete($con, $itemId)) {
                            $_SESSION['message'] = "Staff deleted successfully!";
                        } else {
                            $_SESSION['errors'][] = "Failed to delete staff.";
                        }
                        break;
                    case 'reservation':
                        if (Reservation::delete($con, $itemId)) {
                            $_SESSION['message'] = "Reservation deleted successfully!";
                        } else {
                            $_SESSION['errors'][] = "Failed to delete reservation.";
                        }
                        break;
                    default:
                        $_SESSION['errors'][] = "Invalid item type.";
                        break;
                }
            }
        }

        // switch ($itemType) {
        //     case 'room':
        //         if (Room::delete($con, $itemId)) {
        //             $_SESSION['message'] = "Room deleted successfully!";
        //         } else {
        //             $_SESSION['errors'][] = "Failed to delete room.";
        //         }
        //         break;
        //     case 'staff':
        //         if (Staff::delete($con, $itemId)) {
        //             $_SESSION['message'] = "Staff deleted successfully!";
        //         } else {
        //             $_SESSION['errors'][] = "Failed to delete staff.";
        //         }
        //         break;
        //     case 'reservation':
        //         if (Reservation::delete($con, $itemId)) {
        //             $_SESSION['message'] = "Reservation deleted successfully!";
        //         } else {
        //             $_SESSION['errors'][] = "Failed to delete reservation.";
        //         }
        //         break;
        //     default:
        //         $_SESSION['errors'][] = "Invalid item type.";
        //         break;
        // }
    } else {
        $_SESSION['errors'][] = "Failed to delete item. Required data not received.";
    }
    header('Location: admin.php');
    exit();
}