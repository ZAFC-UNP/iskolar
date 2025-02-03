# 🎓 iSkolar Online
Scholar Record Management System
iSkolar Online is a scholarship management system designed to streamline the process of managing scholarship programs, scholar records, and desseminating announcements from the organization to the scholars.

# 🚀 Features
- 📋 Scholar Management: 
  Register, update, and manage scholars' profiles. </br>
- 🎓 Scholarship Programs : 
  Track and manage different scholarship programs. </br>
- 📩 SMS & Email Notifications: 
  Notify scholars about announcements and updates. </br>
- 📊 Reports & Analytics : 
  View scholar distributions using charts with drill-down functionality. </br>
- 👥 User Roles: 
  Set specific User Roles to different users (e.g., admin, scholar). </br>
- 🔒 Secure Authentication: 
  User login with account-based access. </br>

# 🛠️ Technologies Used
  | Name | Description |
  | --- | --- |
  | Frontend | HTML, CSS, JavaScript |
  | Backend | PHP (MySQLi) |
  | Database | MySQL |
  | Server | XAMPP (for local development) |
  | PhilSMS | SMS Sending API |
  | PHPMailer | Email Sending |

# 🖥️ Installation Guide
- Clone the repository:
```md
git clone https://github.com/ZAFC-UNP/iskolar.git ]
```
- Start XAMPP and enable Apache & MySQL. </br>
- Import the database (iskolar.sql) into MySQL. </br>
- Configure the database connection in includes/dbcon.php. </br>
- Run the project in a browser (http://localhost/iskolar). </br>

# Database Structure
| Name | Description |
| announcements | Contains all announcements sent |
| archivedInformation | Contains all archived information after entering new semester |
| logs | Contains all logs for audit trails |
| notifications | Contains all announcements such as scholar registering, renewing, and updating academic details |
| scholarships | Contains all scholarship programs |
| user | Contains user credentials  |
| user_files | Contains all files uploaded by the users |
| userprofile | Contains all information about the users |

# Usage
- Admin can manage scholar accounts and registrations, send announcements, and generate accurate reports. 
- Scholars can log in to view announcements and their scholarship application status.

# Contribution
If you’d like to contribute, feel free to submit a pull request or report issues.
<details>
  <summary>☎️ Contact Details</summary>
- <a href="https://www.facebook.com/zynhelashley.catandijan">ⓕ Facebook</a>
- 📧 zafcatandijan.ccit@unp.edu.ph
</details>
