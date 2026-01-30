<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Alta Travel Blog</title>

<link rel="stylesheet" href="/website-alta-website-1/CSS/global.css">

<?php if ($currentPage == 'index.php'): ?>
<link rel="stylesheet" href="/website-alta-website-1/CSS/index.css">
<?php elseif ($currentPage == 'destinations.php'): ?>
<link rel="stylesheet" href="/website-alta-website-1/CSS/destinations.css">
<?php elseif ($currentPage == 'experiences.php'): ?>
<link rel="stylesheet" href="/website-alta-website-1/CSS/experiences.css">
<?php elseif ($currentPage == 'aboutus.php'): ?>
<link rel="stylesheet" href="/website-alta-website-1/CSS/aboutus.css">
<?php elseif ($currentPage == 'contact.php'): ?>
<link rel="stylesheet" href="/website-alta-website-1/CSS/contact.css">
<?php elseif ($currentPage == 'dashboard.php'): ?>
<link rel="stylesheet" href="/website-alta-website-1/CSS/dashboard.css">
<?php endif; ?>


<body>

<nav class="navbar">
    <div class="logo">ALTA TRAVEL BLOG</div>

    <div class="menu" id="menu">
        <span></span><span></span><span></span>
    </div>

    <ul class="nav-links" id="navLinks">
        <li><a href="index.php" class="<?= $currentPage == 'index.php' ? 'active' : '' ?>">Home</a></li>
        <li><a href="destinations.php" class="<?= $currentPage == 'destinations.php' ? 'active' : '' ?>">Destinations</a></li>
        <li><a href="aboutus.php" class="<?= $currentPage == 'aboutus.php' ? 'active' : '' ?>">About Us</a></li>
        <li><a href="experiences.php" class="<?= $currentPage == 'experiences.php' ? 'active' : '' ?>">Experiences</a></li>
        <li><a href="contact.php" class="<?= $currentPage == 'contact.php' ? 'active' : '' ?>">Contact</a></li>

        <?php if (isset($_SESSION["user_id"])): ?>
            <?php if ($_SESSION["role"] === "admin"): ?>
                <li><a href="dashboard.php" class="<?= $currentPage == 'dashboard.php' ? 'active' : '' ?>">Dashboard</a></li>
            <?php endif; ?>
            <li><a href="logout.php" >Logout (<?= htmlspecialchars($_SESSION["username"]) ?>)</a></li>
        <?php else: ?>
            <li><a href="login.php" class="<?= $currentPage == 'login.php' ? 'active' : '' ?>">Login</a></li>
            <li><a href="signup.php" class="<?= $currentPage == 'signup.php' ? 'active' : '' ?>">Sign Up</a></li>
        <?php endif; ?>
    </ul>
</nav>
