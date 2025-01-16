<?php
require '../classes/DbConnector.php';
require '../classes/Room.php';
require '../classes/RoomImages.php'; // Include the RoomImages class

use classes\DbConnector;
use classes\Room;

// Initialize database connection
$dbConnector = new DbConnector();
$con = $dbConnector->getConnection();

include('message.php');

// Check if room ID is provided
if (!isset($_GET['room_id']) || empty($_GET['room_id'])) {
    die("Room ID not provided.");
}

$room_id = $_GET['room_id'];

// Fetch room details by ID
$room = Room::getRoomById($con, $room_id);
$roomImages = $room->getImages($con);

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
        .card{
            box-shadow: 0 0 20px dimgray;
        }

        label {
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="addroom-container">
        <div class="container mt-5 mb-5 w-75 p-3 .h-25">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #8d437f; color: white;">
                            <h4 class="m-0" style="padding: 5px"><b> View Room </b></h4>
                            <a href="Admin.php">
                                <button type="button" class="btn-close" aria-label="Close"></button>
                            </a>
                        </div>

                        <div class="card-body">
                            <form action="Adminprocess.php" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="roomType">Room Type:</label>
                                    <p class="form-control"><?php echo htmlspecialchars($room->getRoomType()); ?></p>
                                </div>

                                <div class="mb-3">
                                    <label for="adultCount">Adult Count:</label>
                                    <p class="form-control"><?php echo htmlspecialchars($room->getAdultCount()); ?></p>
                                </div>

                                <div class="mb-3">
                                    <label for="childrenCount">Children Count:</label>
                                    <p class="form-control"><?php echo htmlspecialchars($room->getChildrenCount()); ?></p>
                                </div>

                                <div class="mb-3">
                                    <label for="pricePerNight">Price per Night:</label>
                                    <p class="form-control"><?php echo htmlspecialchars($room->getPricePerNight()); ?></p>
                                </div>

                                <div class="mb-3">
                                    <label for="roomDescription">Room Description:</label>
                                    <p class="form-control"><?php echo htmlspecialchars($room->getRoomDescription()); ?></p>
                                </div>

                                <div class="mb-3">
                                    <label for="numberOfRooms">Number of Rooms:</label>
                                    <p class="form-control"><?php echo htmlspecialchars($room->getNumberOfRooms()); ?></p>
                                </div>

                                <div class="mb-3">
                                    <label for="roomInsideNormalImage">Room Inside Normal Image:</label><br>
                                    <!-- <p class="form-control"><?php echo htmlspecialchars($room->getRoomInsideNormalImage()); ?></p> -->
                                    <img src="<?php echo htmlspecialchars($room->getRoomInsideNormalImage()); ?>" alt="Current Image" style="max-width: 200px; margin-top: 10px;">
                                </div>

                                <div class="mb-3">
                                    <label for="roomInside360ViewImage">Room Inside 360 View Image:</label><br>
                                    <!-- <p class="form-control"><?php echo htmlspecialchars($room->getRoomInside360ViewImage()); ?></p> -->
                                    <img src="<?php echo htmlspecialchars($room->getRoomInside360ViewImage()); ?>" alt="Current Image" style="max-width: 200px; margin-top: 10px;">
                                </div>

                                <div class="mb-3">
                                    <label for="roomBathroom360ViewImage">Room Bathroom 360 View Image:</label><br>
                                    <!-- <p class="form-control"><?php echo htmlspecialchars($room->getRoomBathroom360ViewImage()); ?></p> -->
                                    <img src="<?php echo htmlspecialchars($room->getRoomBathroom360ViewImage()); ?>" alt="Current Image" style="max-width: 200px; margin-top: 10px;">
                                </div>

                                <div class="mb-3">
                                    <label for="roomOutdoor360ViewImage">Room Outdoor 360 View Image:</label><br>
                                    <!-- <p class="form-control"><?php echo htmlspecialchars($room->getRoomOutdoor360ViewImage()); ?></p> -->
                                    <img src="<?php echo htmlspecialchars($room->getRoomOutdoor360ViewImage()); ?>" alt="Current Image" style="max-width: 200px; margin-top: 10px;">
                                </div>

                                <input type="hidden" name="room_id" value="<?php echo htmlspecialchars($room_id); ?>">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>