<?php

require_once '../config/config.php';
require_once '../config/json.php';
require_once '../includes/auth.php';

requireOwner();

$memberships = readJson('memberships.json');

?>

<?php include '../includes/header.php'; ?>

<div class="dashboard-header">
    <p class="welcome-text">MEMBER MANAGEMENT</p>
    <h1>➕ Add New Member</h1>
    <p>Register a new gym member.</p>
</div>

<div class="form-card">

    <form action="../actions/member.php" method="POST" class="validate">

        <input type="hidden" name="action" value="add">

        <div class="form-row">

            <div class="form-group">
                <label>Member Name *</label>

                <input
                    type="text"
                    name="name"
                    placeholder="Enter member name"
                    required
                >
            </div>

            <div class="form-group">
                <label>Mobile Number</label>

                <input
                    type="tel"
                    name="phone"
                    placeholder="Enter mobile number"
                >
            </div>

        </div>


        <div class="form-row">

            <div class="form-group">
                <label>Age *</label>

                <input
                    type="number"
                    name="age"
                    min="10"
                    max="100"
                    required
                >
            </div>

            <div class="form-group">
                <label>Height (cm) *</label>

                <input
                    type="number"
                    name="height"
                    min="50"
                    max="250"
                    required
                >
            </div>

        </div>


        <div class="form-row">

            <div class="form-group">
                <label>Weight (kg) *</label>

                <input
                    type="number"
                    name="weight"
                    step="0.1"
                    min="20"
                    max="300"
                    required
                >
            </div>


            <div class="form-group">

                <label>Experience Level</label>

                <select name="level">

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


        <div class="form-row">

            <div class="form-group">

                <label>Fitness Goal</label>

                <select name="goal">

                    <option value="Build Muscle">
                        💪 Build Muscle
                    </option>

                    <option value="Lose Weight">
                        🔥 Lose Weight
                    </option>

                    <option value="Improve Fitness">
                        🏃 Improve Fitness
                    </option>

                    <option value="Improve Cardio">
                        ❤️ Improve Cardio
                    </option>

                    <option value="Maintain Weight">
                        ⚖️ Maintain Weight
                    </option>

                </select>

            </div>


            <div class="form-group">

                <label>Membership Plan</label>

                <select name="membershipId">

                    <option value="0">
                        No Membership
                    </option>

                    <?php foreach ($memberships as $plan): ?>

                        <option value="<?= $plan['id'] ?>">

                            <?= htmlspecialchars($plan['name']) ?>

                            -
                            ₹<?= number_format($plan['price']) ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

        </div>


        <button type="submit" class="primary-btn">
            ✅ Add Member
        </button>

        <a href="member.php" class="secondary-btn">
            Cancel
        </a>

    </form>

</div>

<script src="../js/validation.js"></script>

<?php include '../includes/footer.php'; ?>