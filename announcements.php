
<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ensure the user is logged in
if (!isset($_SESSION['uid'])) {
    header("Location: index.php"); // Redirect to login page if not logged in
    exit();
}
//var_dump($_SESSION); // Print the session variables to see if they are being set correctly

// Retrieve user information from the session
$username = $_SESSION['username'];
$photoPath = $_SESSION['photoPath'];
$userType = $_SESSION['userType'];
$fullName = $_SESSION['fullName'];

if($userType != "admin"){
    header("Location: permissionControl.php"); // Redirect to login page if not logged in
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
<link href="css/bar.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="icon" type="img/png" href="img/unplogo.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <title>iSkolar Online - Announcements</title>
    <style>
               .fab {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 56px;
            height: 56px;
            background-color: #4e73df;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            cursor: pointer;
            z-index: 1000;
            transition: transform 0.5s ease; /* Add transition for smooth rotation */
        }

        .fab.active {
            transform: rotate(45deg); 
        }

        .fab i {
            color: #fff;
            font-size: 24px;
        }

        .fab-options {
            position: fixed;
            bottom: 80px;
            right: 20px;
            display: none;
            flex-direction: column;
            align-items: center;
            z-index: 999;
        }

        .fab-option {
            width: 40px;
            height: 40px;
            background-color: #4e73df;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            cursor: pointer;
        }

        .fab-option i {
            color: #fff;
            font-size: 20px;
        }

        .action-icons {
            justify-content: center;
        }
        .action-icons i {
            margin-right: -10px;
            margin-bottom: 10px;
            margin-left: 5px;
            cursor: pointer;

        }
        .announcement-content {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            transition: all 0.3s ease;
            max-height: 3em; /* Initial height for truncated text */
        }

        .content-expanded {
            white-space: normal;
            overflow: visible;
            max-height: none; /* No limit on height when expanded */
        }
        .hidden {
            display: none;
        }
        .dropdown-menu.notifications-container {
            max-height: 300px; /* Set the maximum height you want */
            overflow-y: auto;  /* Enable vertical scrolling if content exceeds max-height */
        }
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-custom sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index-admin.php">
                <div class="sidebar-brand-icon">
                    <img src="img/unplogo.png" alt="UNP iSkolar" height="60px">
                </div>
                <div class="sidebar-brand-text mx-3">iSkolar</div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index-admin.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">Admin</div>
            <!-- Nav Item - Announcements -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAnnouncements"
                    aria-expanded="true" aria-controls="collapseAnnouncements">
                    <i class="fas fa-fw fa-bullhorn"></i>
                    <span>Announcements</span>
                </a>
                <div id="collapseAnnouncements" class="collapse" aria-labelledby="headingAnnouncements" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Manage Announcements:</h6>
                        <a class="collapse-item active" href="#">View All Announcements</a>
                        <a class="collapse-item" href="create_announcement.php">Create Announcement</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Users -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Users</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rlinded">
                <h6 class="collapse-header">Add Users:</h6>
                        <a href="addUser.php" class="collapse-item ">Add User Account</a>
                        <h6 class="collapse-header">List of Scholars:</h6>
                        <a class="collapse-item" href="users.php">All Registered Scholars</a>
                        <a class="collapse-item" href="activeUsers.php">Active Scholars</a>
                        <a class="collapse-item" href="inactiveUsers.php">Inactive Scholars</a>
                        <a href="pending.php" class="collapse-item">Pending Scholars</a>
                        <a href="graduate.php" class="collapse-item">Graduated Scholars</a>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGenerateReport"
                    aria-expanded="true" aria-controls="collapseGenerateReport">
                    <i class="fas fa-fw fa-file"></i>
                    <span>Generate Report</span>
                </a>
                <div id="collapseGenerateReport" class="collapse" aria-labelledby="headingGenerateReport" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Generate Report:</h6>
                        <a class="collapse-item" href="generateReport.php">Current Scholarship list</a>
                        <a class="collapse-item" href="generatePastList.php">Previous Lists</a>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="sidebar-heading">School Year</div>
            <li class="nav-item">
                <a class="nav-link" href="#" onclick="confirmNewTerm()">
                    <i class="fas fa-fw fa-calendar"></i>
                    <span>Enter New Semester</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
            <!-- Sidebar Message -->
        </ul>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light navbar-bg-custom topbar mb-4 text-white static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100">
                        <h6>
                        <?php
                        date_default_timezone_set('Asia/Manila');
                            $currentTime = date('H');
                            if ($currentTime < 12) {
                                echo "Good morning";
                            } elseif ($currentTime < 17) {
                                echo "Good afternoon";
                            } else {
                                echo "Good evening";
                            }
                            echo " " . $_SESSION['fullName'] . ", ";
                            
                            ?>
                        </h6>
                    </div>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <!-- Counter - Notifications -->
        <span id="notification-counter" class="badge badge-danger badge-counter"></span>
    </a>

    <!-- Dropdown - Alerts -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in notifications-container"
        aria-labelledby="alertsDropdown">
        <h6 class="dropdown-header">
            Notifications
        </h6>
        <div id="notifications-list"></div>
    </div>
</li>
                        <!-- Profile Dropdown -->
                        <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline navbar-text text-white small">
                                    <!-- Display the idNum here -->
                                    <?php echo htmlspecialchars($username); ?> <br>
                                    <div style="margin-top: -3px"> <?php echo htmlspecialchars($userType); ?> </div>
                                </span>
                                <img class="img-profile rounded-circle" src="<?php echo htmlspecialchars($photoPath); ?>" alt="Profile Photo" onerror="this.onerror=null;this.src='img/undraw_profile.svg';">
                            </a>
                            <!-- Dropdown - User Information -->
                                       <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="showProfile.php">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <?php if ($username == '21-03561'): ?>
                    <a class="dropdown-item" href="logs.php">
                        <i class="fas fa-file-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logs
                    </a>
                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#scholarshipModal">
    <i class="fas fa-file-alt fa-sm fa-fw mr-2 text-gray-400"></i>
    Scholarship Programs
</a>
                <?php endif; ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Announcements</h1>
                        
                        <?php
                            include('includes/dbcon.php');

                            // Retrieve announcements from database
                            $query = "SELECT * FROM announcement WHERE status = 'active' GROUP BY dateCreated DESC";
                            $result = $conn->query($query);

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $announcements[] = $row;
                                }
                            } else {
                                $announcements = array();
                            }
                        
                            // Close connection
                            $conn->close();
                        ?>
                    </div>
                    <!-- Content Row -->
                    <div class="row">
                         <div class="col-xl-12 mb-4">
                            <div class="card shadow h-100 py-2">
                            <div class="card-header bg-success text-white py-3">
                            <h6 class="m-0 font-weight-bold ">📢 List of Announcements</h6>
                        </div>
                        <div class="card-body">
                                <?php if (!empty($announcements)) { ?>
                                    <?php foreach ($announcements as $index => $announcement) { ?>
                                        <div class="row mb-3 announcement-item" data-index="<?php echo $index; ?>">
                                        <div class="col-md-4 d-flex justify-content-center align-items-center">
                                            <a href="uploads/announcement/<?php echo htmlspecialchars($announcement['photo']); ?>" 
                                            data-lightbox="announcement-image" 
                                            data-title="<?php echo htmlspecialchars($announcement['title']); ?>">
                                                <img src="uploads/announcement/<?php echo htmlspecialchars($announcement['photo']); ?>" 
                                                    alt="Announcement Image" 
                                                    class="img-fluid rounded" 
                                                    style="max-height: 200px; object-fit: cover; cursor: pointer;">
                                            </a>
                                        </div>
                                                <div class="col-md-8">
                                                <h5 class="font-weight-bold d-flex justify-content-between align-items-center">
    <?php echo htmlspecialchars($announcement['title']); ?>
    <button class="btn btn-danger btn-sm" onclick="deleteAnnouncement(<?php echo $announcement['aid']; ?>)" title="Delete Announcement">
        <i class="fas fa-trash"></i>
    </button>
</h5>

                                                <p class="announcement-content content-collapsed"style="text-align:justify;"><?php echo htmlspecialchars($announcement['messageContent']); ?></p>
                                                <p><small class="text-muted">To: <?php echo htmlspecialchars($announcement['recipient']); ?> SCHOLARS</small></p>
                                                <p><small class="text-muted">Posted on <?php echo htmlspecialchars($announcement['dateCreated']); ?></small></p>
                                                <button class="btn btn-success btn-sm " onclick="toggleContent(this)">See More</button>
                                                </div>
                                        </div>
                                            <?php } ?>
                                        <?php } else { ?>
                                    <p>No announcements yet</p>
                                <?php } ?>
                                <?php if (count($announcements) > 3): ?>
                                <div class="text-center">
                                <button id="toggleButton" class="btn btn-success text-white">See Less</button>
                                </div>
                                <?php endif; ?>
                                <script>
                                // JavaScript to handle the "See More / See Less" toggle
                                document.getElementById('toggleButton').addEventListener('click', function() {
                                    var announcementItems = document.querySelectorAll('.announcement-item');
                                    var button = this;

                                    announcementItems.forEach(function(item, index) {
                                        if (index >= 3) {
                                            // Toggle visibility of extra announcements
                                            item.classList.toggle('hidden');
                                        }
                                    });

                                    // Update button text
                                    button.textContent = button.textContent === 'See All Announcements' ? 'See Less' : 'See All Announcements';
                                });
                                </script>
                            </div>
                        </div>      
                    </div>
                    <!-- Floating Action Button -->
                    <div class="fab" id="fab" onclick="toggleFabOptions()">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="fab-options" id="fab-options">
                        <div class="fab-option" onclick="window.location.href='create_announcement.php'">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <div class="fab-option" onclick="window.location.href='addUser.php'">
                            <i class="fas fa-user-plus"></i>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>© iSkolar Online 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <!-- <a class="scroll-to-top rounded" style="margin-bottom: 60px; margin-right: 10px;"href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a> -->
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="index.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
<!-- Modal -->
<div class="modal fade" id="scholarshipModal" tabindex="-1" aria-labelledby="scholarshipModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scholarshipModalLabel">Scholarship Programs</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
        style="
            background-color: #f8f9fa; /* Light background color for better contrast */
            border: 1px solid #dee2e6; /* Subtle border */
            border-radius: 50%; /* Fully rounded button */
            width: 40px; /* Larger clickable area */
            height: 40px; /* Larger clickable area */
            padding: 0; /* Remove default padding */
            font-size: 1.25rem; /* Slightly larger icon */
            color: #6c757d; /* Grey color for the icon */
            display: flex; /* Center the icon */
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); /* Slight shadow for depth */
            transition: background-color 0.3s, color 0.3s; /* Smooth transition for hover effects */
        "
        onmouseover="this.style.backgroundColor='#e9ecef'; this.style.color='#343a40';"
        onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.color='#6c757d';">
        <i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <!-- Table to display scholarship programs -->
                <table id="scholarshipTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Program Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be populated here by JavaScript -->
                    </tbody>
                </table>

                <!-- Form to add a new scholarship program -->
                <form id="addScholarshipForm">
                    <div class="mb-3">
                        <label for="programName" class="form-label">Scholarship Program Name</label>
                        <input type="text" class="form-control" id="programName" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Program</button>
                </form>
            </div>
        </div>
    </div>
</div>


    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>


    <script>
        const fab = document.getElementById('fab');
        function toggleFabOptions() {
            const fabOptions = document.getElementById('fab-options');
            if (fabOptions.style.display === 'none' || fabOptions.style.display === '') {
                fabOptions.style.display = 'flex';
                fab.classList.add('active'); // Add the 'active' class for rotation
            } else {
                fabOptions.style.display = 'none';
                fab.classList.remove('active'); // Remove the 'active' class
            }
        }
    </script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get the JSON data from PHP
        var usertypeData = <?php echo $json_data; ?>;

        // Check if the JSON data is correctly parsed
        console.log(usertypeData);

        
    });
</script>

<script>
    function deleteAnnouncement(aid) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this announcement!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    url: 'controller/delete_announcement.php',
                    data: {aid: aid},
                    success: function(data) {
                        Swal.fire(
                            'Deleted!',
                            'Your announcement has been deleted.',
                            'success'
                        ).then((result) => {
                            location.reload();
                        });
                    }
                });
            }
        });
    }
</script>

<script>
    const trashIcons = document.querySelectorAll('.hover-trash');

trashIcons.forEach(icon => {
  icon.addEventListener('mouseover', () => {
    icon.classList.add('fa-trash-restore-alt');
    icon.classList.remove('fa-trash-alt');
  });

  icon.addEventListener('mouseout', () => {
    icon.classList.add('fa-trash-alt');
    icon.classList.remove('fa-trash-restore-alt');
  });
});
</script>
<script>
    function confirmNewTerm() {
        Swal.fire({
            title: 'Confirm New Semester',
            text: 'Are you sure you want to enter a new semester?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, proceed',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading alert
                Swal.fire({
                    title: 'Please wait...',
                    html: 'Saving your information...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Redirect to your PHP script after the loading alert is displayed
                setTimeout(() => {
                    window.location.href = 'controller/NewTerm.php'; // Adjust the path accordingly
                }, 100); // Short delay to allow Swal to render
            }
        });
        return false; // Prevent default link behavior
    }
</script>
<script>
function toggleContent(button) {

    var content = button.parentNode.querySelector('.announcement-content');
    

    if (content.classList.contains('content-collapsed')) {
        content.classList.remove('content-collapsed');
        content.classList.add('content-expanded');
        button.textContent = 'See Less';
    } else {
        content.classList.remove('content-expanded');
        content.classList.add('content-collapsed');
        button.textContent = 'See More';
    }
}
    </script>
    <script>
    $(document).ready(function() {
        // Function to fetch unread notifications count and notifications list
        function fetchNotifications() {
            $.ajax({
                url: 'controller/get_notifications.php', // PHP file to handle fetching notifications
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    //console.log('Received notification list:', response); // Log the entire response to check its structure

                    // Update notification counter
                    $('#notification-counter').html(response.unreadCount);

                    // Update notification list
                    $('#notifications-list').html(response.notificationsHTML);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching notifications:', error);
                }
            });
        }

        // Fetch notifications initially and every 10 seconds (adjust the time as needed)
        fetchNotifications();
        setInterval(fetchNotifications, 5000);
    });

    $("#alertsDropdown").click(function() {
    // Trigger the AJAX request to update the notification statuses
    $.ajax({
        type: "POST",
        url: "controller/update_notifications.php", // Replace with the URL of your PHP script
        success: function(data) {
            //console.log(data); // Log the response from the PHP script
        }
    });

    // Update the notification counter and list
    // You can add code here to update the notification counter and list
    // For example:
    $("#notification-counter").html("0");
});
</script>
<script>
    $(document).ready(function() {
        // Fetch and display scholarship programs when the modal is shown
        $('#scholarshipModal').on('show.bs.modal', function() {
            fetchScholarships();
        });

        // Fetch scholarship programs from the server
        function fetchScholarships() {
            $.ajax({
                url: 'controller/fetchScholarships.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log('Response received:', response); // Debugging line
                    if (response.success) {
                        var tableBody = $('#scholarshipTable tbody');
                        tableBody.empty();
                        if (response.data.length === 0) {
                            tableBody.append('<tr><td colspan="3">No scholarships available.</td></tr>');
                        } else {
                            response.data.forEach(function(program, index) {
                                tableBody.append(
                                    '<tr>' +
                                    '<td>' + (index + 1) + '</td>' +
                                    '<td>' + htmlspecialchars(program.scholarName) + '</td>' +
                                    '<td><button class="btn btn-danger btn-sm remove-btn" data-id="' + program.id + '"><i class="fas fa-trash-alt"></i></button></td>' +
                                    '</tr>'
                                );
                            });
                        }
                    } else {
                        Swal.fire('Error', response.message || 'Error fetching scholarship programs.', 'error');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching scholarship programs:', error);
                    Swal.fire('Error', 'Error fetching scholarship programs. Please try again later.', 'error');
                }
            });
        }

        // Function to encode HTML special characters
        function htmlspecialchars(str) {
            return $('<div>').text(str).html();
        }

        $('#addScholarshipForm').submit(function(e) {
            e.preventDefault();
            var programName = $('#programName').val().toUpperCase();

            $.ajax({
                url: 'controller/addScholarship.php', // Server script to add data
                type: 'POST',
                data: { scholarName: programName },
                success: function(response) {
                    if (response.success) {
                        fetchScholarships(); // Refresh the list
                        $('#programName').val(''); // Clear the form input
                        Swal.fire('Success', 'Scholarship Program Added', 'success');
                    } else {
                        Swal.fire('Error', 'Failed to add Scholarship Program', 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error', 'Failed to add Scholarship Program', 'error');
                }
            });
        });

        // Handle click event for remove buttons
        $('#scholarshipTable').on('click', '.remove-btn', function() {
            var scholarshipId = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to remove this scholarship program.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, remove it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'controller/removeScholarship.php', // Server script to remove data
                        type: 'POST',
                        data: { scholarId: scholarshipId },
                        success: function(response) {
                            if (response.success) {
                                fetchScholarships(); // Refresh the list
                                Swal.fire('Removed!', 'Scholarship Program has been removed.', 'success');
                            } else {
                                Swal.fire('Error', response.message || 'Failed to remove Scholarship Program', 'error');
                            }
                        },
                        error: function() {
                            Swal.fire('Error', 'Failed to remove Scholarship Program', 'error');
                        }
                    });
                }
            });
        });
    });
</script>
