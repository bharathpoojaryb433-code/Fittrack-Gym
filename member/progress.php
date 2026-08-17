<?php

require_once '../config/config.php';
require_once '../config/json.php';
require_once '../includes/auth.php';

requireMember();

$progress = readJson('progress.json');

$userId = $_SESSION['user']['id'];

$userProgress = [];

foreach ($progress as $item) {

    if ($item['userId'] == $userId) {
        $userProgress[] = $item;
    }

}

$latest = end($userProgress);

?>

<?php include '../includes/header.php'; ?>

<div class="dashboard-header">

    <p class="welcome-text">
        FITNESS PROGRESS
    </p>

    <h1>My Progress 📈</h1>

</div>


<div class="stats-grid">

    <div class="stat-card">

        <div class="stat-icon">⚖️</div>

        <div>
            <span>Current Weight</span>

            <strong>
                <?= $latest['weight'] ?? '--' ?> kg
            </strong>
        </div>

    </div>


    <div class="stat-card">

        <div class="stat-icon">📊</div>

        <div>
            <span>BMI</span>

            <strong>
                <?= $latest['bmi'] ?? '--' ?>
            </strong>
        </div>

    </div>


    <div class="stat-card">

        <div class="stat-icon">🏋️</div>

        <div>
            <span>Workouts</span>

            <strong>
                <?= $latest['workoutCount'] ?? 0 ?>
            </strong>
        </div>

    </div>


    <div class="stat-card">

        <div class="stat-icon">🔥</div>

        <div>
            <span>Calories</span>

            <strong>
                <?= $latest['calories'] ?? 0 ?>
            </strong>
        </div>

    </div>

</div>


<div class="dashboard-grid">

    <div class="dashboard-card">

        <h2>Update Progress</h2>

        <form
            action="../actions/progress.php"
            method="POST"
            class="validate"
        >

            <div class="form-group">

                <label>Current Weight (kg)</label>

                <input
                    type="number"
                    name="weight"
                    step="0.1"
                    required
                >

            </div>


            <div class="form-group">

                <label>Workout Count</label>

                <input
                    type="number"
                    name="workoutCount"
                    min="0"
                    value="0"
                >

            </div>


            <div class="form-group">

                <label>Calories Burned</label>

                <input
                    type="number"
                    name="calories"
                    min="0"
                    value="0"
                >

            </div>


            <button
                type="submit"
                class="primary-btn"
            >
                📈 Save Progress
            </button>

        </form>

    </div>


    <div class="dashboard-card">

        <h2>Weekly Workout Progress</h2>

        <canvas
            id="workoutChart"
            width="500"
            height="280"
        ></canvas>

    </div>

</div>


<br>


<div class="table-card">

    <h2>Progress History</h2>

    <br>

    <table class="data-table">

        <thead>

            <tr>

                <th>Date</th>
                <th>Weight</th>
                <th>BMI</th>
                <th>Workouts</th>
                <th>Calories</th>

            </tr>

        </thead>

        <tbody>

        <?php foreach (array_reverse($userProgress) as $item): ?>

            <tr>

                <td>
                    <?= htmlspecialchars($item['date']) ?>
                </td>

                <td>
                    <?= $item['weight'] ?> kg
                </td>

                <td>
                    <?= $item['bmi'] ?>
                </td>

                <td>
                    <?= $item['workoutCount'] ?>
                </td>

                <td>
                    <?= $item['calories'] ?> kcal
                </td>

            </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

</div>


<script src="../js/chart.js"></script>

<script>

createWorkoutChart(
    "workoutChart",
    ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
    [3, 5, 4, 6, 3, 8, 5]
);

</script>

<script src="../js/validation.js"></script>

<?php include '../includes/footer.php'; ?>