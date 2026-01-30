<?php
session_start();

$currentPage = 'contact.php';
require __DIR__ . "/includes/db.php";


class ContactHandler {

    private $conn;
    public $error = "";
    public $success = "";

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function handleMessage() {

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            return;
        }

        $name    = trim($_POST["name"] ?? "");
        $email   = trim($_POST["email"] ?? "");
        $message = trim($_POST["message"] ?? "");

        if ($name === "" || $email === "" || $message === "") {
            $this->error = "All fields are required.";
            return;
        }

        $stmt = $this->conn->prepare(
            "INSERT INTO contact_messages (name, email, message)
             VALUES (?, ?, ?)"
        );

        if (!$stmt) {
            $this->error = "Database error.";
            return;
        }

        $stmt->bind_param("sss", $name, $email, $message);

        if ($stmt->execute()) {
            $this->success = "Message sent successfully!";
        } else {
            $this->error = "Something went wrong. Please try again.";
        }
    }
}

$contact = new ContactHandler($conn);
$contact->handleMessage();

include __DIR__ . "/includes/header.php";
?>



<!--contactus-->
<div class="contact-container">
    <h1>Contact Us</h1>

    <?php if ($contact->error): ?>
        <p class="error"><?= htmlspecialchars($contact->error) ?></p>
    <?php endif; ?>

    <?php if ($contact->success): ?>
        <p class="success"><?= htmlspecialchars($contact->success) ?></p>
    <?php endif; ?>

    <form method="POST" class="contact-form">

        <label>Name</label>
        <input type="text" name="name" placeholder="Your name">

        <label>Email</label>
        <input type="email" name="email" placeholder="Your email">

        <label>Message</label>
        <textarea name="message" placeholder="Your message"></textarea>

        <button type="submit">Send Message</button>
    </form>
</div>

<script src="javascript/dashboard.js"></script>

<?php include __DIR__ . "/includes/footer.php"; ?>
