<?php 
session_start();
include('message.php'); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <title>Add Room</title>

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
         <?php include('message.php'); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center" style=" background-color:#8d437f;">
                            <h4 class="m-0" style="padding: 5px; color: white"><b>Add Room</b></h4>
                            <a href="Admin.php">
                                <button type="button" class="btn-close" aria-label="Close"></button>
                            </a>
                        </div>

                        <div class="card-body">
                            <form action="add_room_process.php" method="POST" enctype="multipart/form-data">

                                <div class="mb-3">
                                    <label for="roomType">Room Type:</label>
                                    <input type="text" id="roomType" name="roomType" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="adultCount">Adult Count:</label>
                                    <input type="number" id="adultCount" name="adultCount" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="childrenCount">Children Count:</label>
                                    <input type="number" id="childrenCount" name="childrenCount" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="pricePerNight">Price per Night:</label>
                                    <input type="number" id="pricePerNight" name="pricePerNight" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="roomDescription">Room Description:</label>
                                    <input type="text" id="roomDescription" name="roomDescription" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="numberOfRooms">Number of Rooms:</label>
                                    <input type="number" id="numberOfRooms" name="numberOfRooms" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="roomInsideNormalImage">Room Inside Normal Image:</label>
                                    <input type="file" id="roomInsideNormalImage" name="roomInsideImageUpload" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="roomInside360ViewImage">Room Inside 360 View Image:</label> <label style="color: Orange;">Upload a 3D panoramic image for a better view! </label>
                                    <input type="file" id="roomInside360ViewImage" name="roomInside360ImageUpload" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="roomBathroom360ViewImage">Room Bathroom 360 View Image:</label> <label style="color: Orange;">Upload a 3D panoramic image for a better view! </label>
                                    <input type="file" id="roomBathroom360ViewImage" name="bathroom360ImageUpload" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="roomOutdoor360ViewImage">Room Outdoor 360 View Image:</label> <label style="color: Orange;">Upload a 3D panoramic image for a better view! </label>
                                    <input type="file" id="roomOutdoor360ViewImage" name="outdoor360ImageUpload" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="amenities">Amenities:</label>
                                    <div id="amenities">
                                        <div class="d-flex align-items-center mb-2">
                                            <input type="text" id="amenity_0" name="amenities[]" class="form-control" required>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-link text-decoration-none" onclick="addAmenity()">Add</button>
                                </div>

                                <div class="mb-3">
                                    <label for="additionalRoomImages">Additional Room Images:</label>
                                    <div id="additionalPhotosSection">
                                        <div class="d-flex align-items-center mb-2">
                                            <input type="file" id="additional_photo_0" name="additionalPhotos[]" class="form-control" accept="image/*" required>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-link text-decoration-none" onclick="addPhoto()">Add</button>
                                </div>

                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary" style="background-color: #8d437f; border:none; width: 100%;" name="RoomSubmit">Add Room</button>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addAmenity() {
            var amenityIndex = document.querySelectorAll('#amenities input[type="text"]').length;
            var newAmenity = `
                <div class="d-flex align-items-center mb-2">
                    <input type="text" id="amenity_${amenityIndex}" name="amenities[]" class="form-control" required>
                </div>
            `;
            document.getElementById('amenities').insertAdjacentHTML('beforeend', newAmenity);
        }

        function addPhoto() {
            var photoIndex = document.querySelectorAll('#additionalPhotosSection input[type="file"]').length;
            var newPhoto = `
                <div class="d-flex align-items-center mb-2">
                    <input type="file" id="additional_photo_${photoIndex}" name="additionalPhotos[]" class="form-control" accept="image/*" required>
                </div>
            `;
            document.getElementById('additionalPhotosSection').insertAdjacentHTML('beforeend', newPhoto);
        }
    </script>
</body>

</html>