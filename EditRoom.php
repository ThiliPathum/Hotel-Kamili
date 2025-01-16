<?php
session_start();
require '../classes/DbConnector.php';
require '../classes/Room.php';

use classes\DbConnector;
use classes\Room;

$dbConnector = new DbConnector();
$con = $dbConnector->getConnection();

include('message.php');

if (!isset($_GET['room_id']) || empty($_GET['room_id'])) {
    die("Room ID not provided.");
}

$room_id = $_GET['room_id'];
$room = Room::getRoomById($con, $room_id);

if (!$room) {
    die("Room not found.");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <title>Update Room</title>

    <style>
        body {
            /* background-image: url(images/image1.jpeg); */
            background-color: lightgray;
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            opacity: 0.9;
        }

        .card {
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
                <h4 class="m-0" style="padding: 5px;"><b>Update Room</b></h4>
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
                        <label for="roomType">Room Type:</label>
                        <input type="text" id="roomType" name="roomType" class="form-control" required value="<?php echo htmlspecialchars($room->getRoomType()); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="adultCount">Adult Count:</label>
                        <input type="number" id="adultCount" name="adultCount" class="form-control" required value="<?php echo htmlspecialchars($room->getAdultCount()); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="childrenCount">Children Count:</label>
                        <input type="number" id="childrenCount" name="childrenCount" class="form-control" required value="<?php echo htmlspecialchars($room->getChildrenCount()); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="pricePerNight">Price per Night:</label>
                        <input type="text" id="pricePerNight" name="pricePerNight" class="form-control" required value="<?php echo htmlspecialchars($room->getPricePerNight()); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="roomDescription">Room Description:</label>
                        <input type="text" id="roomDescription" name="roomDescription" class="form-control" required value="<?php echo htmlspecialchars($room->getRoomDescription()); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="numberOfRooms">Number of Rooms:</label>
                        <input type="number" id="numberOfRooms" name="numberOfRooms" class="form-control" required value="<?php echo htmlspecialchars($room->getNumberOfRooms()); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="roomInsideNormalImage">Room Inside Normal Image:</label>
                        <input type="file" id="roomInsideNormalImage" name="roomInsideNormalImage" class="form-control">
                        <img src="<?php echo htmlspecialchars($room->getRoomInsideNormalImage()); ?>" alt="Current Image" style="max-width: 200px; margin-top: 10px;">
                    </div>

                    <div class="mb-3">
                        <label for="roomInside360ViewImage">Room Inside 360 View Image:</label> <label style="color: Orange;">Upload a 3D panoramic image for a better view! </label>
                        <input type="file" id="roomInside360ViewImage" name="roomInside360ViewImage" class="form-control" title="Please upload 3D penaromic image for 3D view">
                        <img src="<?php echo htmlspecialchars($room->getRoomInside360ViewImage()); ?>" alt="Current Image" style="max-width: 200px; margin-top: 10px;">
                    </div>

                    <div class="mb-3">
                        <label for="roomBathroom360ViewImage">Room Bathroom 360 View Image:</label><label style="color: Orange;">Upload a 3D panoramic image for a better view! </label>
                        <input type="file" id="roomBathroom360ViewImage" name="roomBathroom360ViewImage" class="form-control">
                        <img src="<?php echo htmlspecialchars($room->getRoomBathroom360ViewImage()); ?>" alt="Current Image" style="max-width: 200px; margin-top: 10px;">
                    </div>

                    <div class="mb-3">
                        <label for="roomOutdoor360ViewImage">Room Outdoor 360 View Image:</label><label style="color: Orange;">Upload a 3D panoramic image for a better view! </label>
                        <input type="file" id="roomOutdoor360ViewImage" name="roomOutdoor360ViewImage" class="form-control">
                        <img src="<?php echo htmlspecialchars($room->getRoomOutdoor360ViewImage()); ?>" alt="Current Image" style="max-width: 200px; margin-top: 10px;">
                    </div>

                    <input type="hidden" name="room_id" value="<?php echo $room_id; ?>">

                    <div class="mb-3">
                        <button type="submit" name="roomSubmit" class="btn btn-primary" style="background-color: #8d437f; border:none; width: 100%;">Update Room</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

</html>