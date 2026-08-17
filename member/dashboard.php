<?php

require_once '../config/config.php';
require_once '../config/json.php';
require_once '../includes/auth.php';

requireMember();

$members = readJson('members.json');

$currentMember = null;

foreach ($members as $member) {

    if ($member['userId'] == $_SESSION['user']['id']) {
        $currentMember = $member;
        break;
    }

}

?>

<?php include '../includes/header.php'; ?>

<div class="dashboard-header">
<section class="hero-section">

    <div class="hero-content">

        <span class="hero-tag">
            💪 FITNESS MANAGEMENT
        </span>

        <h1>
            Build Your
            <span>Strongest Self</span>
        </h1>

        <p>
            Track workouts, monitor progress,
            manage your fitness goals and stay
            consistent with FITTRACK GYM.
        </p>

        <div class="hero-buttons">

            <a href="workouts.php" class="primary-btn">
                🏋️ Start Workout
            </a>

            <a href="progress.php" class="secondary-btn">
                📈 View Progress
            </a>

        </div>

    </div>


    <div class="hero-image">

        <div class="hero-glow"></div>

        <img
            src="../assets/images/body.png"
            alt="body.png"
        >

    </div>

</section>
    <p class="welcome-text">
        Welcome back 👋
    </p>

    <h1>
        <?= htmlspecialchars($_SESSION['user']['name']) ?>
    </h1>

    <p>
        Ready for today's workout?
    </p>

</div>


<div class="stats-grid">

    <div class="stat-card">

        <div class="stat-icon">🔥</div>

        <div>
            <span>Calories</span>
            <strong>450</strong>
        </div>

    </div>


    <div class="stat-card">

        <div class="stat-icon">⏱️</div>

        <div>
            <span>Workout Time</span>
            <strong>45 min</strong>
        </div>

    </div>


    <div class="stat-card">

        <div class="stat-icon">🏋️</div>

        <div>
            <span>Exercises</span>
            <strong>5</strong>
        </div>

    </div>


    <div class="stat-card">

        <div class="stat-icon">🔥</div>

        <div>
            <span>Streak</span>
            <strong>7 Days</strong>
        </div>

    </div>

</div>


<div class="dashboard-card">

    <h2>Today's Workout</h2>

    <p>
        Chest & Arms — Intermediate
    </p>

    <a
        href="workouts.php"
        class="primary-button">

        Start Workout →

    </a>

</div>


<?php include '../includes/footer.php'; ?>