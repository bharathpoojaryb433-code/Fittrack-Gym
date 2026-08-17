<?php

require_once '../config/config.php';
require_once '../config/json.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.php");
    exit;
}

$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

$users = readJson('users.json');

$foundUser = null;

foreach ($users as $user) {

    if (
        strtolower($user['email']) === strtolower($email) &&
        $user['password'] === $password
    ) {
        $foundUser = $user;
        break;
    }
}

if (!$foundUser) {

    $_SESSION['login_error'] = "Invalid email or password.";

    header("Location: ../index.php");
    exit;
}

$_SESSION['user'] = $foundUser;

if ($foundUser['role'] === 'owner') {

    header("Location: ../owner/dashboard.php");

} else {

    header("Location: ../member/dashboard.php");

}

exit;