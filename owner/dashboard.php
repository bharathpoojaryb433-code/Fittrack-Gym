<?php

require_once '../config/config.php';
require_once '../config/json.php';
require_once '../includes/auth.php';

requireOwner();

$members = readJson('members.json');
$memberships = readJson('memberships.json');
$attendance = readJson('attendance.json');
$workouts = readJson('workouts.json');

$totalMembers = count($members);
$totalPlans = count($memberships);
$totalAttendance = count($attendance);
$totalWorkouts = count($workouts);

?>

<?php include '../includes/header.php'; ?>

<section class="dashboard-header">

    <div>

        <p class="welcome-text">
            Welcome back 👋
        </p>

        <h1>
            Gym Owner Dashboard
        </h1>

    </div>

</section>


<div class="stats-grid">

    <div class="stat-card">

        <div class="stat-icon">👥</div>

        <div>
            <span>Total Members</span>
            <strong><?= $totalMembers ?></strong>
        </div>

    </div>


    <div class="stat-card">

        <div class="stat-icon">💳</div>

        <div>
            <span>Membership Plans</span>
            <strong><?= $totalPlans ?></strong>
        </div>

    </div>


    <div class="stat-card">

        <div class="stat-icon">📅</div>

        <div>
            <span>Attendance Records</span>
            <strong><?= $totalAttendance ?></strong>
        </div>

    </div>


    <div class="stat-card">

        <div class="stat-icon">🏋️</div>

        <div>
            <span>Completed Workouts</span>
            <strong><?= $totalWorkouts ?></strong>
        </div>

    </div>

</div>


<div class="dashboard-grid">

    <div class="dashboard-card">

        <h2>Quick Actions</h2>

        <div class="quick-actions">

            <a href="add-member.php">
                ➕ Add Member
            </a>

            <a href="members.php">
                👥 View Members
            </a>

            <a href="attendance.php">
                📅 Attendance
            </a>

            <a href="foods.php">
                🥗 Healthy Food
            </a>

        </div>

    </div>


    <div class="dashboard-card">

        <h2>Business Overview</h2>

        <p>
            Manage your gym members, workouts,
            memberships and healthy food services
            from one dashboard.
        </p>

    </div>

</div>


<?php include '../includes/footer.php'; ?>