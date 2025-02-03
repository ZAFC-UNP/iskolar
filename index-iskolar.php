
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
    <link rel="stylesheet" href="css/student.css">
    <title>iSkolar Online</title>
    <style>
        .sidebar-brand {
            font-family: 'Nunito', sans-serif;
            font-weight: 900;
            font-size: 1.5rem;
            color: #fff;
            text-shadow: 2px 2px 2px rgba(0,0,0,0.5);
        }
        body{
            color: black;
        }
        .hidden {
    display: none;
}
.centered-container {
    display: flex;
    justify-content: center; /* Centers the row content */
    padding: 20px;
}

.centered-container .row {
    display: flex;
    justify-content: center; /* Centers the columns within the row */
    margin: 0; /* Remove default margin */
}

.centered-container .col-md-4 {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    margin: 15px;
    flex: 1; /* Allows the columns to grow equally */
    transition: transform 0.3s;
}

.centered-container .col-md-4 h2 {
    color: #000000;
    margin-bottom: 15px;
}

.centered-container .col-md-4 p {
    line-height: 1.6;
}

.centered-container .col-md-4:hover {
    transform: translateY(-5px); /* Lift effect on hover */
}

@media (max-width: 768px) {
    .centered-container .row {
        flex-direction: column;
    }
    .centered-container .col-md-4 {
        margin-bottom: 20px; /* Space between stacked columns */
    }
}

    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
    
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light navbar-bg-custom topbar text-white static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <a class="sidebar-brand d-flex align-items-center justify-content-center" style="text-decoration:none;" href="index-iskolar.php">
                <div class="sidebar-brand-icon">
                    <img src="img/unplogo.png" alt="UNP iSkolar" height="60px">
                </div>
                <div class="sidebar-brand-text mx-3">iSkolar Online</div>
            </a>
            <div class="d-none d-sm-inline-block mx-3 my-2 border-left" style="border-left: 2px solid #fff; height: 50px;"></div>
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <div class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 text-center">
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
                            <a class="dropdown-item" href="#">
                                    <i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Home
                                </a>
                                    
                            <a class="dropdown-item" href="showProfileIskolar.php">
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
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/carousel/1.png" class="d-block w-100" alt="Slide 1">
            </div>
            <div class="carousel-item">
                <img src="img/carousel/2.png" class="d-block w-100" alt="Slide 2">
            </div>
            <div class="carousel-item">
                <img src="img/carousel/3.png" class="d-block w-100" alt="Slide 3">
            </div>
            <div class="carousel-item">
                <img src="img/carousel/4.png" class="d-block w-100" alt="Slide 4">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden"></span>
        </button>
    </div>
    
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
    <div class="section">
        <h2>Discover Your College Journey</h2>
        <p>Explore our college programs and learn more about scholarship opportunities through our virtual tour.</p>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/yVk_aY7Aj1g?si=aNESIgroeFKBaktf" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-center">News and Announcements</h1>
    </div>
    <?php
    include('includes/dbcon.php');

    // Assuming the current user's username is stored in the session as 'username'
    $currentUsername = $_SESSION['username'];

    // Query to fetch announcements based on the user's scholarName
    $query = "
        SELECT a.*
        FROM announcement a
        INNER JOIN userprofile up ON up.scholarName = a.recipient OR a.recipient = 'ALL'
        INNER JOIN user u ON u.upId = up.upId
        WHERE u.username = ? AND a.status = 'active'
        ORDER BY a.dateCreated DESC
    ";

    // Prepare and execute the statement
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $currentUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch announcements
    $announcements = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $announcements[] = $row;
        }
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
?>


    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-12 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <!-- Inside the card body -->
<?php if (!empty($announcements)) { ?>
    <?php foreach ($announcements as $index => $announcement) { ?>
        <div class="row mb-3 announcement-item <?php echo $index > 2 ? 'hidden' : ''; ?>" data-index="<?php echo $index; ?>">
            <div class="col-md-4">
            <img src="uploads/announcement/<?php echo htmlspecialchars($announcement['photo']); ?>" 
    alt="Announcement Image" 
    class="img-fluid" 
    data-toggle="modal" 
    data-target="#imageModal" 
    data-image-src="<?php echo htmlspecialchars($announcement['photo']); ?>" 
    data-image-title="<?php echo htmlspecialchars($announcement['title']); ?>"
    onclick="document.getElementById('modalImage').src=this.src; document.getElementById('modalTitle').innerHTML=this.alt">            </div>
            <div class="col-md-8">
                <h5 class="font-weight-bold"><?php echo htmlspecialchars($announcement['title']); ?></h5>
                <p class="announcement-content content-collapsed" style="text-align:justify;"><?php echo htmlspecialchars($announcement['messageContent']); ?></p>
                <p><small class="text-muted">Posted on <?php echo htmlspecialchars($announcement['dateCreated']); ?></small></p>
                <button class="btn btn-success btn-sm" onclick="toggleContent(this)">See More</button>
            </div>
        </div>
    <?php } ?>
<?php } else { ?>
    <p>No announcements yet</p>
<?php } ?>
<?php if (count($announcements) > 3 ): ?>
    <div class="text-center">
    <button class="toggle-button btn btn-success text-white">See All Announcements</button>
    </div>
<?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var toggleButton = document.querySelector('.toggle-button');
    if (toggleButton) {
        toggleButton.addEventListener('click', function() {
            var announcementItems = document.querySelectorAll('.announcement-item.hidden');
            var button = this;

            if (announcementItems.length > 0) {
                announcementItems.forEach(function(item) {
                    item.classList.remove('hidden');
                });
                button.textContent = 'See Less';
            } else {
                announcementItems = document.querySelectorAll('.announcement-item');
                announcementItems.forEach(function(item, index) {
                    if (index > 2) {
                        item.classList.add('hidden');
                    }
                });
                button.textContent = 'See All Announcements';
            }
        });
    }
});
</script>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Page Content -->

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Announcement Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" class="img-fluid" alt="Enlarged Image">
                <p id="modalTitle" class="mt-2"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- About Us Modal -->
<div class="modal fade" id="aboutUsModal" tabindex="-1" role="dialog" aria-labelledby="aboutUsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="aboutUsModalLabel">About Us</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="indent">
                <p> This is one service unit of the Office of Student Affairs & Services that is in charge of the different scholarship and educational grants/privileges offered to students either by the university, the national government or by any interested individual, group of persons or company. </p></div>
                <div class="indent">
                <p>
                As may be required by the Memorandum of Agreement between the sponsor/s and the university through the Office of Student Affairs & Services, the coordinator for scholarship may conduct the selection and screening of students who may wish to avail of the scholarship grants/privileges. This service area is also in charge of the processing of papers needed for the release of the scholarship benefits of the grantees/scholars.</p></div>
                <div class="indent">
                <p>For more information, contact us at unpiskolar@gmail.com.</p></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade privacy" id="policyModal" tabindex="-1" role="dialog" aria-labelledby="policyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 70%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="policyModalLabel">GENERAL GUIDELINES & POLICIES ON</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body privacy-modal">
            <div id="scholarship-section">
        <h2>SCHOLARSHIP</h2>

        <ul>
            <li>1. A student applies for the scholarship/study privileges/grants before enrolment period but not (1) one month after the close of enrolment. The application is renewed each term.</li>
            <li>2. A student enjoys only one scholarship/study privilege/grant for any given term, summer not included.</li>
            <li>3. The average grade requirement and the level of performance considered for any grant is based on those obtained in the semester immediately prior to an application.</li>
            <li>4. A grade of 5.0 is a disqualification for any privilege/grant.</li>
            <li>5. Scholars/Grantees must carry the regular curricular load of the course enrolled in and must finish the course within the period prescribed.</li>
            <li>6. Conviction for any grave offense is a permanent disqualification as stipulated in the Student Code of Conduct and Discipline.</li>
        </ul>

        <p>The University of Northern Philippines has different existing scholarship and educational grants/privileges and are categorized into the following:</p>

        <h3>A. Academic Scholarship</h3>
        <div class="indent">
            <h4>A. 1. Entrance Scholar</h4>
            <ul>
                <li>Valedictorian—100% discount on tuition fee only</li>
                <li>Salutatorian—75% discount on tuition fee only</li>
            </ul>

            <h4>A. 2. BS Physics Scholar</h4>
            <ul>
                <li>100% discount on all fees except trust fund</li>
            </ul>

            <h4>A. 3. University Scholar</h4>
            <ul>
                <li>Average grade of 1.25—up with no grade lower than 1.75</li>
                <li>100% discount on all fees except trust fund</li>
            </ul>

            <h4>A. 4. College Scholar</h4>
            <ul>
                <li>Average grade of 1.26—1.75 no grade lower than 2.0</li>
                <li>100% discount on tuition fee only</li>
            </ul>

            <h4>A. 5. Dean’s List</h4>
            <ul>
                <li>Average grade of 2.0—1.76 no grade lower than 2.5</li>
                <li>50% discount on tuition fee only</li>
            </ul>

            <h4>A. 6. Top 3 Passers of the UNP College Admission Test</h4>
            <ul>
                <li>100% discount on tuition fee only</li>
            </ul>
        </div>

        <h3>B. Study Privileges</h3>
        <div class="indent">
            <h4>B. 1 UNP Employee Study Privilege</h4>
            <ul>
                <li>Employees/Dependents—100% discount on all fees and 50% discount (dependents beyond Baccalaureate degree including medicine).</li>
            </ul>

            <h4>B. 2. College Choir</h4>
            <ul>
                <li>New member—50% discount on all fees except trust fund</li>
                <li>Old Member—100% discount on all fees except trust fund</li>
            </ul>

            <h4>B. 3. Marching Band/ Millennium Band</h4>
            <ul>
                <li>100% discount on all fees except trust fund</li>
            </ul>

            <h4>B. 4. Athletic Scholar</h4>
            <ul>
                <li>Category A—100% discount on all fees</li>
                <li>Category B—100% discount on tuition fee only</li>
                <li>Category C—50% discount on tuition fee only</li>
            </ul>

            <h4>B. 5. UNP Dance Troupe</h4>
            <ul>
                <li>100% discount on all fees except trust fund</li>
            </ul>

            <h4>B. 6. ROTC Cadet Officer</h4>
            <ul>
                <li>Corps Commander—100% discount on tuition fee only</li>
                <li>Ex-O, S1 to S4—50% discount on tuition fee only</li>
            </ul>

            <h4>B. 7. Student Council Executive Officer</h4>
            <ul>
                <li>SC President—100% discount on all fees except trust fund</li>
                <li>Other SC Executive Officers—100% discount on tuition fee only</li>
                <li>SC Representatives & Mandated Presidents—100% discount on tuition fee only</li>
                <li>SC Volunteer Corps—50% discount on tuition fee</li>
            </ul>

            <h4>B. 8. New Tandem</h4>
            <ul>
                <li>Editor-in-Chief—100% discount on all fees except trust fund</li>
                <li>Associate Managing Editor—85% discount on all fees except trust fund</li>
                <li>Section Editors, Layout Artist—75% discount on all fees except trust fund</li>
                <li>Staff writers and Circulation managers—50% discount on all fees except trust fund</li>
            </ul>

            <h4>B. 9. Adopt-A-School/Community Program</h4>
            <ul>
                <li>100% discount on all fees except trust fund</li>
            </ul>

            <h4>B. 10. Barangay Study Privilege</h4>
            <ul></ul>

            <h4>B. 11. Lucky 7</h4>
            <ul></ul>
        </div>
    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid centered-container">
    <div class="row">
        <div class="col-md-4">
            <h2>Vision</h2>
            <p>A Globally Recognized university in a Heritage City by 2030.</p>
        </div>
        <div class="col-md-4">
            <h2>Mission</h2>
            <p>To produce globally skilled and morally upright professionals instilled with rich cultural values.</p>
        </div>
    </div>
</div>

            <!-- Footer -->
            <footer class="sticky-footer footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                    <a href="#" data-toggle="modal" data-target="#policyModal">Privacy and Policies</a>|
                    <a href="#" data-toggle="modal" data-target="#aboutUsModal">About Us</a>
                    <br> <br>
                        <span>All rights reservered | iSkolar Online 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" style="margin-bottom: 10px; margin-right: 10px;"href="#page-top">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>


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
}; 
    </script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get the JSON data from PHP
        var usertypeData = <?php echo $json_data; ?>;

        // Check if the JSON data is correctly parsed
        console.log(usertypeData);

        
    });
</script>