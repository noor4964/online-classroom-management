<?php


$admin_email = "admin@gmail.com";
$admin_password = "admin123";

$teacher_email = "teacher@gmail.com";
$teacher_password = "teacher123";

$student_email = "student@gmail.com";
$student_password = "student123";

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action === 'login') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $userType = isset($_POST['userType']) ? trim($_POST['userType']) : '';
    
    if ($userType === 'admin' && $email === $admin_email && $password === $admin_password) {
        
        header("Location: ../views/admin/dashboard.php?name=Admin");
        exit();
    } 
    else if ($userType === 'teacher' && $email === $teacher_email && $password === $teacher_password) {
        
        header("Location: ../views/teacher/dashboard.php?name=Teacher");
        exit();
    }
    else if ($userType === 'student' && $email === $student_email && $password === $student_password) {
        
        header("Location: ../views/student/dashboard.php?name=Student");
        exit();
    } 
    else {
        
        $error = "Invalid credentials. Please try again.";
        header("Location: ../views/auth/login.php?error=" . urlencode($error));
        exit();
    }
}


elseif ($action === 'redirect') {
    $userType = isset($_GET['userType']) ? $_GET['userType'] : '';
    
    if ($userType === 'teacher') {
        
        header("Location: ../views/teacher/dashboard.php");
        exit();
    } 
    elseif ($userType === 'student') {
       
        header("Location: ../views/student/dashboard.php");
        exit();
    }
    else {
        
        header("Location: ../views/auth/login.php");
        exit();
    }
}

else {
    header("Location: ../views/auth/login.php");
    exit();
}

if ($action === 'register') {
    $firstName = isset($_POST['firstName']) ? trim($_POST['firstName']) : '';
    $lastName = isset($_POST['lastName']) ? trim($_POST['lastName']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $confirmPassword = isset($_POST['confirmPassword']) ? trim($_POST['confirmPassword']) : '';
    $userType = isset($_POST['userType']) ? trim($_POST['userType']) : '';
    
    $errors = [];
    
    if (empty($firstName)) {
        $errors[] = "First name is required";
    }
    
    if (empty($lastName)) {
        $errors[] = "Last name is required";
    }
    
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters";
    }
    
    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match";
    }
    
    if (!empty($errors)) {
        $errorMsg = implode(", ", $errors);
        header("Location: ../views/auth/register.php?error=" . urlencode($errorMsg));
        exit();
    }
    
    header("Location: ../views/auth/login.php?success=Registration successful! Please login.");
    exit();
}