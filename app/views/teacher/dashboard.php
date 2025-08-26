<!DOCTYPE html>
<html>
    <head>
        <title>Teacher Dashboard</title>
        <link rel="stylesheet" type="text/css" href="../../../public/css/style.css">
    </head>
    <body>
        <header>
            <h1>Teacher Dashboard</h1>
        </header>
        <div class="container">
            <h2>Welcome, Teacher<?php echo isset($_GET['name']) ? ' ' . htmlspecialchars($_GET['name']) : ''; ?>!</h2>
            <p>Manage your classes and students from this dashboard.</p>
            
            <div class="dashboard-actions">
                <a href="../auth/login.php" class="btn">Logout</a>
            </div>
        </div>
    </body>
</html>
