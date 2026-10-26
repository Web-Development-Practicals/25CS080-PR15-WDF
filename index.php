<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>StudentHub - University Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">StudentHub</a>
        <div class="navbar-nav ms-auto">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a class="nav-link btn btn-outline-light btn-sm px-3 me-2" href="<?php echo ($_SESSION['role'] === 'admin') ? 'admin_dashboard.php' : 'student_dashboard.php'; ?>">Dashboard</a>
                <a class="nav-link btn btn-danger btn-sm text-white px-3" href="logout.php">Logout</a>
            <?php else: ?>
                <a class="nav-link btn btn-primary btn-sm text-white px-3 me-2" href="login.php">Login</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container py-5 text-center">
    <h1 class="display-5 fw-bold text-dark">Welcome to StudentHub Portal</h1>
    <p class="lead text-secondary mt-3">The unified academic and event management portal of CHARUSAT FTE.</p>
    
    <div class="row g-4 mt-4 justify-content-center">
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h4 class="card-title text-primary">Student Access</h4>
                    <p class="card-text text-muted">Access enrolled courses, academic updates, and participate in campus events.</p>
                    <a href="login.php" class="btn btn-outline-primary">Student Login</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h4 class="card-title text-success">Admin Control</h4>
                    <p class="card-text text-muted">Monitor real-time system metrics, manage registrations, and review audit logs.</p>
                    <a href="login.php" class="btn btn-outline-success">Admin Portal</a>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="text-center text-muted py-4 border-top">
    <p class="mb-0">ITUE203 - Web Development Frameworks | Practical 15 Integration</p>
</footer>

</body>
</html>