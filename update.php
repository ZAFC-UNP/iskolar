<?php
    $page_title="Update Profile";
    include('includes/header.php');

    
// Determine the current school year based on the current month
$currentMonth = date('n'); // Get the current month as a number (1-12)
$currentYear = date('Y'); // Get the current year

if ($currentMonth <= 5) {
    // Months January to May
    $schoolYear = ($currentYear - 1) . "-" . $currentYear;
    $sem = "2ND SEMESTER";
} else {
    // Months June to December
    $schoolYear = $currentYear . "-" . ($currentYear + 1);
    $sem = "1ST SEMESTER";
}
?>

<style>
    body {
        background-color: #3a66b3; /* Blue gradient background */
        background-image: linear-gradient(to bottom, #3a66b3, #214b8c); /* Gradient effect */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Matching the style of the reset form */
    }

    #updateFormContainer {
        display: flex;
        flex-direction: column; /* Column layout for smaller screens */
        align-items: center;
        justify-content: center;
        min-height: 100vh; /* Full viewport height */
        padding: 20px;
    }

    #updateForm {
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 600px;
        background-color: #ffffff; /* Solid white background for better readability */
        border: none; /* Remove border for a clean look */
        margin-top: -25px; /* Adjust spacing from the top */
        margin-bottom: 30px; /* Adjust spacing from the bottom */
        background-color: rgba(255, 255, 255, 0.8); /* Off-white semi-transparent background */
        backdrop-filter: blur(10px); /* Frosted glass effect */
        -webkit-backdrop-filter: blur(10px); /* Frosted glass effect for Safari */
        border: 1px solid rgba(255, 255, 255, 0.3);
        max-height: 100%;
        overflow: auto;
        color: #002147;

    }

    .form-control, .form-select {
        border-radius: 20px; /* Rounded input fields */
        padding: 10px 15px; /* Padding inside input fields */
        border: 1px solid #ddd; /* Light border around input fields */
    }

    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 5px rgba(58, 102, 179, 0.5); /* Soft blue shadow on focus */
        border-color: #3a66b3; /* Blue border on focus */
    }

    .btn-primary {
        background-color: #3a66b3; /* Blue button background */
        border: none; /* Remove border for a clean look */
        border-radius: 20px; /* Rounded button */
        padding: 10px 20px; /* Button padding */
        width: 100%; /* Full width button */
        margin-top: 20px; /* Spacing above button */
    }

    .btn-primary:hover {
        background-color: #214b8c; /* Darker blue on hover */
    }

    .text-center {
        color: #3a66b3; /* Blue color for the text center */
        margin-top: 20px; /* Add spacing to separate from the form */
    }

    .text-center a {
        color: #3a66b3; /* Blue links */
        text-decoration: none; /* Remove underline */
    }

    .text-center a:hover {
        text-decoration: underline; /* Underline on hover */
    }

    /* Styles for adding an image */
    .background-image{
        background-image: url('img/bgimg2.jpg');
        background-size: cover;
        background-position: center;
        height: 100%;
        width: 100%;
        display: flex; /* Corrected from 'position: flex;' */
        justify-content: center;
        align-items: center; /* Center content vertically */
        position: relative; /* Ensure content is positioned relative to this container */
        overflow-x:hidden;
        background-repeat: no-repeat;
    }

    .image-container img {
        max-width: 100%;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .left-img {
            position: fixed;
            top: 30%; /* Distance from the top */
            left: 5%; /* Distance from the left */
            width: 100px; /* Adjust the size as needed */
            z-index: 1000; /* Ensure it stays above other elements */
            width: 20%;
        }

        .right-img {
            position: fixed;
            top: 30%; /* Distance from the top */
            right: 5%; /* Distance from the right */
            width: 100px; /* Adjust the size as needed */
            z-index: 1000; /* Ensure it stays above other elements */
            width: 20%;
        }
</style>

<body class="background-image">

    <img src="img/unplogo.png" class="left-img">
    <img src="img/BagongPilipinaslogo.png" alt="" class="right-img">

<div id="updateFormContainer" class="container mt-5">
    <!-- Update form section -->
    <div id="updateForm">
        <h2 class="text-center mb-4">Renew Scholarship</h2>
        <form method="POST" enctype="multipart/form-data" action="updateProfile.php">
            <!-- Hidden inputs for ID and token -->
            <input type="hidden" name="idNum" value="<?php echo $_GET['idNum']; ?>">
            <input type="hidden" name="upId" value="<?php echo htmlspecialchars($_GET['upId']); ?>">
            <input type="hidden" name="verify_token" value="<?php echo htmlspecialchars($_GET['code']); ?>">
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($_GET['email']); ?>">
            

            <!-- Form fields -->
            <div class="mb-3">
            <label for="schoolYear" class="form-label">School Year</label>
<input 
    type="text" 
    class="form-control" 
    id="schoolYear" 
    name="schoolYear" 
    value="<?php echo htmlspecialchars($schoolYear); ?>" 
    readonly 
    >

            </div>
            <div class="mb-3">
                <label for="sem">Semester <span>*</span></label>
                <input 
    type="text" 
    class="form-control" 
    id="sem" 
    name="sem" 
    value="<?php echo htmlspecialchars($sem); ?>" 
    readonly 
    >
            </div>
            <div class="mb-3">
                <label for="year" class="form-label">Year Level</label>
                <select class="form-select" id="year" name="year" >
                    <option value="" selected disabled>Select Year Level</option>
                        <option value="1st Year">1st Year</option>
                        <option value="2nd Year">2nd Year</option>
                        <option value="3rd Year">3rd Year</option>
                        <option value="4th Year">4th Year</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="noOfUnits" class="form-label">Number of Units</label>
                <input type="number" class="form-control" id="noOfUnits" name="noOfUnits" min="0" placeholder="Enter Number of Units" required>
            </div>
            <div class="mb-3">
                <label for="noOfSubjects" class="form-label">Number of Subjects</label>
                <input type="number" class="form-control" id="noOfSubjects" name="noOfSubjects" min="0" placeholder="Enter Number of Subjects" required>
            </div>
            <div class="mb-3">
                <label for="grade" class="form-label">Grade</label>
                <input type="text" class="form-control" id="grade" name="grade" min="0" step="any" placeholder="Enter Last Semester Grade (e.g., 1.75)" required>
            </div>

            <!-- File uploads -->
            <div class="mb-3">
                <label for="certOfScholarship" class="form-label">Certificate of Scholarship (PDF only)</label>
                <input class="form-control" type="file" id="certOfScholarship" name="certOfScholarship" accept=".pdf" required>
            </div>
            <div class="mb-3">
                <label for="grades" class="form-label">Grades (PDF only)</label>
                <input class="form-control" type="file" id="grades" name="grades" accept=".pdf" required>
            </div>
            <div class="mb-3">
                <label for="cor" class="form-label">Certificate of Registration (PDF only)</label>
                <input class="form-control" type="file" id="cor" name="cor" accept=".pdf" required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Renew Scholarship</button>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.15/dist/sweetalert2.all.min.js"></script>
<script>
// Form submission handler
document.getElementById('updateForm').addEventListener('submit', function (e) {
    // Display a loading spinner
    Swal.fire({
        title: 'Please wait...',
        html: 'Updating your information...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading()
        }
    });
});
</script>

<?php
// PHP script to handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

    if ($stmt->execute()) {
        echo '<script>
            Swal.fire({
                icon: "success",
                title: "Success!",
                text: "Academic information updated successfully!",
                confirmButtonText: "OK"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "http://localhost/iskolar/auth/success.php";
                }
            });
        </script>';
    } else {
        echo '<script>
            Swal.fire({
                icon: "error",
                title: "Error!",
                text: "Error updating information!",
                confirmButtonText: "Try Again"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "http://localhost/iskolar/update.php";
                }
            });
        </script>';
    }
}
?>
</body>
</html>
