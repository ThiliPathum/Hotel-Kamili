<?php
require_once '../AdminPanel/session_check.php';

session_start();
check_login();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/success.css">
</head>
<body>
    <div class="background-image">
        <div class="container d-flex flex-column justify-content-center align-items-center vh-100 text-center">
            <div class="logo-container">
                <img src="../Assests/cropped-kamili-Copy-1.png" alt="Logo" class="logo">
            </div>
            <div class="contact-container">
                <a href="../contact-us.php" class="btn btn-outline-light">Contact Us</a>
            </div>
            <div class="card p-4">
                <div class="card-body">
                    <i class="lni lni-checkmark-circle success-icon mb-3"></i>
                    <h2 class="card-title mb-3">You Need Permission</h2>
                    <p class="card-text"><b>Currently you have no access to this page.</b></p>
                    <!-- <a href="#" class="btn mt-3">Request Access</a> -->
                    <!-- <br> -->
                    <form action="../AdminPanel/login.php" method="POST">
                        <input type="hidden" name="staff_id" value="<?php echo $_SESSION['staff_id']; ?>">
                        <button type="submit" class="btn mt-3">Sign In</button>
                    </form>
                    
                    <hr>
                   <!-- <a href="../AdminPanel/login.php" style="color: purple; font-size: 18px; text-decoration: none;">Login</a> -->

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="success.js"></script>
</body>
</html>