<!DOCTYPE html>
<?php 
    session_start();

    $paymentMessage = "";

    if (isset($_SESSION['paymentMessage'])) {
        $paymentMessage = $_SESSION['paymentMessage'];
        unset($_SESSION['paymentMessage']);
    }

    use classes\Room;

    require_once './classes/DbConnector.php';
    require_once './classes/Room.php';

    try {
        // Establish database connection
        $dbConnector = new \classes\DbConnector();
        $con = $dbConnector->getConnection();
    } catch (PDOException $exc) {
        // Handle database connection error
        die("Error in DbConnection on filtered_room file: " . $exc->getMessage());
    }

    $availableRoomCount = "";

    if(!empty($_SESSION['check_in_date']) || !empty($_SESSION['check_out_date']) || !empty($_SESSION['guest_count']) || !empty($_SESSION['children_count'])){
        if(!empty($_SESSION['room_id']) || !empty($_SESSION['room_type'])){
            $room_id = $_SESSION['room_id'];
            $room_type = $_SESSION['room_type'];
            unset($_SESSION['room_id']);
            unset($_SESSION['room_type']);
        }
        $check_in_date = $_SESSION['check_in_date'];
        $check_out_date = $_SESSION['check_out_date'];
        $guest_count = $_SESSION['guest_count'];
        $children_count = $_SESSION['children_count'];
        unset($_SESSION['check_in_date']);
        unset($_SESSION['check_out_date']);
        unset($_SESSION['guest_count']);
        unset($_SESSION['children_count']);
    }

 
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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css">
        <link rel="stylesheet" href="./CSS/form.css">
        <link rel="stylesheet" href="/CSS/booking.css">
        <link rel="stylesheet" href="/CSS/payment.css">
        <link rel="stylesheet" href="./Footer/footer.css">
        <link rel="stylesheet" href="../CSS/success.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://js.stripe.com/v2/"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-creditcardvalidator/1.0.0/jquery.creditCardValidator.js"></script>


    </head>
    <body>
        <div class="navbar">
            <img src="./Assests/images/picture_1.png" height=60 width=60 class="companylogo">
        </div>
        <br>
        <br>
        <br> 
        <div class="container d-flex flex-column justify-content-center align-items-center vh-100 text-center" style="margin-top: 100px; margin-bottom: 190px;">
            <div class="card p-4">
                <div class="card-body">
                    <?php 
                        if(isset($paymentMessage)){
                            ?>
                            <i class="fa-solid fa-check" style="font-size: 50px; color: rgb(40, 167, 69);"></i><br><br>
                            <h2 class="card-title mb-3">Your payment is success, Check your mail !</h2>
                            <?php
                        }else{
                            ?>
                            <i class="fa-regular fa-circle-xmark" style="font-size: 50px; color: red;"></i><br><br>
                            <h2 class="card-title mb-3">Your payment is Failed</h2>
                            <?php
                        }
                    ?>
                    <!-- <i class="fa-solid fa-check" style="font-size: 50px; color: rgb(40, 167, 69);"></i>
                    
                    <h2 class="card-title mb-3">Your payment is success, Check your mail !</h2> -->
                    <!-- <p class="card-text"><b>Your information has been successfully saved. We will get back to you soon with the access info.</b></p> -->
                    <a href="./index.php" class="btn mt-3">Home</a>
                </div>
            </div>
        </div>

        <?php
            require './Footer/footer.php';
        ?>

        <script src="./JS/script.js"></script>
        <div id="message" class="error-message"></div>

    </body>
</html>