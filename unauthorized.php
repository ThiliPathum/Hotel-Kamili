<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unauthorized Access</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/success.css">

    <style>
        .warning-icon {
            font-size: 60px;
            color: #FFA500; /* Bright orange color for the warning */
        }
    </style>
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
                <i class="lni lni-warning warning-icon"></i>
                    <h2 class="card-title mb-3">Unauthorized Access</h2>
                    <p class="card-text"><b>You do not have permission to view this page.</b></p>
                    <!-- <a href="#" class="btn mt-3">Request Access</a> -->
                    <!-- <br> -->
                    <form action="request_access.php" method="POST">
                        <input type="hidden" name="staff_id" value="<?php echo $_SESSION['staff_id']; ?>">
                        
                    </form>
                    
                    <hr>
                   <a href="../AdminPanel/login.php" style="color: purple; font-size: 18px; text-decoration: none;">SignIn</a>

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="success.js"></script>
</body>
</html>