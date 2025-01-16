<?php
session_start();
include('message.php');

require '../classes/DbConnector.php';
require '../classes/Reservation.php';
require_once '../classes/Customer.php';
require_once '../classes/room.php';

use classes\DbConnector;
use classes\Reservation;
use classes\Customer;
use classes\Room;

$dbConnector = new DbConnector();
$con = $dbConnector->getConnection();

include('message.php');

if (!isset($_GET['reservation_id']) || empty($_GET['reservation_id'])) {
    die("Room ID not provided.");
}

$reservation_id = $_GET['reservation_id'];
$reservation = Reservation::getReservationById($con, $reservation_id);

$reservation_id = $_GET['reservation_id'];

// Retrieve reservation details from the database
$ReservationObj = new Reservation(null, null, null, null, null, null, null, null);
$reservation = $ReservationObj->read($con, $reservation_id);

if (!$reservation) {
    die("Reservation not found.");
}

// Retrieve customer details from the database
$customer = Customer::read($con, $reservation['customer_id']);

if (!$customer) {
    die("Customer not found.");
}

// Retrieve customer details from the database
$room = Room::read($con, $reservation['room_id']);

if (!$reservation) {
    die("Room not found.");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Add Reservation</title>
    <style>
        body {
            /* background-image: url(images/image1.jpeg); */
            background-color: lightgray;
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            opacity: 0.9;
        }

        .card{
            box-shadow: 0 0 20px dimgray;
        }

        label {
            font-weight: 600;
        }

        .form-step {
            display: none;
        }

        .form-step-active {
            display: block;
        }
    </style>
</head>

<body>
    <div class="container mt-5 mb-5 w-75 p-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #8d437f; color: white;">
                <h4 class="m-0" style="padding: 5px;"><b> Reservation No: <?php echo htmlspecialchars($reservation['reservation_id']); ?></b></h4>
                <a href="Admin.php" class="btn-close" aria-label="Close"></a>
            </div>

            <div class="card-body">
                <?php if (isset($_SESSION['errors'])) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php foreach ($_SESSION['errors'] as $error) : ?>
                            <p><?php echo $error; ?></p>
                        <?php endforeach; ?>
                    </div>
                    <?php unset($_SESSION['errors']); ?>
                <?php endif; ?>

                <form action="EditProcess.php" method="POST" enctype="multipart/form-data">
                

                    <div class="mb-3">
                        <label for="room">Room Number:</label>
                        <input type="text" id="roomType" name="roomType" class="form-control" required value="<?php echo htmlspecialchars($room['room_id']); ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="customer">Customer Name:</label>
                        <input type="text" id="full_name" name="full_name" class="form-control" required value="<?php echo htmlspecialchars($customer['full_name']); ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="check_in_date">Check In Date:</label>
                        <input type="text" id="check_in_date" name="check_in_date" class="form-control" required value="<?php echo htmlspecialchars($reservation['check_in_date']); ?>" >
                    </div>

                    <div class="mb-3">
                        <label for="check_out_date">Check Out Date:</label>
                        <input type="text" id="check_out_date" name="check_out_date" class="form-control" required value="<?php echo htmlspecialchars($reservation['check_out_date']); ?>" >
                    </div>

                    <div class="mb-3">
                        <label for="number_of_adult">Number of Adult:</label>
                        <input type="text" id="number_of_adult" name="number_of_adult" class="form-control" required value="<?php echo htmlspecialchars($reservation['number_of_adult']); ?>" >
                    </div>

                    <div class="mb-3">
                        <label for="number_of_children">Number of Children:</label>
                        <input type="text" id="number_of_children" name="number_of_children" class="form-control" required value="<?php echo htmlspecialchars($reservation['number_of_children']); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="number_of_room">Number of Rooms:</label>
                        <input type="text" id="number_of_room" name="number_of_room" class="form-control" required value="<?php echo htmlspecialchars($reservation['number_of_room']); ?>" >
                    </div>

                    <div class="mb-3">
                        <label for="total_price">Total Amount:</label>
                        <input type="text" id="total_price" name="total_price" class="form-control" required value="<?php echo htmlspecialchars($reservation['total_price']); ?>">
                    </div>

                    <div class="mb-3">
                                        <label for="payment_status">Payment Status:</label>
                                        <select id="payment_status" name="payment_status" class="form-select" required value="<?php echo htmlspecialchars($reservation['payment_status']); ?>">
                                            <option value="Completed">Completed</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Failed">Failed</option>
                                        </select>
                                    </div>

                    <input type="hidden" name="reservation_id" value="<?php echo $reservation_id; ?>">

                    <div class="mb-3">
                        <button type="submit" name="roomSubmit" class="btn btn-primary" style="background-color: #8d437f; border:none; width: 100%;">Update Reservation</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>