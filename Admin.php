<?php

session_start();
require_once '../classes/DbConnector.php';
require_once '../classes/room.php';
require_once '../classes/staff.php';
require_once '../classes/faq.php';
require_once '../classes/Reservation.php';
require_once '../classes/RoomAmenity.php';
require_once '../classes/RoomImages.php';
require_once '../classes/EventCustomization.php';
require_once '../classes/EventTypes.php';
require_once '../AdminPanel/session_check.php';

check_login();

use classes\DbConnector;
use classes\Room;
use classes\staff;
use classes\Reservation;



// Initialize $selectedDate with a default value if not set
$selectedDate = isset($_POST['date']) ? $_POST['date'] : date('Y-m-d');


$dbConnector = new DbConnector();
$con = $dbConnector->getConnection();

$rooms = Room::getAllRooms($con);

$availableRooms = Room::getAllRoomAvailableCountWithinASpecificDate($con, $selectedDate);
$reservedRooms = Room::getReservedRoomCountByDate($con, $selectedDate);


$staff = new staff('', '', '', '', '', '', '', '');
$staffList = $staff->getAllStaff($con);

$reservations = Reservation::getAllReservations($con);

$customEvent = new \EventCustomization('', '', '', '', '', '', '', '', '', '', '', '');
$event = $customEvent->getAllEventCustomization($con);

// $faq = new faq('', '');
// $faqList = $faq->getAllFaq($con);

// pagination for reservation

$totalReservations = Reservation::getTotalReservations($con);
$limit = 10;
$totalPages = ceil($totalReservations / $limit);
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1);
$offset = ($page - 1) * $limit;
$reservations = Reservation::getAllReservations($con, $limit, $offset);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="png" href="../Assests/cropped-kamili-Copy-1.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

    <!-- Include Date Range Picker CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!-- My CSS -->
    <link rel="stylesheet" href="../CSS/Admin_style.css">


    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin') : ?>
        <title>Admin Dashboard</title>
    <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'Receptionist') : ?>
        <title>Receptionist Dashboard</title>
    <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'Room Manager') : ?>
        <title>Room Manager Dashboard</title>
    <?php endif; ?>



</head>

<body>

    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <img class="img" src="../Assests/cropped-kamili-Copy-1.png" alt="Kamili Beach Resort"><br>
            <!-- <span class="text">Kamili Beach Resort</span> -->
        </a>
        <ul class="side-menu top">
            <li class="active">
                <a href="#" onclick="showDashboard()">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Recent </span>
                </a>
            </li>
            <li>
                <a href="#" onclick="showRoomDetails()">
                    <i class='bx bxs-institution'></i>
                    <span class="text">Room</span>
                </a>
            </li>

            <li>
                <a href="#" onclick="showReservationDetails()">
                    <i class='bx bxs-doughnut-chart'></i>
                    <span class="text">Reservation</span>
                </a>
            </li>
            <li>
                <a href="#" onclick="showStaffDetails()">
                    <i class='bx bxs-group'></i>
                    <span class="text">Staff</span>
                </a>
            </li>

            <li>
                <a href="#" onclick="showEventDetails()">
                    <i class='bx bxs-calendar-event'></i>
                    <span class="text">Event</span>
                </a>
            </li>

            <!-- <li>
                <a href="#" onclick="showFAQs()">
                    <i class='bx bxs-message-dots'></i>
                    <span class="text">FAQ</span>
                </a>
            </li> -->
            <li>
                <a href="#" onclick="showSettings()">
                    <i class='bx bxs-cog'></i>
                    <span class="text">Settings</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu top">
            <li>
                <a href="../AdminPanel/logout.php" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">

        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input">
                    <!-- <input type="search" placeholder="Search..."> -->
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden>

            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin') : ?>

                <!-- <a href="#" class="notification" onclick="showNotification()">
                    <i class='bx bxs-bell'></i>
                    <span class="num">8</span>
                </a> -->

            <?php endif; ?>

            <a href="#" class="profile-button">
                <?php if (isset($_SESSION['user_name'])) : ?>
                    <span><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                <?php else : ?>
                    <span>No username set</span>
                <?php endif; ?>
            </a>

        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <?php include('message.php'); ?>
            <div class="head-title">

                <div class="left">
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin'): ?>
                        <h1>Admin Dashboard</h1>
                    <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'Receptionist'): ?>
                        <h1>Receptionist Dashboard</h1>
                    <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'Room Manager'): ?>
                        <h1>Room Manager Dashboard</h1>
                    <?php endif; ?>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="#" id="breadcrumb">Recent</a>
                        </li>
                    </ul>
                </div>
            </div>

            <ul class="box-info">
                <li>
                    <i id="calendar-icon" class='bx bxs-calendar-check'></i>
                    <span class="text">
                        <h3>Pick a date</h3>
                        <form method="post">
                            <input type="date" name="date" id="date" value="<?php echo htmlspecialchars($selectedDate); ?>" onchange="updateDate()">
                        </form>
                    </span>
                    <script>
                        document.addEventListener('DOMContentLoaded', (event) => {
                            // Function to update date input if not already set
                            const updateDate = () => {
                                const dateInput = document.getElementById('date');
                                if (!dateInput.value) {
                                    const today = new Date().toISOString().split('T')[0];
                                    dateInput.value = today;
                                }
                            };

                            // Call updateDate on DOMContentLoaded and when date input changes
                            updateDate();

                            // Function to submit form when date changes
                            const dateInput = document.getElementById('date');
                            dateInput.addEventListener('change', function() {
                                this.form.submit();
                            });
                        });
                    </script>

                </li>
                <li>
                    <i class='bx bx-bed'></i>
                    <span class="text">
                        <h3><?php echo $availableRooms; ?></h3>
                        <p>Available Rooms</p>
                    </span>
                </li>
                <li>
                    <i class='bx bx-registered'></i>
                    <span class="text">
                        <h3><?php echo $reservedRooms; ?></h3>
                        <p>Reserved Rooms</p>
                    </span>
                </li>
            </ul>

            <div class="table-data">
                <form action="" method="post">
                    <div class="order">
                        <?php include('message.php'); ?>
                        <div class="head">
                            <h3>Recent Bookings</h3>

                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Reservation No</th>
                                    <th>Customer Name</th>
                                    <th>Check in</th>
                                    <th>Check out</th>
                                    <th>Payment status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($reservations)) : ?>
                                    <?php foreach ($reservations as $reservation) : ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($reservation['reservation_id']); ?></td>
                                            <td><?php echo htmlspecialchars($reservation['full_name']); ?></td>
                                            <td><?php echo htmlspecialchars($reservation['check_in_date']); ?></td>
                                            <td><?php echo htmlspecialchars($reservation['check_out_date']); ?></td>
                                            <td><?php echo htmlspecialchars($reservation['payment_status']); ?></td>
                                            <td>
                                                <div class="icon-button">

                                                    <?php if ($reservation['reservation_status'] === 'cancelled') : ?>

                                                        <button type="button" onclick="cancelReservation(<?php echo htmlspecialchars($reservation['reservation_id']); ?>)" style="color: red; background-color: white; border: none; border-radius: 5px; padding: 8px; width: 100px; ">
                                                            <span><b>Cancelled</b></span>
                                                        </button>

                                                    <?php else : ?>

                                                        <a href="viewReservations.php?reservation_id=<?php echo htmlspecialchars($reservation['reservation_id']); ?>">
                                                            <button type="button"><img src="../Assests/view.png" alt="View"></button>
                                                        </a>
                                                </div>
                                            <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="5">No reservations found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <!-- Pagination Links -->
                        <div class="pagination">
                            <?php if ($page > 1) : ?>
                                <a href="?page=<?php echo $page - 1; ?>" class="pagination-link">Previous</a>
                            <?php endif; ?>
                            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                                <a href="?page=<?php echo $i; ?>" <?php if ($i == $page) echo 'class="pagination-link active"';
                                                                    else echo 'class="pagination-link"'; ?>><?php echo $i; ?></a>
                            <?php endfor; ?>
                            <?php if ($page < $totalPages) : ?>
                                <a href="?page=<?php echo $page + 1; ?>" class="pagination-link">Next</a>
                            <?php endif; ?>
                        </div>

                    </div>
                </form>

                <!-- Room section start -->
                <?php include('message.php'); ?>
                <form action="AddRoom.php" method="post">
                    <div class="order" id="roomDetails">
                        <div class="head" style="margin-top: -32px;">
                            <h3>Room Details</h3>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Room ID</th>
                                    <th>Room Type</th>
                                    <th>Guest count</th>
                                    <th>Price per night</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($rooms)) : ?>
                                    <?php foreach ($rooms as $room) : ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($room['room_id']); ?></td>
                                            <td><?php echo htmlspecialchars($room['room_type']); ?></td>
                                            <td><?php echo htmlspecialchars($room['adult_count'] + $room['children_count']); ?></td>
                                            <td><?php echo htmlspecialchars($room['price_per_night']); ?></td>
                                            <td>
                                                <div class="icon-button" id="roomDetailsSection">
                                                    <button type="button" class="viewButton"><a href="ViewRoom.php?room_id=<?php echo $room['room_id']; ?>"><img src="../Assests/view.png" alt="View"></a></button>

                                                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin') : ?>
                                                        <button type="button" class="editButton"><a href="EditRoom.php?room_id=<?php echo $room['room_id']; ?>"><img src="../Assests/edit.png" alt="Edit"></a></button>
                                                        <button type="button" onclick="DeleteProcess(<?php echo $room['room_id']; ?>, 'room')"><img src="../Assests/delete.png" alt="Delete"></button>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="5">No Room found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin') : ?>
                            <div><button type="submit" class="btn-add">Add +</button></div>
                        <?php endif; ?>
                    </div>
                </form>

                <!-- Room section end -->


                <!-- Reservation start -->
                <?php include('message.php'); ?>
                <form action="AddReservation.php" method="post">
                    <div class="order" id="reservation" style="display:none;">
                        <div class="head" style="margin-top: -32px;">
                            <h3>Reservations</h3>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Reservation ID</th>
                                    <th>Room Number</th>
                                    <th>Amount</th>
                                    <th>Guest count</th>
                                    <th>Payment status</th>
                                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin' || $_SESSION['role'] === 'Receptionist') : ?>
                                        <th>Resrvation status</th>
                                    <?php endif; ?>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($reservations as $reservation) : ?>
                                    <?php if (!empty($reservations)) : ?>
                                        <tr id="reservation-row-<?php echo htmlspecialchars($reservation['reservation_id']); ?>">
                                            <td><?php echo htmlspecialchars($reservation['reservation_id']); ?></td>
                                            <td><?php echo htmlspecialchars($reservation['room_id']); ?></td>
                                            <td><?php echo htmlspecialchars($reservation['total_price']); ?></td>
                                            <td><?php echo htmlspecialchars($reservation['number_of_adult'] + $reservation['number_of_children']); ?></td>
                                            <td><?php echo htmlspecialchars($reservation['payment_status']); ?></td>

                                            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin' || $_SESSION['role'] === 'Receptionist') : ?>
                                                <td>
                </form>
                <form action="./cancel_reservation.php" method="POST" onsubmit="return confirm('Are you sure you want to cancel this reservation?');">
                    <input type="hidden" name="cancel_reservation_id" value="<?php echo htmlspecialchars($reservation['reservation_id']); ?>" />
                    <input type="hidden" name="reason" value="Customer request" />
                    <input type="submit" name="CancelReservation" value="Cancel" style="color: black; background-color: #b89bb1; border: none; border-radius: 5px; padding: 8px; width: 100px; cursor: pointer;">
                </form>
                <form action="AddReservation.php" method="post">
                    </td>
                <?php endif ?>



                <td>
                    <div class="icon-button">

                        <?php if ($reservation['reservation_status'] === 'cancelled') : ?>


                            <a href="viewReservations.php?reservation_id=<?php echo htmlspecialchars($reservation['reservation_id']); ?>">
                                <button type="button"><img src="../Assests/view.png" alt="View"></button>
                            </a>

                            <button type="button" onclick="DeleteProcess(<?php echo htmlspecialchars($reservation['reservation_id']); ?>, 'reservation')">
                                <img src="../Assests/delete.png" alt="Delete">
                            </button>

                        <?php else : ?>

                            <a href="viewReservations.php?reservation_id=<?php echo htmlspecialchars($reservation['reservation_id']); ?>">
                                <button type="button"><img src="../Assests/view.png" alt="View"></button>
                            </a>

                            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin' || $_SESSION['role'] === 'Receptionist') : ?>

                                <a href="EditReservation.php?reservation_id=<?php echo htmlspecialchars($reservation['reservation_id']); ?>">
                                    <button type="button" class="editButton">
                                        <img src="../Assests/edit.png" alt="Edit">
                                    </button>
                                </a>

                                <button type="button" onclick="DeleteProcess(<?php echo htmlspecialchars($reservation['reservation_id']); ?>, 'reservation')">
                                    <img src="../Assests/delete.png" alt="Delete">
                                </button>

                            <?php endif; ?>

                        <?php endif; ?>

                    </div>
                </td>
                </tr>
            <?php else : ?>
                <tr>
                    <td colspan="5">No reservations Found.</td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>

        </tbody>
        </table>
        <div><button class="btn-add" id="show-staff">Add +</button></div>

        <!-- Pagination Links -->
        <div class="pagination">
            <?php if ($page > 1) : ?>
                <a href="?page=<?php echo $page - 1; ?>" class="pagination-link">Previous</a>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <a href="?page=<?php echo $i; ?>" <?php if ($i == $page) echo 'class="pagination-link active"';
                                                    else echo 'class="pagination-link"'; ?>><?php echo $i; ?></a>
            <?php endfor; ?>
            <?php if ($page < $totalPages) : ?>
                <a href="?page=<?php echo $page + 1; ?>" class="pagination-link">Next</a>
            <?php endif; ?>
        </div>
            </div>
            </form>
            <!-- Reservation end -->

            <!-- Staff Strt -->

            <form action="AddStaff.php" method="post">
                <?php include('message.php'); ?>
                <div class="order" id="staff" style="display:none;">
                    <div class="head" style="margin-top: -32px;">
                        <h3>Staff details</h3>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin'): ?>
                                    <th>Staff ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($staffList as $staff) : ?>
                                <?php if (!empty($staffList)) : ?>
                                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin'): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($staff['staff_id']); ?></td>
                                            <td><?php echo htmlspecialchars($staff['firstname']); ?></td>
                                            <td><?php echo htmlspecialchars($staff['lastname']); ?></td>
                                            <td><?php echo htmlspecialchars($staff['email']); ?></td>
                                            <td><?php echo htmlspecialchars($staff['role']); ?></td>
                                            <td>
                                                <div class="icon-button">
                                                    <button type="button" onclick="viewStaff(<?php echo $staff['staff_id']; ?>)"><a href="ViewStaff.php?staff_id=<?php echo $staff['staff_id']; ?>"><img src="../Assests/view.png" alt="View"></button>

                                                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin'): ?>
                                                        <button type="button" onclick="editStaff(<?php echo $staff['staff_id']; ?>)"><a href="EditStaff.php?staff_id=<?php echo $staff['staff_id']; ?>"><img src="../Assests/edit.png" alt="Edit"></a></button>
                                                        <button type="button" onclick="DeleteProcess(<?php echo $staff['staff_id']; ?>, 'staff')"><img src="../Assests/delete.png" alt="Delete"></button>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="5">No Staff Found.</td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>

                        </tbody>

                    </table>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin'): ?>
                        <div><button class="btn-add" id="show-staff">Add +</button></div>
                    <?php else: ?>
                        <div class="no-events-container" style="border: 1px solid #ccc; border-radius: 5px; padding: 20px; text-align: center; background-color: #f9f9f9; margin: 20px; color: #555;">
                            <h2>This is Section is Not Available</h2>

                        </div>

                    <?php endif; ?>
                </div>
            </form>

            <!-- Staff end -->

            <!-- event strt -->

            <form action="add_event_status.php" method="post">
                <div class="order" id="event" style="display:none;">
                    <div class="head" style="margin-top: -32px;">
                        <h3>Event</h3>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Reservation ID</th>
                                <th>Event Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($event as $customEvent) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($customEvent['reservation_id']); ?></td>
                                    <td>
                                        <?php
                                        $cus_id = $customEvent['customization_id'];
                                        $event_type_id = EventCustomization::getEventTypeIdByCustomizationId($con, $cus_id);
                                        $event_name = EventTypes::getEventNameById($con, $event_type_id);
                                        echo $event_name;
                                        ?>
                                    </td>
                                    <td>
                                        <!-- Add a hidden input for customization_id -->
                                        <input type="hidden" name="customization_id[]" value="<?php echo $cus_id; ?>">
                                        <select name="status[]" class="custom-select">
                                            <option value="Set" <?php echo $customEvent['status'] == 'Set' ? 'selected' : ''; ?>>Set</option>
                                            <option value="Not Set" <?php echo $customEvent['status'] == 'Not Set' ? 'selected' : ''; ?>>Not Set</option>
                                        </select>
                                    </td>
                                    <td>
                                        <div class="icon-button">
                                            <button type="button" onclick="viewEvent(<?php echo $customEvent['reservation_id']; ?>)">
                                                <img src="../Assests/view.png" alt="View">
                                            </button>

                                            <script>
                                                function viewEvent(reservationId) {
                                                    window.location.href = 'EventCustomization.php?reservation_id=' + reservationId;
                                                }
                                            </script>

                                            <button type="button" onclick="DeleteProcess()"><img src="../Assests/delete.png" alt="Delete"></button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div><button class="btn-add" id="show-staff" type="submit">Save Changes</button></div>
                </div>

                <!-- Pagination Links -->
                <div class="pagination">
                    <?php if ($page > 1) : ?>
                        <a href="?page=<?php echo $page - 1; ?>" class="pagination-link">Previous</a>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                        <a href="?page=<?php echo $i; ?>" <?php if ($i == $page) echo 'class="pagination-link active"';
                                                            else echo 'class="pagination-link"'; ?>><?php echo $i; ?></a>
                    <?php endfor; ?>
                    <?php if ($page < $totalPages) : ?>
                        <a href="?page=<?php echo $page + 1; ?>" class="pagination-link">Next</a>
                    <?php endif; ?>
                </div>
                </div>
            </form>

            <!-- event end -->

            <!-- FAQ strt -->

            <form action="" method="post" style="width: 100%;">
                <?php include('message.php'); ?>
                <div class="order" id="faq" style="display:none;">
                    <div class="head" style="margin-top: -32px;">
                        <h3>FAQ</h3>
                    </div>

                    <div class="faq" style="background-color: #cebcca; padding: 10px;">
                        <?php if (!empty($reservations)) : ?>
                            <?php $count = 1; ?>
                            <?php foreach ($faqList as $faqItem) : ?>
                                <div class="faq-item" style="border-bottom: 1px solid #ccc; padding-bottom: 10px;">
                                    <div class="faq-question" style="display: flex; justify-content: space-between; align-items: center;">
                                        <div style="flex-grow: 1;">
                                            <?php echo $count . ". " . htmlspecialchars($faqItem['faq_question']); ?>
                                        </div>
                                        <div class="icon-button" style="display: flex; gap: 5px;">
                                            <button type="button"><img src="../Assests/edit.png" alt="Edit" style="width: 20px; height: 20px;"></button>
                                            <button type="button" onclick="DeleteProcess(<?php echo $faqId; ?>, 'faq', event)">
                                                <img src="../Assests/delete.png" alt="Delete" style="width: 20px; height: 20px;">
                                            </button>
                                            <button type="button"><img src="../Assests/icons8-upload-26.png" alt="upload" style="width: 20px; height: 20px;"></button>
                                        </div>
                                    </div>
                                    <div class="faq-answer" style="display: none; padding: 10px; background-color: #f9f9f9; margin-top: 10px;">
                                        <?php echo htmlspecialchars($faqItem['faq_answer']); ?>
                                    </div>
                                </div>
                                <?php $count++; ?>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5">No FAQ found.</td>
                            </tr>
                        <?php endif; ?>
                    </div>

                    <div><button class="btn-add" id="show-faq">Add +</button></div>

                </div>
            </form>

            <!-- FAQ end -->

            <!-- Settings strt -->

            <form action="AddEvent.php" method="post">
                <div class="order" id="settings" style="display:none;">
                    <div class="head">
                        <h3>Settings</h3>

                    </div>

                    <ul class="Home-settings">

                        <li>
                            <i class='AboutUs content'></i>
                            <button>Event Settings</button>
                        </li>
                        <!-- <li>
                            <i class='gallary'></i>
                            <button>Gallary</button>
                        </li>
                        <li>
                            <i class='Feedback'></i>
                            <button>Feedback</button>
                        </li> -->

                    </ul>

                </div>
            </form>

            <!-- Settings end -->

        </main>
        <!-- MAIN end-->

    </section>
    <!-- CONTENT -->

    <script src="../JS/Admin_script.js"></script>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Moment.js -->
    <script src="https://cdn.jsdelivr.net/momentjs/2.29.1/moment.min.js"></script>

    <!-- Include Date Range Picker JS -->
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <!-- <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('date').value = today;

        });
    </script> -->

    <script>
        function viewEvent(reservationId) {
            // Redirect to the EventCustomization page with the reservation_id as a query parameter
            window.location.href = 'EventCustomization.php?reservation_id=' + reservationId;
        }
    </script>

</body>

</html>