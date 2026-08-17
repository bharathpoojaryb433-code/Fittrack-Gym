<?php

require_once '../config/config.php';
require_once '../config/json.php';
require_once '../includes/auth.php';

requireOwner();

$settingsFile = 'settings.json';

$settings = readJson($settingsFile);

if (empty($settings)) {

    $settings = [

        'gymName' => ' GYM',

        'phone' => '',

        'email' => '',

        'address' => '',

        'openingTime' => '06:00',

        'closingTime' => '22:00',

        'defaultRestTime' => 60,

        'darkMode' => false

    ];

}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $settings = [

        'gymName' =>
            trim($_POST['gymName']),

        'phone' =>
            trim($_POST['phone']),

        'email' =>
            trim($_POST['email']),

        'address' =>
            trim($_POST['address']),

        'openingTime' =>
            trim($_POST['openingTime']),

        'closingTime' =>
            trim($_POST['closingTime']),

        'defaultRestTime' =>
            (int)$_POST['defaultRestTime'],

        'darkMode' =>
            isset($_POST['darkMode'])

    ];

    writeJson(
        $settingsFile,
        $settings
    );

    $_SESSION['message'] =
        'Settings saved successfully.';

    header("Location: settings.php");

    exit;
}

?>

<?php include '../includes/header.php'; ?>

<div class="dashboard-header">

    <p class="welcome-text">
        GYM ADMINISTRATION
    </p>

    <h1>⚙️ Settings</h1>

    <p>Manage your gym business settings.</p>

</div>


<?php if (!empty($_SESSION['message'])): ?>

    <div class="success-message">

        <?= htmlspecialchars($_SESSION['message']) ?>

    </div>

    <?php unset($_SESSION['message']); ?>

<?php endif; ?>


<div class="form-card">

<form method="POST">

    <h2>Gym Information</h2>

    <br>


    <div class="form-group">

        <label>Gym Name</label>

        <input
            type="text"
            name="gymName"
            value="<?= htmlspecialchars($settings['gymName']) ?>"
            required
        >

    </div>


    <div class="form-row">

        <div class="form-group">

            <label>Phone</label>

            <input
                type="tel"
                name="phone"
                value="<?= htmlspecialchars($settings['phone']) ?>"
            >

        </div>


        <div class="form-group">

            <label>Email</label>

            <input
                type="email"
                name="email"
                value="<?= htmlspecialchars($settings['email']) ?>"
            >

        </div>

    </div>


    <div class="form-group">

        <label>Gym Address</label>

        <textarea name="address"><?= htmlspecialchars($settings['address']) ?></textarea>

    </div>


    <h2>Gym Timing</h2>

    <br>


    <div class="form-row">

        <div class="form-group">

            <label>Opening Time</label>

            <input
                type="time"
                name="openingTime"
                value="<?= htmlspecialchars($settings['openingTime']) ?>"
            >

        </div>


        <div class="form-group">

            <label>Closing Time</label>

            <input
                type="time"
                name="closingTime"
                value="<?= htmlspecialchars($settings['closingTime']) ?>"
            >

        </div>

    </div>


    <div class="form-group">

        <label>Default Rest Timer (seconds)</label>

        <input
            type="number"
            name="defaultRestTime"
            value="<?= $settings['defaultRestTime'] ?>"
            min="10"
        >

    </div>


    <div class="form-group">

        <label>

            <input
                type="checkbox"
                name="darkMode"
                <?= !empty($settings['darkMode'])
                    ? 'checked' : '' ?>
            >

            Enable Dark Mode

        </label>

    </div>


    <button
        type="submit"
        class="primary-btn"
    >
        💾 Save Settings
    </button>

</form>

</div>

<?php include '../includes/footer.php'; ?>