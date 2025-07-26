title: QRCAS - QR Code Based Attendance System
description: A complete QR-based attendance management system with Admin, Teacher, and Student portals.
author: Gaurav Sonawane
repository_url: https://github.com/gauravsonawane77/QRCAS-QR-Code-Based-Attendance-System
license: MIT
version: 2.0
updated: 2025-07-26

features:
  - QR code-based student attendance
  - Three types of user logins (Admin, Teacher, Student)
  - Admin panel for managing users, subjects, and timetables
  - Teacher module to display QR codes for attendance
  - Student module to scan QR and mark attendance
  - Secure and structured database design
  - Clean and modular folder structure

technologies:
  frontend:
    - HTML5
    - CSS3
    - JavaScript
  backend:
    - PHP
    - MySQL
  tools:
    - XAMPP (Apache + MySQL)
    - Git / GitHub for version control

project_structure:
  - /admin: Web-based Admin panel to manage students, teachers, subjects, and timetables
  - /teacher: Login and QR code generation module
  - /student: Login and QR code scanning module
  - /database: MySQL schema and setup instructions
  - /assets: Images, CSS, and JS used across modules

setup_instructions:
  - Clone the repository:
    - git clone https://github.com/gauravsonawane77/QRCAS-QR-Code-Based-Attendance-System.git
  - Move the project to your XAMPP `htdocs` directory
  - Import the database:
    - Open phpMyAdmin
    - Create a new database (e.g., `qrattendance`)
    - Import `qrattendance.sql` from `/database` folder
  - Configure DB credentials in `/config/db.php`
  - Start Apache and MySQL from XAMPP
  - Visit: http://localhost/qrattendance/

user_roles:
  - Admin:
      - Add/Edit/Delete Students, Teachers, Subjects
      - Create and update timetables
  - Teacher:
      - Login and generate unique QR code for each lecture
  - Student:
      - Login and scan QR code to mark attendance

future_enhancements:
  - Email notification on attendance
  - Data analytics for teachers and admins
  - Export attendance as Excel or PDF
  - Mobile-friendly UI
  - OTP-based login and validation

contributors:
  - Gaurav Sonawane (https://github.com/gauravsonawane77)

license_section:
  type: MIT
  url: https://opensource.org/licenses/MIT
