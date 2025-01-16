<?php
session_start();
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
    die("Reservation ID not provided.");
}

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

if (!$customer) {
    die("Customer not found.");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Reservation Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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

                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="customer">Customer Name:</label>
                        <p class="form-control"><?php echo htmlspecialchars($customer['full_name']); ?></p>
                    </div>

                    <div class="mb-3">
                        <label for="room">Room:</label>
                        <p class="form-control"><?php echo htmlspecialchars($room['room_id']); ?></p>
                    </div>

                    <div class="mb-3">
                        <label for="check_in_date">Check In Date:</label>
                        <p class="form-control"><?php echo htmlspecialchars($reservation['check_in_date']); ?></p>
                    </div>

                    <div class="mb-3">
                        <label for="check_out_date">Check Out Date:</label>
                        <p class="form-control"><?php echo htmlspecialchars($reservation['check_out_date']); ?></p>
                    </div>

                    <div class="mb-3">
                        <label for="number_of_children">Number of Children:</label>
                        <p class="form-control"><?php echo htmlspecialchars($reservation['number_of_children']); ?></p>
                    </div>

                    <div class="mb-3">
                        <label for="number_of_adult">Number of Adults:</label>
                        <p class="form-control"><?php echo htmlspecialchars($reservation['number_of_adult']); ?></p>
                    </div>

                    <div class="mb-3">
                        <label for="number_of_room">Number of Rooms:</label>
                        <p class="form-control"><?php echo htmlspecialchars($reservation['number_of_room']); ?></p>
                    </div>

                    <div class="mb-3">
                        <label for="total_price">Total Amount:</label>
                        <p class="form-control"><?php echo htmlspecialchars($reservation['total_price']); ?></p>
                    </div>

                    <div class="mb-3">
                        <label for="payment_status">Payment Status:</label>
                        <p class="form-control"><?php echo htmlspecialchars($reservation['payment_status']); ?></p>
                    </div>

                    <input type="hidden" name="reservation_id" value="<?php echo $reservation_id; ?>">
                </form>
            </div>
        </div>
    </div>
</body>
</html>