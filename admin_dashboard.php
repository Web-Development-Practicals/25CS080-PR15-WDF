<?php
session_start();
require_once "db.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php?error=Please login first.");
    exit;
}

if ($_SESSION["role"] !== "admin") {
    http_response_code(403);
    die("<h2 style='color:red; text-align:center; margin-top:50px;'>403 Forbidden: Admins only.</h2>");
}

// Dynamic queries
$totalUsers = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];
$totalStudents = $conn->query("SELECT COUNT(*) AS total FROM users WHERE role = 'student'")->fetch_assoc()['total'];
$totalEvents = $conn->query("SELECT COUNT(*) AS total FROM events")->fetch_assoc()['total'];
$latestUsers = $conn->query("SELECT username, email, role, created_at FROM users ORDER BY created_at DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - StudentHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="admin_dashboard.php">StudentHub Admin</a>
        <div class="navbar-nav ms-auto align-items-center">
            <span class="text-white me-3">Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?></span>
            <a class="btn btn-danger btn-sm" href="logout.php">Logout</a>
        </div>
    </div>
</nav>

<div class="container py-4">
    <h2 class="mb-4">System Overview</h2>

    <!-- Dynamic Metric Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white shadow-sm border-0">
                <div class="card-body">
                    <h5>Total Users</h5>
                    <h2 class="fw-bold"><?php echo $totalUsers; ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white shadow-sm border-0">
                <div class="card-body">
                    <h5>Total Students</h5>
                    <h2 class="fw-bold"><?php echo $totalStudents; ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-info text-white shadow-sm border-0">
                <div class="card-body">
                    <h5>Total Events</h5>
                    <h2 class="fw-bold"><?php echo $totalEvents; ?></h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Registrations -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white fw-bold">Recent Registrations</div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Date Registered</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $latestUsers->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><span class="badge bg-secondary"><?php echo htmlspecialchars($row['role']); ?></span></td>
                        <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>