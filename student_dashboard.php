<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php?error=Please login first.");
    exit;
}

if ($_SESSION["role"] !== "student") {
    http_response_code(403);
    die("<h2 style='color:red; text-align:center; margin-top:50px;'>403 Forbidden: Students only.</h2>");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Portal - StudentHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="student_dashboard.php">StudentHub (Student)</a>
        <div class="navbar-nav ms-auto">
            <span class="nav-item nav-link active me-3">Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?></span>
            <a class="btn btn-outline-light btn-sm" href="logout.php">Logout</a>
        </div>
    </div>
</nav>

<div class="container py-4">
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <h3>Student Dashboard</h3>
            <p class="text-muted">Welcome to your personal academic portal. You have access to registered courses, schedules, and college events.</p>
            <div class="badge bg-info text-dark">Role: Student</div>
            <div class="badge bg-secondary"><?php echo htmlspecialchars($_SESSION["email"]); ?></div>
        </div>
    </div>
</div>

</body>
</html>