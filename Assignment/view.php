<?php
session_start();
include "config.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Students - UNICROSS Portal</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --primary-blue: #0056b3;
            --secondary-blue: #007bff;
            --light-gray: #f4f7fc;
            --text-dark: #2c3e50;
            --text-light: #5a6a7e;
            --border-color: #dfe7ef;
            --danger-text: #c82333;
            --danger-bg: #fdecea;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: var(--light-gray);
            color: var(--text-dark);
            min-height: 100vh;
        }
        
        .container { 
            max-width: 1200px; 
            margin: 50px auto; 
            background: #ffffff;
            border-radius: 20px; 
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 30px 40px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 20px;
        }
        
        .page-header h1 { 
            font-size: 1.8rem; 
            font-weight: 600;
        }
        .page-header h2 {
            font-size: 1.1rem;
            font-weight: 400;
            color: var(--text-light);
            margin-top: 5px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .btn-back {
            background-color: #eef5ff;
            color: var(--primary-blue);
        }
        .btn-back:hover {
            background-color: #dbe9ff;
        }
        
        .table-wrapper {
            overflow-x: auto; /* Makes table responsive */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px; /* Ensures table has a minimum width before scrolling */
        }
        th, td {
            padding: 15px;
            text-align: left;
            vertical-align: middle;
        }
        thead {
            border-bottom: 2px solid var(--border-color);
        }
        th {
            font-weight: 600;
            font-size: 14px;
            color: var(--text-dark);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        tbody tr {
            border-bottom: 1px solid var(--border-color);
            transition: background-color 0.2s ease;
        }
        tbody tr:last-child {
            border-bottom: none;
        }
        tbody tr:hover {
            background-color: var(--light-gray);
        }
        td .user-name {
            font-weight: 600;
        }
        td .user-email {
            font-size: 14px;
            color: var(--text-light);
        }
        .btn-delete {
            background-color: var(--danger-bg);
            color: var(--danger-text);
            padding: 8px 12px;
            font-size: 14px;
        }
        .btn-delete:hover {
            background-color: var(--danger-text);
            color: #fff;
        }
        
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            border: 2px dashed var(--border-color);
            border-radius: 15px;
            margin-top: 30px;
        }
        .empty-state i {
            font-size: 3rem;
            color: #bdcbe0;
            margin-bottom: 20px;
        }
        .empty-state h3 {
            font-size: 1.5rem;
            color: var(--text-dark);
        }
        .empty-state p {
            color: var(--text-light);
            max-width: 400px;
            margin: 10px auto 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="page-header">
            <div>
                <h1>Student Records</h1>
                <?php
                if (isset($_GET['search']) && isset($_SESSION['search_results'])) {
                    echo "<h2>Displaying search results</h2>";
                    $students = $_SESSION['search_results'];
                    unset($_SESSION['search_results']);
                } else {
                    echo "<h2>A list of all registered students</h2>";
                    $result = $conn->query("SELECT * FROM student_records ORDER BY created_at DESC");
                    $students = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
                }
                ?>
            </div>
            <a href="index.php" class="btn btn-back">
                <i class="fa-solid fa-arrow-left"></i>
                Back to Portal
            </a>
        </header>

        <?php if (!empty($students)): ?>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Reg No</th>
                            <th>Full Name</th>
                            <th>Department</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($student['regno']); ?></td>
                            <td>
                                <div class="user-name"><?php echo htmlspecialchars($student['full_name']); ?></div>
                                <div class="user-email"><?php echo htmlspecialchars($student['email']); ?></div>
                            </td>
                            <td><?php echo htmlspecialchars($student['department']); ?></td>
                            <td>
                                <a href="process.php?action=delete&id=<?php echo $student['id']; ?>" 
                                   class="btn btn-delete" 
                                   onclick="return confirm('Are you sure you want to delete this student?')">
                                   <i class="fa-solid fa-trash-can"></i>
                                   Delete
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <i class="fa-solid fa-users-slash"></i>
                <h3>No Students Found</h3>
                <p>There are no student records to display. Try registering a new student or refining your search.</p>
            </div>
        <?php endif; ?>

        <?php if(isset($conn)) { $conn->close(); } ?>
    </div>
</body>
</html>