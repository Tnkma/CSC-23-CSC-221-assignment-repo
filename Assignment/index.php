<?php 
session_start();
// include "config.php"; // This should be present for functionality
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNICROSS Student Management Portal</title>
    
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
            --success-bg: #e6f9f0;
            --success-text: #0d6a3b;
            --error-bg: #fdecea;
            --error-text: #a31621;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: var(--light-gray);
            background-image: 
                radial-gradient(circle at 1px 1px, rgba(0, 0, 0, 0.05) 1px, transparent 0),
                radial-gradient(circle at 10px 10px, rgba(0, 0, 0, 0.05) 1px, transparent 0);
            background-size: 20px 20px;
            min-height: 100vh; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            padding: 20px;
        }
        
        .portal-container { 
            width: 100%; 
            max-width: 550px; 
            background: #ffffff;
            border-radius: 20px; 
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .portal-header {
            padding: 30px;
            text-align: center;
            border-bottom: 1px solid var(--border-color);
        }

        .portal-header img {
            height: 50px;
            margin-bottom: 15px;
        }
        
        .portal-header h1 { 
            font-size: 1.8rem; 
            font-weight: 600;
            color: var(--text-dark); 
        }

        .alert-container {
            padding: 0 25px;
        }
        .alert { 
            padding: 15px; 
            margin: 20px 0 0 0; 
            border-radius: 10px; 
            font-size: 14px; 
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .alert-success { background: var(--success-bg); color: var(--success-text); }
        .alert-error { background: var(--error-bg); color: var(--error-text); }

        .tab-nav {
            display: flex;
            justify-content: center;
            background: #f9fbfd;
            border-bottom: 1px solid var(--border-color);
        }
        .tab-btn {
            flex: 1;
            padding: 18px 10px;
            background: none;
            border: none;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            font-weight: 500;
            color: var(--text-light);
            transition: all 0.3s ease;
            position: relative;
        }
        .tab-btn:hover {
            color: var(--primary-blue);
        }
        .tab-btn.active {
            color: var(--primary-blue);
        }
        .tab-btn.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: var(--primary-blue);
            border-radius: 3px;
        }
        
        .tab-content {
            padding: 30px;
        }
        .tab-pane {
            display: none;
            animation: slideIn 0.4s ease-out;
        }
        .tab-pane.active {
            display: block;
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(10px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .tab-pane h2 {
            text-align: center;
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 25px;
        }

        .input-group {
            position: relative;
            margin-bottom: 20px;
        }
        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            transition: color 0.2s ease;
        }
        .form-input {
            width: 100%;
            padding: 14px 14px 14px 45px;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            font-size: 15px;
            font-family: 'Poppins', sans-serif;
            background: #fdfdfd;
            transition: all 0.3s ease;
        }
        .form-input:focus {
            outline: none;
            border-color: var(--secondary-blue);
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.15);
        }
        .form-input:focus + i {
            color: var(--secondary-blue);
        }

        .btn {
            background: linear-gradient(135deg, var(--secondary-blue), var(--primary-blue));
            color: white;
            font-weight: 500;
            padding: 14px 25px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
            transition: all 0.3s ease;
            display: block;
            width: 100%;
        }
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 123, 255, 0.2);
        }

        .footer {
            text-align: center;
            padding: 20px;
            color: #888;
            font-size: 13px;
        }

    </style>
</head>
<body>
    <div class="portal-container">
        <header class="portal-header">
            <img src="https://upload.wikimedia.org/wikipedia/en/c/c9/Unicross_logo.png" alt="UNICROSS Logo" style="height:50px;">
            <h1>Student Management Portal</h1>
        </header>

        <div class="alert-container">
            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <i class="fa-solid fa-check-circle"></i>
                    <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-error">
                    <i class="fa-solid fa-exclamation-triangle"></i>
                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>
        </div>

        <nav class="tab-nav">
            <button class="tab-btn active" onclick="showTab('register')"><i class="fa-solid fa-user-plus"></i> Register</button>
            <button class="tab-btn" onclick="showTab('search')"><i class="fa-solid fa-search"></i> Search</button>
            <button class="tab-btn" onclick="showTab('view')"><i class="fa-solid fa-users"></i> View All</button>
        </nav>

        <main class="tab-content">
            <div id="register" class="tab-pane active">
                <h2>Create New Student Profile</h2>
                <form action="process.php" method="POST">
                    <div class="input-group">
                        <input type="text" name="regno" class="form-input" placeholder="Registration Number" required>
                        <i class="fa-solid fa-hashtag"></i>
                    </div>
                    <div class="input-group">
                        <input type="text" name="name" class="form-input" placeholder="Full Name" required>
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <div class="input-group">
                        <input type="email" name="email" class="form-input" placeholder="Email Address" required>
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div class="input-group">
                        <input type="text" name="department" class="form-input" placeholder="Department" required>
                        <i class="fa-solid fa-building-columns"></i>
                    </div>
                    <button type="submit" name="registerBtn" class="btn">Register Student</button>
                </form>
            </div>

            <div id="search" class="tab-pane">
                <h2>Find a Student</h2>
                 <form action="process.php" method="POST">
                    <div class="input-group">
                        <input type="text" name="search" class="form-input" placeholder="Enter Email or Reg. No." required>
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <button type="submit" name="searchBtn" class="btn">Search</button>
                </form>
            </div>

            <div id="view" class="tab-pane" style="text-align: center;">
                <h2>View All Records</h2>
                <p style="color: var(--text-light); margin-bottom: 25px;">Click the button below to display a list of all registered students.</p>
                <a href="view.php" class="btn">View All Students</a>
            </div>
        </main>

        <footer class="footer">
            <p>&copy; <?php echo date('Y'); ?> University of Cross River State (UNICROSS)</p>
        </footer>
    </div>

    <script>
        function showTab(tabId) {
            // Hide all tab panes
            const tabPanes = document.querySelectorAll('.tab-pane');
            tabPanes.forEach(pane => {
                pane.classList.remove('active');
            });

            // Deactivate all tab buttons
            const tabBtns = document.querySelectorAll('.tab-btn');
            tabBtns.forEach(btn => {
                btn.classList.remove('active');
            });

            // Show the selected tab pane
            document.getElementById(tabId).classList.add('active');

            // Activate the selected tab button
            event.currentTarget.classList.add('active');
        }
    </script>

</body>
</html>