<?php
session_start();
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: login.php");
    exit;
}

$email = trim($_POST["email"] ?? "");
$password = $_POST["password"] ?? "";

if ($email === "" || $password === "") {
    header("Location: login.php?error=All fields are required.");
    exit;
}

$stmt = $conn->prepare("SELECT id, username, email, password, role FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    header("Location: login.php?error=Invalid email or password.");
    exit;
}

$user = $result->fetch_assoc();

if (!password_verify($password, $user["password"])) {
    header("Location: login.php?error=Invalid email or password.");
    exit;
}

// Regenerate Session ID to mitigate session fixation
session_regenerate_id(true);

$_SESSION["user_id"] = $user["id"];
$_SESSION["username"] = $user["username"];
$_SESSION["email"] = $user["email"];
$_SESSION["role"] = $user["role"];
$_SESSION["last_activity"] = time();

// Log to audit table
$actionText = "User logged in: " . $user["role"];
$logStmt = $conn->prepare("INSERT INTO audit_logs (user_id, action) VALUES (?, ?)");
$logStmt->bind_param("is", $user["id"], $actionText);
$logStmt->execute();

$stmt->close();
$conn->close();

if ($user["role"] === "admin") {
    header("Location: admin_dashboard.php");
} else {
    header("Location: student_dashboard.php");
}
exit;
?>