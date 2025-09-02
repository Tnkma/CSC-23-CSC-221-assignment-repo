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
            --light-blue-bg: #f0f6ff;
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
            min-height: 100vh; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            padding: 20px;
        }
        
        .portal-container { 
            width: 100%; 
            max-width: 850px; 
            background: #ffffff;
            border-radius: 24px; 
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
            display: flex;
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.98) translateY(-10px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }

        /* --- Left Sidebar --- */
        .portal-sidebar {
            flex-basis: 45%;
            background-color: var(--light-blue-bg);
            padding: 40px;
            border-top-left-radius: 24px;
            border-bottom-left-radius: 24px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: var(--text-dark);
        }
        .portal-sidebar .illustration {
            max-width: 250px;
            margin: 0 auto 30px;
        }
        .portal-sidebar h2 {
            font-size: 1.6rem;
            font-weight: 600;
            margin-bottom: 10px;
        }
        .portal-sidebar p {
            font-size: 15px;
            color: var(--text-light);
            line-height: 1.6;
        }

        /* --- Right Main Content --- */
        .portal-main {
            flex-basis: 55%;
            display: flex;
            flex-direction: column;
        }

        .portal-header {
            padding: 30px 30px 20px 30px;
            text-align: center;
        }
        .portal-header img {
            height: 45px;
            margin-bottom: 10px;
        }
        .portal-header h1 { 
            font-size: 1.6rem; 
            font-weight: 600;
            color: var(--text-dark); 
        }

        .alert-container {
            padding: 0 30px;
        }
        .alert { 
            padding: 15px; 
            margin-top: 15px; 
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
            border-bottom: 1px solid var(--border-color);
            margin-top: 20px;
        }
        .tab-btn {
            flex: 1;
            padding: 15px 10px;
            background: none;
            border: none;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 500;
            color: var(--text-light);
            transition: all 0.3s ease;
            position: relative;
        }
        .tab-btn:hover { color: var(--primary-blue); }
        .tab-btn.active { color: var(--primary-blue); }
        .tab-btn.active::after {
            content: ''; position: absolute; bottom: -1px; left: 0;
            width: 100%; height: 3px; background-color: var(--primary-blue);
        }
        
        .tab-content { padding: 25px 30px; }
        .tab-pane { display: none; }
        .tab-pane.active { display: block; animation: slideIn 0.4s ease-out; }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .input-group { position: relative; margin-bottom: 18px; }
        .input-group i { position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #aaa; transition: color 0.2s ease; }
        .form-input {
            width: 100%; padding: 13px 13px 13px 45px;
            border: 1px solid var(--border-color); border-radius: 10px;
            font-size: 14px; font-family: 'Poppins', sans-serif; background: #fdfdfd;
            transition: all 0.3s ease;
        }
        .form-input:focus { outline: none; border-color: var(--secondary-blue); box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1); }
        .form-input:focus + i { color: var(--secondary-blue); }

        .btn {
            background: linear-gradient(135deg, var(--secondary-blue), var(--primary-blue));
            color: white; font-weight: 500; padding: 13px 25px;
            border: none; border-radius: 10px; cursor: pointer;
            text-decoration: none; font-size: 15px;
            transition: all 0.3s ease; display: block; width: 100%;
        }
        .btn:hover { transform: translateY(-3px); box-shadow: 0 6px 20px rgba(0, 123, 255, 0.2); }

        .footer {
            text-align: center; padding: 20px; color: #999;
            font-size: 12px; margin-top: auto;
        }

        /* --- Responsive Design --- */
        @media (max-width: 900px) {
            .portal-container {
                flex-direction: column;
                max-width: 500px;
                margin: 20px auto;
            }
            .portal-sidebar {
                display: none; /* Hide the sidebar on smaller screens for simplicity */
            }
            .portal-main {
                flex-basis: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="portal-container">
        <div class="portal-sidebar">
            <svg class="illustration" viewBox="0 0 293 280" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M146.5 280C227.424 280 293 217.301 293 139.998C293 62.6946 227.424 0 146.5 0C65.5756 0 0 62.6946 0 139.998C0 217.301 65.5756 280 146.5 280Z" fill="#E0EFFF"/>
                <rect x="74" y="66" width="145" height="152" rx="10" fill="#FFFFFF"/>
                <rect x="74" y="66" width="145" height="30" rx="10" fill="#A8CCF3"/>
                <path d="M146.5 218C162.225 218 175 205.225 175 189.5V107.5C175 91.7751 162.225 79 146.5 79C130.775 79 118 91.7751 118 107.5V189.5C118 205.225 130.775 218 146.5 218Z" fill="#6B9EFF"/>
                <path d="M146.5 197C157.269 197 166 188.269 166 177.5V129.5C166 118.731 157.269 110 146.5 110C135.731 110 127 118.731 127 129.5V177.5C127 188.269 135.731 197 146.5 197Z" fill="#FFFFFF"/>
                <circle cx="146.5" cy="154.5" r="14.5" fill="#A8CCF3"/>
            </svg>
            <h2>Welcome to the Portal</h2>
            <p>Manage student records with ease. Register new students, search for existing ones, and view all entries in one centralized location.</p>
        </div>

        <div class="portal-main">
            <header class="portal-header">
                <img src="https://upload.wikimedia.org/wikipedia/en/c/c9/Unicross_logo.png" alt="UNICROSS Logo">
                <h1>Student Management</h1>
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
                     <form action="process.php" method="POST">
                        <div class="input-group">
                            <input type="text" name="search" class="form-input" placeholder="Enter Email or Reg. No." required>
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                        <button type="submit" name="searchBtn" class="btn">Search</button>
                    </form>
                </div>

                <div id="view" class="tab-pane" style="text-align: center;">
                    <h2 style="font-size: 1.2rem; margin-bottom: 15px;">View All Records</h2>
                    <p style="color: var(--text-light); margin-bottom: 20px; font-size: 14px;">Click the button below to display a list of all registered students.</p>
                    <a href="view.php" class="btn">View All Students</a>
                </div>
            </main>

            <footer class="footer">
                <p>&copy; <?php echo date('Y'); ?> University of Cross River State</p>
            </footer>
        </div>
    </div>

    <script>
        function showTab(tabId) {
            document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            document.getElementById(tabId).classList.add('active');
            event.currentTarget.classList.add('active');
        }
    </script>

</body>
</html>