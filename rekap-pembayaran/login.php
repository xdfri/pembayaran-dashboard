<?php
require 'includes/db.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        // Query untuk mengambil data pengguna berdasarkan username
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifikasi password
        if ($user && password_verify($password, $user['password'])) {
            // Set session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect ke dashboard
            header('Location: index.php');
            exit();
        } else {
            $error = "Username atau password salah.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    </head>
<body class="flex items-center justify-center h-screen bg-gray-200">
<div class="w-full max-w-sm">
    <h1 class="text-2xl font-bold mb-6 text-center">Login</h1>
    <?php if (!empty($error)): ?>
        <div class="bg-red-500 text-white p-3 rounded mb-4"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form action="login.php" method="post" class="bg-white p-6 rounded-lg shadow-md">
        <div class="mb-4">
            <label class="block text-gray-700">Username</label>
            <input type="text" name="username" class="border px-4 py-2 w-full" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Password</label>
            <input type="password" name="password" class="border px-4 py-2 w-full" required>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Login</button>
    </form>
</div>
</body>
</html>
