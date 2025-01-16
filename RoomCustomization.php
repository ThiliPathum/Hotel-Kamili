<!DOCTYPE html>

<?php
session_start();
ob_start();


use classes\CakeOptions;

require_once './classes/DbConnector.php';
require_once './classes/EventTypes.php';
require_once './classes/DecorationOptions.php';
require_once './classes/CakeOptions.php';

$message = "";

try {
    // Establish database connection
    $dbConnector = new \classes\DbConnector();
    $con = $dbConnector->getConnection();
} catch (PDOException $exc) {
    // Handle database connection error
    die("Error in DbConnection on DisplayRooms file: " . $exc->getMessage());
}

// Fetch all EventType
$eventTypes = EventTypes::getAllEventType($con);

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking-Kamili Beach Resort</title>
    <link rel="icon" href="images/picture_1.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="./CSS/form.css">
    <link rel="stylesheet" href="/CSS/booking.css">
    <link rel="stylesheet" href="/CSS/payment.css">
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" href="./Footer/footer.css">
    <link rel="stylesheet" href="./CSS/customization.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://js.stripe.com/v2/"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-creditcardvalidator/1.0.0/jquery.creditCardValidator.js"></script>


</head>

<body>
    <style>
        /* Modal styling */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 20% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 40%;
            /* Set modal width to 40% */
            border-radius: 10px;
            /* Optional: Adding some rounding to the modal */
        }

        /* Header Style */
        #customizationModal h4 {
            text-align: center;
            /* Center the header text */
        }

        #customizationModal h6 {
            text-align: center;
            /* Center the header text */
        }

        /* Button Alignment */
        #btnalign {
            display: flex;
            /* Use flexbox for alignment */
            justify-content: center;
            /* Center the buttons */
            margin-top: 20px;
            /* Space above buttons */
        }

        #btnalign button {
            background-color: #4CAF50;
            /* Green */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 0 10px;
            /* Margin around buttons */
        }

        #btnalign button:hover {
            background-color: #45a049;
        }

        /* Close Button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    <?php
    require './NavBar/navbar.php';
    ?>


    <form action="RoomCustomization.php" method="POST" enctype="multipart/form-data">

        <?php
        $eventId = "";
        ?>

        <!-- Event Type Dropdown -->
        <!-- <form method="POST" action="RoomCustomization.php"> -->
        <label for="event_type">Event Type:</label>
        <select name="event_type" id="event_type" onchange="this.form.submit()">
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event_type'])) {
                $eventId = $_POST['event_type'];
                $event = EventTypes::getEventNameById($con, $eventId)
            ?>
                <option value="<?php echo $eventId; ?>" disabled selected><?php echo htmlspecialchars($event); ?></option>
            <?php
            } else {
            ?>
                <option value="" disabled selected>Select Event Type</option>
            <?php
            }
            foreach ($eventTypes as $eventType) {
                // Correcting double dollar sign
                $eventId = $eventType['event_type_id'];
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event_type'])) {
                    if ($_POST['event_type'] == $eventId) {
                        $_SESSION['event_type'] = $_POST['event_type'];
                        continue;
                    }
                }
            ?>
                <option value="<?php echo $eventId; ?>"><?php echo htmlspecialchars($eventType['event_name']); ?></option>
            <?php
            }
            ?>
        </select>
        <!-- </form> -->
        <br><br>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event_type'])) {
            $eventId = $_POST['event_type'];

            $decorations = DecorationOptions::getDecorationOptionsByEventTypeID($con, $eventId);
        ?>
            <!-- Decoration Options -->
            <div id="decoration_options">
                <h4><label>Select Your Preferred Room Decoration:</label></h4>
                <div id="birthday_decorations" class="decoration-section">
                    <?php
                    if (!empty($decorations)) {
                        foreach ($decorations as $decoration) {
                    ?>
                            <div class="decoration-option" onclick="selectDecoration(this, '<?php echo $decoration['decoration_id']; ?>')">
                                <img src="<?php echo $decoration['decoration_image']; ?>" alt="<?php echo $decoration['decoration_name']; ?>">
                                <p><?php echo $decoration['decoration_name'] . ' - Rs ' . $decoration['decoration_price']; ?></p>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
                <!-- Hidden input to store the selected decoration ID -->
                <input type="hidden" id="selected_decoration" name="selected_decoration" value="">
            </div>

        <?php
        }
        ?>

        <script>
            function selectDecoration(element, decorationId) {
                // Remove the 'selected' class from all decoration options
                const allOptions = document.querySelectorAll('.decoration-option');
                allOptions.forEach(option => option.classList.remove('selected'));

                // Add the 'selected' class to the clicked option
                element.classList.add('selected');

                // Set the hidden input field with the selected decoration ID
                document.getElementById('selected_decoration').value = decorationId;
            }
        </script>

        <style>
            /* Styling for selected decoration option */
            .decoration-option.selected {
                border: 3px solid #ff9900;
                /* Orange border for selected item */
                border-radius: 5px;
            }
        </style>


        <!-- Theme Color Selection -->
        <label for="theme_color">Choose Theme Color:</label>
        <div id="color_palette" class="color-palette">
            <div class="color-option" style="background-color: #FFFFFF;" data-color="#FFFFFF"></div>
            <div class="color-option" style="background-color: #FF6F61;" data-color="#FF6F61"></div>
            <div class="color-option" style="background-color: #228B22;" data-color="#228B22"></div>
            <div class="color-option" style="background-color: #000000;" data-color="#000000"></div>
            <div class="color-option" style="background-color: #FFD700;" data-color="#FFD700"></div>
            <div class="color-option" style="background-color: #003366;" data-color="#003366"></div>
            <div class="color-option" style="background-color: #A9A9A9;" data-color="#A9A9A9"></div>
            <div class="color-option" style="background-color: #FF1493;" data-color="#FF1493"></div>
        </div>
        <input type="hidden" id="theme_color" name="theme_color" required>

        <br><br>

        <!-- Cake Customization -->
        <label>Do you want to order a cake?</label><br>

        <table>
            <thead></thead>
            <tbody>
                <tr>
                    <td style="padding-right: 40px;"><label for="cake_yes">Yes</label></td>
                    <td><input type="radio" id="cake_yes" name="cake_order" value="yes" onclick="toggleCakeOptions(true)" required></td>
                </tr>
                <tr>
                    <td style="padding-right: 40px;"><label for="cake_no"> No</label></td>
                    <td><input type="radio" id="cake_no" name="cake_order" value="no" onclick="toggleCakeOptions(false)" required></td>
                </tr>
            </tbody>

        </table>
        <br><br>

        <div id="cake_options" style="display: none;">
            <!-- Cake Kg Dropdown -->
            <label for="cake_kg">Weight:</label>
            <select name="cake_kg" id="cake_kg">
                <option value="" disabled selected>Choose</option>
                <option value="1">1 kg</option>
                <option value="1.5">1.5 kg</option>
                <option value="2">2 kg</option>
                <option value="2.5">2.5 kg</option>
                <!-- <option value="3">3 kg</option>
                    <option value="4">4 kg</option>
                    <option value="5">5 kg</option>
                    <option value="6">6 kg</option>
                    <option value="7">7 kg</option> -->
            </select>
            <br><br>

            <?php
            $cakeOptions = CakeOptions::getAllCakeOptions($con);
            ?>

            <!-- Cake Type Dropdown -->
            <label for="cake_type">Popular Cakes:</label>
            <select name="cake_type" id="cake_type">
                <option value="" disabled selected>Choose yours</option>
                <?php
                if (!empty($cakeOptions)) {
                    foreach ($cakeOptions as $cakeOption) {
                ?>
                        <option value="<?php echo $cakeOption['cake_option_id']; ?>">
                            <span style="text-align: left;"><?php echo $cakeOption['cake_type']; ?></span> -
                            <span style="text-align: right;"><?php echo $cakeOption['cake_price']; ?> per Kg</span>
                        </option>
                <?php
                    }
                }
                ?>
            </select>
            <br><br>

            <label for="cake_message">Custom wording on Cake:</label>
            <input type="text" id="cake_message" name="cake_message" placeholder="Enter cake message">
            <br><br>

            <!-- Optional Cake Design Upload -->
            <!-- Input for cake image upload -->
            <label for="cake_design">Upload any Preferred Cake Image (Optional)</label>
            <input type="file" id="cake_design" name="cake_design" accept="image/*">
            <br><br>
        </div>

        <!-- Customization Suggestions -->
        <label for="suggestions">Requests:</label><br>
        <textarea id="suggestions" name="suggestions" rows="4" cols="50" placeholder="Enter your suggestions"></textarea>
        <br><br>

        <input type="submit" value="Submit Customization">
    </form>

    <script>
        function toggleCakeOptions(show) {
            document.getElementById('cake_options').style.display = show ? 'block' : 'none';
        }
    </script>

    <script>
        const colorOptions = document.querySelectorAll('.color-option');
        const themeColorInput = document.getElementById('theme_color');

        colorOptions.forEach(option => {
            option.addEventListener('click', () => {
                // Remove existing selected class
                colorOptions.forEach(opt => opt.style.border = '2px solid transparent');
                // Highlight selected color
                option.style.border = '2px solid #000';
                // Update hidden input with selected color
                themeColorInput.value = option.dataset.color;
            });
        });
    </script>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['event_type'])) {
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_POST['event_type'])) {

        // Retrieve and sanitize form data
        $event_type = $eventId;
        $selected_decoration = isset($_POST['selected_decoration']) ? intval($_POST['selected_decoration']) : null;
        $theme_color = isset($_POST['theme_color']) ? htmlspecialchars($_POST['theme_color']) : null;
        $cake_order = isset($_POST['cake_order']) ? htmlspecialchars($_POST['cake_order']) : null;
        $cake_kg = isset($_POST['cake_kg']) ? floatval($_POST['cake_kg']) : null;
        $cake_type = isset($_POST['cake_type']) ? intval($_POST['cake_type']) : null;
        $cake_message = isset($_POST['cake_message']) ? htmlspecialchars($_POST['cake_message']) : null;
        $suggestions = isset($_POST['suggestions']) ? htmlspecialchars($_POST['suggestions']) : null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle the file upload
            if (isset($_FILES['cake_design']) && $_FILES['cake_design']['error'] === UPLOAD_ERR_OK) {

                $fileTmpPath = $_FILES['cake_design']['tmp_name'];
                $fileName = $_FILES['cake_design']['name'];
                $fileSize = $_FILES['cake_design']['size'];
                $fileType = $_FILES['cake_design']['type'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));

                // Define allowed file extensions
                $allowedfileExtensions = ['jpg', 'jpeg', 'png', 'gif'];

                // Check if the file has an allowed extension
                if (in_array($fileExtension, $allowedfileExtensions)) {
                    // Set the upload path for the file (e.g., to an 'uploads' directory)
                    $uploadFileDir = './uploads/';
                    $dest_path = $uploadFileDir . $fileName;

                    // Move the file to the specified directory
                    if (move_uploaded_file($fileTmpPath, $dest_path)) {
                        $_SESSION['dest_path'] = $dest_path;
                        // echo 'File is successfully uploaded: ' . $dest_path;
                    } else {
                        // echo 'There was some error moving the file to the upload directory.';
                        $_SESSION['dest_path'] = null;
                    }
                    // $_SESSION['fileTmpPath'] = $fileTmpPath;
                    // $_SESSION['dest_path'] = $dest_path;

                } else {
                    // echo 'Upload failed. Allowed file types: ' . implode(',', $allowedfileExtensions);
                }
            } else {
                // echo 'No file uploaded or an error occurred.';
            }
        }

        $_SESSION['selected_decoration'] = $selected_decoration;
        $_SESSION['theme_color'] = $theme_color;
        $_SESSION['cake_order'] = $cake_order;
        $_SESSION['cake_kg'] = $cake_kg;
        $_SESSION['cake_type'] = $cake_type;
        $_SESSION['cake_message'] = $cake_message;
        $_SESSION['suggestions'] = $suggestions;

        $decoration_price = DecorationOptions::getDecorationPriceByDecorationId($con, $selected_decoration);
        // echo $decoration_price;

        $total_decoration_price = 0;

        if ($cake_order == 'yes') {
            $cake_unit_price = CakeOptions::getCakePriceByCakeOptionId($con, $cake_type);
            $total_cake_price = $cake_unit_price * $cake_kg;
            $total_decoration_price = $decoration_price + $total_cake_price;
        } else {
            $total_decoration_price = $decoration_price;
        }

        // echo $total_decoration_price;

        $_SESSION['total_decoration_price'] = $total_decoration_price;

        header("Location: " . $_SERVER['PHP_SELF'] . "?form_submitted=1");
    }
    ?>
    <!-- Modal -->
    <div id="customizationModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h4>Your Total Customization Price is : Rs <?php echo $_SESSION['total_decoration_price']; ?></h4>
            <br>
            <h6>This amount will added with your total Billing process</h6>
            <div id="btnalign">
                <button id="continueButton">Continue</button>
            </div>
        </div>
    </div>

    <script>
        // Function to check if 'form_submitted' parameter exists in the URL
        function checkIfFormSubmitted() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('form_submitted') === '1') {
                // Show the modal if form_submitted=1
                document.getElementById('customizationModal').style.display = 'block';
            }
        }

        // Close modal functionality
        document.querySelector('.close').onclick = function() {
            document.getElementById('customizationModal').style.display = 'none';
        };

        // Redirect to reservation-form.php when the continue button is clicked
        document.getElementById('continueButton').onclick = function() {
            window.location.href = 'reservation-form.php'; // Redirect to reservation-form.php
        };

        // Run the function when the page loads
        window.onload = checkIfFormSubmitted;
    </script>


    <?php
    require './Footer/footer.php';
    ?>
</body>

</html>