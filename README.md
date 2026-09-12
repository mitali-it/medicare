# 🏥 MediCare+

MediCare+ is a web-based Hospital and Healthcare Management System developed using PHP and MySQL.

## 📌 About the Project

MediCare+ helps patients find hospitals and doctors, view hospital details, and book medical appointments online.

The system also provides an Admin Panel to manage hospitals, doctors, services, and appointments.

## ✨ Features

### 👤 Patient
- Patient Registration & Login
- View Hospitals
- View Departments & Doctors
- Book Appointments
- View Appointment Status
- Manage Profile
- Logout

### 👨‍💼 Admin
- Admin Login
- Add & Manage Hospitals
- Add & Manage Doctors
- Add & Manage Services
- View Appointments
- Approve / Reject Appointments
- View Reports

## 🗄️ Main Database Tables

- `patient_info`
- `add_hospital`
- `add_doctor`
- `add_service`
- `appointment`
- `contact_messages`

## 📂 Project Structure

```text
MediCare+
│
├── index.php
├── profile1.php
├── hos.php
├── details.php
├── logout.php
│
├── admin-login.php
├── admin1.php
├── admin-logout.php
│
├── img/
│   ├── md1.jpg
│   ├── o1.jpeg
│   ├── r1.webp
│   └── ...
│
└── README.md

Additional PHP files may be present depending on the final project implementation.

🔄 System Workflow
                    MediCare+
                        |
          +-------------+-------------+
          |                           |
       Patient                      Admin
          |                           |
       Register                    Login
          |                           |
        Login                     Dashboard
          |                           |
       Homepage              +--------+--------+
          |                  |        |        |
       Hospitals         Hospitals Doctors Services
          |
    Select Hospital
          |
   Hospital Details
          |
   Departments
          |
      Doctors
          |
   Book Appointment
          |
       Pending
          |
      Admin Review
          |
      +---+---+
      |       |
   Approved Rejected
      |       |
      +---+---+
          |
   Patient Checks Status
👤 Patient Workflow
Patient Registration
        ↓
Patient Login
        ↓
MediCare+ Homepage
        ↓
View Hospitals
        ↓
Select Hospital
        ↓
Hospital Details
        ↓
Departments & Doctors
        ↓
Book Appointment
        ↓
Appointment Pending
        ↓
Admin Reviews Appointment
        ↓
Approved / Rejected
        ↓
Patient Views Status
👨‍💼 Admin Workflow
Admin Login
     ↓
Admin Dashboard
     ↓
Manage Hospitals
     ↓
Manage Doctors
     ↓
Manage Services
     ↓
View Appointments
     ↓
Approve / Reject
     ↓
Appointment Status Updated
⚙️ Setup
Install XAMPP.
Start Apache and MySQL.
Copy the project into the htdocs folder.
Create a database named hospital.
Import the SQL database.
Update the database connection if required.
Open the project in the browser.
💻 Technologies Used
HTML5
CSS3
Bootstrap 4.6
JavaScript
jQuery
PHP
MySQL / MariaDB
Apache / XAMPP
🎯 Objective

The main objective of MediCare+ is to provide an easy platform for patients to find hospitals and doctors, book appointments, and check appointment status while allowing administrators to manage the system efficiently.

🚀 Future Enhancements
Online Payment
Email/SMS Notifications
Online Consultation
Medical Records
Doctor Availability
Advanced Search

👩‍💻 Author
Mitali Sahni
Bsc.it-student

MediCare+

Project Type: Healthcare / Hospital Management Portal

Technology: PHP + MySQL

Frontend: HTML, CSS, Bootstrap, JavaScript, jQuery

Database: MySQL / MariaDB

Server: Apache / XAMPP

⭐ MediCare+

Find Hospitals. Find Doctors. Book Appointments.
