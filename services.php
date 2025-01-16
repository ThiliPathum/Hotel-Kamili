<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="png" href="../Assests/cropped-kamili-Copy-1.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services | Kamili Beach Resort</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="./CSS/services.css">
    <link rel="stylesheet" href="./NavBar/navbar.css">
	<link rel="stylesheet" href="./Footer/footer.css">


</head>
<body>

  
<div class="kamili-navbar">
            <header>
                <div class="content flex_space">
                    <div class="logo">
                        <img src="../Assests/cropped-kamili-Copy-1.png" alt="Image" width="70px" height="70px">
                    </div>

                    <div class="navlinks">
                        <ul id="menulist">
                            <li><a href="./index.php">Home</a></li>
                            <li><a href="./about-us.php">About</a></li>
                            <li><a href="./rooms.php">Rooms</a></li>
                            <li><a href="./services.php">Services</a></li>
                            <!-- <li><a href="#">FAQ</a></li> -->
                            <li><a href="../contact-us.php">Contact</a></li>
                            <li><button onclick="window.location.href='../filterd_room.php'" class="primary-btn" style="padding: 0px 40px;">BOOK NOW</button></li>
                        </ul>
                        <span class="fa fa-bars" onclick="menutoggle()"></span>
                    </div>
                </div>
            </header>

            <script>
                var menulist = document.getElementById('menulist');
                menulist.style.maxHeight = "0px";

                function menutoggle() {
                    if (menulist.style.maxHeight == "0px") {
                        menulist.style.maxHeight = "100vh";
                    } else {
                        menulist.style.maxHeight = "0px";
                    }
                }
            </script>
        </div>

    <br>

    <section>
		<div class="about top container flex left heading" style="align-items: center; margin-left: 500px;">
			<h1>WELCOME</h1>
			<h2 style="margin-left: 110px;">Services</h2>
		</div>
	</section>

        
    <div class="container mt-5">
        <div class="row">
            <!-- Pool -->
            <div class="col-md-4 mb-4">
                <div class="card service-card">
                    <img src="./Assests/pool.jpg" class="card-img-top" alt="Pool">
                    <div class="card-body text-center">
                        <i class="fas fa-swimming-pool service-icon"></i>
                        <h5 class="card-title">The Pool</h5>
                        <p class="card-text">Enjoy a refreshing dip or lounge by our beautiful pool, perfect for a relaxing day under the sun.</p>
                    </div>
                </div>
            </div>
            <!-- Spa -->
            <div class="col-md-4 mb-4">
                <div class="card service-card">
                    <img src="./Assests/spa.jpg" class="card-img-top" alt="Spa">
                    <div class="card-body text-center">
                        <i class="fas fa-spa service-icon"></i>
                        <h5 class="card-title">Ayurvedic Spa</h5>
                        <p class="card-text">Unwind with daily spa treatments at our Ayurvedic spa, where trained therapists rejuvenate your body and mind.</p>
                    </div>
                </div>
            </div>
            <!-- Gym -->
            <div class="col-md-4 mb-4">
                <div class="card service-card">
                    <img src="./Assests/gym.jpg" class="card-img-top" alt="Gym">
                    <div class="card-body text-center">
                        <i class="fas fa-dumbbell service-icon"></i>
                        <h5 class="card-title">The Gym</h5>
                        <p class="card-text">Stay fit with our basic gym facilities or enjoy a run on the beach with fresh air and scenic views.</p>
                    </div>
                </div>
            </div>
            <!-- Souvenir Shop -->
            <div class="col-md-4 mb-4">
                <div class="card service-card">
                    <img src="./Assests/souveni.jpg" class="card-img-top" alt="Souvenir Shop">
                    <div class="card-body text-center">
                        <i class="fas fa-store service-icon"></i>
                        <h5 class="card-title">Souvenir Shop</h5>
                        <p class="card-text">Explore local culture with our range of traditional attire and unique gifts perfect for souvenirs.</p>
                    </div>
                </div>
            </div>
            <!-- Library -->
            <div class="col-md-4 mb-4">
                <div class="card service-card">
                    <img src="./Assests/lib.jpg" class="card-img-top" alt="Library">
                    <div class="card-body text-center">
                        <i class="fas fa-book service-icon"></i>
                        <h5 class="card-title">Library</h5>
                        <p class="card-text">Relax with a book from our library, featuring a variety of topics in multiple languages including French.</p>
                    </div>
                </div>
            </div>
            <!-- Activities -->
            <div class="col-md-4 mb-4">
                <div class="card service-card">
                    <img src="./Assests/game.jpg" class="card-img-top" alt="Activities">
                    <div class="card-body text-center">
                        <i class="fas fa-futbol service-icon"></i>
                        <h5 class="card-title">Games & Activities</h5>
                        <p class="card-text">Enjoy beach volleyball, football, cricket, water polo, mini golf, and croquet during your stay.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--footer-->
<?php
    require './Footer/footer.php';
?>
   
    
  <script src="https://kit.fontawesome.com/032d11eac3.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>