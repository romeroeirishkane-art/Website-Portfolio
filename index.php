<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio | [Your Name]</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <nav class="split-nav">
        <div class="nav-brand">[Your Name]</div>
        <div class="nav-links">
            <a href="index.php" class="active">Home</a>
            <a href="about.php">About Me</a>
            <a href="contact.php">Contact</a>
            <a href="admin.php">Admin</a>
            <div class="hamburger">
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <div class="split-layout">
        
        <div class="split-left">
            <!-- Using the new photo you uploaded. -->
            <img src="uploads/hero.png" alt="Profile Portfolio Image" onerror="this.src='https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=988&auto=format&fit=crop'">
        </div>
        
        <div class="split-right">
            <div class="content-wrapper">
                <h1 class="huge-title">
                    <span class="title-top">My <hr class="title-line"></span>
                    <span>Portfolio</span>
                </h1>
                
                <p class="split-paragraph">
                  Libre lang mangarap,
Walang hanggan na paghiling.
                </p>
                
                <div class="split-btns">
                    <a href="about.php" class="btn-solid">Explore Now</a>
                </div>
            </div>
            
         
        </div>

    </div>
</body>
</html>