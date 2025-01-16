<!DOCTYPE html>
<?php 
    session_start();
    $message = "";
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a Room</title>
</head>
<body>
    <h1>Add a Room</h1>
    <?php 
        if(!empty($message)){
            if($message == 'SUCCESS'){
            ?>
                <div class="alert alert-success" role="alert">
                    Your Room registration was successful!
                </div>
                <?php
                }else{
                ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $message; ?>
                </div>
            <?php
            }             
        }
    ?>
    <form action="add_room_process.php" method="post" enctype="multipart/form-data">
        <!-- Room Details -->
        <h2>Room Details</h2>
        <label for="room_type">Room Type:</label>
        <input type="text" id="room_type" name="room_type" required><br>

        <label for="adult_count">Adult Count:</label>
        <input type="number" id="adult_count" name="adult_count" required><br>

        <label for="children_count">Children Count:</label>
        <input type="number" id="children_count" name="children_count" required><br>

        <label for="price_per_night">Price per Night:</label>
        <input type="number" id="price_per_night" name="price_per_night" required><br>

        <label for="room_description">Room Description:</label>
        <textarea id="room_description" name="room_description" required></textarea><br>

        <label for="number_of_rooms">Number of Rooms:</label>
        <input type="number" id="number_of_rooms" name="number_of_rooms" required><br>

        <label for="room_inside_normal_image">Room Inside Normal Image:</label>
        <input type="file" id="room_inside_normal_image" name="room_inside_normal_image" accept="image/*" required><br>

        <label for="room_inside_360view_image">Room Inside 360 View Image:</label>
        <input type="file" id="room_inside_360view_image" name="room_inside_360view_image" accept="image/*" required><br>

        <label for="room_bathroom_360view_image">Room Bathroom 360 View Image:</label>
        <input type="file" id="room_bathroom_360view_image" name="room_bathroom_360view_image" accept="image/*" required><br>

        <label for="room_outdoor_360view_image">Room Outdoor 360 View Image:</label>
        <input type="file" id="room_outdoor_360view_image" name="room_outdoor_360view_image" accept="image/*" required><br>

        <!-- Amenities -->
        <h2>Amenities</h2>
        <div id="amenities">
            <div>
                <label for="amenity_0">Amenity:</label>
                <input type="text" id="amenity_0" name="amenities[]" required>
            </div>
        </div>
        <button type="button" onclick="addAmenity()">Add Another Amenity</button>

        <!-- Additional Photos -->
        <h2>Additional Photos</h2>
        <div id="additional_photos_section">
            <div>
                <label for="additional_photo_0">Select Image:</label>
                <input type="file" id="additional_photo_0" name="additional_photos[]" accept="image/*" required>
            </div>
        </div>
        <button type="button" onclick="addPhoto()">Add Another Photo</button>

        <br><br><br>
        <button type="submit" name="submit">Create Room</button>
    </form>

    <script>
        function addAmenity() {
            var amenityIndex = document.querySelectorAll('#amenities div').length;
            var newAmenity = `
                <div>
                    <label for="amenity_${amenityIndex}">Amenity:</label>
                    <input type="text" id="amenity_${amenityIndex}" name="amenities[]" required>
                </div>
            `;
            document.getElementById('amenities').insertAdjacentHTML('beforeend', newAmenity);
        }

        function addPhoto() {
            var photoIndex = document.querySelectorAll('#additional_photos_section div').length;
            var newPhoto = `
                <div>
                    <label for="additional_photo_${photoIndex}">Select Image:</label>
                    <input type="file" id="additional_photo_${photoIndex}" name="additional_photos[]" accept="image/*" required>
                </div>
            `;
            document.getElementById('additional_photos_section').insertAdjacentHTML('beforeend', newPhoto);
        }
    </script>
</body>
</html>
