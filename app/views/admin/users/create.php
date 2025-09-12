<?php
session_start();


if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header('Location: ../../auth/login.php?error=' . urlencode('Access denied'));
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create User</title>
    <link rel="stylesheet" href="../../../../public/css/style.css">
    <style>
       
        body { margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .admin-form-container { max-width: 600px; margin: 20px auto; padding: 20px; background: white; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .admin-form-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 2px solid #e9ecef; }
        .admin-form-header h1 { margin: 0; color: #333; font-size: 1.8rem; }
        .admin-form-group { margin-bottom: 15px; }
        .admin-form-group label { display: block; margin-bottom: 5px; font-weight: bold; color: #495057; }
        .admin-form-group input, .admin-form-group select { width: 100%; padding: 10px; border: 1px solid #ced4da; border-radius: 5px; font-size: 1rem; box-sizing: border-box; }
        .admin-form-row { display: flex; gap: 15px; }
        .admin-form-row .admin-form-group { flex: 1; }
        .admin-form-actions { margin-top: 20px; padding-top: 15px; border-top: 1px solid #e9ecef; }
        .btn { display: inline-block; padding: 10px 20px; border: none; border-radius: 5px; text-decoration: none; font-size: 1rem; cursor: pointer; margin-right: 10px; transition: all 0.3s ease; }
        .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .btn-secondary { background: #6c757d; color: white; }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0,0,0,0.2); }
        input:focus, select:focus { outline: none; border-color: #667eea; box-shadow: 0 0 0 2px rgba(102, 126, 234, 0.2); }
        @media (max-width: 768px) { .admin-form-container { margin: 10px; padding: 15px; } .admin-form-row { flex-direction: column; gap: 0; } .admin-form-header { flex-direction: column; gap: 10px; text-align: center; } }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="admin-form-container">
        <div class="admin-form-header">
            <h1>Create User</h1>
            <a href="index.php" class="btn btn-secondary">← Back</a>
        </div>

        <?php if (isset($_SESSION['success'])): ?>
            <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px; border: 1px solid #c3e6cb;">
                <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px; border: 1px solid #f5c6cb;">
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="../../../controllers/admin/userController.php">
            <input type="hidden" name="action" value="create">
            
            <div class="admin-form-row">
                <div class="admin-form-group">
                    <label>First Name *</label>
                    <input type="text" name="firstName" required value="<?php echo isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : ''; ?>">
                </div>
                <div class="admin-form-group">
                    <label>Last Name *</label>
                    <input type="text" name="lastName" required value="<?php echo isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : ''; ?>">
                </div>
            </div>

            <div class="admin-form-group">
                <label>Role *</label>
                <select name="role" required>
                    <option value="">Select Role</option>
                    <option value="teacher" <?php echo (isset($_POST['role']) && $_POST['role'] == 'teacher') ? 'selected' : ''; ?>>Teacher</option>
                    <option value="student" <?php echo (isset($_POST['role']) && $_POST['role'] == 'student') ? 'selected' : ''; ?>>Student</option>
                    <option value="admin" <?php echo (isset($_POST['role']) && $_POST['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                </select>
            </div>

            <div style="background: #e9ecef; padding: 15px; border-radius: 5px; margin: 15px 0; border-left: 4px solid #667eea;">
                <strong>Note:</strong> Email will be automatically generated based on role and name.<br>
                Default password will be set to: <strong>password123</strong><br>
                User can change password after first login.
            </div>
                </div>
                <div class="admin-form-group">
                    <label>Confirm Password *</label>
                    <input type="password" name="confirmPassword" required>
                </div>
            <div class="admin-form-actions">
                <button type="submit" class="btn btn-primary">Create User</button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
