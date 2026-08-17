<?php

require_once '../config/config.php';
require_once '../config/json.php';
require_once '../includes/auth.php';

requireOwner();

$members = readJson('members.json');
$workouts = readJson('workouts.json');
$attendance = readJson('attendance.json');
$progress = readJson('progress.json');

$id = (int)($_GET['id'] ?? 0);

$member = null;

foreach ($members as $item) {

    if ($item['id'] === $id) {
        $member = $item;
        break;
    }

}

if (!$member) {
    header("Location: member.php");
    exit;
}


$memberWorkouts = 0;
$memberCalories = 0;
$memberAttendance = 0;

foreach ($workouts as $workout) {

    if ($workout['userId'] == $member['userId']) {

        $memberWorkouts++;

        $memberCalories +=
            (int)$workout['calories'];
    }

}


foreach ($attendance as $record) {

    if ($record['memberId'] == $member['id']) {
        $memberAttendance++;
    }

}

?>

<?php include '../includes/header.php'; ?>

<div class="dashboard-header">

    <p class="welcome-text">
        MEMBER PROFILE
    </p>

    <h1>
        👤 <?= htmlspecialchars($member['name']) ?>
    </h1>

</div>


<div class="dashboard-grid">

    <div class="dashboard-card">

        <h2>Personal Details</h2>

        <p>
            <strong>Name:</strong>
            <?= htmlspecialchars($member['name']) ?>
        </p>

        <p>
            <strong>Age:</strong>
            <?= $member['age'] ?>
        </p>

        <p>
            <strong>Height:</strong>
            <?= $member['height'] ?> cm
        </p>

        <p>
            <strong>Weight:</strong>
            <?= $member['weight'] ?> kg
        </p>

        <p>
            <strong>Phone:</strong>
            <?= htmlspecialchars($member['phone']) ?>
        </p>

        <p>
            <strong>Goal:</strong>
            <?= htmlspecialchars($member['goal']) ?>
        </p>

        <p>
            <strong>Level:</strong>
            <?= htmlspecialchars($member['level']) ?>
        </p>

    </div>


    <div class="dashboard-card">

        <h2>Fitness Summary</h2>

        <p>
            🏋️ Workouts:
            <strong><?= $memberWorkouts ?></strong>
        </p>

        <p>
            🔥 Calories:
            <strong><?= $memberCalories ?> kcal</strong>
        </p>

        <p>
            📅 Attendance:
            <strong><?= $memberAttendance ?></strong>
        </p>

        <br>

        <a
            href="edit-member.php?id=<?= $member['id'] ?>"
            class="primary-btn"
        >
            ✏️ Edit Profile
        </a>

    </div>

</div>


<br>

<div class="table-card">

    <h2>Workout History</h2>

    <br>

    <table class="data-table">

        <thead>

            <tr>
                <th>Date</th>
                <th>Exercise</th>
                <th>Sets</th>
                <th>Reps</th>
                <th>Weight</th>
                <th>Calories</th>
            </tr>

        </thead>

        <tbody>

        <?php foreach ($workouts as $workout): ?>

            <?php if ($workout['userId'] == $member['userId']): ?>

                <tr>

                    <td><?= $workout['date'] ?></td>

                    <td>
                        <?= htmlspecialchars(
                            $workout['exerciseName']
                        ) ?>
                    </td>

                    <td><?= $workout['sets'] ?></td>

                    <td><?= $workout['reps'] ?></td>

                    <td><?= $workout['weight'] ?> kg</td>

                    <td><?= $workout['calories'] ?> kcal</td>

                </tr>

            <?php endif; ?>

        <?php endforeach; ?>

        </tbody>

    </table>

</div>

<?php include '../includes/footer.php'; ?>