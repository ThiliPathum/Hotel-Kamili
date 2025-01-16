<!DOCTYPE html>
<?php
session_start();

// Include the necessary files
require_once './classes/DbConnector.php';
require_once './classes/Room.php';
require_once './classes/RoomAmenity.php';
require_once './classes/RoomImages.php';

try {
    // Establish database connection
    $dbConnector = new \classes\DbConnector();
    $con = $dbConnector->getConnection();
} catch (PDOException $exc) {
    // Handle database connection error
    die("Error in DbConnection on DisplayRooms file: " . $exc->getMessage());
}

$room_id = $_GET['id'];
$_SESSION['room_id'] = $_GET['id'];

// Fetch single room details by Id
$room = \classes\Room::read($con, $room_id);
$_SESSION['room_type'] = $room['room_type'];

// Fetch room images
$images = \classes\RoomImages::getImagesByRoomId($con, $room_id);

?>

<html>

<head>
    <meta charset="utf-8">
    <title>Deluxe Room - Kamili Beach Resort</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./CSS/delux.css">
    <link rel="stylesheet" href="./NavBar/navbar.css">
    <link rel="stylesheet" href="./Footer/footer.css">
    <script src="JS/deluxe.js"></script>
    <script src="https://kit.fontawesome.com/dbed6b6114.js" crossorigin="anonymous"></script>
    <link rel="icon" href="images/picture_1.png" type="image/png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css"
        integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"
        integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css">
</head>

<body>
    <!--header01-->
    <?php require './NavBar/navbar.php'; ?>
    <!--end of header01-->

    <!-- fullscreen modal -->
    <div id="modal"></div>
    <!-- end of fullscreen modal -->

    <!-- body content  -->
    <section class="services sec-width" id="services">
        <div class="title"></div>
        <div class="services-container">
            <!--Introduction -->
            <article class="service">
                <div class="service-content">
                    <h2><?php echo htmlspecialchars($room['room_type']); ?></h2>
                    <p>
                        <?php echo htmlspecialchars($room['room_description']); ?>
                    </p>
                    <br>
                    <!-- <button type="button" onclick="window.location.href='reservation-form.php'" class="btn">BOOK NOW</button> -->
                    <button type="button" onclick="openCustomizationModal()" class="btn">BOOK NOW</button>
                </div>
            </article>

            <!-- Image -->
            <article class="service">
                <div id="panorama" class="service-content" style="width: 600px; height: 400px;"></div>
            </article>

            <script>
                pannellum.viewer('panorama', {
                    "type": "equirectangular",
                    "panorama": '<?php echo htmlspecialchars($room['room_inside_360view_image']); ?>',
                    "autoLoad": true
                });
            </script>
        </div>
    </section>

    <!--Room Facilities-->
    <section class="rooms sec-width" id="rooms">
        <div class="title"></div>
        <div class="service-content">
            <h2>Rooms Amenties</h2>
            <div class="rooms-container">
                <article class="room">
                    <div class="room-image">
                        <img src="<?php echo htmlspecialchars($room['room_inside_normal_image']); ?>" alt="room image">
                    </div>
                    <div class="room-text">
                        <div class="text">
                            <p>
                            <div class="content">
                                <div class="box flex">
                                    <i class="fas fa-bed"></i>
                                    <span>Queen Size Double Bed</span>
                                </div>
                                <div class="box flex">
                                    <i class="fas fa-wifi"></i>
                                    <span>Free WiFi</span>
                                </div>
                                <div class="box flex">
                                    <i class="fas fa-bath"></i>
                                    <span>Bath Tub</span>
                                </div>
                                <div class="box flex">
                                    <i class="fas fa-toilet-paper"></i>
                                    <span>Complimentry Toiletries</span>
                                </div>
                                <div class="box flex">
                                    <i class="fas fa-tv"></i>
                                    <span>Cable TV</span>
                                </div>
                                <div class="box flex">
                                    <i class="fas fa-coffee"></i>
                                    <span>Tea & Coffee Making Facility</span>
                                </div>
                                <div class="box flex">
                                    <i class="fas fa-shower"></i>
                                    <span>Hot & Cold Water</span>
                                </div>
                                <div class="box flex">
                                    <i class="fas fa-shower"></i>
                                    <span>Rain Shower</span>
                                </div>
                            </div>
                            </p>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="rooms sec-width" id="rooms">
        <div class="containersss">
            <div id="panorama2" class="grid-item" style="width: 600px; height: 400px;"></div>
            <div id="panorama3" class="grid-item" style="width: 600px; height: 400px;"></div>
        </div>
    </section>

    <script>
        pannellum.viewer('panorama2', {
            "type": "equirectangular",
            "panorama": '<?php echo htmlspecialchars($room['room_bathroom_360view_image']); ?>',
            "autoLoad": true
        });
        pannellum.viewer('panorama3', {
            "type": "equirectangular",
            "panorama": '<?php echo htmlspecialchars($room['room_outdoor_360view_image']); ?>',
            "autoLoad": true
        });
    </script>

    <section class="gallary mtop " id="gallary">
        <div class="container">
            <div class="heading_top flex1">
                <br>
                <br>
                <br>
                <div class="owl-carousel owl-theme">
                    <?php foreach ($images as $image): ?>
                        <div class="item">
                            <img src="<?php echo htmlspecialchars($image['image_path']); ?>" alt="Additional Image">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Structure -->
    <div id="customizationModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeCustomizationModal()">&times;</span>
            <h4 style="color: blueviolet;">Celebrating something special?</h4>
            <center><label>Would you like us to arrange any room decorations for you?</label></center>
            <div id="btnalign">
                <button onclick="handleCustomizationResponse(true)">YES</button>
                <button onclick="handleCustomizationResponse(false)">NO</button>
            </div>
        </div>
    </div>

    <br>
    <br>

    <script>
        function openCustomizationModal() {
            document.getElementById("customizationModal").style.display = "block"; // Show modal
        }

        function closeCustomizationModal() {
            document.getElementById("customizationModal").style.display = "none"; // Hide modal
        }

        function handleCustomizationResponse(answer) {
            if (answer) {
                // User clicked YES
                // Redirect to the event customization form
                window.location.href = 'RoomCustomization.php'; // Adjust to your customization form URL
            } else {
                // User clicked NO
                closeCustomizationModal(); // Close the modal
                // You can proceed with the booking process here if needed
                window.location.href = 'reservation-form.php'; // Redirect to the reservation form
            }
        }

        // Close the modal if the user clicks outside of it
        window.onclick = function(event) {
            var modal = document.getElementById("customizationModal");
            if (event.target == modal) {
                closeCustomizationModal();
            }
        };
    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"
        integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2PXrksvCdz+HxA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            items: 4,
            dots: false,
            autoplay: true,
            autoplayTimeout: 2000
        })
    </script>

    <!-- footer -->
    <?php require './Footer/footer.php'; ?>
    <!--end of footer-->
</body>

</html>