<?php
session_start();
require __DIR__ . "/includes/db.php";


class DashboardHandler {

    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function checkAdmin() {
        if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
            header("Location: index.php");
            exit;
        }
    }

    public function getUsers() {
        return $this->conn->query(
            "SELECT id, username, email, role FROM users ORDER BY id DESC"
        );
    }

    public function getMessages() {
        return $this->conn->query(
            "SELECT * FROM contact_messages ORDER BY created_at DESC"
        );
    }
    public function getExperiences() {
    return $this->conn->query(
        "SELECT e.id, e.title, e.image, u.username, e.created_at
         FROM experiences e
         JOIN users u ON e.user_id = u.id
         ORDER BY e.created_at DESC"
    );
}
}


$dashboard = new DashboardHandler($conn);
$dashboard->checkAdmin();

$usersResult   = $dashboard->getUsers();
$messagesResult = $dashboard->getMessages();
$experiencesResult = $dashboard->getExperiences();

include __DIR__ . "/includes/header.php";
?>

<link rel="stylesheet" href="CSS/dashboard.css">

<!-- NAVBAR -->
<nav class="navbar">
    <div class="logo">ALTA TRAVEL BLOG</div>
    <div class="menu" id="menu">
        <span></span><span></span><span></span>
    </div>

    <ul class="nav-links" id="navLinks">
        <li><a href="index.php">Home</a></li>
        <li><a href="destinations.php">Destinations</a></li>
        <li><a href="aboutus.php">About Us</a></li>
        <li><a href="contact.php">Contact Us</a></li>

        <li><a href="dashboard.php" class="active">Dashboard</a></li>
        <li>
            <a href="logout.php">
                Logout (<?= htmlspecialchars($_SESSION["username"]) ?>)
            </a>
        </li>
    </ul>
</nav>

<div class="dashboard-container">
    <h1>Welcome, Admin 👋</h1>

    <div class="cards">

        <!-- USERS -->
        <div class="card">
            <h2>Users</h2>
            <p>Manage registered users</p>

            <div class="tablescroll">
                <table class="dashboard-table">
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>

                    <?php while ($u = $usersResult->fetch_assoc()): ?>
                        <tr>
                            <td><?= $u["id"] ?></td>
                            <td><?= htmlspecialchars($u["username"]) ?></td>
                            <td><?= htmlspecialchars($u["email"]) ?></td>
                            <td><?= $u["role"] ?></td>
                            <td>
                                <?php if ($u["id"] !== $_SESSION["user_id"]): ?>
                                    <a
                                        href="delete_user.php?id=<?= $u['id'] ?>"
                                        class="delete-btn"
                                        onclick="return confirm('Are you sure you want to delete this user?')">
                                        Delete
                                    </a>
                                <?php else: ?>
                                    <span style="color:#999;">You</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
        </div>

        <!-- DESTINATIONS PLACEHOLDER -->
        <div class="card">
            <h2>User Experiences</h2>
            <p>Add / edit user experiences</p>
              <div class="tablescroll">
        <table class="dashboard-table">
            <tr>
                <th>Title</th>
                <th>User</th>
                <th>Date</th>
                <th>Action</th>
            </tr>

            <?php while ($exp = $experiencesResult->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($exp["title"]) ?></td>
                    <td><?= htmlspecialchars($exp["username"]) ?></td>
                    <td><?= $exp["created_at"] ?></td>
                    <td>
                        <a 
                            href="delete_experience.php?id=<?= $exp['id'] ?>"
                            class="delete-btn"
                            onclick="return confirm('Delete this experience?')">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
        </div>

        <!-- CONTACT MESSAGES -->
        <div class="card">
            <h2>📩 Contact Messages</h2>
            <p>View contact messages</p>

            <div class="tablescroll">
                <table class="dashboard-table">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>

                    <?php while ($row = $messagesResult->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row["id"] ?></td>
                            <td><?= htmlspecialchars($row["name"]) ?></td>
                            <td><?= htmlspecialchars($row["email"]) ?></td>
                            <td><?= nl2br(htmlspecialchars($row["message"])) ?></td>
                            <td><?= $row["created_at"] ?></td>
                            <td>
                                <a
                                    href="delete_message.php?id=<?= $row['id'] ?>"
                                    class="delete-btn"
                                    onclick="return confirm('Are you sure you want to delete this message?')">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
        </div>

    </div>
</div>

<?php if (isset($_GET["error"])): ?>
<script>
<?php if ($_GET["error"] === "selfdelete"): ?>
    alert("❌ You cannot delete yourself.");
<?php elseif ($_GET["error"] === "admin_protected"): ?>
    alert("❌ You cannot delete an admin user.");
<?php endif; ?>
</script>
<?php endif; ?>

<script src="javascript/dashboard.js"></script>

<?php include __DIR__ . "/includes/footer.php"; ?>
