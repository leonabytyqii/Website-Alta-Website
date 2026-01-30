<?php
session_start();
$currentPage = 'signup.php';
require __DIR__ . "/includes/db.php";

class SignupHandler {
    private $conn;
    public $error = "";

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function registerUser($username, $email, $password, $confirm) {

        if ($username === "" || $email === "" || $password === "" || $confirm === "") {
            $this->error = "All fields are required.";
            return false;
        }

        if ($password !== $confirm) {
            $this->error = "Passwords do not match.";
            return false;
        }

        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $role = "user";

        $stmt = $this->conn->prepare(
            "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)"
        );

        if (!$stmt) {
            $this->error = "Database error.";
            return false;
        }

        $stmt->bind_param("ssss", $username, $email, $hashed, $role);

       try {
    if ($stmt->execute()) {
        return true;
    }
} catch (mysqli_sql_exception $e) {
    if ($e->getCode() == 1062) {
        $this->error = "Email already exists.";
    } else {
        $this->error = "Database error.";
    }
    return false;
}

    }
}

$signup = new SignupHandler($conn);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = trim($_POST["password"] ?? "");
    $confirm = trim($_POST["confirm"] ?? "");

    if ($signup->registerUser($username, $email, $password, $confirm)) {
        header("Location: login.php?registered=1");
        exit;
    }
}

include __DIR__ . "/includes/header.php";
?>

<link rel="stylesheet" href="CSS/signup.css">

<div class="login-container">
    <h1 class="title">TRAVEL BLOG</h1>

    <div class="login-box">
        <h2>Sign Up</h2>

        <?php if ($signup->error): ?>
            <p class="error"><?= htmlspecialchars($signup->error) ?></p>
        <?php endif; ?>

        <form method="POST" id="signupForm">

            <label>Username</label>
            <input type="text" id="username" name="username">
            <span id="userError" class="error"></span>

            <label>Email</label>
            <input type="email" id="email" name="email">
            <span id="emailError" class="error"></span>

            <label>Password</label>
            <input type="password" id="password" name="password">
            <span id="passError" class="error"></span>

            <label>Confirm Password</label>
            <input type="password" id="confirm" name="confirm">
            <span id="confirmError" class="error"></span>

            <button type="submit" class="btn">Create Account</button>

            <p class="signup">
                Already have an account?
                <a href="login.php">Log In</a>
            </p>
        </form>
    </div>
</div>

<script src="javascript/signup.js"></script>

<?php include __DIR__ . "/includes/footer.php"; ?>
