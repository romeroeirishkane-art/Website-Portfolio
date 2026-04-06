<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About | Portfolio</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <nav class="legacy-nav">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php" class="active">About</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="admin.php">Admin</a></li>
        </ul>
    </nav>

    <div class="container">
        <div class="card" style="text-align: center; margin-top: 2rem;">
            
            <div class="profile-wrapper">
                <img src="uploads/profile.jpg" alt="Profile Picture" class="profile-img" onerror="this.src='https://via.placeholder.com/250/161619/FFFFFF?text=Profile'">
            </div>
            
            <h1 class="text-gradient">Eirish Kane Romero</h1>
            <h2>Full Stack Developer</h2>
            
            <p style="color: var(--text-muted); max-width: 600px; margin: 1.5rem auto 3rem;">
                Crafting pixel-perfect websites and robust web applications focused on aesthetics and cutting-edge technologies.
            </p>

            <h3 style="text-align: left;"><i class="fas fa-code text-gradient-orange"></i> My Toolkit</h3>
            <div class="skills-grid">
                <div class="skill-card">
                    <i class="fas fa-server skill-icon"></i>
                    <h4>Backend</h4>
                    <p>PHP, Node.js, Python</p>
                </div>
                <div class="skill-card">
                    <i class="fas fa-database skill-icon"></i>
                    <h4>Database</h4>
                    <p>MySQL, MongoDB</p>
                </div>
                <div class="skill-card">
                    <i class="fab fa-react skill-icon"></i>
                    <h4>Frontend</h4>
                    <p>React, Vue.js, HTML/CSS</p>
                </div>
                <div class="skill-card">
                    <i class="fas fa-mobile-alt skill-icon"></i>
                    <h4>Mobile</h4>
                    <p>Responsive Design</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>