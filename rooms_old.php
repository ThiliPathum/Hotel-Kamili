<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Accommodation - Kamili Beach Resort</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/rooms.css">
    <script src="JS/accommodation.js"></script>
    <script src="https://kit.fontawesome.com/dbed6b6114.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"
        integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <link rel="icon" href="images/picture_1.png" type="image/png">
    <link rel="stylesheet" href="./NavBar/navbar.css">
	<link rel="stylesheet" href="./Footer/footer.css">
</head>

<body>

<!-- Header -->
    <?php
      require './NavBar/navbar.php';
    ?>

    <!-- body content  -->

    <section class="rooms sec-width" id="rooms">
        <div class="service-content">
            <!-- <h2>Our Rooms</h2> -->
            <div class="about top container flex left heading">
                <h1>WELCOME</h1>
                <h2>Our Rooms</h2>
            </div>
            <div class="rooms-container">
                <!-- single room -->
                <article class="room">
                    <div class="room-image">
                        <img src="./Assests/images/picture_23.webp" alt="room image">
                    </div>
                    <div class="room-text">
                        <h3>Deluxe Rooms</h3>
                        <p>Experience the epitome of comfort and elegance in our Deluxe Rooms. Thoughtfully designed to
                            provide a serene and luxurious retreat, each room features plush bedding, modern
                            furnishings, and stunning views. Enjoy premium amenities including complimentary high-speed
                            Wi-Fi, a flat-screen TV, a well-stocked minibar, and an en-suite bathroom with a rain shower
                            and designer toiletries. Unwind in your private balcony or terrace, perfect for soaking up
                            the natural beauty of our resort's surroundings. Whether you're here for relaxation or
                            adventure, our Deluxe Rooms offer the ideal sanctuary for a memorable stay. </p>
                        <p class="rate">
                            <span>$99.00 /</span> Per Night
                        </p>
                        <a href="deluxe.html" class="btn">VIEW MORE</a>
                    </div>
                </article>
                <!-- end of single room -->
                <!-- single room -->
                <article class="room">
                    <div class="room-image">
                        <img src="./Assests/images/picture_7.jpg" alt="room image">
                    </div>
                    <div class="room-text">
                        <h3>Superior Rooms</h3>
                        <p>Discover refined elegance in our Superior Rooms, designed for guests seeking both comfort and
                            sophistication. Each room boasts chic decor, plush bedding, and ample natural light,
                            creating a serene and inviting atmosphere. Enjoy top-tier amenities including complimentary
                            high-speed Wi-Fi, a flat-screen TV, a well-stocked minibar, and an en-suite bathroom with a
                            rain shower and premium toiletries. Relax on your private balcony or terrace, offering
                            stunning views of the resort’s lush landscapes. Whether you’re here for business or leisure,
                            our Superior Rooms provide a perfect blend of style and convenience for an exceptional stay.
                        </p>
                        <p class="rate">
                            <span>$99.00 /</span> Per Night
                        </p>
                       <a href="superior.html" class="btn">VIEW MORE</a>
                    </div>
                </article>
                <!-- end of single room -->
                <!-- single room -->
                <article class="room">
                    <div class="room-image">
                        <img src="./Assests/images/picture_5.jpg" alt="room image">
                    </div>
                    <div class="room-text">
                        <h3>Deluxe Family Rooms</h3>
                        <p>Our Deluxe Family Rooms are designed with families in mind, offering ample space and
                            exceptional comfort for an unforgettable stay. Each room features cozy bedding, modern
                            decor, and a spacious layout that accommodates both relaxation and fun. Enjoy a range of
                            premium amenities including complimentary high-speed Wi-Fi, a flat-screen TV, a well-stocked
                            minibar, and an en-suite bathroom with a rain shower and luxury toiletries. The room also
                            includes a comfortable sitting area and a private balcony or terrace with breathtaking
                            views, perfect for quality family time. </p>
                        <p class="rate">
                            <span>$99.00 /</span> Per Night
                        </p>
                        <a href="deluxe family.html" class="btn">VIEW  MORE</a>
                    </div>
                </article>
                <!-- end of single room -->
            </div>
    </section>

    <!--footer-->
        <?php
            require './Footer/footer.php';
        ?>

    <!--end of footer-->
    <script src="https://kit.fontawesome.com/032d11eac3.js" crossorigin="anonymous"></script>
</body>

</html>