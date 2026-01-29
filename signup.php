<?php
session_start();
require __DIR__ . "/includes/db.php";

/**
 * OOP KLASA PËR SIGNUP
 */
class SignupHandler {

    private $conn;
    public $error = "";
    public $success = "";

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function handleSignup() {

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            return;
        }

        $username = trim($_POST["username"] ?? "");
        $email    = trim($_POST["email"] ?? "");
        $password = $_POST["password"] ?? "";
        $confirm  = $_POST["confirm"] ?? "";

        if ($username === "" || $email === "" || $password === "" || $confirm === "") {
            $this->error = "All fields are required.";
            return;
        }

        if ($password !== $confirm) {
            $this->error = "Passwords do not match.";
            return;
        }

        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $role   = "user";

        $stmt = $this->conn->prepare(
            "INSERT INTO users (username, email, password, role)
             VALUES (?, ?, ?, ?)"
        );

        if (!$stmt) {
            $this->error = "Database error.";
            return;
        }

        $stmt->bind_param("ssss", $username, $email, $hashed, $role);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        }

        // handle duplicate email / username
        if ($this->conn->errno === 1062) {
            $this->error = "Email already exists.";
        } else {
            $this->error = "Something went wrong. Please try again.";
        }
    }
}

/**
 * KRIJO OBJECT + THIRR SIGNUP
 */
$signup = new SignupHandler($conn);
$signup->handleSignup();

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
        <li><a href="contact.php">Contact Us</a></li>

        <?php if (isset($_SESSION["user_id"])): ?>
            <?php if ($_SESSION["role"] === "admin"): ?>
                <li><a href="dashboard.php">Dashboard</a></li>
            <?php endif; ?>
            <li>
                <a href="logout.php">
                    Logout (<?= htmlspecialchars($_SESSION["username"]) ?>)
                </a>
            </li>
        <?php else: ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="signup.php" class="active">Sign Up</a></li>
        <?php endif; ?>
    </ul>
</nav>

<!--signup-->
<div class="login-container">
    <h1 class="title">TRAVEL BLOG</h1>

    <div class="login-box">
        <h2>Sign Up</h2>

        <?php if ($signup->error): ?>
            <p style="color:red"><?= htmlspecialchars($signup->error) ?></p>
        <?php endif; ?>

        <form action="signup.php" method="POST">

            <label>Username</label>
            <input type="text" id="username" name="username" placeholder="Enter username">

            <label>Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email">

            <label>Password</label>
            <input type="password" id="password" name="password" placeholder="Create a password">

            <label>Confirm Password</label>
            <input type="password" id="confirm" name="confirm" placeholder="Confirm password">

            <button type="submit" class="btn">Create Account</button>

            <p class="signup">
                Already have an account?
                <a href="login.php">Log In</a>
            </p>
        </form>
    </div>
</div>

<?php include __DIR__ . "/includes/footer.php"; ?>
