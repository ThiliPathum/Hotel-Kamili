<!DOCTYPE html>
<?php 
    session_start();
    $message = "";
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
    }
    $token = isset($_GET['token']) ? $_GET['token'] : '';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/login.css">
    <title>Reset Password</title>
</head>
<body>
 <div class="wrapper">
    

<!----------------------------- Form box ----------------------------------->    
    <div class="form-box">
        
        <!-------------------  form -------------------------->

        <form method="post" action="process-reset-password.php" class="login-container" id="login">
            <?php 
                if(!empty($message)){
                    if($message == 'SUCCESS'){
                        ?>
                        <div class="alert alert-success" role="alert">
                            Password updated. You can now login.
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
            <div class="top">
                <header>Reset Password</header>
            </div> 

            <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

            <div class="input-box">
                <input type="password" class="input-field" placeholder="New Password" name="password" required>
                <i class="bx bx-lock-alt"></i>
            </div>

            <div class="input-box">
                <input type="password" class="input-field" placeholder="Confirm Password" name="password_confirmation" required>
                <i class="bx bx-lock-alt"></i>
            </div>
            <br>
            <div class="input-box">
                <input type="submit" class="submit" value="Submit">
            </div>
             <div class="account">
                 <span>Back to the <a href="login.php" >Login</a></span>
            </div> 
             
        </form>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


</body>
</html>