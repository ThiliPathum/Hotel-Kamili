<!DOCTYPE html>
<?php 
    session_start();
    $message = "";
    $msg = "";
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
    }

    if(isset($_SESSION['msg'])){
        $msg = $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="png" href="../Assests/cropped-kamili-Copy-1.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/login.css">
    <title>Login & Registration</title>
</head>
<body>
 <div class="wrapper">
    <nav class="nav">
        <div class="nav-logo">
            <p><img src="../Assests/cropped-kamili-Copy-1.png" width="100px" height="100px" style="margin-top: 20px;"></p>
        </div>
        <div class="nav-menu" id="navMenu">
            <!--  <ul>
                <li><a href="#" class="link active">Home</a></li>
                <li><a href="#" class="link">Contact Us</a></li>
                <li><a href="#" class="link">Services</a></li>
                <li><a href="#" class="link">About</a></li>
            </ul> -->
        </div> 
        <div class="nav-button">
            <button class="btn white-btn" id="loginBtn" onclick="login()">Sign In</button>
            <button class="btn" id="registerBtn" onclick="register()">Sign Up</button>
        </div>
        <div class="nav-menu-btn">
            <i class="bx bx-menu" onclick="myMenuFunction()"></i>
        </div>
    </nav>

<!----------------------------- Form box ----------------------------------->    
    <div class="form-box">
        
        <!------------------- login form -------------------------->

        <form action="login_process.php" method="POST" class="login-container" id="login">
            <?php 
                if(!empty($msg)){
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $msg; ?>
                    </div>
                    <?php
                }
            ?>
            <div class="top">
                <header>Login</header>
            </div> 
            <div class="input-box">
                <input type="text" class="input-field" placeholder="Username" name="user_name">
                <i class="bx bx-user"></i>
            </div>
            <div class="input-box">
                <input type="password" class="input-field" placeholder="Password" name="password">
                <i class="bx bx-lock-alt"></i>
            </div>
            <div class="two-col">
                <div class="one">
                    <input type="checkbox" id="login-check">
                    <label for="login-check"> Remember Me</label>
                </div>
                <div class="two">
                    <label><a href="forget.php">Forgot password?</a></label>
                </div>
            </div>
            <br>
            <div class="input-box">
                <input type="submit" class="submit" value="Sign In">
            </div>
            <div class="account">
                 <span>Don't have an account? <a href="#" onclick="register()">Sign Up</a></span>
            </div>
             
        </form>


        <!------------------- registration form -------------------------->

        <form action="signup_process.php" method="POST" class="register-container" id="register">
            <?php 
                if(!empty($message)){
                    if($message == 'SUCCESS'){
                        ?>
                        <div class="alert alert-success" role="alert">
                            Your Staff registration was successful!
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
                <header>Sign Up</header>
            </div>
            <div class="two-forms">
                <div class="input-box">
                    <input type="text" class="input-field" placeholder="First name" name="first_name">
                    <i class="bx bx-user"></i>
                </div>
                <div class="input-box">
                    <input type="text" class="input-field" placeholder="Last name" name="last_name">
                    <i class="bx bx-user"></i>
                </div>
            </div>

            
                <div class="input-box">
                    <input type="text" class="input-field" placeholder="National Identity Card" name="nic_no">
                    <i class="bx bx-id-card"></i>
                </div>
                <div class="input-box">
                    <input type="text" class="input-field" placeholder="Contact No" name="contact_no">
                    <i class="bx bx-phone"></i>
                </div>
          

            
            <div class="input-box">
                <input type="text" class="input-field" placeholder="Email" name="email_address">
                <i class="bx bx-envelope"></i>
            </div>
            <div class="input-box">
                <input type="text" class="input-field" placeholder="Username" name="user_name">
                <i class="bx bx-user"></i>
            </div>
            
            <div class="input-box">
                <input type="password" class="input-field" placeholder="Password" name="password">
                <i class="bx bx-lock-alt"></i>
            </div>
            <div class="input-box">
                <input type="submit" class="submit" value="Register">
            </div>
            <div class="account">
               <span>Have an account? <a href="#" onclick="login()">Login</a></span>
            </div>
        </form>
    </div>
</div>   


<script>
   
   function myMenuFunction() {
    var i = document.getElementById("navMenu");

    if(i.className === "nav-menu") {
        i.className += " responsive";
    } else {
        i.className = "nav-menu";
    }
   }
 
</script> 

<script>

    var a = document.getElementById("loginBtn");
    var b = document.getElementById("registerBtn");
    var x = document.getElementById("login");
    var y = document.getElementById("register");

    function login() {
        x.style.left = "4px";
        y.style.right = "-520px";
        a.className += " white-btn";
        b.className = "btn";
        x.style.opacity = 1;
        y.style.opacity = 0;
    }

    function register() {
        x.style.left = "-510px";
        y.style.right = "5px";
        a.className = "btn";
        b.className += " white-btn";
        x.style.opacity = 0;
        y.style.opacity = 1;
    }

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>