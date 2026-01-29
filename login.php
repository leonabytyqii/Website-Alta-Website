<?php
session_start();
require __DIR__ . "/includes/db.php";


class LoginHandler {

    private $conn;
    public $error = "";

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function handleLogin() {

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            return;
        }

        $username = trim($_POST["username"] ?? "");
        $password = $_POST["password"] ?? "";

        if ($username === "" || $password === "") {
            $this->error = "Please fill in all fields.";
            return;
        }

        $stmt = $this->conn->prepare(
            "SELECT id, username, password, role FROM users WHERE username = ?"
        );

        if (!$stmt) {
            $this->error = "Database error.";
            return;
        }

        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows !== 1) {
            $this->error = "Wrong username or password.";
            return;
        }

        $user = $result->fetch_assoc();

        if (!password_verify($password, $user["password"])) {
            $this->error = "Wrong username or password.";
            return;
        }

        
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["role"] = $user["role"];

        header("Location: index.php");
        exit;
    }
}


$login = new LoginHandler($conn);
$login->handleLogin();

include __DIR__ . "/includes/header.php";
?>

<link rel="stylesheet" href="/website-alta-website-1/CSS/signup.css">

<!--navbari-->
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
        <li><a href="#" id="openContact">Contact Us</a></li>
        <li><a href="login.php" class="active">Log In</a></li>
    </ul>
</nav>

<!--login form-->
<div class="login-container">
    <h1 class="title">TRAVEL BLOG</h1>

    <div class="login-box">
        <h2>Log In</h2>

        <?php if ($login->error): ?>
            <p style="color:red"><?= htmlspecialchars($login->error) ?></p>
        <?php endif; ?>

        <form method="POST" action="login.php" id="loginForm">

            <label>Username</label>
            <input type="text" name="username" placeholder="Enter username" id="username">
            <span class="error" id="userError"></span>

            <label>Password</label>
            <input type="password" name="password" placeholder="Enter password" id="password">
            <span class="error" id="passError"></span>

            <button type="submit" class="btn">Log In</button>

            <p class="signup">
                Don't have an account?
                <a href="signup.php">Sign Up</a>
            </p>

        </form>
    </div>
</div>

<?php include __DIR__ . "/includes/footer.php"; ?>
