<?php
session_start();
// Include the necessary files
use classes\Room;

require_once './classes/DbConnector.php';
require_once './classes/Room.php';
require_once './classes/RoomAmenity.php';
require_once './classes/RoomImages.php';

if(!empty($_GET['res'])){
  $response_status = $_GET['res'];
}

try {
  // Establish database connection
  $dbConnector = new \classes\DbConnector();
  $con = $dbConnector->getConnection();
} catch (PDOException $exc) {
  // Handle database connection error
  die("Error in DbConnection on filtered_room file: " . $exc->getMessage());
}

$availableRoomCount = "";
$rooms = [];

if (isset($_POST['check_in_date']) && isset($_POST['check_out_date']) && isset($_POST['guest_count']) && isset($_POST['children_count'])) {
  $check_in_date = $_POST['check_in_date'];
  $check_out_date = $_POST['check_out_date'];
  $guest_count = $_POST['guest_count'];
  $children_count = $_POST['children_count'];

  // Fetch available rooms based on the filter
  $rooms = Room::filterAvailableRooms($con, $check_in_date, $check_out_date, $guest_count, $children_count);
} else {
  // Fetch all rooms with their details if no filter is applied
  $rooms = \classes\Room::getAllRooms($con);
}

// Fetch all unique room types
$roomTypes = Room::getAllRoomTypes($con);

// Fetch the minimum and maximum room prices
$priceRange = Room::getMinAndMaxRoomPrice($con);

$minPrice = $priceRange['min_price'];
$maxPrice = $priceRange['max_price'];

?>

<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" type="png" href="../Assests/cropped-kamili-Copy-1.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rooms | Kamili Beach Resort</title>
  <link rel="stylesheet" href="./css/home.css">
  <link rel="stylesheet" href="./css/filtered_room.css">
  <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
</head>

<body>
  <?php
  require './NavBar/navbar.php';
  ?>

  <script>
    function toggleFilterPanel() {
      var filterPanel = document.getElementById('filter-panel');
      if (filterPanel.style.display === 'block') {
        filterPanel.style.display = 'none';
      } else {
        filterPanel.style.display = 'block';
      }
    }

    function updatePriceValue(value) {
      document.getElementById('price_value').textContent = 'Rs. ' + value;
    }
  </script>

  <script>
    window.onload = function() {
      var today = new Date();
      var day = ("0" + today.getDate()).slice(-2);
      var month = ("0" + (today.getMonth() + 1)).slice(-2);
      var year = today.getFullYear();
      var todayDate = year + "-" + month + "-" + day;

      document.getElementById("check_in_date").setAttribute("min", todayDate);
      document.getElementById("check_out_date").setAttribute("min", todayDate);
    };
  </script>

  <?php 
    if(!empty($response_status)){
      if($response_status == 1){
        ?>
          <br>
          <br>
          <div style="text-align: center; color: red;">
            <b>Please first filter by your check-in and check-out dates, along with the adult and children count.</b>
          </div>
        <?php
      }
    }
  ?>

  <section class="rooms">
    <div class="container top">
      <div class="heading" style="text-align: center;">
        <h1 style="margin-left: 400px;">EXPLORE</h1>
        <h2>Our Accommodations</h2>
        <p>Exceptional Facilities Provided For You - Accommodations.</p>
      </div>

      <br>
      <br>

      <?php
      if (isset($_POST['check_in_date']) && isset($_POST['check_out_date']) && isset($_POST['guest_count']) && isset($_POST['children_count']) && isset($_POST['room_type']) && isset($_POST['selected_price'])) {
        $_SESSION['check_in_date'] = $_POST['check_in_date'];
        $_SESSION['check_out_date'] = $_POST['check_out_date'];
        $_SESSION['guest_count'] = $_POST['guest_count'];
        $_SESSION['children_count'] = $_POST['children_count'];
        $rooms = Room::filterRooms($con, $_POST['check_in_date'], $_POST['check_out_date'], $_POST['guest_count'], $_POST['children_count'], $_POST['selected_price'], $_POST['room_type']);
      } else {
        if (isset($_POST['room_type']) && isset($_POST['selected_price'])) {
          // echo "Filtering with type and price only";
          $rooms = Room::filterByTypeAndPrice($con, $_POST['room_type'], $_POST['selected_price']);
        }
      }
      ?>


      <div class="content mtop rooms-grid">
        <?php
        if (!empty($rooms)) {
          foreach ($rooms as $room) {
        ?>
            <div class="room-item">
              <div class="image">
                <img src="<?php echo htmlspecialchars($room['room_inside_normal_image']); ?>" alt="Premium Deluxe">
              </div>
              <div class="text">
                <h2><?php echo htmlspecialchars($room['room_type']); ?></h2>
                <!-- <div class="rate flex">
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                  <i class="fa fa-star"></i>
                </div> -->
                <h4 style="text-align: right; color: rgb(255, 0, 255);">
                  <?php
                  $availableRoomCount = Room::findAvailableRoomCount($con, $check_in_date ?? '', $check_out_date ?? '', $room['room_type']);
                  echo htmlspecialchars($availableRoomCount) . " Rooms Available";
                  ?>
                </h4>
                <p>
                <ul type="disk">
                  <?php
                  $amenities_displayed = 0;
                  foreach ($room['amenities'] as $amenity) :
                    if ($amenities_displayed < 3) :
                  ?>
                      <li><?php echo htmlspecialchars($amenity['amenity_name']); ?></li>
                  <?php
                      $amenities_displayed++;
                    endif;
                  endforeach;
                  ?>
                </ul>
                </p>
                <div class="button flex">
                  <?php
                  if (!empty($availableRoomCount)) {
                    if ($availableRoomCount == 0) {
                  ?>
                      <button class="primary-btn" disabled>VIEW MORE</button>
                    <?php
                    } else {
                    ?>
                      <button class="primary-btn" onclick="window.location.href='singleRoom.php?id=<?php echo $room['room_id']; ?>'">VIEW MORE</button>
                    <?php
                    }
                  } else {
                    ?>
                    <button class="primary-btn" onclick="window.location.href='singleRoom.php?id=<?php echo $room['room_id']; ?>'">VIEW MORE</button>
                  <?php
                  }
                  ?>
                  <h3>Rs.<?php echo htmlspecialchars($room['price_per_night']); ?> <span><br> Per Night </span></h3>
                </div>
              </div>
            </div>
          <?php
          }
        } else {
          ?>
          <p>No rooms found.</p>
        <?php
        }
        ?>
      </div>
    </div>
  </section>

  <br>
  <br>
  <br>
  <br>

  <!--------------------------------------------------------------------- Footer --------------------------------------------------------------->

  <?php
  require './Footer/footer.php';
  ?>
</body>

</html>