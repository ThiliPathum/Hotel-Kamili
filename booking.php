<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Booking-Kamili Beach Resort</title>
	<link rel="icon" href="images/picture_1.png" type="image/png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
		integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<link rel="stylesheet" href="/CSS/booking.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="/resources/demos/style.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>

<body>
	<div class="navbar">
		<img src="./Assests/images/picture_1.png" height=60 width=60 class="companylogo">
	</div>
	</div>
    <br>
    <br>
    <br>
	<div class="container">

		<div class="blocks">

			<div class="left">
				<p>Name</p>
				<div class="date-input-container">
					<i class="fas fa-user-alt date-icon"></i>
					<input class="date-input-field" type="text" placeholder="Enter Your Name">
				</div>
				<p>Email Address</p>
				<div class="date-input-container">
					<i class="fas fa-pen-alt date-icon"></i>
					<input class="date-input-field" type="text" placeholder="Enter Your Email">
				</div>
				<p>Contact Details</p>
				<div class="date-input-container">
					<i class="fas fa-phone date-icon"></i>
					<input class="date-input-field" type="text" placeholder="Enter Your Phone Number">
				</div>
				<p>Check In</p>
				<div class="date-input-container">
					<i class="fas fa-calendar-alt date-icon"></i>
					<input class="date-input-field " type="text" id="sourcedatepicker" placeholder="mm/dd/yyyy">
				</div>
				<p>Check Out</p>
				<div class="date-input-container">
					<i class="fas fa-calendar-alt date-icon"></i>
					<input class="date-input-field" type="text" id="destinationdatepicker" placeholder="mm/dd/yyyy">
				</div>
				<!-- <p>Room Catergory</p> -->
				<!-- <div class="select">
					<div class="selectBtn" data-type="firstOption"><i class="fas fa-hotel"></i>Select Room Catergory
					</div>
					<div class="selectDropdown">
						<div class="option" data-type="firstOption">Deluxe Room</div>
						<div class="option" data-type="secondOption">Superior Room</div>
						<div class="option" data-type="thirdOption">Deluxe Family Room</div>
					</div>
				</div> -->
				<p> Number of Adults</p>
				<div class="date-input-container">
					<i class="fas fa-user-alt date-icon"></i>
					<input class="date-input-field" type="text" placeholder="Enter Number">
				</div>

				<p>Number of Children</p>
				<div class="date-input-container">
					<i class="fas fa-child date-icon"></i>
					<input class="date-input-field" type="text" placeholder="Enter Number">
				</div>
			</div>
			<div class="right">
				<div class="trip-detail-container">
					<div class="one-way-container">
						<h1 class="trip-detail-title">
							<span><img src="./Assests/images/picture_1.png" height=40 width=40 class="companylogo"></span> Kamili
							Beach Resort
						</h1>
						<table>
							<table>
								<tr>
									<td><span>
											<i class="fas fa-star"></i>
											<i class="fas fa-star"></i>
											<i class="fas fa-star"></i>
											<i class="fas fa-star"></i>
										</span>
									</td>
									<td></td>
								</tr>
								<tr>
									<td>No. 531, First Station Road,Waskaduwa,Kaluthara</td>
								</tr>
								<tr>
									<td>Sri Lanka</td>
									<td></td>
								</tr>
							</table>
						</table>
					</div>
					<hr>
					<div class="two-way-container">
						<h3 class="trip-detail-title">Booking Invoice</h3>
						<table>
							<tr>
								<td>Name</td>
								<td>S.M Kamal Dissanayake</td>
							</tr>
							<tr>
								<td>Room Catergory</td>
								<td>Deluxe Room</td>
							</tr>
							<tr>
								<td>Check In</td>
								<td>Wed June 20, 2024</td>
							</tr>
							<tr>
								<td>Check Out</td>
								<td>Fri June 22, 2024</td>
							</tr>
							<tr>
								<td>Nights</td>
								<td>2</td>
							</tr>
							<tr>
								<td>1 x Deluxe Room Only</td>
								<td>LKR 40,000</td>
							</tr>
							<tr>
								<td>Service Charge (10%)</td>
								<td>LKR 4,000</td>
							</tr>
							<tr>
								<td>VAT Tax (18%)</td>
								<td>LKR 7,200</td>
							</tr>
						</table>
					</div>
					<hr>
					<div class="price-container">
						<h3 class="trip-detail-title">Total</h3>
						<table>
							<tr>
								<td>Grand Total</td>
								<td>LKR 51,200</td>
							</tr>
						</table>
					</div>

				</div>
			</div>
		</div>
		<div class="buttons">
			<button type="button">Room Customization</button>
			<button type="button">Book Now</button>
		</div>
	</div>

	<script src="/JS/booking.js"></script>

</body>

</html>