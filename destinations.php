<?php
session_start();


class DestinationsPage {
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

$page = new DestinationsPage(null);


include __DIR__ . "/includes/header.php";
?>

<link rel="stylesheet" href="CSS/destinations.css">

    <!--navbari-->
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
<!--discovermore-->
 <section class="discovermore">
        <div class="discovermore1">
            <h1>Discover More <br> Destinations</h1>
            <p>Explore even more cities and unique places around the world with ALTA Travel Blog.</p>
        </div>

        <img src="./images/greecediscovermore.webp"  class="discover-img">
    </section>

    <!-- Destinations List -->
    <section class="destinations-container">

        <div class="destination-card" onmouseover="ndryshoLondon()" onmouseout="ktheLondon()">
            <img src="./images/london.avif" id="foto" >
            <div class="destination-info"  >
                <h3>London, United Kingdom</h3>
                <p>Historic sights and modern city life.</p>
                <p class="price">From €599</p>
            </div>
        </div>
        <div class="destination-card"onmouseover="ndryshoBarcelona()" onmouseout="ktheBarcelona()">
            <img src="./images/barcelona.avif" id="foto1">
            <div class="destination-info">
                <h3>Barcelona,Spain</h3>
                <p>A vibrant mix of beaches, art and Mediterranean sunshine.</p>
                <p class="price">From €499</p>
            </div>
        </div>

        <div class="destination-card" onmouseover="ndryshoQipro()" onmouseout="ktheQipro()">
            <img src="./images/Qipro.webp" id="foto2">
            <div class="destination-info">
                <h3>Nicosia,Cyprus</h3>
                <p>A perfect blend of history and nature.</p>
                <p class="price">From €399</p>
            </div>
        </div>

        <div class="destination-card" onmouseover="ndryshoKroacia()" onmouseout="ktheKroacia()">
            <img src="./images/kroaciaa.jpg" id="foto3">
            <div class="destination-info">
                <h3>Zagreb,Croacia</h3>
                <p>A place of culture, cafes and cobblestone streets.</p>
                <p class="price">From €549</p>
            </div>
        </div>

        <div class="destination-card" onmouseover="ndryshoLisbon()" onmouseout="ktheLisbon()">
            <img src="./images/lisbon.jpg" id="foto4">
            <div class="destination-info">
                <h3>Lisbon,Portugal</h3>
                <p>A city of sunshine, colors and ocean breeze.</p>
                <p class="price">From €699</p>
            </div>
        </div>

        <div class="destination-card" onmouseover="ndryshoVienna()" onmouseout="ktheVienna()">
            <img src="./images/Vienna.jpg" id="foto5">
            <div class="destination-info">
                <h3>Vienna,Austria</h3>
                <p>Elegant streets, classical music and timeless beauty.</p>
                <p class="price">From €589</p>
            </div>
        </div>

        <div class="destination-card" onmouseover="ndryshoBudapest()"onmouseout="ktheBudapest()">
            <img src="./images/Budapest.jpg" id="foto6">
            <div class="destination-info">
                <h3>Budapest,Hungary</h3>
                <p>The pearl of the Danube, glowing magically by night.</p>
                <p class="price">From €389</p>
            </div>
        </div>

        <div class="destination-card" onmouseover="ndryshoRiga()" onmouseout="ktheRiga()">
            <img src="./images/riga.jpg" id="foto7">
            <div class="destination-info">
                <h3>Riga,Latvia</h3>
                <p>Art-nouveau charm and cozy Baltic atmosphere.</p>
                <p class="price">From €500</p>
            </div>
        </div>
       <div class="destination-card" onmouseover="ndryshoTallin()" onmouseout="ktheTallin()" >
            <img src="./images/tallin.avif" id="foto8">
            <div class="destination-info">
                <h3>Tallinn,Estonia</h3>
                <p>Medieval streets mixed with futuristic tech vibes.</p>
                <p class="price">From €450</p>
            </div>
        </div>
       <div class="destination-card" onmouseover="ndryshoReykjavik()" onmouseout="ktheReykjavik()">
            <img src="./images/reykjavik.webp" id="foto9">
            <div class="destination-info">
                <h3>Reykjavik,Iceland</h3>
                <p>Where nature, magic and northern lights meet.</p>
                <p class="price">From €499</p>
            </div>
        </div>

        <div class="destination-card" onmouseover="ndryshoRoma()" onmouseout="ktheRoma()">
            <img src="./images/romafountain.webp" id="foto10">
            <div class="destination-info">
                <h3>Rome,Italy</h3>
                <p>A city of ancient wonders and unforgettable flavors.</p>
                <p class="price">From €550</p>
            </div>
        </div>
       <div class="destination-card" onmouseover="ndryshoFinland()" onmouseout="ktheFinland()">
            <img src="./images/finland.webp" id="foto11">
            <div class="destination-info">
                <h3>Helsinki,Finland</h3>
                <p>Bright, clean and beautifully Scandinavian.</p>
                <p class="price">From €489</p>
            </div>
        </div>

 
    </section>

    <script src="javascript/destinations.js"></script>
    <?php
include __DIR__ . "/includes/footer.php";
?>

   