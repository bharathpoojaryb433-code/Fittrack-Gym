<?php

require_once '../config/config.php';
require_once '../config/json.php';
require_once '../includes/auth.php';

requireMember();

$exercises = readJson('exercises.json');
$workouts = readJson('workouts.json');

$userId = $_SESSION['user']['id'];

$completed = 0;

foreach ($workouts as $workout) {

    if ($workout['userId'] == $userId) {
        $completed++;
    }
}

?>

<?php include '../includes/header.php'; ?>

<div class="dashboard-header">

    <p class="welcome-text">TRAIN TODAY</p>

    <h1>My Workouts 🏋️</h1>

    <p>
        Choose an exercise and track your workout.
    </p>

</div>


<div class="stats-grid">

    <div class="stat-card">

        <div class="stat-icon">🏋️</div>

        <div>
            <span>Completed</span>
            <strong><?= $completed ?></strong>
        </div>

    </div>

    <div class="stat-card">

        <div class="stat-icon">🔥</div>

        <div>
            <span>Calories</span>
            <strong>450</strong>
        </div>

    </div>

</div>


<div class="workout-categories">

    <div class="category-card">
        <div class="category-icon">💪</div>
        <h3>Chest</h3>
    </div>

    <div class="category-card">
        <div class="category-icon">🦵</div>
        <h3>Legs</h3>
    </div>

    <div class="category-card">
        <div class="category-icon">🔥</div>
        <h3>Abs</h3>
    </div>

    <div class="category-card">
        <div class="category-icon">🏋️</div>
        <h3>Arms</h3>
    </div>

    <div class="category-card">
        <div class="category-icon">🧘</div>
        <h3>Full Body</h3>
    </div>

    <div class="category-card">
        <div class="category-icon">❤️</div>
        <h3>Cardio</h3>
    </div>

</div>


<h2>Available Exercises</h2>

<br>

<div class="exercise-grid">

<?php foreach ($exercises as $exercise): ?>

    <div class="exercise-card">

        <img
            src="../<?= htmlspecialchars($exercise['image']) ?>"
            alt="<?= htmlspecialchars($exercise['name']) ?>"
            onerror="this.style.display='none'"
        >

        <div class="exercise-content">

            <h3>
                <?= htmlspecialchars($exercise['name']) ?>
            </h3>

            <div class="exercise-meta">

                <span>
                    <?= htmlspecialchars($exercise['category']) ?>
                </span>

                <span>
                    <?= htmlspecialchars($exercise['difficulty']) ?>
                </span>

                <span>
                    <?= $exercise['sets'] ?> Sets
                </span>

                <span>
                    <?= $exercise['reps'] ?> Reps
                </span>

            </div>

            <a
                class="primary-button"
                href="exercise.php?id=<?= $exercise['id'] ?>"
            >
                Start →
            </a>

        </div>

    </div>

<?php endforeach; ?>

</div>

<?php include '../includes/footer.php'; ?>