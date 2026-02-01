<?php
session_start();
$currentPage = 'signup.php';
require __DIR__ . "/includes/db.php";

class SignupHandler {
    private $conn;
    public $errors = [];

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function registerUser($username, $email, $password, $confirm) {
    if ($username === "") {
    $this->errors["username"] = "Complete this field";
}

if ($email === "") {
    $this->errors["email"] = "Complete this field";
}

if ($password === "") {
    $this->errors["password"] = "Complete this field";
}

if ($confirm === "") {
    $this->errors["confirm"] = "Complete this field";
}

if ($password !== "" && $confirm !== "" && $password !== $confirm) {
    $this->errors["confirm"] = "Passwords do not match.";
}

if (!empty($this->errors)) {
    return false;
}

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $this->conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'user')");
        $stmt->bind_param("sss", $username, $email, $hashedPassword);

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


<div class="login-container">
    <h1 class="title">TRAVEL BLOG</h1>

    <div class="login-box">
        <h2>Sign Up</h2>

      

        <form method="POST" id="signupForm" novalidate>

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

<script src="javascript/signup1.js"></script>

<?php include __DIR__ . "/includes/footer.php"; ?>
