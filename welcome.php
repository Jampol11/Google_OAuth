<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Welcome</title></head>
<body>
<h2>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h2>
<p>Email: <?php echo htmlspecialchars($_SESSION['email']); ?></p>
<a href="logout.php">Logout</a>
</body>
</html>
