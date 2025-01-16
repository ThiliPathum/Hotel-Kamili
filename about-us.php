<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>About Us - Kamili Beach Resort</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./CSS/about-us.css">
    <link rel="stylesheet" href="./NavBar/navbar.css">
	<link rel="stylesheet" href="./Footer/footer.css">
    <script src="JS/aboutus.js"></script>
    <script src="https://kit.fontawesome.com/dbed6b6114.js" crossorigin="anonymous"></script>
    <link rel="icon" href="./Assests/images/picture_1.png" type="image/png">
</head>

<body>

     <!--header01-->
     <?php
      require './NavBar/navbar.php';
    ?>
  
    <!--end of header01-->

    <!-- <header class="header" id="header">
        <div class="head-bottom flex">
            <h2> About US <br>
                "Where Tranquility Meets the Ocean Breeze"</h2>
        </div>
    </header> -->
    <!-- end of header -->


    <!-- fullscreen modal -->
    <div id="modal"></div>
    <!-- end of fullscreen modal -->

    <!-- body content  -->
    <section class="services sec-width" id="services">
        <div class="services-container">
            <!-- single service -->
            <article class="service">
                <div class="service-content">
                    <!-- <h2>About Us</h2> -->
                    <div class="about top container flex left heading">
                        <h1>WELCOME</h1>
                        <h2>About Us</h2>
                    </div>
                    <p>We draw our inspiration from the word ‘Kamili’ which denotes the city of Kalutara, an age-old
                        symbol in Buddhism that stands for purity of body, mind and soul.
                        The unfolding of the petals as depicted in our logo stands for an awakening of the soul, a
                        guaranteed experience as you enjoy your stay with us.
                    </P>
                    <br>
                    <p>The lotus seed is buried in a pool of mud, on which it grows, heading towards the sunshine and
                        air, to finally blossom on long stalks floating above the muddy waters it grew in.
                        For us, this is symbolic of the peace and quiet that will envelop you when you step into our
                        resort, away from the hustle and bustle of the fast-paced life we live in.</p>
                </div>
            </article>

            <!-- single service -->
            <article class="service">
                <div class="service-content">
                    <img style="height: 500px; border-radius: 15px;" src="./Assests/laya-safari.jpg" alt="room image">
                </div>
            </article>
        </div>
    </section>

    <section class="services sec-width" id="services">
        <div class="title"></div>
        <div class="services-container">
            <!-- Service 01-->
            <article class="service">
                <div class="service-img">
                    <img src="./Assests/images/picture_11.jpg" alt="Pool"> </a>
                </div>
                <div class="service-content">
                    <h2>Pool Area</h2>
                    <p>The outdoor pool area at our hotel is a tranquil oasis designed for relaxation and enjoyment.
                        Surrounded by lush landscaping and comfortable lounge chairs, our sparkling pool offers a
                        refreshing escape from the everyday. Guests can bask in the sun, take a leisurely swim, or enjoy
                        a drink from our poolside bar. With attentive service and a serene atmosphere, it's the perfect
                        spot to unwind.!</p>
                </div>
            </article>

            <!-- Service 02 -->
            <article class="service">
                <div class="service-img">
                    <img src="./Assests/images/picture_28.jpg" alt="High Tea"> </a>
                </div>
                <div class="service-content">
                    <h2>Saturday High Tea</h2>
                    <p>Join us every Saturday for an exquisite High Tea experience at our hotel. Indulge in a delightful
                        selection of freshly baked scones, delicate finger sandwiches, and an array of sweet treats, all
                        served with premium teas and sparkling champagne. Set in our elegant dining area, it's the
                        perfect way to spend a leisurely afternoon with friends or family.</p>
                </div>
            </article>

            <!-- Service 03-->
            <article class="service">
                <div class="service-img">
                    <img src="./Assests/images/picture_29.webp" alt="seafood"> </a>
                </div>
                <div class="service-content">
                    <h2>Friday Sea Food Buffet</h2>
                    <p>Every Friday, delight in our sumptuous Seafood Buffet at the hotel. Savor the freshest catches
                        of the day, including lobster, shrimp, oysters, and a variety of fish, all expertly prepared by
                        our talented chefs. Complement your meal with an assortment of salads, sides, and delectable
                        desserts. Set in a stylish and inviting atmosphere, it's a culinary experience not to be missed.
                        !</p>
                </div>
            </article>

            <!-- Service 04-->
            <article class="service">
                <div class="service-img">
                    <img src="./Assests/images/picture_31.jpg" alt="Family"> </a>
                </div>
                <div class="service-content">
                    <h2>Day Out Packages</h2>
                    <p>Escape for a day with our delightful Day Out Packages at the hotel. Perfect for a quick getaway,
                        these packages include access to our tranquil pool area, a delicious lunch at our on-site
                        restaurant, and rejuvenating spa treatments. Whether you're looking to relax or explore, our day
                        out packages offer something for everyone. Plan your perfect day with us.</p>
                </div>
            </article>


            <!-- Service 05-->
            <article class="service">
                <div class="service-img">
                    <img src="./Assests/images/picture_30.webp" alt="Couple"> </a>
                </div>
                <div class="service-content">
                    <h2>Honeymoon Packages</h2>
                    <p>Celebrate your love with our exclusive Honeymoon Packages at the hotel. Designed to create
                        unforgettable memories, our packages include luxurious accommodations, romantic dinners, spa
                        treatments, and special touches to enhance your stay. Whether you're relaxing by the pool,
                        enjoying
                        a sunset stroll on the beach, or indulging in breakfast in bed, every moment is tailored to
                        perfection.</p>
                </div>
            </article>


            <!-- Service 06-->
            <article class="service">
                <div class="service-img">
                    <img src="./Assests/images/picture_31.jpeg" alt="Couple"> </a>
                </div>
                <div class="service-content">
                    <h2>OutDoor Wedding Packages</h2>
                    <p>Say "I do" amidst the stunning backdrop of our outdoor wedding venue at the hotel. Our Outdoor
                        Wedding
                        Packages are designed to create the perfect setting for your special day, offering beautifully
                        landscaped gardens, elegant décor, and personalized service. From the ceremony to the reception,
                        our
                        dedicated team will ensure every detail is flawlessly executed</p>
                </div>
            </article>
        </div>
    </section>

    <!-- end of body content -->

    <!--footer-->
    <?php
        require './Footer/footer.php';
    ?>
     <!--end of footer-->
    <script src="https://kit.fontawesome.com/032d11eac3.js" crossorigin="anonymous"></script>


    <script src="script.js"></script>
</body>

</html>