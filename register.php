<?php 
    $page_title = "Iskolar Registration";
    include('includes/header.php');
?>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f4;
            padding:0;
        }
        .form-container {
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
            max-width: 60vw;
            margin: auto;
            background-color: rgba(255, 255, 255, 0.8); /* Off-white semi-transparent background */
            backdrop-filter: blur(10px); /* Frosted glass effect */
            -webkit-backdrop-filter: blur(10px); /* Frosted glass effect for Safari */
            border: 1px solid rgba(255, 255, 255, 0.3);
            max-height: 100%;
            overflow: auto;
            color: #002147;
            margin: 10px;  
                      
        }
        .form-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .form-group {
            flex: 1;
            margin-right: 20px;
        }
        .form-group:last-child {
            margin-right: 0;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        span{
            color: red;
        }

        ::placeholder{
            text-transform: uppercase;
        }
        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group input[type="date"],
        .form-group input[list],
        .form-group select {
            width: calc(100% - 10px);
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            text-transform: uppercase;    
        }
        .form-group input[type="email"]{
            width: calc(100% - 10px);
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-group input[type="password"]{
            width: calc(100% - 10px);
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 1040; /* Ensure it is behind the popup but above other content */
        }
        .terms-popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90%;
            max-width: 600px;
            background: #ffffff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            border-radius: 8px;
            z-index: 1050; /* Ensure it stays on top */
            display: none; /* Initially hidden */
            padding: 20px;
            overflow-y: auto;
        }
        .terms-popup.active, .overlay.active {
            display: block;
        }
        .terms-popup .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 20px;
            color: #000;
            cursor: pointer;
            transition: color 0.3s;
        }
        .terms-popup .close-btn:hover {
            color: #ff0000;
        }
        .terms-popup h1 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        .terms-popup ul {
            list-style-type: disc;
            padding-left: 20px;
        }
        .terms-popup ul li {
            margin-bottom: 0.5rem;
        }
        .terms-popup p {
            margin-top: 1rem;
            font-size: 1rem;
        }
        .btn-register {
            background-color: green;
            color: white;
            border: none;
        }
        .btn-register:hover {
            background-color: darkgreen;
        }
            input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        @media (max-width: 600px) {
        .form-row {
            flex-wrap: wrap;
        }
        .form-group {
            margin-right: 0;
            min-width: calc(70% - 20px);
        }
    }
    .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }
        
      .bd-mode-toggle {
        z-index: 1500;
      }

      .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
      }
      .comment{
        color: #333333;
        font-size: small;
      }
      .background-image {
        background-image: url('img/index.png');
        background-size: cover;
        background-position: center;
        height: 100vh;
        width: 100vw;
        display: flex; /* Corrected from 'position: flex;' */
        justify-content: center;
        align-items: center; /* Center content vertically */
        position: relative; /* Ensure content is positioned relative to this container */
        overflow-x:hidden;
        background-repeat: no-repeat;
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
        .logo {
        width: 400px;
        height: auto;
    }

    @media (max-width: 768px) {
        .logo {
            display: none;
        }
        .form-container{
            max-width:80vw;
        }
        .manus{
            display:none;
        }
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
</head>   
<body class="background-image">



<div class="form-container" id="registerForm">
    <h2 style="text-align: center; margin-bottom: 20px; margin-right:10px"><span><img src="img/unpManus.png" alt="" style="width:300px; margin-right:10px;" class="manus"></span>Scholarship Registration Form</h2>
    
    <form action="registration.php" method="post" id="registrationForm" enctype="multipart/form-data">

    <section id="personalInformation" class="section active">
        <h3>Personal Information</h3>
        <div class="form-row">
            <div class="form-group">
                <label for="idNum">ID Number:<span>*</span></label>
                <input type="text" name="idNum" placeholder="Enter ID number">
            </div>
        </div>
            <div class="form-row">
            <div class="form-group">
                <label for="firstname">First Name:<span>*</span></label>
                <input type="text" id="firstname" name="firstname" placeholder="Enter First name" required>
            </div>
            <div class="form-group">
                <label for="middlename">Middle Name:</label>
                <input type="text" id="middlename" name="middlename" placeholder="Enter Middle name">
            </div>
            <div class="form-group">
                <label for="lastname">Last Name:<span>*</span></label>
                <input type="text" id="lastname" name="lastname" placeholder="Enter Last name"  required>
            </div>
            <div class="form-group">
                <label for="suffix">Suffix:</label>
                <input type="text" id="suffix" name="suffix" placeholder="e.g., Jr., Sr., III">
            </div>
        </div>
            <div class="form-group">
                <label for="scholarship">Scholarship:<span>*</span></label>
                <?php
                include 'includes/dbcon.php';
                $sql = "SELECT scholarName FROM scholarships";
                $result = $conn->query($sql);
                ?>

                <select id="scholarName" name="scholarName"> 
                    <option value="">Please Select</option>
                    
                    <?php
                    if ($result->num_rows > 0) {
                        // Output data of each row
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
                <label for="email">Email:<span>*</span></label>
                <input type="email" id="email" name="email" placeholder="Enter Email Address" required>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth:<span>*</span></label>
                <input type="date" id="dob" name="dob" placeholder="Enter date of birth" onchange="calculateAge()">
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="text" id="age" name="age" min="0" disabled>
            </div>
            <div class="form-group">
                <label for="civilStatus">Civil Status:<span>*</span></label>
                <select id="civilStatus" name="civilStatus" required>
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
            <label for="contactNumber">Contact Number:<span>*</span></label>
            <input type="text" id="contactNumber" name="contactNumber" placeholder="+639xxxxxxxxx" maxlength="13" required 
                pattern="^\+63\d{10}$" title="Please enter a valid contact number starting with +63 and 10 additional digits" oninput="validateContactNumber(this)">
        </div>
        <div class="form-group">
            <label for="telNumber">Telephone Number:</label>
            <input type="text" id="telNumber" name="telNumber" placeholder="012xxxxxxx" maxlength="10" 
                >
        </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for="numChildren">No. of Children in the Family:<span>*</span></label>
                <input type="number" id="chirldrenCount" name="childrenCount" min="0" placeholder="Enter number of children" required>
            </div>
            <div class="form-group">
                <label for="cmi">Combined Monthly Income:<span>*</span></label>
                <select id="cmi" name="cmi">
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
                <select id="sex" name="sex">
                    <option value="">--Please Select--</option>
                    <option value="MALE">MALE</option>
                    <option value="FEMALE">FEMALE</option>
                </select>
            </div>
            <div class="form-group">
                <label for="gender">Gender:<span>*</span></label>
                <input list="genders" id="gender" name="gender" placeholder="Enter gender" required>
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
                <select id="region" name="region" onchange="populateProvinces(this.value)">
                    <option value="">--Please Select--</option>
                </select>
            </div>
            <div class="form-group">
                <label for="province">Province:<span>*</span></label>
                <select id="province" name="province" onchange="populateCities(this.value)" disabled>
                    <option value="">--Please Select--</option>
                </select>
            </div>
            <div class="form-group">
                <label for="city">City:<span>*</span></label>
                <select id="city" name="city" onchange="populateBarangays(this.value)" disabled>
                    <option value="">--Please Select--</option>
                </select>
            </div>
            <div class="form-group">
                <label for="barangay">Barangay:<span>*</span></label>
                <select id="barangay" name="barangay" disabled>
                    <option value="">--Please Select--</option>
                </select>
            </div>
            </div>
            <hr>
            <p style="text-align: center; float:left;">Have an acount already? <span><a href="index.php" style="text-decoration: none; cursor: pointer;">Click here </a></span>To login</p>
            <button type="button" class="circle-button" onclick="showSection('academicInformation')" style="float:right;">
    <i class="fas fa-chevron-right"></i>
</button>

    </section>
    
    <section id="academicInformation" class="section">
        <h3>Academic Information</h3>
        <div class="form-row"></div>
        <div class="form-group">
                <label for="year">Year:<span>*</span></label>
                <select id="year" name="year">
                    <option value="">Select Year</option>
                    <option value="1st Year">1st Year</option>
                    <option value="2nd Year">2nd Year</option>
                    <option value="3rd Year">3rd Year</option>
                    <option value="4th Year">4th Year</option>
                </select>
            </div>
            <div class="form-group">
                <label for="schoolYear">School Year <span>*</span></label>
                <input type="text" id="schoolYear" name="schoolYear" placeholder="2 0 _ _ - 2 0 _ _" minlength="9" maxlength="9" required>
            </div>
            <div class="form-group">
                <label for="sem">Semester <span>*</span></label>
                <select id="sem" name="sem">
                    <option value="">Select Semester</option>
                    <option value="1st Semester">1st Semester</option>
                    <option value="2nd Semester">2nd Semester</option>
                </select>
            </div>
        <div class="form-row">
            <div class="form-group">
                <label for="collegeDepartment">College Department:<span>*</span></label>
                <select id="collegeDepartment" onchange="populateCourses(this.value)" name="college">
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
                <select onchange="populateMajor(this.value)" name="course" id="course" disabled>
                    <option value="">Select Course</option>
                </select>
                </div>
                <div class="form-group">
                <label for="major">Major: <span>*</span></label>
                <select onchange="getMajor(this.value)" name="major" id="major" disabled>
                    <option value="">Select Major</option>
                    <option value="">Not Applicable</option>
                </select>
            </div>
            </div>

        <div class="form-row">
            <div class="form-group">
                <label for="noOfUnits">No. of Units:<span>*</span></label>
                <input type="number" id="noOfUnits" name="noOfUnits" min="0" placeholder="Enter number of units">
            </div>
            <div class="form-group">
                <label for="noOfSubjects">No. of Subjects:<span>*</span></label>
                <input type="number" id="noOfSubjects" name="noOfSubjects" min="0" placeholder="Enter number of subjects">
            </div>
            <div class="form-group">
                <label for="grade">Last Semester Average Grade:<span>*</span></label>
                <input type="text" id="grade" name="grade" min="0" maxlength="4" step="any" placeholder="Enter Last Sem Grade">
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
                <input class="form-control" type="file" id="certOfScholarship" name="certOfScholarship" accept=".pdf" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                
                <label for="grades" class="form-label">Upload Grades:<span>*</span></label>
                <div class="comment">File format should be pdf. Upload: IDnumber_Grades.pdf
                </div>
                <input class="form-control" type="file" id="grades" name="grades" accept=".pdf" required>
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
                <input class="form-control" type="file" id="cor" name="cor" accept=".pdf" required>
            </div>
        </div>
        <hr>
        <h6 style="text-align: center; margin-bottom:.5px;">By clicking the register button, you are agreeing to the <span><i onclick="togglePopup()" style="color: blue; text-decoration: underline; cursor: pointer;"> terms and conditions</i></span> of the UNP OSAS SFAS </h6>
        <button type="button" class="circle-button" onclick="showSection('academicInformation')"><i class="fas fa-chevron-left"></i></button>
        <button type="submit" name="regis_btn" style="background-color: green;" onclick="submitForm()" >Register</button>

    </section>
        
    </form>
    </div>
</div>
<img src="img/newUnpSeal.png" alt="" class="logo" style="width:400px; height:auto">


<div class="overlay" id="overlay"></div>

        <div id="terms" class="terms-popup">
        <i class="far fa-window-close close-btn" onclick="togglePopup()"></i> 
        <h1>General Guidelines & Policies on Scholarship</h1>
        <ul>
            <li>A student applies for the scholarship/study privileges/grants before the enrollment period but not (1) one month after the close of enrollment. The application is renewed each term.</li>
            <li>A student enjoys only one scholarship/study privilege/grant for any given term, midyear term not included.</li>
            <li>The average grade requirement and the level of performance considered for any grant are based on those obtained in the semester immediately prior to an application.</li>
            <li>A grade of 5.0 is a disqualification for any privilege/grant.</li>
            <li>Scholars/Grantees must carry the regular curricular load of the course enrolled in and must finish the course within the period prescribed.</li>
            <li>Conviction for any grave offense is a permanent disqualification as stipulated in the Student Code of Conduct and Discipline.</li>
        </ul>
        <p>By registering on the system, you are agreeing to these terms and conditions of the organization.</p>
    </div>
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
<?php 
    include ('includes\footer.php');
?>