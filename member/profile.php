<?php

require_once '../config/config.php';
require_once '../config/json.php';
require_once '../includes/auth.php';

requireMember();

$members = readJson('members.json');

$userId = $_SESSION['user']['id'];

$currentMember = null;

foreach ($members as $member) {

    if ($member['userId'] == $userId) {
        $currentMember = $member;
        break;
    }
}

if (!$currentMember) {

    $currentMember = [
        'name' => $_SESSION['user']['name'],
        'age' => '',
        'height' => '',
        'weight' => '',
        'goal' => '',
        'level' => '',
        'phone' => ''
    ];

}

?>

<?php include '../includes/header.php'; ?>

<div class="dashboard-header">

    <p class="welcome-text">
        MY ACCOUNT
    </p>

    <h1>My Profile 👤</h1>

</div>


<div class="form-card">

<form
    action="../actions/profile.php"
    method="POST"
    class="validate"
>

    <div class="form-row">

        <div class="form-group">

            <label>Name</label>

            <input
                type="text"
                name="name"
                value="<?= htmlspecialchars($currentMember['name']) ?>"
                required
            >

        </div>


        <div class="form-group">

            <label>Phone</label>

            <input
                type="tel"
                name="phone"
                value="<?= htmlspecialchars($currentMember['phone']) ?>"
            >

        </div>

    </div>


    <div class="form-row">

        <div class="form-group">

            <label>Age</label>

            <input
                type="number"
                name="age"
                value="<?= htmlspecialchars($currentMember['age']) ?>"
                min="10"
                max="100"
                required
            >

        </div>


        <div class="form-group">

            <label>Height (cm)</label>

            <input
                type="number"
                name="height"
                value="<?= htmlspecialchars($currentMember['height']) ?>"
                min="50"
                max="250"
                required
            >

        </div>

    </div>


    <div class="form-row">

        <div class="form-group">

            <label>Weight (kg)</label>

            <input
                type="number"
                step="0.1"
                name="weight"
                value="<?= htmlspecialchars($currentMember['weight']) ?>"
                min="20"
                max="300"
                required
            >

        </div>


        <div class="form-group">

            <label>Experience Level</label>

            <select name="level">

                <option
                    <?= $currentMember['level'] === 'Beginner'
                        ? 'selected' : '' ?>
                >
                    Beginner
                </option>

                <option
                    <?= $currentMember['level'] === 'Intermediate'
                        ? 'selected' : '' ?>
                >
                    Intermediate
                </option>

                <option
                    <?= $currentMember['level'] === 'Advanced'
                        ? 'selected' : '' ?>
                >
                    Advanced
                </option>

            </select>

        </div>

    </div>


    <div class="form-group">

        <label>Fitness Goal</label>

        <select name="goal">

            <option
                <?= $currentMember['goal'] === 'Build Muscle'
                    ? 'selected' : '' ?>
            >
                Build Muscle
            </option>

            <option
                <?= $currentMember['goal'] === 'Lose Weight'
                    ? 'selected' : '' ?>
            >
                Lose Weight
            </option>

            <option
                <?= $currentMember['goal'] === 'Improve Fitness'
                    ? 'selected' : '' ?>
            >
                Improve Fitness
            </option>

            <option
                <?= $currentMember['goal'] === 'Improve Cardio'
                    ? 'selected' : '' ?>
            >
                Improve Cardio
            </option>

            <option
                <?= $currentMember['goal'] === 'Maintain Weight'
                    ? 'selected' : '' ?>
            >
                Maintain Weight
            </option>

        </select>

    </div>


    <button
        type="submit"
        class="primary-btn"
    >
        💾 Save Profile
    </button>

</form>

</div>

<script src="../js/validation.js"></script>

<?php include '../includes/footer.php'; ?>