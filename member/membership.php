<?php

require_once '../config/config.php';
require_once '../config/json.php';
require_once '../includes/auth.php';

requireMember();

$members = readJson('members.json');
$memberships = readJson('memberships.json');

$userId = $_SESSION['user']['id'];

$currentMember = null;

foreach ($members as $member) {

    if ($member['userId'] == $userId) {
        $currentMember = $member;
        break;
    }
}

$currentPlan = null;

if ($currentMember) {

    foreach ($memberships as $plan) {

        if ($plan['id'] == $currentMember['membershipId']) {
            $currentPlan = $plan;
            break;
        }

    }
}

?>

<?php include '../includes/header.php'; ?>

<div class="dashboard-header">

    <p class="welcome-text">
        MEMBERSHIP
    </p>

    <h1>My Membership 💳</h1>

</div>


<?php if ($currentPlan): ?>

<div class="dashboard-card">

    <h2>
        <?= htmlspecialchars($currentPlan['name']) ?>
    </h2>

    <h3>
        ₹<?= number_format($currentPlan['price']) ?>
    </h3>

    <p>
        Duration:
        <?= htmlspecialchars($currentPlan['duration']) ?>
    </p>

    <p>
        <?= htmlspecialchars($currentPlan['description']) ?>
    </p>

    <br>

    <span class="badge badge-success">
        ACTIVE
    </span>

</div>

<?php else: ?>

<div class="dashboard-card">

    <h2>No Membership</h2>

    <p>
        Please contact the gym owner to activate
        your membership.
    </p>

</div>

<?php endif; ?>


<br>

<h2>Available Plans</h2>

<br>

<div class="dashboard-grid">

<?php foreach ($memberships as $plan): ?>

    <div class="dashboard-card">

        <h2>
            <?= htmlspecialchars($plan['name']) ?>
        </h2>

        <h1>
            ₹<?= number_format($plan['price']) ?>
        </h1>

        <p>
            <?= htmlspecialchars($plan['duration']) ?>
        </p>

        <br>

        <p>
            <?= htmlspecialchars($plan['description']) ?>
        </p>

    </div>

<?php endforeach; ?>

</div>

<?php include '../includes/footer.php'; ?>