# Student Management Portal

A comprehensive web-based student management system built for CSC 282 as part of the Computer Lab II coursework.

## 📋 Project Information

- **Student Name:** Onwusilike Godswill Chimnonso
- **Registration Number:** 23/CSC/221
- **Course Code:** CSC 282
- **Course Title:** Computer Lab II
- **Institution:** University of Cross River State (UNICROSS)
- **Department:** Computer Science

## 🎯 Project Overview

The Student Management Portal is a modern, responsive web application designed to streamline student record management. The system provides an intuitive interface for registering new students, searching existing records, and managing student data efficiently.

## Test the app features at `[tnkma.com.ng](https://tnkma.com.ng)`

## ✨ Features

### Core Functionality
- **Student Registration:** Add new student records with comprehensive validation
- **Student Search:** Search students by email address or registration number
- **View All Students:** Display all registered students in a structured table
- **Record Management:** Delete student records with confirmation prompts
- **Data Validation:** Real-time form validation and error handling

### Technical Features
- **Responsive Design:** Mobile-friendly interface with modern UI/UX
- **Security:** SQL injection prevention using prepared statements
- **Session Management:** Flash messaging for user feedback
- **Input Sanitization:** XSS protection and data cleaning
- **Database Integrity:** Unique constraints on email and registration numbers

## 🛠️ Technology Stack

- **Frontend:**
  - HTML5 & CSS3
  - JavaScript (ES6+)
  - Font Awesome Icons
  - Google Fonts (Poppins)
  - Responsive Grid Layout

- **Backend:**
  - PHP 8.4+
  - Object-Oriented Programming (OOP)
  - MySQLi with Prepared Statements

- **Database:**
  - MySQL 8.7+
  - Structured table design with constraints

## 📁 Project Structure

```
Assignment/
├── index.php          # Homepage with registration, search, and navigation
├── process.php        # Backend processing logic (StudentManager class)
├── view.php          # Display students with search results
├── config.php        # Database configuration and connection
└── README.md         # Project documentation
```

## 🗄️ Database Schema

### Table: `student_records`
```sql
CREATE TABLE student_records (
    id INT PRIMARY KEY AUTO_INCREMENT,
    regno VARCHAR(20) UNIQUE NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    department VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

## 🚀 Installation & Setup

### Prerequisites
- XAMPP/LAMP/WAMP server
- PHP 8.4 or higher
- MySQL 8.7 or higher
- Web browser (Chrome, Firefox, Safari, Edge)

### Installation Steps

1. **Clone/Download the project:**
   ```bash
   git clone https://github.com/Tnkma/CSC-23-CSC-221-assignment-repo.git
   ```

2. **Setup Web Server:**
   - Place project folder in `htdocs` (XAMPP) or `www` (LAMP)
   - Start Apache and MySQL services

3. **Database Configuration:**
   - Create a new database (e.g., `school_portal`)
   - Update `config.php` with your database credentials:
   ```php
   $servername = "localhost";
   $username = "your_username";
   $password = "your_password";
   $dbname = "school_portal";
   ```

4. **Initialize Database:**
   ```bash
   # Run setup script
   php setup_db.php
   ```

5. **Access Application:**
   - Open browser and navigate to: `http://localhost/Assignment/`

## 📱 Usage Guide

### Student Registration
1. Navigate to the "Register" tab on the homepage
2. Fill in all required fields:
   - Registration Number (e.g., 23/CSC/001)
   - Full Name
   - Email Address
   - Department
3. Click "Register Student"
4. System validates uniqueness of email and registration number

### Student Search
1. Click on the "Search" tab
2. Enter either email address or registration number
3. Click "Search" to view results in the students table

### View All Students
1. Click on the "View All" tab
2. Click "View All Students" button
3. Browse complete student database with options to delete records

## 🔒 Security Features

### Input Validation
- **Server-side validation** for all form inputs
- **Email format validation** using PHP filters
- **Required field validation** prevents empty submissions
- **Data sanitization** to prevent XSS attacks

### Database Security
- **Prepared statements** prevent SQL injection
- **Unique constraints** maintain data integrity
- **Input escaping** for additional protection

### Session Security
- **Session-based messaging** for user feedback
- **Proper session management** with cleanup

## 🧪 Testing

### Test Scenarios Covered
1. **Valid student registration** with unique data
2. **Duplicate email detection** and error handling
3. **Duplicate registration number** validation
4. **Search functionality** by email and registration number
5. **Record deletion** with confirmation
6. **Form validation** for empty/invalid inputs
7. **Responsive design** across different devices

### Sample Test Data
```
Registration Number: CSC/2023/001
Name: John Smith
Email: john.smith@unicross.edu.ng
Department: Computer Science
```

## 📊 Performance Considerations

- Efficient database queries with proper indexing
- Responsive design optimized for various screen sizes
- Minimal external dependencies for faster loading
- Clean, maintainable code structure

## 🤝 Contributing

This project is submitted as coursework for CSC 282. For educational purposes, suggestions and improvements are welcome through:
- Code review comments
- Feature suggestions
- Bug reports

## 📞 Contact
**Student:** Onwusilike Godswill Chimnonso  
**Registration Number:** 23/CSC/221  
**Email:** [onwusilikenonso@gmail.com]  
**Department:** Computer Science  
**University:** University of Cross River State (UNICROSS)

---

*Submitted in partial fulfillment of the requirements for CSC 282 - Computer Lab II*
