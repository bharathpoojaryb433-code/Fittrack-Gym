<?php

require_once '../config/config.php';
require_once '../config/json.php';
require_once '../includes/auth.php';

requireOwner();

$members = readJson('members.json');
$memberships = readJson('memberships.json');

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

?>

<?php include '../includes/header.php'; ?>

<div class="dashboard-header">

    <p class="welcome-text">
        MEMBER MANAGEMENT
    </p>

    <h1>✏️ Edit Member</h1>

</div>


<div class="form-card">

<form
    action="../actions/member.php"
    method="POST"
    class="validate"
>

    <input type="hidden" name="action" value="edit">

    <input
        type="hidden"
        name="id"
        value="<?= $member['id'] ?>"
    >


    <div class="form-row">

        <div class="form-group">

            <label>Name *</label>

            <input
                type="text"
                name="name"
                value="<?= htmlspecialchars($member['name']) ?>"
                required
            >

        </div>


        <div class="form-group">

            <label>Phone</label>

            <input
                type="tel"
                name="phone"
                value="<?= htmlspecialchars($member['phone']) ?>"
            >

        </div>

    </div>


    <div class="form-row">

        <div class="form-group">

            <label>Age</label>

            <input
                type="number"
                name="age"
                value="<?= $member['age'] ?>"
                required
            >

        </div>


        <div class="form-group">

            <label>Height</label>

            <input
                type="number"
                name="height"
                value="<?= $member['height'] ?>"
                required
            >

        </div>

    </div>


    <div class="form-row">

        <div class="form-group">

            <label>Weight</label>

            <input
                type="number"
                step="0.1"
                name="weight"
                value="<?= $member['weight'] ?>"
                required
            >

        </div>


        <div class="form-group">

            <label>Level</label>

            <select name="level">

                <?php

                $levels = [
                    'Beginner',
                    'Intermediate',
                    'Advanced'
                ];

                foreach ($levels as $level):

                ?>

                    <option
                        value="<?= $level ?>"
                        <?= $member['level'] === $level
                            ? 'selected' : '' ?>
                    >
                        <?= $level ?>
                    </option>

                <?php endforeach; ?>

            </select>

        </div>

    </div>


    <div class="form-group">

        <label>Fitness Goal</label>

        <select name="goal">

            <?php

            $goals = [
                'Build Muscle',
                'Lose Weight',
                'Improve Fitness',
                'Improve Cardio',
                'Maintain Weight'
            ];

            foreach ($goals as $goal):

            ?>

                <option
                    value="<?= $goal ?>"
                    <?= $member['goal'] === $goal
                        ? 'selected' : '' ?>
                >
                    <?= $goal ?>
                </option>

            <?php endforeach; ?>

        </select>

    </div>


    <div class="form-group">

        <label>Membership</label>

        <select name="membershipId">

            <option value="0">
                No Membership
            </option>

            <?php foreach ($memberships as $plan): ?>

                <option
                    value="<?= $plan['id'] ?>"
                    <?= $member['membershipId'] == $plan['id']
                        ? 'selected' : '' ?>
                >

                    <?= htmlspecialchars($plan['name']) ?>

                    - ₹<?= number_format($plan['price']) ?>

                </option>

            <?php endforeach; ?>

        </select>

    </div>


    <button
        type="submit"
        class="primary-btn"
    >
        💾 Update Member
    </button>

    <a
        href="member.php"
        class="secondary-btn"
    >
        Cancel
    </a>

</form>

</div>

<script src="../js/validation.js"></script>

<?php include '../includes/footer.php'; ?>