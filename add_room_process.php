<?php
session_start();

// Include the necessary files
require_once '../classes/DbConnector.php';
require_once '../classes/Room.php';
require_once '../classes/RoomAmenity.php';
require_once '../classes/RoomImages.php';

$message = "";

try {
    // Establish database connection
    $dbConnector = new \classes\DbConnector();
    $con = $dbConnector->getConnection();
} catch (PDOException $exc) {
    // Handle database connection error
    die("Error in DbConnection on add_room_process file: " . $exc->getMessage());
}

// Check if the form is submitted
if (isset($_POST['RoomSubmit'])) {
    if (isset($_POST['roomType'], $_POST['adultCount'], $_POST['childrenCount'], $_POST['roomDescription'], $_POST['pricePerNight'], $_POST['numberOfRooms'])) {
        if (!empty($_POST['roomType']) && !empty($_POST['adultCount']) && !empty($_POST['childrenCount']) && !empty($_POST['roomDescription']) && !empty($_POST['pricePerNight']) && !empty($_POST['numberOfRooms'])) {
            // Retrieve form data
            $roomType = $_POST['roomType'];
            $adultCount = $_POST['adultCount'];
            $childrenCount = $_POST['childrenCount'];
            $pricePerNight = $_POST['pricePerNight'];
            $roomDescription = $_POST['roomDescription'];
            $numberOfRooms = $_POST['numberOfRooms'];
            $roomInsideNormalImage = $_FILES['roomInsideImageUpload']['name'];
            $roomInside360ViewImage = $_FILES['roomInside360ImageUpload']['name'];
            $roomBathroom360ViewImage = $_FILES['bathroom360ImageUpload']['name'];
            $roomOutdoor360ViewImage = $_FILES['outdoor360ImageUpload']['name'];
            $amenities = $_POST['amenities'];
            $additionalPhotos = $_FILES['additionalPhotos'];

            // Upload images and store their paths
            $imageUploadPath = "../uploads/";
            $roomInsideNormalImagePath = $imageUploadPath . basename($roomInsideNormalImage);
            move_uploaded_file($_FILES["roomInsideImageUpload"]["tmp_name"], $roomInsideNormalImagePath);

            $roomInside360ViewImagePath = $imageUploadPath . basename($roomInside360ViewImage);
            move_uploaded_file($_FILES["roomInside360ImageUpload"]["tmp_name"], $roomInside360ViewImagePath);

            $roomBathroom360ViewImagePath = $imageUploadPath . basename($roomBathroom360ViewImage);
            move_uploaded_file($_FILES["bathroom360ImageUpload"]["tmp_name"], $roomBathroom360ViewImagePath);

            $roomOutdoor360ViewImagePath = $imageUploadPath . basename($roomOutdoor360ViewImage);
            move_uploaded_file($_FILES["outdoor360ImageUpload"]["tmp_name"], $roomOutdoor360ViewImagePath);

            // Create a new Room instance
            $room = new \classes\Room($roomType, $adultCount, $childrenCount, $pricePerNight, $roomDescription, $numberOfRooms, $roomInsideNormalImagePath, $roomInside360ViewImagePath, $roomBathroom360ViewImagePath, $roomOutdoor360ViewImagePath);
            $room->setCreatedBy($_SESSION['staff_id']);

            // Save room details to the database
            $roomId = $room->create($con);

            // Save amenities to the database
            if ($roomId && !empty($amenities)) {
                foreach ($amenities as $amenity) {
                    $roomAmenity = new \classes\RoomAmenity($roomId, $amenity);
                    $roomAmenity->setCreatedBy($_SESSION['staff_id']);
                    $roomAmenity->create($con);
                }
            }

            // Save additional photos to the database
            if ($roomId && !empty($additionalPhotos['name'][0])) {
                foreach ($additionalPhotos['name'] as $key => $additionalPhoto) {
                    $additionalPhotoPath = $imageUploadPath . basename($additionalPhotos['name'][$key]);
                    move_uploaded_file($additionalPhotos['tmp_name'][$key], $additionalPhotoPath);
                    
                    $roomImages = new \classes\RoomImages($roomId, $additionalPhotoPath);
                    $roomImages->setCreatedBy($_SESSION['staff_id']);
                    $roomImages->create($con);
                }
            }

            $_SESSION['message'] = "Room added Successfully";
        } else {
            $_SESSION['message'] = "Required fields are empty";
        }
    } else {
        $_SESSION['message'] = "Data not received from the form";
    }
} else {
    $_SESSION['message'] = "Something went wrong, Try Again!";
}

header("Location:AddRoom.php");
exit();
?>