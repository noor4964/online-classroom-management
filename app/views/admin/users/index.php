<?php
session_start();


require_once __DIR__ . '/../../../models/Database.php';
require_once __DIR__ . '/../../../models/User.php';


if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header('Location: ../../auth/login.php?error=' . urlencode('Access denied'));
    exit;
}


$users = getAllUsers();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Users Management</title>
    <link rel="stylesheet" href="../../../../public/css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
       
        body { margin: 0; padding: 0; font-family: Arial, sans-serif; background-color: #f4f4f4; }
        .admin-users-container { max-width: 1200px; margin: 20px auto; padding: 20px; background: white; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .admin-users-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 2px solid #e9ecef; }
        .admin-users-header h1 { margin: 0; color: #333; font-size: 1.8rem; }
        .admin-users-search { margin-bottom: 20px; display: flex; gap: 15px; flex-wrap: wrap; }
        .admin-users-search input, .admin-users-search select { padding: 10px; border: 1px solid #ced4da; border-radius: 5px; font-size: 1rem; min-width: 200px; }
        .admin-users-search input:focus, .admin-users-search select:focus { outline: none; border-color: #667eea; box-shadow: 0 0 0 2px rgba(102, 126, 234, 0.2); }
        .admin-users-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .admin-users-table th, .admin-users-table td { padding: 12px; text-align: left; border-bottom: 1px solid #e9ecef; }
        .admin-users-table th { background: #f8f9fa; font-weight: bold; color: #495057; border-bottom: 2px solid #e9ecef; }
        .admin-users-table tbody tr:hover { background-color: #f8f9fa; }
        .admin-users-table tbody tr:nth-child(even) { background-color: #fdfdfd; }
        .admin-users-table tbody tr:nth-child(even):hover { background-color: #f8f9fa; }
        .btn { display: inline-block; padding: 8px 16px; border: none; border-radius: 5px; text-decoration: none; font-size: 0.9rem; cursor: pointer; margin-right: 5px; transition: all 0.3s ease; text-align: center; }
        .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
        .btn-warning { background: #ffc107; color: #212529; }
        .btn-danger { background: #dc3545; color: white; }
        .btn-secondary { background: #6c757d; color: white; }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0,0,0,0.2); }
        .role { padding: 4px 8px; border-radius: 4px; font-size: 0.8rem; font-weight: bold; }
        .role.teacher { background: #28a745; color: white; }
        .role.student { background: #17a2b8; color: white; }
        .role.admin { background: #6f42c1; color: white; }
        .success-message { background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px; border: 1px solid #c3e6cb; }
        .error-message { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px; border: 1px solid #f5c6cb; }
        .empty-state { text-align: center; padding: 40px; color: #6c757d; }
        .admin-users-header div { display: flex; gap: 10px; align-items: center; }
        
       
        @media (max-width: 768px) {
            .admin-users-container { margin: 10px; padding: 15px; }
            .admin-users-header { flex-direction: column; gap: 15px; text-align: center; }
            .admin-users-search { flex-direction: column; }
            .admin-users-search input, .admin-users-search select { min-width: 100%; }
            .admin-users-table { font-size: 0.8rem; }
            .admin-users-table th, .admin-users-table td { padding: 8px 4px; }
            .btn { padding: 6px 10px; font-size: 0.8rem; margin: 2px; }
        }
        
       
        .admin-users-table td:last-child { white-space: nowrap; }
        
       
        .admin-users-search { background: #f8f9fa; padding: 15px; border-radius: 8px; border: 1px solid #e9ecef; }
        
       
        .empty-state { text-align: center; padding: 40px; color: #6c757d; }
        .empty-state h3 { margin-bottom: 10px; }
        
       
        .loading { text-align: center; padding: 20px; color: #6c757d; }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="admin-users-container">
        <div class="admin-users-header">
            <h1>Users Management</h1>
            <div>
                <a href="../dashboard.php" class="btn btn-secondary">← Back to Dashboard</a>
                <a href="create.php" class="btn btn-primary">+ Add User</a>
            </div>
        </div>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="success-message">
                <?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <table class="admin-users-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($users)): ?>
                    <tr>
                        <td colspan="5" class="empty-state">
                            <h3>No users found</h3>
                            <p>Start by adding your first user</p>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['first_name'] . ' ' . $user['last_name']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><span class="role <?php echo htmlspecialchars($user['user_type']); ?>"><?php echo ucfirst(htmlspecialchars($user['user_type'])); ?></span></td>
                            <td><?php echo date('M d, Y', strtotime($user['created_at'])); ?></td>
                            <td>
                                <a href="view.php?id=<?php echo $user['id']; ?>" class="btn btn-secondary btn-sm">View</a>
                                <a href="edit.php?id=<?php echo $user['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="delete.php?id=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
