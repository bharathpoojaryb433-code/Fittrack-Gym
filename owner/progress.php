<?php

require_once '../config/config.php';
require_once '../config/json.php';
require_once '../includes/auth.php';

requireOwner();

$progress = readJson('progress.json');
$members = readJson('members.json');

?>

<?php include '../includes/header.php'; ?>

<div class="dashboard-header">

    <p class="welcome-text">
        FITNESS ANALYTICS
    </p>

    <h1>📈 Member Progress</h1>

    <p>Monitor member fitness progress.</p>

</div>


<div class="table-card">

<table class="data-table">

<thead>

<tr>

    <th>Date</th>
    <th>Member</th>
    <th>Weight</th>
    <th>BMI</th>
    <th>Workouts</th>
    <th>Calories</th>

</tr>

</thead>


<tbody>

<?php foreach (array_reverse($progress) as $item): ?>

<?php

$memberName = 'Unknown';

foreach ($members as $member) {

    if ($member['userId'] == $item['userId']) {

        $memberName = $member['name'];

        break;
    }

}

?>

<tr>

    <td>
        <?= htmlspecialchars($item['date']) ?>
    </td>

    <td>
        <?= htmlspecialchars($memberName) ?>
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

<?php include '../includes/footer.php'; ?>