<!DOCTYPE html>

<?php
  session_start();

  // Include the necessary files
  require_once './classes/DbConnector.php';
  require_once './classes/Room.php';
  require_once './classes/RoomAmenity.php';
  require_once './classes/RoomImages.php';

  $message = "";

  try {
      // Establish database connection
      $dbConnector = new \classes\DbConnector();
      $con = $dbConnector->getConnection();
  } catch (PDOException $exc) {
      // Handle database connection error
      die("Error in DbConnection on DisplayRooms file: " . $exc->getMessage());
  }

  // Fetch all rooms with their details
  $rooms = \classes\Room::getAllRooms($con);
?>

<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" type="png" href="../Assests/cropped-kamili-Copy-1.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KAMILI BEACH RESORT</title>
  <link rel="stylesheet" href="./css/home.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous"
    referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
</head>

<body>
  <?php
      require './NavBar/navbar.php';
  ?>

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


  <section class="home">
    <div class="content">
      <div class="owl-carousel owl-theme">
        <div class="item">
          <img src="Assests/banner-1.png" alt="Image here.">
          <div class="text">
             <!-- <h1>Your Perfect Costal Escape</h1> 
             <p>Lorem ipsum dolor sit amet constur adipisicing elit sed do eiusmtem por incid.
            </p>  
             <div class="flex">
              <button class="primary-btn">READ MORE</button>
              <button class="secondary-btn">CONTACT US</button>
            </div> -->
          </div>
          
        </div>
        <div class="item">
          <img src="Assests/banner-1.png" alt="Image here.">
          <div class="text">
            <!-- <h1>Spend Your Holiday</h1>
            <p>Lorem ipsum dolor sit amet constur adipisicing elit sed do eiusmtem por incid.
            </p> -->
            <!-- <div class="flex">
              <button class="primary-btn">READ MORE</button>
              <button class="secondary-btn">CONTACT US</button>
            </div> -->
          </div>
        </div>
        <div class="item">
          <img src="Assests/Kamili3.jpg" alt="Image here.">
          <div class="text">
            <!-- <h1>Spend Your Holiday</h1>
            <p>Lorem ipsum dolor sit amet constur adipisicing elit sed do eiusmtem por incid.
            </p> -->
            <!-- <div class="flex">
              <button class="primary-btn">READ MORE</button>
              <button class="secondary-btn">CONTACT US</button>
            </div> -->
          </div>
        </div>
        <div class="item">
          <img src="Assests/Banner3.jpg" alt="Image here.">
          <div class="text">
            <!-- <h1>Spend Your Holiday</h1>
            <p>Lorem ipsum dolor sit amet constur adipisicing elit sed do eiusmtem por incid.
            </p> -->
            <!-- <div class="flex">
              <button class="primary-btn">READ MORE</button>
              <button class="secondary-btn">CONTACT US</button>
            </div> -->
          </div>
        </div>
        
      </div>
    </div>
  </section>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"
    referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js" integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA==" crossorigin="anonymous"
    referrerpolicy="no-referrer"></script>
  <script>
    $('.owl-carousel').owlCarousel({
      loop: true,
      margin: 0,
      nav: true,
      dots: false,
      navText: ["<i class = 'fa fa-chevron-left'></i>", "<i class = 'fa fa-chevron-right'></i>"],
      responsive: {
        0: {
          items: 1
        },
        768: {
          items: 1
        },
        1000: {
          items: 1
        }
      }
    })
  </script>

  <script>
        window.onload = function() {
            var today = new Date();
            var day = ("0" + today.getDate()).slice(-2);
            var month = ("0" + (today.getMonth() + 1)).slice(-2);
            var year = today.getFullYear();
            var todayDate = year + "-" + month + "-" + day;
            
            document.getElementById("check_in_date").setAttribute("min", todayDate);
            document.getElementById("check_out_date").setAttribute("min", todayDate);
        };
  </script>


<div id="ww_2ad46a8f3424f" v='1.3' loc='id' a='{"t":"ticker","lang":"en","sl_lpl":1,"ids":["wl11769"],"font":"Arial","sl_ics":"one_a","sl_sot":"celsius","cl_bkg":"image","cl_font":"#FFFFFF","cl_cloud":"#FFFFFF","cl_persp":"#81D4FA","cl_sun":"#FFC107","cl_moon":"#FFC107","cl_thund":"#FF5722"}'><a href="https://weatherwidget.org/" id="ww_2ad46a8f3424f_u" target="_blank">Html weather widget</a></div><script async src="https://app2.weatherwidget.org/js/?id=ww_2ad46a8f3424f"></script>

   <section class="book">
    <div class="container flex_space">
      <div class="text">
        <h1> <span>Book </span> Your Rooms </h1>
      </div>
      <div class="form">
        <form class="grid" action="filterd_room.php" method="post">
          <input type="date" id="check_in_date" placeholder="Araival Date" name="check_in_date" required>
          <input type="date" id="check_out_date" placeholder="Departure Date" name="check_out_date" required>
          <input type="number" placeholder="Adult Count" name="guest_count" min="1" required>
          <input type="number" placeholder="Childern count" name="children_count" min="0" required>
          <input type="submit" value="CHECK AVAILABILITY">
        </form>
      </div>
    </div>
  </section>



  <section class="about top">
    <div class="container flex">
      <div class="left">
        <div class="heading">
          <h1>WELCOME</h1>
          <h2>KAMILI BEACH RESORT</h2>
        </div>
        <br>
        <p style="font-size: medium;">We draw our inspiration from the word ‘Kamili’ which denotes the city of Kalutara,
          an age-old symbol in Buddhism that stands for purity of body, mind and soul.The unfolding of the petals as depicted in our logo stands
          for an awakening of the soul, a guaranteed experience as you enjoy your stay with us.The lotus seed is buried in a pool of mud,
           on which it grows, heading towards the sunshine and air, to finally blossom on long stalks floating above the muddy waters it grew in.</p>
        <br>
           <button onclick="window.location.href='about-us.php'" class="primary-btn">ABOUT US</button>
      </div>
      <div class="right">
        <img style="margin-top: 35px; border-radius: 15px;" src="Assests/laya-safari.jpg" alt="Image here">
      </div>
    </div>
  </section>

  <section class="counter top">
    <div class="container grid">
      <div class="box">
        <h1>24 <i class="fa-solid fa-xmark"></i> 7</h1>
        <hr>
        <span>SERVICES</span>
      </div>
      <div class="box">
        <h1>20</h1>
        <hr>
        <span>ROOMS</span>
      </div>
      <div class="box">
        <h1>1600</h1>
        <hr>
        <span>CUSTOMERS</span>
      </div>
      <div class="box">
        <h1>50</h1>
        <hr>
        <span>STAFF</span>
      </div>
       
    </div> 
  </section>

  <section class="rooms">
    <div class="container top">
      <div class="heading">
        <h1>EXPLORE</h1>
        <h2>Our Accomadations</h2>
        <p>Exceptional Facilities Provide For You - Accomadations.
        </p>
      </div>
      <div class="content mtop">
        <div class="owl-carousel owl-carousel1 owl-theme">

        <?php 
          if(!empty($rooms)){
            foreach ($rooms as $room){
              ?>
                <div class="room-item">
                  <div class="image">
                    <img style="height: 300px;" src="<?php echo htmlspecialchars($room['room_inside_normal_image']); ?>" alt="Premium Deluxe">
                  </div>
                  <div class="text">
                    <h2><?php echo htmlspecialchars($room['room_type']); ?></h2>
                    <br>
                    <!-- <div class="rate flex">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                    </div> -->
                    <p>
                    <ul type="disk">
                      <?php 
                      $amenities_displayed = 0;
                      foreach ($room['amenities'] as $amenity): 
                        if ($amenities_displayed < 3):
                      ?>
                        <li><?php echo htmlspecialchars($amenity['amenity_name']); ?></li>
                      <?php 
                          $amenities_displayed++;
                        endif;
                      endforeach; 
                      ?>
                    </ul>
                    </p>
                    <div class="button flex">
                    <button class="primary-btn" onclick="window.location.href='singleRoom.php?id=<?php echo $room['room_id']; ?>'">VIEW</button>
                      <h3>Rs.<?php echo htmlspecialchars($room['price_per_night']); ?> <span><br> Per Night </span></h3>
                    </div>
                  </div>
                </div>
              <?php
            }
          }else{
            ?>
            <p>No rooms found.</p>
            <?php
          }
        ?>
          <!-- <div class="room-item">
            <div class="image">
              <img src="Assests/Luxary.jpg" alt="Premium Deluxe">
            </div>
            <div class="text">
              <h2>Premium Deluxe</h2>
              <div class="rate flex">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
              </div>
              <p>
              <ul type="disk">
                <li>Double Beds</li>
                <li>Wi-Fi</li>
                <li>Air Condition</li>
              </ul>
              </p>
              <div class="button flex">
                <button class="primary-btn">VIEW MORE</button>
                <h3>Rs.25000 <span><br> Per Night </span></h3>
              </div>
            </div>
          </div> -->
          <!-- <div class="room-item">
            <div class="image">
              <img src="Assests/Luxary.jpg" alt="Premium Deluxe">
            </div>
            <div class="text">
              <h2>Premium Deluxe</h2>
              <div class="rate flex">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
              </div>
              <p>
              <ul type="disk">
                <li>Double Beds</li>
                <li>Wi-Fi</li>
                <li>Air Condition</li>
              </ul>
              </p>
              <div class="button flex">
                <button class="primary-btn">VIEW MORE</button>
                <h3>Rs.25000 <span><br> Per Night </span></h3>
              </div>
            </div>
          </div> -->
          <!-- <div class="room-item">
            <div class="image">
              <img src="Assests/Luxary.jpg" alt="Premium Deluxe">
            </div>
            <div class="text">
              <h2>Premium Deluxe</h2>
              <div class="rate flex">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
              </div>
              <p>
              <ul type="disk">
                <li>Double Beds</li>
                <li>Wi-Fi</li>
                <li>Air Condition</li>
              </ul>
              </p>
              <div class="button flex">
                <button class="primary-btn">VIEW MORE</button>
                <h3>Rs.25000 <span><br> Per Night </span></h3>
              </div>
            </div>
          </div> -->
          <!-- <div class="room-item">
            <div class="image">
              <img src="Assests/Luxary.jpg" alt="Premium Deluxe">
            </div>
            <div class="text">
              <h2>Premium Deluxe</h2>
              <div class="rate flex">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
              </div>
              <p>
              <ul type="disk">
                <li>Double Beds</li>
                <li>Wi-Fi</li>
                <li>Air Condition</li>
              </ul>
              </p>
              <div class="button flex">
                <button class="primary-btn">VIEW MORE</button>
                <h3>Rs.25000 <span><br> Per Night </span></h3>
              </div>
            </div>
          </div> -->
        </div>
      </div>
    </div>
    </div>
  </section>
  <script>
    $('.owl-carousel1').owlCarousel({
      loop: true,
      margin: 40,
      nav: true,
      dots: false,
      navText: ["<i class = 'fa fa-chevron-left'></i>", "<i class = 'fa fa-chevron-right'></i>"],
      responsive: {
        0: {
          items: 1
        },
        768: {
          items: 2,
          margin: 10,
        },
        1000: {
          items: 3
        }
      }
    })
  </script>
  
   <section class="gallery">
    <div class="container top">
      <div class="heading">
        <h1>PHOTOS</h1>
        <h2>Our Gallery</h2>
        <p>Scenary Kamili Beach Resort 
      </div>
    </div>

    <div class="content mtop">
      <div class="owl-carousel owl-carousel1 owl-theme">

        <div class="items">
          <div class="img">
            <img src="Assests/laya-safari.jpg" alt="">
          </div>
        </div>
        
        <div class="items">
          <div class="img">
            <img src="Assests/kamili-02-1024x683.jpg" alt="">
          </div>
        </div>
        <div class="items">
          <div class="img">
            <img src="Assests/Kamili 5.jpg" alt="">
          </div>
        </div>
        <div class="items">
          <div class="img">
            <img src="Assests/wedding.jpg" alt="">
          </div>
        </div>
        <div class="items">
          <div class="img">
            <img src="Assests/kamili-beach-villa.jpg" alt="">
          </div>
        </div>
        <div class="items">
          <div class="img">
            <img src="Assests/Luxary.jpg" alt="">
          </div>
        </div>
        <div class="items">
          <div class="img">
            <img src="Assests/tRY.jpg" alt="">
          </div>
        </div>
        <div class="items">
          <div class="img">
            <img src="Assests/Deluxe.jpg" alt="">
          </div>
        </div>
       <div class="items">
          <div class="img">
            <img src="Assests/Kamili 5.jpg" alt="">
          </div>
        </div>
       <!-- <div class="items">
          <div class="img">
            <img src="Assests/one.jpg" alt="">
          </div>
          <div class="overlay">
            <span class="fa fa-plus"> </span>
            <h3>Photo Title Here.</h3>
          </div>
        </div> -->
      </div>
    </div>
  </section>


  <script>
    $('.owl-carousel1').owlCarousel({
      loop: true,
      margin: 0,
      nav: true,
      dots: false,
      autoplay: true,
      autoplayTimeout: 1000,
      autoplayHoverPause: true,
      navText: ["<i class = 'fa fa-chevron-left'></i>", "<i class = 'fa fa-chevron-right'></i>"],
      responsive: {
        0: {
          items: 1
        },
        768: {
          items: 4,
        },
        1000: {
          items: 6
        }
      }
    })
  </script> 


  
<section class="about top">
  <div class="container flex">
    <div class="left">
      
      <div class="heading">
        <h1>Location</h1>
        <h2>Our Location</h2>
      </div>
      
      <p> Kamili Beach Resort, Kalutara, is located on the southern pristine beaches of Sri Lanka, the stunning ocean frontage
        resort Kamili Beach offers finest holiday experiences in a tranquil set up. The resort is 70km away from Colombo Airport & locates 
        just a 60 mins drive from the commercial city Colombo..
        The resort with full of green & serenity boasts some of the best facilities for its guests,
         on a 3+ acres of beach frontage landscape. Further Resort offers upscale accommodation in a naturally beautiful & relaxing environment.
          In addition to its grandly designed 24 ocean frontage rooms with the view, the resort offers mostly attracted lobby, 
          outdoor pool, the 'Kamilia' all day dining restaurant & the lobby/pool bar again with the view. 
          Souvenir shop, travel desk, spa, library & mini gym are some of the other highlights that are offered. 

      
      </p>
      <button onclick="window.location.href='contact-us.php'" class="primary-btn">Contact Us</button>
   
      
    </div>
     <div class="right">
      <br><br><br>

      <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15852.547690961677!2d79.9402779!3d6.6299107!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae237ea16279aa7%3A0x390b8d00c37b628c!2sKamili%20Beach%20Resort!5e0!3m2!1sen!2slk!4v1716179643103!5m2!1sen!2slk" width="600px" height="400px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      
    
    </div> 
  </div>
</section>


<br>


  <section class="Customer top">
    <div class="container">
      <div class="owl-carousel owl-carousel2 owl-theme">
        <div class="item">
          <i class="fa-solid fa-quote-right"></i>
          <p>From the arrival to departure the staff was very helpful, friendly and the room and food was amazing. Great view points  where you can see the sea range with sunshine.
           </p>
          <h3>HESH K</h3>
          <label> VIA TRIP ADVISOR</label>
        </div>
        <div class="item">
          <i class="fa-solid fa-quote-right"></i>
          <p>The room was very comfortable and cozy. All the necessary requirements were fulfilled. The view deck on the last floor was exciting and had a great view, which everyone enjoyed.
             </p>
          <h3>Dr.TIRANYA</h3>
          <label> VIA Booking.com</label>
        </div>
        <div class="item">
          <i class="fa-solid fa-quote-right"></i>
          <p>The Foods are very delicious. All the necessary requirements were fulfilled.</p>
          <h3>Aysha Cader</h3>
          <label>VIA Booking.com</label>
        </div>
      </div>
    </div>
  </section>
  <script>
    $('.owl-carousel2').owlCarousel({
      loop: true,
      margin: 0,
      nav: false,
      dots: true,
      responsive: {
        0: {
          items: 1
        },
        768: {
          items: 1,
        },
        1000: {
          items: 1
        }
      }
    })
  </script>



  <!-- <section class="news top rooms">
    <div class="container">
      <div class="heading">
        <h1>NEWS</h1>
        <h2>Our News</h2>
        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
      </div>


      <div class="content flex">
        <div class="left grid2">
          <div class="items">
            <div class="image">
              <img src="images/blog-1.png" alt="">
            </div>
            <div class="text">
              <h2>Finibus bonorum malorm.</h2>
              <div class="admin flex">
                <i class="fa fa-user"></i>
                <label>Admin</label>
                <i class="fa fa-heart"></i>
                <label>500</label>
                <i class="fa fa-comments"></i>
              </div>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
          </div>
          <div class="items">
            <div class="image">
              <img src="images/blog-2.png" alt="">
            </div>
            <div class="text">
              <h2>Finibus bonorum malorm.</h2>
              <div class="admin flex">
                <i class="fa fa-user"></i>
                <label>Admin</label>
                <i class="fa fa-heart"></i>
                <label>500</label>
                <i class="fa fa-comments"></i>
              </div>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
          </div>
        </div>

        <div class="right">
          <div class="box flex">
            <div class="img">
              <img src="images/blog-s1.png" alt="">
            </div>
            <div class="stext">
              <h2>Etiam Vel Nequ</h2>
              <p>Lorem ipsum dolor sit amet constur adipisicing elit sed do eiusmtem por incid.
              </p>
            </div>
          </div>
          <div class="box flex">
            <div class="img">
              <img src="images/blog-s2.png" alt="">
            </div>
            <div class="stext">
              <h2>Etiam Vel Nequ</h2>
              <p>Lorem ipsum dolor sit amet constur adipisicing elit sed do eiusmtem por incid.
              </p>
            </div>
          </div>
          <div class="box flex">
            <div class="img">
              <img src="images/blog-s3.png" alt="">
            </div>
            <div class="stext">
              <h2>Etiam Vel Nequ</h2>
              <p>Lorem ipsum dolor sit amet constur adipisicing elit sed do eiusmtem por incid.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> -->

  
  


  <section class="newsletter mtop">
    <div class="container flex_space">
      <h1>Subscribe to Our Newsletter</h1>
      <input type="text" placeholder="Your Email">
      <input type="text" value="Subscribe">
    </div>
  </section>

<!--------------------------------------------------------------------- Footer --------------------------------------------------------------->
 
  <?php
      require './Footer/footer.php';
  ?>



  <script src="https://kit.fontawesome.com/032d11eac3.js" crossorigin="anonymous"></script>
</body>

</html>