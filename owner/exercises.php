<?php

require_once '../config/config.php';
require_once '../config/json.php';
require_once '../includes/auth.php';

requireOwner();

$exercises = readJson('exercises.json');

?>

<?php include '../includes/header.php'; ?>

<div class="dashboard-header">

    <p class="welcome-text">
        WORKOUT MANAGEMENT
    </p>

    <h1>🏋️ Exercises</h1>

    <p>Manage gym exercises and workout information.</p>

</div>


<div class="form-card">

    <h2>Add Exercise</h2>

    <br>

    <form method="POST">

        <input type="hidden" name="add_exercise" value="1">

        <div class="form-row">

            <div class="form-group">

                <label>Exercise Name</label>

                <input
                    type="text"
                    name="name"
                    required
                >

            </div>


            <div class="form-group">

                <label>Category</label>

                <select name="category">

                    <option>Chest</option>
                    <option>Legs</option>
                    <option>Abs</option>
                    <option>Arms</option>
                    <option>Full Body</option>
                    <option>Cardio</option>

                </select>

            </div>

        </div>


        <div class="form-row">

            <div class="form-group">

                <label>Difficulty</label>

                <select name="difficulty">

                    <option>Beginner</option>
                    <option>Intermediate</option>
                    <option>Advanced</option>

                </select>

            </div>


            <div class="form-group">

                <label>Target Muscle</label>

                <input
                    type="text"
                    name="target"
                    placeholder="Chest"
                >

            </div>

        </div>


        <div class="form-row">

            <div class="form-group">

                <label>Sets</label>

                <input
                    type="number"
                    name="sets"
                    value="3"
                >

            </div>


            <div class="form-group">

                <label>Reps</label>

                <input
                    type="number"
                    name="reps"
                    value="12"
                >

            </div>

        </div>


        <div class="form-group">

            <label>Calories</label>

            <input
                type="number"
                name="calories"
                value="50"
            >

        </div>


        <button
            type="submit"
            class="primary-btn"
        >
            ➕ Add Exercise
        </button>

    </form>

</div>


<br>


<div class="exercise-grid">

<?php foreach ($exercises as $exercise): ?>

    <div class="exercise-card">

        <div class="exercise-content">

            <div class="category-icon">
                🏋️
            </div>

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

            <p>
                Target:
                <?= htmlspecialchars($exercise['target']) ?>
            </p>

        </div>

    </div>

<?php endforeach; ?>

</div>


<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $exercises[] = [

        'id' => getNextId($exercises),

        'name' => trim($_POST['name']),

        'category' => trim($_POST['category']),

        'difficulty' => trim($_POST['difficulty']),

        'target' => trim($_POST['target']),

        'sets' => (int)$_POST['sets'],

        'reps' => (int)$_POST['reps'],

        'calories' => (int)$_POST['calories'],

        'image' => 'assets/images/exercises/default.jpg'

    ];

    writeJson('exercises.json', $exercises);

    header("Location: exercises.php");

    exit;
}

?>

<?php include '../includes/footer.php'; ?>