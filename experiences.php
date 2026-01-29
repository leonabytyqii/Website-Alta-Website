<?php
session_start();
require __DIR__ . "/includes/db.php";

$query = "
    SELECT experiences.*, users.username
    FROM experiences
    JOIN users ON experiences.user_id = users.id
    ORDER BY experiences.created_at DESC
";

$result = $conn->query($query);
?>

<?php include __DIR__ . "/includes/header.php"; ?>
<link rel="stylesheet" href="CSS/experiences.css">


<!-- NAVBAR -->
<nav class="navbar">
    <div class="logo">ALTA TRAVEL BLOG</div>
     <div class="menu" id="menu">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <ul class="nav-links" id="navLinks">
        <li><a href="index.php">Home</a></li>
        <li><a href="destinations.php">Destinations</a></li>
        <li><a href="aboutus.php">About Us</a></li>
        <li><a href="experiences.php" class="active">Experiences</a></li>
        <li><a href="contact.php">Contact Us</a></li>
       
        <?php if (isset($_SESSION["user_id"])): ?>
            <?php if ($_SESSION["role"] === "admin"): ?>
                <li><a href="dashboard.php">Dashboard</a></li>
            <?php endif; ?>
            <li><a href="logout.php">Logout (<?= htmlspecialchars($_SESSION["username"]) ?>)</a></li>
        <?php else: ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="signup.php">Sign Up</a></li>
        <?php endif; ?>
    </ul>
</nav>

<!-- EXPERIENCES -->
<div class="experiences-container">
    <h1>User Experiences <span>🌍</span></h1>

    <?php if ($result->num_rows === 0): ?>
        <p class="no-experiences">No experiences shared yet.</p>
    <?php else: ?>
        <div class="experiences-grid">
            <?php while ($exp = $result->fetch_assoc()): ?>
                <div class="experience-card">
                    <?php if (!empty($exp["image"])): ?>
                        <img src="<?= htmlspecialchars($exp["image"]) ?>" alt="Experience image">
                    <?php endif; ?>

                    <div class="experience-content">
                        <h3><?= htmlspecialchars($exp["title"]) ?></h3>
                        <p><?= nl2br(htmlspecialchars($exp["description"])) ?></p>

                        <div class="experience-meta">
                            <span>👤 <?= htmlspecialchars($exp["username"]) ?></span>
                            <span>📅 <?= date("d M Y", strtotime($exp["created_at"])) ?></span>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . "/includes/footer.php"; ?>
