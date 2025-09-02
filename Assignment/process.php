<?php

session_start();
include 'config.php';

class StudentManager {
    private $conn;
    
    public function __construct($connection) {
        $this->conn = $connection;
    }
    
    // Sanitize input data
    private function sanitizeInput($data) {
        return htmlspecialchars(strip_tags(trim($data)));
    }
    
    // Validate email format
    private function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    
    // Check if email already exists
    private function emailExists($email) {
        $stmt = $this->conn->prepare("SELECT id FROM student_records WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }
    
    // Check if registration number already exists
    private function regnoExists($regno) {
        $stmt = $this->conn->prepare("SELECT id FROM student_records WHERE regno = ?");
        $stmt->bind_param("s", $regno);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }
    
    // Register new student
    public function registerStudent($data) {
        try {
            // Sanitize inputs
            $regno = $this->sanitizeInput($data['regno']);
            $name = $this->sanitizeInput($data['name']);
            $email = $this->sanitizeInput($data['email']);
            $department = $this->sanitizeInput($data['department']);
            
            // Validate required fields
            if (empty($regno) || empty($name) || empty($email) || empty($department)) {
                throw new Exception("All fields are required.");
            }
            
            // Validate email
            if (!$this->validateEmail($email)) {
                throw new Exception("Invalid email format.");
            }
            
            // Check if registration number already exists
            if ($this->regnoExists($regno)) {
                throw new Exception("Registration number already exists in the system.");
            }
            
            // Check if email already exists
            if ($this->emailExists($email)) {
                throw new Exception("Email already exists in the system.");
            }
            
            // Insert student using prepared statement
            $stmt = $this->conn->prepare("INSERT INTO student_records (regno, full_name, email, department) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $regno, $name, $email, $department);
            
            if ($stmt->execute()) {
                $_SESSION['success'] = "Student registered successfully!";
                return true;
            } else {
                throw new Exception("Failed to register student. Please try again.");
            }
            
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            return false;
        }
    }
    
    // Search for student
    public function searchStudent($searchTerm) {
        try {
            $searchTerm = $this->sanitizeInput($searchTerm);
            
            if (empty($searchTerm)) {
                throw new Exception("Search term cannot be empty.");
            }
            
            $stmt = $this->conn->prepare("SELECT * FROM student_records WHERE email = ? OR regno = ?");
            $stmt->bind_param("ss", $searchTerm, $searchTerm);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $_SESSION['search_results'] = $result->fetch_all(MYSQLI_ASSOC);
                return true;
            } else {
                $_SESSION['error'] = "No student found with the provided information.";
                return false;
            }
            
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            return false;
        }
    }
    
    // Delete student
    public function deleteStudent($id) {
        try {
            $id = filter_var($id, FILTER_VALIDATE_INT);
            
            if (!$id) {
                throw new Exception("Invalid student ID.");
            }
            
            $stmt = $this->conn->prepare("DELETE FROM student_records WHERE id = ?");
            $stmt->bind_param("i", $id);
            
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    $_SESSION['success'] = "Student deleted successfully!";
                    return true;
                } else {
                    throw new Exception("Student not found.");
                }
            } else {
                throw new Exception("Failed to delete student.");
            }
            
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            return false;
        }
    }
}

// Initialize StudentManager
$studentManager = new StudentManager($conn);

// Handle different actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Handle student registration
    if (isset($_POST['registerBtn'])) {
        $studentManager->registerStudent($_POST);
        header("Location: index.php");
        exit();
    }
    
    // Handle student search
    if (isset($_POST['searchBtn'])) {
        if ($studentManager->searchStudent($_POST['search'])) {
            header("Location: view.php?search=1");
        } else {
            header("Location: index.php");
        }
        exit();
    }
}

// Handle student deletion (GET request)
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $studentManager->deleteStudent($_GET['id']);
    header("Location: view.php");
    exit();
}

// Close database connection
$conn->close();

// Redirect to index if no valid action
header("Location: index.php");
exit();
?>