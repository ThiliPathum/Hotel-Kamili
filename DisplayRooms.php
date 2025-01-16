<?php
session_start();

// Include the necessary files
require_once './classes/DbConnector.php';
require_once './classes/Room.php';
require_once './classes/RoomAmenity.php';
require_once './classes/RoomImages.php';

$message = "";

try {
    // Establish database connection
    $dbConnector = new \classes\DbConnector();
    $con = $dbConnector->getConnection();
} catch (PDOException $exc) {
    // Handle database connection error
    die("Error in DbConnection on DisplayRooms file: " . $exc->getMessage());
}

// Fetch all rooms with their details
$rooms = \classes\Room::getAllRooms($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Rooms</title>
    <style>
        .room {
            border: 1px solid #ccc;
            margin-bottom: 20px;
            padding: 20px;
        }
        .room img {
            max-width: 100px;
            margin-right: 10px;
        }
        .room-details, .room-amenities, .room-images {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>All Rooms</h1>
    <?php if (!empty($rooms)): ?>
        <?php foreach ($rooms as $room): ?>
            <div class="room">
                <div class="room-details">
                    <h2><?php echo htmlspecialchars($room['room_type']); ?></h2>
                    <p>Adults: <?php echo htmlspecialchars($room['adult_count']); ?></p>
                    <p>Children: <?php echo htmlspecialchars($room['children_count']); ?></p>
                    <p>Price per Night: <?php echo htmlspecialchars($room['price_per_night']); ?></p>
                    <p>Number of Rooms: <?php echo htmlspecialchars($room['number_of_rooms']); ?></p>
                    <p>Description: <?php echo htmlspecialchars($room['room_description']); ?></p>
                </div>
                <div class="room-images">
                    <h3>Images</h3>
                    <img src="<?php echo htmlspecialchars($room['room_inside_normal_image']); ?>" alt="Room Inside Normal">
                    <img src="<?php echo htmlspecialchars($room['room_inside_360view_image']); ?>" alt="Room Inside 360 View">
                    <img src="<?php echo htmlspecialchars($room['room_bathroom_360view_image']); ?>" alt="Room Bathroom 360 View">
                    <img src="<?php echo htmlspecialchars($room['room_outdoor_360view_image']); ?>" alt="Room Outdoor 360 View">
                    <?php foreach ($room['images'] as $image): ?>
                        <img src="<?php echo htmlspecialchars($image['image_path']); ?>" alt="Additional Image">
                    <?php endforeach; ?>
                </div>
                <div class="room-amenities">
                    <h3>Amenities</h3>
                    <ul>
                        <?php foreach ($room['amenities'] as $amenity): ?>
                            <li><?php echo htmlspecialchars($amenity['amenity_name']); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No rooms found.</p>
    <?php endif; ?>
</body>
</html>
