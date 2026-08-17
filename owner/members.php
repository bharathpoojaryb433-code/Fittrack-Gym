<?php

require_once '../config/config.php';
require_once '../config/json.php';
require_once '../includes/auth.php';

requireOwner();

$members = readJson('members.json');
$memberships = readJson('memberships.json');

?>

<?php include '../includes/header.php'; ?>

<div class="dashboard-header">

    <p class="welcome-text">GYM MANAGEMENT</p>

    <h1>👥 Members</h1>

    <p>Manage your gym members.</p>

</div>


<div class="dashboard-grid">

    <div class="dashboard-card">

        <h3>Total Members</h3>

        <h1><?= count($members) ?></h1>

    </div>

    <div class="dashboard-card">

        <h3>Membership Plans</h3>

        <h1><?= count($memberships) ?></h1>

    </div>

</div>

<br>


<div style="margin-bottom:20px;">

    <a href="add-member.php" class="primary-btn">
        ➕ Add Member
    </a>

</div>


<div class="table-card">

    <table class="data-table">

        <thead>

            <tr>

                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Weight</th>
                <th>Goal</th>
                <th>Level</th>
                <th>Actions</th>

            </tr>

        </thead>


        <tbody>

        <?php foreach ($members as $member): ?>

            <tr>

                <td>
                    #<?= $member['id'] ?>
                </td>

                <td>
                    <strong>
                        <?= htmlspecialchars($member['name']) ?>
                    </strong>
                </td>

                <td>
                    <?= $member['age'] ?>
                </td>

                <td>
                    <?= $member['weight'] ?> kg
                </td>

                <td>
                    <?= htmlspecialchars($member['goal']) ?>
                </td>

                <td>

                    <span class="badge badge-success">
                        <?= htmlspecialchars($member['level']) ?>
                    </span>

                </td>

                <td>

                    <div class="table-actions">

                        <a href="member-details.php?id=<?= $member['id'] ?>">
                            👁️
                        </a>

                        <a href="edit-member.php?id=<?= $member['id'] ?>">
                            ✏️
                        </a>

                        <form
                            action="../actions/member.php"
                            method="POST"
                            onsubmit="return confirm('Delete this member?');"
                        >

                            <input
                                type="hidden"
                                name="action"
                                value="delete"
                            >

                            <input
                                type="hidden"
                                name="id"
                                value="<?= $member['id'] ?>"
                            >

                            <button
                                type="submit"
                                class="danger-btn"
                            >
                                🗑️
                            </button>

                        </form>

                    </div>

                </td>

            </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

</div>

<?php include '../includes/footer.php'; ?>