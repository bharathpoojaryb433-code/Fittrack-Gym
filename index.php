<?php

require_once 'config/config.php';
require_once 'config/json.php';

if (isset($_SESSION['user'])) {

    if ($_SESSION['user']['role'] === 'owner') {
        header("Location: owner/dashboard.php");
    } else {
        header("Location: member/dashboard.php");
    }

    exit;
}

$error = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>FITTRACK GYM</title>

    <link rel="stylesheet"
          href="css/style.css">

    <link rel="stylesheet"
          href="css/login.css">

</head>

<body>

<div class="login-container">

    <div class="login-brand">

        <div class="brand-logo">
            FIT<span>TRACK</span>
        </div>

        <h1>
            Train Smart.<br>
            Live Strong.
        </h1>

        <p>
            Your complete fitness and healthy
            lifestyle management platform.
        </p>

        <div class="stats">

            <div>
                <strong>500+</strong>
                <small>Members</small>
            </div>

            <div>
                <strong>50+</strong>
                <small>Exercises</small>
            </div>

            <div>
                <strong>24/7</strong>
                <small>Fitness</small>
            </div>

        </div>

    </div>


    <div class="login-box">

        <div class="login-header">

            <h2>Welcome Back 👋</h2>

            <p>
                Login to your FITTRACK account
            </p>

        </div>

        <?php if ($error): ?>

            <div class="error-message">
                <?= htmlspecialchars($error) ?>
            </div>

        <?php endif; ?>


        <form action="actions/login.php"
              method="POST">

            <div class="form-group">

                <label>Email</label>

                <input
                    type="email"
                    name="email"
                    placeholder="Enter your email"
                    required
                >

            </div>


            <div class="form-group">

                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                >

            </div>


            <button
                type="submit"
                class="login-button">

                LOGIN →

            </button>

        </form>


        <div class="demo-login">

            <p>Demo Accounts</p>

            <small>
                Owner: admin@fittrack.com / admin123
            </small>

            <small>
                Member: member@fittrack.com / member123
            </small>

        </div>

    </div>

</div>

</body>
</html>