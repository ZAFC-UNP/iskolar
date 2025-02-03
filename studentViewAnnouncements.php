
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

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
<link href="css/bar.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="icon" type="img/png" href="img/unplogo.png">
    <title>Announcements</title>
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
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-custom sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index-iskolar.php">
                <div class="sidebar-brand-icon">
                    <img src="img/unplogo.png" alt="UNP iSkolar" height="60px">
                </div>
                <div class="sidebar-brand-text mx-3">iSkolar</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index-iskolar.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Main</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Student
            </div>

            <!-- Nav Item - Announcements -->
            <li class="nav-item active">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-bullhorn active"></i>
                    <span>Announcements</span></a>
            </li>

            <!-- Nav Item - Profile -->
            <li class="nav-item">
                <a class="nav-link" href="showProfileIskolar.php">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Profile</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

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
                            $query = "SELECT * FROM announcement GROUP BY dateCreated DESC";
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
                            <div class="card-header bg-success py-3">
                            <h6 class="m-0 font-weight-bold text-white">📢 List of Announcements</h6>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($announcements)) {?>
                                <?php foreach ($announcements as $announcement) {?>
                                    <div class="card mb-3">
                                        <div class="card-body border-left-success shadow h-100 py-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <h4 class="card-title"><strong><?php echo $announcement['title']; ?></strong></h4>
                                            </div>
                                            <p class="card-text"><?php echo $announcement['messageContent'];?></p>
                                            <p class="card-text"><small class="text-muted">Posted on <?php echo $announcement['dateCreated'];?></small></p>
                                        </div>
                                    </div>
                                <?php }?>
                            <?php } else {?>
                                <p>No announcements yet</p>
                            <?php }?>
                            </div>
                        </div>      
                    </div>
     
                    <!-- Floating Action Button -->
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
    <a class="scroll-to-top rounded" style="margin-bottom: 60px; margin-right: 10px;"href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
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
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
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
