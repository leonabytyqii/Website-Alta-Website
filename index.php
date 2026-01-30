<?php
session_start();


class IndexPage {

    public function isLoggedIn() {
        return isset($_SESSION["user_id"]);
    }

    public function isAdmin() {
        return isset($_SESSION["role"]) && $_SESSION["role"] === "admin";
    }

    public function getUsername() {
        return $_SESSION["username"] ?? "";
    }
}

$page = new IndexPage();
$currentPage = 'index.php';

include __DIR__ . "/includes/header.php";
?>





<!--Carousel-->
<div class="slideshow-container">
    <div class="mySlides">
        <img src="images/img1.webp" alt="Image 1">
        <div class="text">
            <h1>Your Next Adventure <br> Starts Here!</h1>
            <p id="p1"><i>The journey of your dreams is closer than it seems!</i></p>
        </div>
    </div>

    <div class="mySlides">
        <img src="images/carousel22.webp" alt="Image 2" style="width:100%">
    </div>

    <div class="mySlides">
        <img src="images/img3.png" alt="Image 3" style="width:100%">
    </div>

    <button class="carousel-control prev" id="prevBtn" onclick="plusSlides(-1)">&lt;</button>
    <button class="carousel-control next" id="nextBtn" onclick="plusSlides(1)">&gt;</button>
</div>

<br>

<!--Top destinations-->
<section class="top-destinations">
    <h2>Top destinations</h2>
    <div class="destinations-container">

        <div class="destination-card">
            <img src="images/maltta.jpg" alt="">
            <div class="text-card"><h3>Valetta,Malta</h3></div>
        </div>

        <div class="destination-card">
            <img src="images/roma.png" alt="">
            <div class="text-card"><h3>Rome,Italy</h3></div>
        </div>

        <div class="destination-card">
            <img src="images/berni.png" alt="">
            <div class="text-card"><h3>Bern,Switzerland</h3></div>
        </div>

        <div class="destination-card">
            <img src="images/amsterdami.png" alt="">
            <div class="text-card"><h3>Amsterdam,The Netherlands</h3></div>
        </div>

        <div class="destination-card">
            <img src="images/sweden.png" alt="">
            <div class="text-card"><h3>Stockholm,Sweden</h3></div>
        </div>

        <div class="destination-card">
            <img src="images/osloo.png" alt="">
            <div class="text-card"><h3>Oslo,Norway</h3></div>
        </div>

    </div>

    <div class="destinationwrap">
        <a href="destinations.php" class="btn-discover">Discover more</a>
    </div>
</section>

<!--Companies-->
<section class="companies">
  <div class="companies-container">

    <div class="company-logo"><img src="images/travelocity.png" alt=""></div>
    <div class="company-logo"><img src="images/expedia.png" alt=""></div>
    <div class="company-logo"><img src="images/booking.png" alt=""></div>
    <div class="company-logo"><img src="images/kayak.png" alt=""></div>
    <div class="company-logo"><img src="images/agoda.png" alt=""></div>
    <div class="company-logo"><img src="images/skyscanner.png" alt=""></div>
    <div class="company-logo"><img src="images/priceline.png" alt=""></div>

    <div class="company-logo"><img src="images/travelocity.png" alt=""></div>
    <div class="company-logo"><img src="images/expedia.png" alt=""></div>
    <div class="company-logo"><img src="images/booking.png" alt=""></div>
    <div class="company-logo"><img src="images/kayak.png" alt=""></div>
    <div class="company-logo"><img src="images/agoda.png" alt=""></div>
    <div class="company-logo"><img src="images/skyscanner.png" alt=""></div>
    <div class="company-logo"><img src="images/priceline.png" alt=""></div>

  </div>
</section>

<!--Why us?-->
<section>
<div class="why-us">
<h2>Why choose Alta Travel Blog?</h2>
<div class="why-us-content">
<div class="why-us-text">
<ul>
<li><b>1. Inspiring destinations:</b> We don’t book trips. We simply help you discover places that spark your curiosity and give you ideas for your next journey.</li><br>
<li><b>2. Real stories, real places:</b> Everything we share comes from genuine experiences. Not ads. Not clichés. Just honest impressions from around the world.</li><br>
<li><b>3. Ideas for every mood:</b> Whether you want calm beaches, lively cities or quiet nature spots, our blog gives you inspiration that fits your travel style.</li><br>
<li><b>4. A space to dream:</b> Every trip starts with a thought. Here, you can explore freely, get inspired and imagine where you want to go next.</li>
</ul>
<br>
<p>Choose Alta Travel Blog for your next adventure and let us turn your travel dreams into reality!</p>
</div>
<div class="video-container">
<a href="https://www.youtube.com/watch?v=cu-nceNFuYU">
<img src="images/videoframe.png" alt="">
</a>
</div>
</div>
</div>
</section>
<script src="/website-alta-website-1/javascript/index.js"></script>
<?php
include __DIR__ . "/includes/footer.php";
?>


