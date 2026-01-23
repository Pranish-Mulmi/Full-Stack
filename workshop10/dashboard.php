<?php
require 'db.php';
require 'session.php';

$user_email = '';

if (isset($_SESSION['user_id'])) {
    $stmt = $pdo->prepare("SELECT email FROM users WHERE id = :id");
    $stmt->execute([':id' => $_SESSION['user_id']]);
    $user = $stmt->fetch();

    if ($user) {
        $user_email = htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8');
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body>
<h1>Welcome to my site</h1>
<?php if ($user_email): ?>
    <p>Logged In User: <?= $user_email ?></p>
    <form method="post" action="logout.php">
        <button type="submit">Logout</button>
    </form>
<?php else: ?>
    <a href="login.php"><button>Login</button></a>
<?php endif; ?>
</body>
</html>