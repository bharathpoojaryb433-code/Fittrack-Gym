<?php

require_once '../config/config.php';
require_once '../config/json.php';
require_once '../includes/auth.php';

requireOwner();

$attendance = readJson('attendance.json');
$members = readJson('members.json');

?>

<?php include '../includes/header.php'; ?>

<div class="dashboard-header">

    <p class="welcome-text">
        GYM ATTENDANCE
    </p>

    <h1>📅 Attendance</h1>

    <p>Track daily gym attendance.</p>

</div>


<div class="dashboard-grid">

    <div class="dashboard-card">

        <h3>Total Records</h3>

        <h1><?= count($attendance) ?></h1>

    </div>

    <div class="dashboard-card">

        <h3>Total Members</h3>

        <h1><?= count($members) ?></h1>

    </div>

</div>

<br>


<div class="table-card">

<table class="data-table">

<thead>

<tr>
    <th>Date</th>
    <th>Time</th>
    <th>Member</th>
    <th>Status</th>
</tr>

</thead>

<tbody>

<?php foreach (array_reverse($attendance) as $record): ?>

<?php

$memberName = 'Unknown';

foreach ($members as $member) {

    if ($member['id'] == $record['memberId']) {

        $memberName = $member['name'];

        break;
    }

}

?>

<tr>

    <td>
        <?= htmlspecialchars($record['date']) ?>
    </td>

    <td>
        <?= htmlspecialchars($record['time']) ?>
    </td>

    <td>
        <?= htmlspecialchars($memberName) ?>
    </td>

    <td>

        <span class="badge badge-success">
            <?= htmlspecialchars($record['status']) ?>
        </span>

    </td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

<?php include '../includes/footer.php'; ?>