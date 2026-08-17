<?php

require_once '../config/config.php';
require_once '../config/json.php';
require_once '../includes/auth.php';

requireOwner();

/*
|--------------------------------------------------------------------------
| Load JSON data
|--------------------------------------------------------------------------
*/

$workouts  = readJson('workouts.json');
$exercises = readJson('exercises.json');
$members   = readJson('members.json');


/*
|--------------------------------------------------------------------------
| Add Workout
|--------------------------------------------------------------------------
*/

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $exerciseId = (int)($_POST['exerciseId'] ?? 0);

    $exerciseName = 'Custom Exercise';

    foreach ($exercises as $exercise) {

        if ((int)$exercise['id'] === $exerciseId) {

            $exerciseName = $exercise['name'];

            break;
        }
    }


    $newWorkout = [

        'id' => getNextId($workouts),

        'userId' => (int)($_POST['memberId'] ?? 0),

        'exerciseId' => $exerciseId,

        'exerciseName' => $exerciseName,

        'category' => trim($_POST['category'] ?? ''),

        'difficulty' => trim($_POST['difficulty'] ?? 'Beginner'),

        'sets' => (int)($_POST['sets'] ?? 3),

        'reps' => (int)($_POST['reps'] ?? 12),

        'weight' => (float)($_POST['weight'] ?? 0),

        'duration' => (int)($_POST['duration'] ?? 0),

        'calories' => (int)($_POST['calories'] ?? 0),

        'date' => date('Y-m-d'),

        'completed' => false

    ];


    $workouts[] = $newWorkout;


    writeJson(
        'workouts.json',
        $workouts
    );


    $_SESSION['message'] =
        'Workout added successfully.';


    header('Location: workouts.php');

    exit;
}

?>

<?php include '../includes/header.php'; ?>


<!-- =========================================================
     PAGE HEADER
========================================================= -->

<div class="dashboard-header">

    <p class="welcome-text">
        WORKOUT MANAGEMENT
    </p>

    <h1>🏋️ Workout Plans</h1>

    <p>
        Create and manage workout plans for your gym members.
    </p>

</div>


<!-- =========================================================
     SUCCESS MESSAGE
========================================================= -->

<?php if (!empty($_SESSION['message'])): ?>

    <div class="success-message">

        <?= htmlspecialchars($_SESSION['message']) ?>

    </div>

    <?php unset($_SESSION['message']); ?>

<?php endif; ?>


<!-- =========================================================
     STATISTICS
========================================================= -->

<div class="dashboard-grid">

    <div class="dashboard-card">

        <h3>Total Workouts</h3>

        <h1>
            <?= count($workouts) ?>
        </h1>

        <p>
            Workout records
        </p>

    </div>


    <div class="dashboard-card">

        <h3>Exercises</h3>

        <h1>
            <?= count($exercises) ?>
        </h1>

        <p>
            Available exercises
        </p>

    </div>


    <div class="dashboard-card">

        <h3>Members</h3>

        <h1>
            <?= count($members) ?>
        </h1>

        <p>
            Gym members
        </p>

    </div>

</div>


<br>


<!-- =========================================================
     ADD WORKOUT FORM
========================================================= -->

<div class="form-card">

    <h2>➕ Create Workout</h2>

    <p>
        Assign an exercise to a gym member.
    </p>

    <br>


    <form
        method="POST"
        class="validate"
    >


        <!-- MEMBER -->

        <div class="form-group">

            <label>
                Select Member *
            </label>

            <select
                name="memberId"
                required
            >

                <option value="">
                    -- Select Member --
                </option>


                <?php foreach ($members as $member): ?>

                    <option
                        value="<?= $member['id'] ?>"
                    >

                        <?= htmlspecialchars(
                            $member['name']
                        ) ?>

                    </option>

                <?php endforeach; ?>

            </select>

        </div>


        <!-- EXERCISE -->

        <div class="form-group">

            <label>
                Select Exercise *
            </label>

            <select
                name="exerciseId"
                id="exerciseSelect"
                required
            >

                <option value="">
                    -- Select Exercise --
                </option>


                <?php foreach ($exercises as $exercise): ?>

                    <option
                        value="<?= $exercise['id'] ?>"
                        data-category="<?= htmlspecialchars(
                            $exercise['category']
                        ) ?>"
                        data-difficulty="<?= htmlspecialchars(
                            $exercise['difficulty']
                        ) ?>"
                        data-sets="<?= $exercise['sets'] ?>"
                        data-reps="<?= $exercise['reps'] ?>"
                        data-calories="<?= $exercise['calories'] ?>"
                    >

                        <?= htmlspecialchars(
                            $exercise['name']
                        ) ?>

                    </option>

                <?php endforeach; ?>

            </select>

        </div>


        <!-- CATEGORY + DIFFICULTY -->

        <div class="form-row">


            <div class="form-group">

                <label>
                    Category
                </label>

                <select name="category">

                    <option value="Chest">
                        💪 Chest
                    </option>

                    <option value="Legs">
                        🦵 Legs
                    </option>

                    <option value="Abs">
                        🔥 Abs
                    </option>

                    <option value="Arms">
                        🏋️ Arms
                    </option>

                    <option value="Full Body">
                        🧘 Full Body
                    </option>

                    <option value="Cardio">
                        ❤️ Cardio
                    </option>

                </select>

            </div>


            <div class="form-group">

                <label>
                    Difficulty
                </label>

                <select name="difficulty">

                    <option value="Beginner">
                        Beginner
                    </option>

                    <option value="Intermediate">
                        Intermediate
                    </option>

                    <option value="Advanced">
                        Advanced
                    </option>

                </select>

            </div>

        </div>


        <!-- SETS + REPS -->

        <div class="form-row">


            <div class="form-group">

                <label>
                    Sets
                </label>

                <input
                    type="number"
                    name="sets"
                    id="sets"
                    value="3"
                    min="1"
                    max="20"
                >

            </div>


            <div class="form-group">

                <label>
                    Reps
                </label>

                <input
                    type="number"
                    name="reps"
                    id="reps"
                    value="12"
                    min="1"
                    max="100"
                >

            </div>

        </div>


        <!-- WEIGHT + DURATION -->

        <div class="form-row">


            <div class="form-group">

                <label>
                    Weight (kg)
                </label>

                <input
                    type="number"
                    name="weight"
                    step="0.5"
                    value="0"
                    min="0"
                >

            </div>


            <div class="form-group">

                <label>
                    Duration (minutes)
                </label>

                <input
                    type="number"
                    name="duration"
                    value="30"
                    min="1"
                    max="300"
                >

            </div>

        </div>


        <!-- CALORIES -->

        <div class="form-group">

            <label>
                Estimated Calories
            </label>

            <input
                type="number"
                name="calories"
                id="calories"
                value="50"
                min="0"
            >

        </div>


        <!-- BUTTON -->

        <button
            type="submit"
            class="primary-btn"
        >

            ➕ Add Workout

        </button>


        <button
            type="reset"
            class="secondary-btn"
        >

            Reset

        </button>

    </form>

</div>


<br>


<!-- =========================================================
     WORKOUT TABLE
========================================================= -->

<div class="table-card">

    <div class="section-header">

        <div>

            <h2>
                📋 Workout Records
            </h2>

            <p>
                Recently created workout plans.
            </p>

        </div>

    </div>


    <br>


    <div class="table-responsive">

        <table class="data-table">

            <thead>

                <tr>

                    <th>
                        ID
                    </th>

                    <th>
                        Member
                    </th>

                    <th>
                        Exercise
                    </th>

                    <th>
                        Category
                    </th>

                    <th>
                        Sets
                    </th>

                    <th>
                        Reps
                    </th>

                    <th>
                        Weight
                    </th>

                    <th>
                        Duration
                    </th>

                    <th>
                        Calories
                    </th>

                    <th>
                        Date
                    </th>

                </tr>

            </thead>


            <tbody>


            <?php if (empty($workouts)): ?>

                <tr>

                    <td
                        colspan="10"
                        style="text-align:center;"
                    >

                        No workouts available.

                    </td>

                </tr>

            <?php endif; ?>


            <?php foreach (array_reverse($workouts) as $workout): ?>


                <?php

                /*
                Find member name
                */

                $memberName = 'Unknown';


                foreach ($members as $member) {

                    if (
                        (int)$member['id']
                        ===
                        (int)$workout['userId']
                    ) {

                        $memberName =
                            $member['name'];

                        break;
                    }

                }

                ?>


                <tr>


                    <td>

                        #<?= $workout['id'] ?>

                    </td>


                    <td>

                        <strong>

                            <?= htmlspecialchars(
                                $memberName
                            ) ?>

                        </strong>

                    </td>


                    <td>

                        🏋️

                        <?= htmlspecialchars(
                            $workout['exerciseName']
                        ) ?>

                    </td>


                    <td>

                        <span class="badge">

                            <?= htmlspecialchars(
                                $workout['category']
                            ) ?>

                        </span>

                    </td>


                    <td>

                        <?= $workout['sets'] ?>

                    </td>


                    <td>

                        <?= $workout['reps'] ?>

                    </td>


                    <td>

                        <?= $workout['weight'] ?>
                        kg

                    </td>


                    <td>

                        <?= $workout['duration'] ?>
                        min

                    </td>


                    <td>

                        🔥

                        <?= $workout['calories'] ?>
                        kcal

                    </td>


                    <td>

                        <?= htmlspecialchars(
                            $workout['date']
                        ) ?>

                    </td>


                </tr>


            <?php endforeach; ?>


            </tbody>

        </table>

    </div>

</div>


<!-- =========================================================
     AUTO-FILL EXERCISE INFORMATION
========================================================= -->

<script>

const exerciseSelect =
    document.getElementById('exerciseSelect');

const setsInput =
    document.getElementById('sets');

const repsInput =
    document.getElementById('reps');

const caloriesInput =
    document.getElementById('calories');


exerciseSelect.addEventListener(
    'change',
    function () {

        const option =
            this.options[this.selectedIndex];


        if (!option.value) {

            return;

        }


        const sets =
            option.dataset.sets;

        const reps =
            option.dataset.reps;

        const calories =
            option.dataset.calories;


        if (sets) {

            setsInput.value = sets;

        }


        if (reps) {

            repsInput.value = reps;

        }


        if (calories) {

            caloriesInput.value =
                calories;

        }

    }
);

</script>


<?php include '../includes/footer.php'; ?>