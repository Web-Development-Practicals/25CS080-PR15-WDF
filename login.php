<?php
session_start();
if (isset($_SESSION["user_id"])) {
    header("Location: " . ($_SESSION["role"] === "admin" ? "admin_dashboard.php" : "student_dashboard.php"));
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>StudentHub - Secure Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center" style="min-height: 100vh;">

<div class="container" style="max-width: 420px;">
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <h3 class="card-title text-center fw-bold mb-4">StudentHub Login</h3>

            <?php if (isset($_GET["error"])): ?>
                <div class="alert alert-danger py-2"><?php echo htmlspecialchars($_GET["error"]); ?></div>
            <?php endif; ?>
            <?php if (isset($_GET["message"])): ?>
                <div class="alert alert-success py-2"><?php echo htmlspecialchars($_GET["message"]); ?></div>
            <?php endif; ?>

            <form action="authenticate.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control" required placeholder="name@charusat.edu.in">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required placeholder="••••••••">
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-2">Sign In</button>
            </form>
            <div class="text-center mt-3">
                <a href="index.php" class="text-decoration-none small text-muted">← Back to Home</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>