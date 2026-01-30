<?php
session_start();
require __DIR__ . "/includes/db.php";

class AboutPage {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function isLoggedIn() {
        return isset($_SESSION["user_id"]);
    }

    public function isAdmin() {
        return ($_SESSION["role"] ?? "") === "admin";
    }

    public function getUsername() {
        return $_SESSION["username"] ?? "";
    }

  
}

$page = new AboutPage(null);

 
include __DIR__ . "/includes/header.php";
?>
<link rel="stylesheet" href="CSS/aboutus.css">



    <!--Navbari-->
  <nav class="navbar">
    <div class="logo">ALTA TRAVEL BLOG</div>
    <div class="menu" id="menu">
      <span></span>
      <span></span>
      <span></span>
    </div>
    <ul class="nav-links" id="navLinks">
        <li><a href="index.php" class="active">Home</a></li>
        <li><a href="destinations.php">Destinations</a></li>
        <li><a href="aboutus.php">About Us</a></li>
        <li><a href="contact.php">Contact Us</a></li>

        <?php if ($page->isLoggedIn()): ?>
            <?php if ($page->isAdmin()): ?>
                <li><a href="dashboard.php">Dashboard</a></li>
            <?php endif; ?>
            <li>
                <a href="logout.php">
                    Logout (<?= htmlspecialchars($page->getUsername()) ?>)
                </a>
            </li>
        <?php else: ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="signup.php">Sign Up</a></li>
        <?php endif; ?>
    </ul>
</nav>
 
   <!--imazh-->
   <div class="container">
    <img src="./images/aboutus/photo.jpeg" alt="">
   <h1>Get To Know <br> Alta Travel Blog</h1>
   <p>We plan journeys that feel effortless,personal and unforgettable.</p>
   </div>

  <!--Who are we-->
 <section class="who">
  <div class="who-inner">
   
    <div class="who-content">
      <h2>Who We Are</h2>
      <p class="whop">
        We believe that every journey holds a story worth telling. <br>
       From weekend escapes to cross-continent adventures, we share real experiences, honest insights, <br>
       and inspiring moments from around the world.
      </p>
      <p class="whop">
        Created by passionate travelers, our blog brings together cultural discoveries, <br>
       hidden gems, practical guides, and stories that make every trip unforgettable.
      </p>
    </div>

    <div class="who-photo">
     
      <img src="./images/aboutus/photo1.avif" alt="Team photo">
    </div>
  </div>
</section>


<!--Mission-->
<section class="mission">
<h3>Our Mission</h3>

<div class="mission-cards">
<div class="mission-card">
<div class="icon">✈️</div>
<h4>Authentic Stories</h4>
<p>Every article is based on real travel experiences — no stock descriptions,<br>only genuine moments that inspire your next adventure.</p>
</div>

<div class="mission-card">
<div class="icon">🌍</div>
<h4>Practical Travel Guides</h4>
  <p>We create easy-to-follow guides, itineraries, tips, and destination breakdowns <br>to help you plan smarter and travel better.</p>
</div>

<div class="mission-card">
<div class="icon">🛡️</div>
<h4>Community & Connection</h4>
<p>Our goal is to build a global travel community where explorers share ideas,<br>support each other, and discover new perspectives.</p>
</section>
<hr>

<!--  What we offer-->
<section class="offer-section">
<h2>What You’ll Find on Our Blog</h2>

<div class="offer-cards">
<div class="offer-card">
<h3>Travel Guides</h3>
<p>Detailed itineraries, city highlights, and tips from real wandering experiences.</p>
</div>

<div class="offer-card">
<h3>Hidden Gems</h3>
<p>Secret locations, breathtaking views, and places most tourists never see.</p>
</div>

<div class="offer-card">
<h3>Budget Tips</h3>
<p>Smart ways to save money while still enjoying every moment of your trip.</p>
</div>

<div class="offer-card">
<h3>Food & Culture</h3>
<p>Authentic dishes, traditions, and cultural discoveries from every destination.</p>
</div>
</div>
</section>
<!-- Meet the team-->
<section class="team-section">
<h2>Meet the Team</h2>

<div class="team-cards">
<div class="team-card">
<img src="./images/aboutus/team1.jpg" alt="ana">
<h3>Ana – Founder & Writer</h3>
<p>
A passionate traveler and storyteller who brings destinations to life
through real experiences and inspirational narratives.
</p>
</div>

<div class="team-card">
<img src="./images/aboutus/team2.avif" alt="Ryan">
<h3>Ryan – Travel Photographer</h3>
<p>
Captures the beauty of every journey with a unique perspective, turning
moments into lasting memories.
</p>
</div>

<div class="team-card">
<img src="./images/aboutus/team3.avif" alt="eva">
<h3>Eva – Adventure Researcher</h3>
<p>
The mind behind our adventure guides, always exploring new destinations
and hidden gems around the world.
</p>
</div>
</div>
</section>

<!-- Why follow our journey -->
<section class="why-section">
<h2>Why Follow Our Journey?</h2>

<div class="why-cards">
<div class="why-card">
<h3>Real Experiences</h3>
<p>
Our blog is built on true stories, honest tips, and authentic moments that help
you explore the world with confidence.
</p>
</div>

<div class="why-card">
<h3>Travel Inspiration</h3>
<p>
Whether you're planning your next trip or dreaming about distant places,
we provide ideas that spark curiosity and adventure.
</p>
</div>

<div class="why-card">
<h3>Useful Knowledge</h3>
<p>
From budget travel tips to cultural insights and detailed guides,
we share everything you need for a better journey.
</p>
</div>
</div>
</section>
<script src="javascript/aboutus.js"></script>
    <?php
include __DIR__ . "/includes/footer.php";
?>

