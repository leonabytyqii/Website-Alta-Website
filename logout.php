<?php
session_start();

class LogoutHandler {
    public function logout() {
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit;
    }
}

$logout = new LogoutHandler();
$logout->logout();
