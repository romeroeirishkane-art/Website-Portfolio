<?php 
include 'config.php'; 

// Simple CAPTCHA generation
if (!isset($_SESSION['captcha'])) {
    $_SESSION['captcha'] = rand(1000, 9999);
}

$error = '';
$success = '';

if ($_POST) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);
    $captcha = $_POST['captcha'];
    $captcha_input = $_POST['captcha_input'];
    
    if ($captcha_input != $_SESSION['captcha']) {
        $error = 'Invalid CAPTCHA!';
    } elseif (empty($name) || empty($email) || empty($message)) {
        $error = 'Please fill all fields!';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email format!';
    } else {
        $stmt = $pdo->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
        if ($stmt->execute([$name, $email, $message])) {
            $success = 'Thank you! Your message has been sent.';
            $_POST = array(); // Clear form
            $_SESSION['captcha'] = rand(1000, 9999); // New CAPTCHA
        } else {
            $error = 'Error sending message. Please try again.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Me</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <nav class="legacy-nav">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Me</a></li>
            <li><a href="contact.php" class="active">Contact</a></li>
            <li><a href="admin.php">Admin</a></li>
        </ul>
    </nav>

    <div class="container">
        
        <?php if ($success): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?= $success ?>
            </div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-triangle"></i> <?= $error ?>
            </div>
        <?php endif; ?>

        <div class="card" style="max-width: 700px; margin: 2rem auto;">
            <h1 class="text-gradient">Get In Touch</h1>
            <p style="color: var(--text-muted); margin-bottom: 2.5rem;">
                I'd love to hear about your project! Feel free to reach out with any questions or inquiries.
            </p>
            
            <form method="POST">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Message</label>
                    <textarea name="message" required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
                </div>
                
                <div class="captcha">
                    <label style="margin: 0;">Code: <strong style="color: var(--primary); letter-spacing: 2px; font-size: 1.2rem;"><?= $_SESSION['captcha'] ?></strong></label>
                    <input type="number" class="captcha-input" name="captcha_input" placeholder="Type..." autocomplete="off" required>
                </div>
                
                <button type="submit" class="btn" style="width: 100%; margin-top: 1rem;"><i class="fas fa-paper-plane" style="margin-right: 8px;"></i> Send Message</button>
            </form>
        </div>
    </div>
</body>
</html>