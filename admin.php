<?php 
include 'config.php'; 

// Simple admin login
if (isset($_POST['login'])) {
    if ($_POST['password'] === 'admin123') { // Change this password!
        $_SESSION['admin_logged_in'] = true;
    }
}

if (!isAdmin()) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['login'])) {
        die('Access denied');
    }
} else {
    // Handle CRUD operations
    if (isset($_GET['delete'])) {
        $stmt = $pdo->prepare("DELETE FROM contacts WHERE id = ?");
        $stmt->execute([$_GET['delete']]);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <nav class="legacy-nav">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Me</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="admin.php" class="active">Admin</a></li>
        </ul>
    </nav>

    <div class="container">
        
        <?php if (!isAdmin()): ?>
            <div class="card login-form">
                <h3 class="text-gradient">Admin Access</h3>
                <form method="POST">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" required>
                    </div>
                    <button type="submit" name="login" class="btn" style="width: 100%; margin-top: 1rem;">Login</button>
                </form>
                <p style="text-align: center; margin-top: 1.5rem;"><small style="color: var(--text-muted);">Default password: admin123</small></p>
            </div>
        <?php else: ?>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                <h1 class="text-gradient">Inbox</h1>
                <a href="?logout=1" class="btn btn-outline" style="padding: 0.5rem 1.5rem;"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
            
            <?php
            // Logout
            if (isset($_GET['logout'])) {
                session_destroy();
                header('Location: admin.php');
                exit;
            }
            
            $stmt = $pdo->query("SELECT * FROM contacts ORDER BY created_at DESC");
            $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>
            
            <?php if (empty($contacts)): ?>
                <div class="card" style="text-align: center;">
                    <i class="fas fa-inbox text-gradient" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                    <p>No contact messages yet.</p>
                </div>
            <?php else: ?>
                <div class="table-wrapper">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($contacts as $contact): ?>
                            <tr>
                                <td>#<?= $contact['id'] ?></td>
                                <td><strong><?= htmlspecialchars($contact['name']) ?></strong></td>
                                <td><a href="mailto:<?= htmlspecialchars($contact['email']) ?>" style="color: var(--secondary); text-decoration: none;"><?= htmlspecialchars($contact['email']) ?></a></td>
                                <td><?= substr(htmlspecialchars($contact['message']), 0, 80) ?><?= strlen($contact['message']) > 80 ? '...' : '' ?></td>
                                <td style="color: var(--text-muted); font-size: 0.9sm;"><?= date('M j, Y', strtotime($contact['created_at'])) ?></td>
                                <td>
                                    <a href="?delete=<?= $contact['id'] ?>" 
                                       class="btn btn-danger" 
                                       style="padding: 0.5rem 1rem; font-size: 0.85rem;"
                                       onclick="return confirm('Delete this message?')"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>