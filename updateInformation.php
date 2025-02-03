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
        .section {
      display: none;
    }
    .section.active {
      display: block;
      /* position: absolute; */
      max-width: 100%;
      max-height: 100%;
    }
    .navbar {
            background-color: #0F4BB4; /* UNP Blue */
            padding:0 !important;
            display: fixed;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .navbar img {
            height: 50px;
        }
        /* Circular Button Style */
        .circle-button {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: none;
            background-color: #007bff; /* Blue background */
            color: white;
            font-size: 20px;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        /* Hover Effect */
        .circle-button:hover {
            background-color: #0056b3; /* Darker blue on hover */
            transform: scale(1.1);
        }

        /* Focus Outline Removed */
        .circle-button:focus {
            outline: none;
        }
        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group input[type="date"],
        .form-group input[list],
        .form-group select {
            
            text-transform: uppercase;    
        }
        .btn-primary1 {
        background-color: #3a66b3; /* Blue button background */
        border: none; /* Remove border for a clean look */
        border-radius: 20px; /* Rounded button */
        padding: 10px 20px; /* Button padding */
        width: 10%; /* Full width button */
        margin-top: 20px; /* Spacing above button */
        color:white;
    }
    .btn-primary2 {
        background-color: #3a66b3; /* Blue button background */
        border: none; /* Remove border for a clean look */
        border-radius: 20px; /* Rounded button */
        padding: 10px 20px; /* Button padding */
        width: 80%; /* Full width button */
        margin-top: 20px; /* Spacing above button */
        color:white;
    }

    .btn-primary1:hover,.btn-primary2:hover {
        background-color: #214b8c; /* Darker blue on hover */
        color:gainsboro;
    }
</style>
<script>
    function showSection(sectionId) {
      const sections = document.querySelectorAll('.section');
      sections.forEach((section) => {
        section.classList.remove('active');
      });
      document.getElementById(sectionId).classList.add('active');
    }
  </script>

<body class="background-image">

    <img src="img/unplogo.png" class="left-img">
    <img src="img/BagongPilipinaslogo.png" alt="" class="right-img">

<div id="updateFormContainer" class="container mt-5">
    <!-- Update form section -->
    <div id="updateForm">
        <form action="updateInformationData.php" method="post" id="registrationForm" enctype="multipart/form-data">

    <section id="personalInformation" class="section active">
    <input type="hidden" name="verify_token" value="<?php echo htmlspecialchars($_GET['verify_token']); ?>">
    <h2 class="text-center mb-4">Update Information</h2>
    <h3>Personal Information</h3>
    <div class="form-row">
        <div class="form-group">
            <label for="idNum">ID Number:<span>*</span></label>
            <input type="text" name="idNum" class="form-control" value="<?php echo $_GET['idNum']; ?>" readonly>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="firstname">First Name:<span>*</span></label>
            <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Enter First name" >
        </div>
        <div class="form-group">
            <label for="middlename">Middle Name:</label>
            <input type="text" id="middlename" name="middlename" class="form-control" placeholder="Enter Middle name">
        </div>
        <div class="form-group">
            <label for="lastname">Last Name:<span>*</span></label>
            <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Enter Last name" >
        </div>
        <div class="form-group">
            <label for="suffix">Suffix:</label>
            <input type="text" id="suffix" name="suffix" class="form-control" placeholder="e.g., Jr., Sr., III">
        </div>
    </div>
    <div class="form-group">
        <label for="scholarship">Scholarship:<span>*</span></label>
        <?php
        include 'includes/dbcon.php';
        $sql = "SELECT scholarName FROM scholarships";
        $result = $conn->query($sql);
        ?>

        <select id="scholarName" name="scholarName" class="form-select" > 
            <option value="">Please Select</option>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<option value="'.htmlspecialchars($row['scholarName']).'">'.htmlspecialchars($row['scholarName']).'</option>';
                }
            } else {
                echo '<option value="">No Scholarships Available</option>';
            }
            $conn->close();
            ?>
        </select>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="dob">Date of Birth:<span>*</span></label>
            <input type="date" id="dob" name="dob" class="form-control" placeholder="Enter date of birth" onchange="calculateAge()" >
        </div>
        <div class="form-group">
            <label for="age">Age:</label>
            <input type="text" id="age" name="age" class="form-control" min="0" disabled>
        </div>
        <div class="form-group">
            <label for="civilStatus">Civil Status:<span>*</span></label>
            <select id="civilStatus" name="civilStatus" class="form-select" >
                <option value="">--Please Select--</option>
                <option value="SINGLE">Single</option>
                <option value="MARRIED">Married</option>
                <option value="DIVORCED">Divorced</option>
                <option value="WIDOWED">Widowed</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="numChildren">No. of Children in the Family:<span>*</span></label>
            <input type="number" id="chirldrenCount" name="childrenCount" class="form-control" min="0" placeholder="Enter number of children" >
        </div>
        <div class="form-group">
            <label for="cmi">Combined Monthly Income:<span>*</span></label>
            <select id="cmi" name="cmi" class="form-select" >
                <option value="">--Please Select--</option>
                <option value="BELOW 5,000">Below 5,000</option>
                <option value="5,001 - 10,000">5,001 - 10,000</option>
                <option value="10,001 - 15,000">10,001 - 15,000</option>
                <option value="15,001 - 20,000">15,001 - 20,000</option>
                <option value="Above 20,000">Above 20,000</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="sex">Sex:<span>*</span></label>
            <select id="sex" name="sex" class="form-select" >
                <option value="">--Please Select--</option>
                <option value="MALE">MALE</option>
                <option value="FEMALE">FEMALE</option>
            </select>
        </div>
        <div class="form-group">
            <label for="gender">Gender:<span>*</span></label>
            <input list="genders" id="gender" name="gender" class="form-control" placeholder="Enter gender" >
            <datalist id='genders'> 
                <option value="Masculine"></option>
                <option value="Feminine"></option>
                <option value="Lesbian"></option>
                <option value="Gay"></option>
                <option value="Bisexual"></option>
                <option value="Transgender"></option>
                <option value="Prefer not to say"></option>
            </datalist>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group">
            <label for="region">Region:<span>*</span></label>
            <select id="region" name="region" class="form-select" onchange="populateProvinces(this.value)" >
                <option value="">--Please Select--</option>
            </select>
        </div>
        <div class="form-group">
            <label for="province">Province:<span>*</span></label>
            <select id="province" name="province" class="form-select" onchange="populateCities(this.value)" disabled >
                <option value="">--Please Select--</option>
            </select>
        </div>
        <div class="form-group">
            <label for="city">City:<span>*</span></label>
            <select id="city" name="city" class="form-select" onchange="populateBarangays(this.value)" disabled >
                <option value="">--Please Select--</option>
            </select>
        </div>
        <div class="form-group">
            <label for="barangay">Barangay:<span>*</span></label>
            <select id="barangay" name="barangay" class="form-select" disabled >
                <option value="">--Please Select--</option>
            </select>
        </div>
    </div>
    <hr>
    <button type="button" class="circle-button" onclick="showSection('academicInformation')" style="float:right;">
    <i class="fas fa-chevron-right"></i>
</section>

    
    <section id="academicInformation" class="section">
        <h3>Academic Information</h3>
        <div class="form-row"></div>
        
            <div class="form-group">
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
            
            <div class="form-group">
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
            <div class="form-group">
                <label for="year">Year Level:<span>*</span></label>
                <select id="year" name="year" class="form-select">
                    <option value="">Select Year</option>
                    <option value="1st Year">1st Year</option>
                    <option value="2nd Year">2nd Year</option>
                    <option value="3rd Year">3rd Year</option>
                    <option value="4th Year">4th Year</option>
                </select>
            </div>
        <div class="form-row">
            <div class="form-group">
                <label for="collegeDepartment">College Department:<span>*</span></label>
                <select id="collegeDepartment" onchange="populateCourses(this.value)" name="college" class="form-select">
                    <option value="">Select College</option>    
                    <option value="CARCH">COLLEGE OF ARCHITECTURE (CARCH)</option>
                    <option value="CAS">COLLEGE OF ARTS AND SCIENCES (CAS)</option>
                    <option value="CBAA">COLLEGE OF BUSINESS ADMINISTRATION AND ACCOUNTANCY (CBAA)</option>
                    <option value="CCJE">COLLEGE OF CRIMINAL JUSTICE EDUCATION (CCJE)</option>
                    <option value="CCIT">COLLEGE OF COMMUNICATION AND INFORMATION TECHNOLOGY (CCIT)</option>
                    <option value="CE">COLLEGE OF ENGINEERING (CE)</option>
                    <option value="CFAD">COLLEGE OF FINE ARTS AND DESIGN (CFAD)</option>
                    <option value="CHS">COLLEGE OF HEALTH SCIENCES (CHS)</option>
                    <option value="CHTM">COLLEGE OF HOSPITALITY AND TOURISM MANAGEMENT (CHTM)</option>
                    <option value="CN">COLLEGE OF NURSING (CN)</option>
                    <option value="CPAD">COLLEGE OF PUBLIC ADMINISTRATION (CPAD)</option>
                    <option value="CSW">COLLEGE OF SOCIAL WORK (CSW)</option>
                    <option value="CTECH">COLLEGE OF TECHNOLOGY (CTECH)</option>
                    <option value="CTE">COLLEGE OF TEACHER EDUCATION (CTE)</option>
                </select>
                </div>

                <div class="form-group">
                <label for="course">Course: <span>*</span></label>
                <select onchange="populateMajor(this.value)" name="course" id="course" class="form-select"disabled>
                    <option value="">Select Course</option>
                </select>
                </div>
                <div class="form-group">
                <label for="major">Major: <span>*</span></label>
                <select onchange="getMajor(this.value)" name="major" id="major" class="form-select"disabled>
                    <option value="">Select Major</option>
                    <option value="">Not Applicable</option>
                </select>
            </div>
            </div>

        <div class="form-row">
            <div class="form-group">
                <label for="noOfUnits">No. of Units:<span>*</span></label>
                <input type="number" id="noOfUnits" name="noOfUnits" min="0" placeholder="Enter number of units" class="form-control">
            </div>
            <div class="form-group">
                <label for="noOfSubjects">No. of Subjects:<span>*</span></label>
                <input type="number" id="noOfSubjects" name="noOfSubjects" min="0" placeholder="Enter number of subjects" class="form-control">
            </div>
            <div class="form-group">
                <label for="grade">Last Semester Average Grade:<span>*</span></label>
                <input type="text" id="grade" name="grade" min="0" maxlength="4" step="any" placeholder="Enter Last Sem Grade" class="form-control">
            </div>
        </div>
        <hr>
        <button type="button" class="circle-button" onclick="showSection('personalInformation')" style="float:left;"><i class="fas fa-chevron-left"></i></button>
        <button type="button" class="circle-button" onclick="showSection('fileUpload')" style="float:right;"><i class="fas fa-chevron-right"></i></button>
    </section>

    <section class="section" id="fileUpload">
        <h3>Submit Required Files</h3>
    <div class="form-row">
            <div class="form-group">
                <label for="certOfScholarship" class="form-label">Upload Certificate of Scholarship:<span>*</span></label>
                <div class="comment">File format should be pdf. Upload: IDnumber_COS.pdf
                </div>
                <input class="form-control" type="file" id="certOfScholarship" name="certOfScholarship" accept=".pdf" >
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                
                <label for="grades" class="form-label">Upload Grades:<span>*</span></label>
                <div class="comment">File format should be pdf. Upload: IDnumber_Grades.pdf
                </div>
                <input class="form-control" type="file" id="grades" name="grades" accept=".pdf" >
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                
                <label for="UNPCAT" class="form-label">Upload Entrance Test Results:</label>
                <div class="comment">Leave blank if Not Applicable. File format should be pdf. Upload: IDnumber_UNPCAT.pdf
                </div>
                <input class="form-control" type="file" id="unpcat" name="unpcat" accept=".pdf">
            </div>
        </div>     

        <div class="form-row">
            <div class="form-group">
                
                <label for="goodMoral" class="form-label">Upload Good Moral Character:<span>*</span></label>
                <div class="comment">For in-coming Freshman (High School Principal) 
                    <br>For old students (Guidance Counselor)
                    <br>File format should be pdf. Upload: IDnumber_GoodMoral.pdf
                </div>
                <input class="form-control" type="file" id="goodMoral" name="goodMoral" accept=".pdf">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                
                <label for="form1" class="form-label">Upload Certificate of Registration:<span>*</span></label>
                <div class="comment">File format should be pdf. Upload: IDnumber_COR.pdf
                </div>
                <input class="form-control" type="file" id="cor" name="cor" accept=".pdf" >
            </div>
        </div>
        <div class="text-center">
                <button type="button" class="btn btn-primary1" onclick="showSection('academicInformation')"><i class="fas fa-chevron-left"></i></button>
                <button type="submit" class="btn btn-primary2">Update Information</button>
            </div>
    </section>
        </form>
    </div>

    
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.15/dist/sweetalert2.all.min.js"></script>
<script>

</script>

<script>
    //Fill course option
function populateCourses(college) {
    let coursesDropDown = document.getElementById('course');
    let majorDropDown = document.getElementById('major');
    coursesDropDown.innerHTML = '<option value="">Select Course</option>';
    majorDropDown.innerHTML = '<option value="">Select Major</option>';

    if (college.trim() === "") {
        coursesDropDown.disabled = true;
        majorDropDown.disabled = true;
        return;
    }

    fetch("JSON/course.json")
        .then(response => response.json())
        .then(data => {
            let courses = data[college] || [];
            courses.forEach(course => {
                let option = document.createElement('option');
                option.value = course;
                option.textContent = course;
                coursesDropDown.appendChild(option);
            });
            coursesDropDown.disabled = false;
        });
}


//Fill Major
function populateMajor(course) {
    let majorDropDown = document.getElementById('major');
    majorDropDown.innerHTML = '<option value="">Not Applicable</option>'
    
    if (course.trim() === "") {
        majorDropDown.disabled = true;
        return;
    }

    fetch("JSON/major.json")
        .then(response => response.json())
        .then(data => {
            let majors = data[course] || [];
            majors.forEach(major => {
                let option = document.createElement('option');
                option.value = major; // Use 'major' as the value
                option.textContent = major; // Use 'major' as the text content
                majorDropDown.appendChild(option);
            });
            majorDropDown.disabled = false;
        })
        .catch(error => {
            console.error('Error fetching or parsing majors:', error);
            majorDropDown.disabled = true; // Handle error by disabling the dropdown
        });
}

document.addEventListener("DOMContentLoaded", function() {
    populateRegions();

    function populateRegions() {
        fetch("JSON/region.json")
            .then(response => response.json())
            .then(data => {
                let regionDropDown = document.getElementById('region');
                data.forEach(region => {
                    let option = document.createElement('option');
                    option.value = region.region_code; // Use region_code for filtering
                    option.textContent = region.region_name;
                    regionDropDown.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching regions:', error));
    }

    window.populateProvinces = function(regionCode) {
        let provinceDropDown = document.getElementById('province');
        let cityDropDown = document.getElementById('city');
        let barangayDropDown = document.getElementById('barangay');

        provinceDropDown.innerHTML = '<option value="">--Please Select--</option>';
        cityDropDown.innerHTML = '<option value="">--Please Select--</option>';
        barangayDropDown.innerHTML = '<option value="">--Please Select--</option>';
        cityDropDown.disabled = true;
        barangayDropDown.disabled = true;

        if (regionCode.trim() === "") {
            provinceDropDown.disabled = true;
            return;
        }

        fetch("JSON/province.json")
            .then(response => response.json())
            .then(data => {
                let provinces = data.filter(province => province.region_code === regionCode);
                provinces.forEach(province => {
                    let option = document.createElement('option');
                    option.value = province.province_code; // Use province_code for filtering cities
                    option.textContent = province.province_name;
                    provinceDropDown.appendChild(option);
                });
                provinceDropDown.disabled = false;
            })
            .catch(error => console.error('Error fetching provinces:', error));
    }

    window.populateCities = function(provinceCode) {
    let cityDropDown = document.getElementById('city');
    let barangayDropDown = document.getElementById('barangay');

    cityDropDown.innerHTML = '<option value="">--Please Select--</option>';
    barangayDropDown.innerHTML = '<option value="">--Please Select--</option>';
    barangayDropDown.disabled = true;

    if (provinceCode.trim() === "") {
        cityDropDown.disabled = true;
        return;
    }

    fetch("JSON/city.json")
        .then(response => response.json())
        .then(data => {
            let cities = data.filter(city => city.province_code === provinceCode);
            cities.forEach(city => {
                let option = document.createElement('option');
                option.value = city.city_code; // Use city_name for value
                option.textContent = city.city_name; // Display city name
                cityDropDown.appendChild(option);
            });
            cityDropDown.disabled = false;
        })
        .catch(error => console.error('Error fetching cities:', error));
}
    window.populateBarangays = function(cityCode) {
        let barangayDropDown = document.getElementById('barangay');

        barangayDropDown.innerHTML = '<option value="">--Please Select--</option>';

        if (cityCode.trim() === "") {
            barangayDropDown.disabled = true;
            return;
        }

        fetch("JSON/barangay.json")
            .then(response => response.json())
            .then(data => {
                let barangays = data.filter(barangay => barangay.city_code === cityCode);
                barangays.forEach(barangay => {
                    let option = document.createElement('option');
                    option.value = barangay.brgy_name; // Set value to barangay name
                    option.textContent = barangay.brgy_name;
                    barangayDropDown.appendChild(option);
                });
                barangayDropDown.disabled = false;
            })
            .catch(error => console.error('Error fetching barangays:', error));
    }

    window.submitForm = function() {
        let selectedRegion =    document.getElementById('region')       .options[document.getElementById('region').selectedIndex].textContent;
        let selectedProvince =  document.getElementById('province')     .options[document.getElementById('province').selectedIndex].textContent;
        let selectedCity =      document.getElementById('city')         .options[document.getElementById('city').selectedIndex].textContent;
        let selectedBarangay =  document.getElementById('barangay')     .options[document.getElementById('barangay').selectedIndex].textContent;

        // Assuming you are sending these values to your backend or saving in your database
        console.log('Selected Region:', selectedRegion);
        console.log('Selected Province:', selectedProvince);
        console.log('Selected City:', selectedCity);
        console.log('Selected Barangay:', selectedBarangay);

        // Send data to backend or perform further actions
    }



    document.getElementById('dob').addEventListener('change', calculateAge);

    function calculateAge() {
        var dob = document.getElementById('dob').value;
        var dobDate = new Date(dob);
        var today = new Date();
        var age = today.getFullYear() - dobDate.getFullYear();
        var monthDiff = today.getMonth() - dobDate.getMonth();
        
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dobDate.getDate())) {
            age--;
        }
        
        document.getElementById('age').value = age;
    }
});

</script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.15/dist/sweetalert2.all.min.js"></script>
<script>
        function togglePopup() {
            const popup = document.getElementById('terms');
            const overlay = document.getElementById('overlay');
            popup.classList.toggle('active');
            overlay.classList.toggle('active');
        }

    </script>
<script>
document.getElementById('registrationForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent the default form submission

    // Display a loading spinner using SweetAlert2
    Swal.fire({
        title: 'Please wait...',
        html: 'Saving your information...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    // Simulate form submission with a delay (for demonstration purposes)
    setTimeout(() => {
        // After the delay, submit the form programmatically
        e.target.submit();
    }, 1000); // Adjust delay as needed
});

</script>
</body>
</html>
