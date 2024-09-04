<?php
session_start();

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function login($username, $password) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM pengguna WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        return true;
    }
    return false;
}

function logout() {
    session_unset();
    session_destroy();
}


?>
