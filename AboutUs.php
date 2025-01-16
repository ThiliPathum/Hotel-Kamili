<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./CSS/AboutUs.css">
  <link rel = "icon" href = "/Assests/images/picture_1.png" type = "image/png">
  <title>AboutUs</title>
</head>

<body>


  <header>
    <div class="content flex_space">
      <div class="logo">
        <img src="/Assests/images/picture_1.png" alt="Image" width="70px" height="70px">
      </div>

      <div class="navlinks">
        <ul id="menulist">
          <li><a href="#home">Home</a> </li>
          <li><a href="/Rooms/about us.html">About</a> </li>
          <li><a href="/Rooms/index.html">Rooms</a> </li>
          <li><a href="#pages">Weddings</a> </li>
          <li><a href="#news">Services</a> </li>
          <li><a href="#around_us">Around Us</a> </li>
          <li><a href="#contact">Contact</a> </li>
          <a href="/Rooms/index.html"> <button class="primary-btn">BOOK NOW</button> </a>
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

  <!-- about us carousel strt -->
  <div class="head1">
    <div class="head-bottom flex">
      <h2> About US <br>
        "Where Tranquility Meets the Ocean Breeze"</h2>
    </div>
  </div>

  <!-- about us carousel end -->

  <!-- fullscreen modal -->
  <div id="modal"></div>
  <!-- end of fullscreen modal -->

  <!-- body content  -->
  <section class="services sec-width" id="services">
      <div class="title"></div>
      <div class="services-container">
          <!-- single service -->
          <article class="service">
              <div class="service-content">
                  <h2>About Us</h2>
                  <p>We draw our inspiration from the word ‘Kamili’ which denotes the city of Kalutara, an age-old
                      symbol in Buddhism that stands for purity of body, mind and soul.
                  </p>
                
                  <P>The unfolding of the petals as depicted in our logo stands for an awakening of the soul, a
                      guaranteed experience as you enjoy your stay with us.
                  </P>
                 
                  <p>The lotus seed is buried in a pool of mud, on which it grows, heading towards the sunshine and
                      air, to finally blossom on long stalks floating above the muddy waters it grew in.</p>
                  
                  <p>For us, this is symbolic of the peace and quiet that will envelop you when you step into our
                      resort, away from the hustle and bustle of the fast-paced life we live in.</p>
              </div>
          </article>

          <!-- single service -->
          <article class="service">
              <div class="service-content">
                  <img src="/Assests/images/picture_18.jpg" alt="room image">
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
                  <img src="/Assests/images/picture_11.jpg" alt="Pool"> </a>
              </div>
              <div class="service-content">
                  <h2>Pool Area</h2>
                  <p>The outdoor pool area at our hotel is a tranquil oasis designed for relaxation and enjoyment.
                      Surrounded by lush landscaping and comfortable lounge chairs, our sparkling pool offers a
                      refreshing escape from the everyday. Guests can bask in the sun, take a leisurely swim, or enjoy
                      a drink from our poolside bar. With attentive service and a serene atmosphere, it's the perfect
                      spot to unwind.!</p>
                  <button type="button" class="btn">Know More</button>
              </div>
          </article>

          <!-- Service 02 -->
          <article class="service">
              <div class="service-img">
                  <img src="/Assests/images/picture_28.jpg" alt="High Tea"> </a>
              </div>
              <div class="service-content">
                  <h2>Saturday High Tea</h2>
                  <p>Join us every Saturday for an exquisite High Tea experience at our hotel. Indulge in a delightful
                      selection of freshly baked scones, delicate finger sandwiches, and an array of sweet treats, all
                      served with premium teas and sparkling champagne. Set in our elegant dining area, it's the
                      perfect way to spend a leisurely afternoon with friends or family.</p>
                  <button type="button" class="btn">Know More</button>
              </div>
          </article>

          <!-- Service 03-->
          <article class="service">
              <div class="service-img">
                  <img src="/Assests/images/picture_29.webp" alt="seafood"> </a>
              </div>
              <div class="service-content">
                  <h2>Friday Sea Food Buffet</h2>
                  <p>Every Friday, delight in our sumptuous Seafood Buffet at the hotel. Savor the freshest catches
                      of the day, including lobster, shrimp, oysters, and a variety of fish, all expertly prepared by
                      our talented chefs. Complement your meal with an assortment of salads, sides, and delectable
                      desserts. Set in a stylish and inviting atmosphere, it's a culinary experience not to be missed.
                      !</p>
                  <button type="button" class="btn">Know More</button>
              </div>
          </article>

          <!-- Service 04-->
          <article class="service">
              <div class="service-img">
                  <img src="/Assests/images/picture_31.jpg" alt="Family"> </a>
              </div>
              <div class="service-content">
                  <h2>Day Out Packages</h2>
                  <p>Escape for a day with our delightful Day Out Packages at the hotel. Perfect for a quick getaway,
                      these packages include access to our tranquil pool area, a delicious lunch at our on-site
                      restaurant, and rejuvenating spa treatments. Whether you're looking to relax or explore, our day
                      out packages offer something for everyone. Plan your perfect day with us.</p>
                  <button type="button" class="btn">Know More</button>
              </div>
          </article>


          <!-- Service 05-->
          <article class="service">
              <div class="service-img">
                  <img src="/Assests/images/picture_30.webp" alt="Couple"> </a>
              </div>
              <div class="service-content">
                  <h2>Honeymoon Packages</h2>
                  <p>Celebrate your love with our exclusive Honeymoon Packages at the hotel. Designed to create
                      unforgettable memories, our packages include luxurious accommodations, romantic dinners, spa
                      treatments, and special touches to enhance your stay. Whether you're relaxing by the pool,
                      enjoying
                      a sunset stroll on the beach, or indulging in breakfast in bed, every moment is tailored to
                      perfection.</p>
                  <button type="button" class="btn">Know More</button>
              </div>
          </article>


          <!-- Service 06-->
          <article class="service">
              <div class="service-img">
                  <img src="/Assests/images/picture_31.jpeg" alt="Couple"> </a>
              </div>
              <div class="service-content">
                  <h2>OutDoor Wedding Packages</h2>
                  <p>Say "I do" amidst the stunning backdrop of our outdoor wedding venue at the hotel. Our Outdoor
                      Wedding
                      Packages are designed to create the perfect setting for your special day, offering beautifully
                      landscaped gardens, elegant décor, and personalized service. From the ceremony to the reception,
                      our
                      dedicated team will ensure every detail is flawlessly executed</p>
                  <button type="button" class="btn">Know More</button>
              </div>
          </article>
      </div>
  </section>

  <section class="customers" id="customers">
      <div class="sec-width">
          <div class="title"></div>
          <h2>Customers</h2>

          <div class="customers-container">
              <!-- single customer -->
              <div class="customer">
                  <div class="rating">
                      <span><i class="fas fa-star"></i></span>
                      <span><i class="fas fa-star"></i></span>
                      <span><i class="fas fa-star"></i></span>
                      <span><i class="fas fa-star"></i></span>
                      <span><i class="far fa-star"></i></span>
                  </div>
                  <h3>We Loved it</h3>
                  <p>"Our stay at this hotel was absolutely wonderful! The rooms were impeccably clean, the staff was
                      incredibly friendly and helpful, and the amenities were top-notch. The breakfast buffet offered
                      a wide variety of delicious options. We can't wait to come back!"</p>
                  <img src="/Assests/images/picture_32.jpg" alt="customer image">
                  <span>Thushani Perera, Sri Lanka</span>
              </div>
              <!-- end of single customer -->
              <!-- single customer -->
              <div class="customer">
                  <div class="rating">
                      <span><i class="fas fa-star"></i></span>
                      <span><i class="fas fa-star"></i></span>
                      <span><i class="fas fa-star"></i></span>
                      <span><i class="fas fa-star"></i></span>
                      <span><i class="far fa-star"></i></span>
                  </div>
                  <h3>Highly Reccomended!</h3>
                  <p>"This hotel exceeded our expectations in every way. The location is perfect, right in the heart
                      of the city, making it easy to explore the local attractions. The service was outstanding, and
                      the spa was a perfect retreat after a long day. Highly recommended!"</p>
                  <img src="/Assests/images/picture_33.jpeg" alt="customer image">
                  <span>Nikil , India</span>
              </div>
              <!-- end of single customer -->
              <!-- single customer -->
              <div class="customer">
                  <div class="rating">
                      <span><i class="fas fa-star"></i></span>
                      <span><i class="fas fa-star"></i></span>
                      <span><i class="fas fa-star"></i></span>
                      <span><i class="fas fa-star"></i></span>
                      <span><i class="far fa-star"></i></span>
                  </div>
                  <h3>Great Experience</h3>
                  <p>"We had a fantastic experience here. The check-in process was smooth, the room was spacious and
                      well-appointed, and the view from our balcony was stunning. The hotel’s restaurant served some
                      of the best meals we’ve ever had. We’ll definitely be returning."</p>
                  <img src="/Assests/images/picture_34.webp" alt="customer image">
                  <span>Eric, England</span>
              </div>
              <!-- end of single customer -->
               <!-- single customer -->
              <div class="customer">
                <div class="rating">
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="fas fa-star"></i></span>
                    <span><i class="far fa-star"></i></span>
                </div>
                <h3>Highly Reccomended!</h3>
                <p>"This hotel exceeded our expectations in every way. The location is perfect, right in the heart
                    of the city, making it easy to explore the local attractions. The service was outstanding, and
                    the spa was a perfect retreat after a long day. Highly recommended!"</p>
                <img src="/Assests/images/picture_33.jpeg" alt="customer image">
                <span>Nikil , India</span>
            </div>
            <!-- end of single customer -->
          </div>
      </div>
  </section>
  <!-- end of body content -->

  <!-- Footer -->
  <footer>
    <div class="container grid">
        <div class="box">
            <img src="/Assests/images/picture_1.png" class="footer-logo" alt="Logo" width="70px" height="70px">
            <p>We draw our inspiration from the word ‘Kamili’ which denotes the city of Kalutara, an age-old symbol in Buddhism that stands for purity of body, mind and soul. We draw our inspiration from the word ‘Kamili’ which denotes the city of Kalutara, an age-old symbol in Buddhism that stands for purity of body, mind and soul.</p>
            <div class="icon">
                <i class="fa fa-facebook-f"></i>
                <i class="fa fa-instagram"></i>
                <i class="fa fa-twitter"></i>
                <i class="fa fa-youtube"></i>
            </div>
        </div>

        <div class="box">
            <h2>Links</h2>
            <ul>
                <li>Home</li>
                <li>About Us</li>
                <li>Contact Us</li>
                <li>Services</li>
                <li>Weddings</li>
                <li>Around Us</li>
            </ul>
        </div>

        <div class="box">
            <h2>Contact Us</h2>
            <i class="fa fa-location-dot"> Location</i>
            <label><br>No. 531,<br> First Station Road,<br> Waskaduwa,<br> Kalutara,<br> Sri Lanka.</label> <br>
            <i class="fa fa-phone"> Hotline</i><br>
            <label>+ (94) 76 2 760 765</label> <br>
            <i class="fa fa-envelope"> Email</i><br>
            <label>reservation@kamilibeach.com</label> <br>
        </div>
    </div>
    <section>
        <!-- Add any additional footer sections if needed -->
    </section>
</footer>

<div class="legal">
    <p class="container">Copyright (c) 2024 - All Rights Reserved.</p>
</div>

  <script src="https://kit.fontawesome.com/032d11eac3.js" crossorigin="anonymous"></script>

</body>

</html>