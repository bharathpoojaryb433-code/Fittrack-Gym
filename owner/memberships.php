<?php

require_once '../config/config.php';
require_once '../config/json.php';
require_once '../includes/auth.php';

requireOwner();

$memberships = readJson('memberships.json');

?>

<?php include '../includes/header.php'; ?>

<div class="dashboard-header">

    <p class="welcome-text">
        BUSINESS MANAGEMENT
    </p>

    <h1>💳 Membership Plans</h1>

    <p>Manage gym membership packages.</p>

</div>


<div class="form-card">

    <h2>Create Membership Plan</h2>

    <br>

    <form method="POST">

        <div class="form-row">

            <div class="form-group">

                <label>Plan Name</label>

                <input
                    type="text"
                    name="name"
                    placeholder="Premium"
                    required
                >

            </div>


            <div class="form-group">

                <label>Price ₹</label>

                <input
                    type="number"
                    name="price"
                    min="0"
                    required
                >

            </div>

        </div>


        <div class="form-group">

            <label>Duration</label>

            <select name="duration">

                <option>1 Month</option>
                <option>3 Months</option>
                <option>6 Months</option>
                <option>1 Year</option>

            </select>

        </div>


        <div class="form-group">

            <label>Description</label>

            <textarea
                name="description"
                placeholder="Gym access, personal training..."
            ></textarea>

        </div>


        <button
            type="submit"
            class="primary-btn"
        >
            ➕ Create Plan
        </button>

    </form>

</div>


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

        <br>

        <span class="badge badge-success">
            ACTIVE
        </span>

    </div>

<?php endforeach; ?>

</div>


<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $memberships[] = [

        'id' => getNextId($memberships),

        'name' =>
            trim($_POST['name']),

        'price' =>
            (int)$_POST['price'],

        'duration' =>
            trim($_POST['duration']),

        'description' =>
            trim($_POST['description'])

    ];

    writeJson(
        'memberships.json',
        $memberships
    );

    header("Location: membership.php");

    exit;
}

?>

<?php include '../includes/footer.php'; ?>