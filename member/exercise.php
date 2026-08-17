<?php

require_once '../config/config.php';
require_once '../config/json.php';
require_once '../includes/auth.php';

requireMember();

$exercises = readJson('exercises.json');

$id = (int)($_GET['id'] ?? 0);

$exercise = null;

foreach ($exercises as $item) {

    if ($item['id'] === $id) {
        $exercise = $item;
        break;
    }
}

if (!$exercise) {
    header("Location: workouts.php");
    exit;
}

?>

<?php include '../includes/header.php'; ?>

<div class="dashboard-header">

    <p class="welcome-text">
        EXERCISE
    </p>

    <h1>
        <?= htmlspecialchars($exercise['name']) ?>
    </h1>

</div>


<div class="workout-panel">

    <h2>
        <?= htmlspecialchars($exercise['name']) ?>
    </h2>

    <br>

    <div class="exercise-meta">

        <span>
            Category:
            <?= htmlspecialchars($exercise['category']) ?>
        </span>

        <span>
            Difficulty:
            <?= htmlspecialchars($exercise['difficulty']) ?>
        </span>

        <span>
            Target:
            <?= htmlspecialchars($exercise['target']) ?>
        </span>

    </div>


    <hr><br>


    <h3>Workout Timer</h3>

    <div
        id="timer"
        class="timer-display"
    >
        00:00
    </div>


    <div class="timer-buttons">

        <button
            class="timer-start"
            onclick="startTimer()"
        >
            ▶ Start
        </button>

        <button
            class="timer-pause"
            onclick="pauseTimer()"
        >
            ⏸ Pause
        </button>

        <button
            class="timer-reset"
            onclick="resetTimer()"
        >
            ↻ Reset
        </button>

    </div>


    <br><br>


    <form
        action="../actions/workout.php"
        method="POST"
        class="validate"
    >

        <input
            type="hidden"
            name="exerciseId"
            value="<?= $exercise['id'] ?>"
        >

        <input
            type="hidden"
            name="exerciseName"
            value="<?= htmlspecialchars($exercise['name']) ?>"
        >

        <input
            type="hidden"
            name="calories"
            value="<?= $exercise['calories'] ?>"
        >

        <div class="form-row">

            <div class="form-group">

                <label>Sets</label>

                <input
                    type="number"
                    name="sets"
                    value="<?= $exercise['sets'] ?>"
                    min="1"
                    required
                >

            </div>


            <div class="form-group">

                <label>Reps</label>

                <input
                    type="number"
                    name="reps"
                    value="<?= $exercise['reps'] ?>"
                    min="1"
                    required
                >

            </div>

        </div>


        <div class="form-row">

            <div class="form-group">

                <label>Weight (kg)</label>

                <input
                    type="number"
                    name="weight"
                    value="0"
                    min="0"
                    step="0.5"
                >

            </div>


            <div class="form-group">

                <label>Duration (minutes)</label>

                <input
                    type="number"
                    name="duration"
                    value="10"
                    min="1"
                >

            </div>

        </div>


        <button
            type="submit"
            class="primary-btn"
        >
            ✅ Complete Exercise
        </button>

    </form>

</div>

<script src="../js/timer.js"></script>
<script src="../js/validation.js"></script>

<?php include '../includes/footer.php'; ?>