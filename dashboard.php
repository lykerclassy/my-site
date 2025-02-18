<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | EduLearn</title>
    <link rel="stylesheet" href="dashboard.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Add in the <head> -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
 
</head>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<body>

<!-- Navigation Bar -->
<div class="navbar">
    <div class="logo"><strong>EduLearn</strong></div>
    <div class="nav-links">
        <a href="dashboard.php"><i class="fas fa-home"></i> Home</a>
        <a href="downloads.php"><i class="fas fa-download"></i> Downloads</a>
        <a href="contact.php"><i class="fas fa-envelope"></i> Contact Us</a>
        <a href="logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
</div>

<!-- Hero Section -->
<header class="hero">
    <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
    <p>Your journey to knowledge starts here.</p>
    <form class="search-bar">
        <input type="text" placeholder="Search for resources...">
        <button type="submit"><i class="fas fa-search"></i></button>
    </form>
</header>

<!-- Slideshow Container -->
<div id="dashboardCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="banner1.jpg" class="d-block w-100" alt="New Study Materials">
            <div class="carousel-caption">
                <h5>📚 New Study Materials Added!</h5>
                <p>Explore the latest revision papers and exam tips.</p>
                <a href="#" class="btn btn-primary">View Materials</a>
            </div>
        </div>
        <div class="carousel-item">
            <img src="banner2.jpg" class="d-block w-100" alt="Exam Tips">
            <div class="carousel-caption">
                <h5>🎯 Exam Tips Available</h5>
                <p>Get expert strategies to excel in your KCSE exams.</p>
                <a href="#" class="btn btn-success">Read Tips</a>
            </div>
        </div>
        <div class="carousel-item">
            <img src="banner3.jpg" class="d-block w-100" alt="Server Maintenance">
            <div class="carousel-caption">
                <h5>⚠️ Server Maintenance on 20th Feb</h5>
                <p>Prepare in advance, as the site will be offline for updates.</p>
            </div>
        </div>
    </div>
    
    <!-- Carousel Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#dashboardCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#dashboardCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<!-- Dashboard Sections -->
<div class="dashboard-container">
    <!-- Quick Access Panel -->
    <div class="dashboard-panel">
        <h2>Quick Links</h2>
        <ul>
            <li><a href="downloads.php"><i class="fas fa-book"></i> Learning Materials</a></li>
            <li><a href="contact.php"><i class="fas fa-comments"></i> Ask a Question</a></li>
            <li><a href="#"><i class="fas fa-user"></i> Profile Settings</a></li>
        </ul>
    </div>

    <!-- Announcements & Updates -->
    <div class="updates-section">
        <h2>Latest Announcements 📢</h2>
        <marquee behavior="scroll" direction="left">
            🆕 New study materials added! 📚 | ⚠️ Server maintenance on 20th Feb | 🎓 Exam tips available now!
        </marquee>
    </div>

    <!-- Featured Learning Resources -->
    <div class="learning-section">
        <h2>Featured Learning Resources 📖</h2>
        <div class="resources-grid">
            <div class="resource-card">
                <h3>Mathematics Revision</h3>
                <p>Past KCSE papers and answers.</p>
                <a href="#">Download Now</a>
            </div>
            <div class="resource-card">
                <h3>Essay Writing Guide</h3>
                <p>Master academic writing skills.</p>
                <a href="#">Read More</a>
            </div>
            <div class="resource-card">
                <h3>Science Experiments</h3>
                <p>Interactive learning activities.</p>
                <a href="#">Explore</a>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    <p>© 2025 EduLearn. All Rights Reserved.</p>
    <p>Need help? <a href="contact.php">Contact Support</a></p>
    <div class="social-icons">
        <a href="#"><i class="fab fa-facebook"></i></a>
        <a href="https://x.com/BMM159023782511?t=C0Lqg2jHPiFMfwbSOZzwJg&s=09"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
    </div>
</div>

<!-- Link to script.js -->
<script src="script.js"></script>

</body>
</html>
