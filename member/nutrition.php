<?php

require_once '../config/config.php';
require_once '../config/json.php';
require_once '../includes/auth.php';

requireMember();

$foods = readJson('foods.json');

?>

<?php include '../includes/header.php'; ?>

<div class="dashboard-header">

    <p class="welcome-text">
        HEALTHY LIFESTYLE
    </p>

    <h1>Nutrition & Healthy Food 🥗</h1>

    <p>
        Healthy food recommendations for your fitness journey.
    </p>

</div>


<div class="nutrition-summary">

    <div class="nutrition-box">
        🔥
        <strong>2200</strong>
        <small>Calories Goal</small>
    </div>

    <div class="nutrition-box">
        🥩
        <strong>150g</strong>
        <small>Protein</small>
    </div>

    <div class="nutrition-box">
        🍚
        <strong>280g</strong>
        <small>Carbs</small>
    </div>

    <div class="nutrition-box">
        💧
        <strong>8</strong>
        <small>Water Glasses</small>
    </div>

</div>


<h2>Recommended Foods</h2>

<br>


<div class="food-grid">

<?php foreach ($foods as $food): ?>

    <div class="food-card">

        <img
            src="../<?= htmlspecialchars($food['image']) ?>"
            alt="<?= htmlspecialchars($food['name']) ?>"
            onerror="this.style.display='none'"
        >

        <div class="food-content">

            <h3>
                <?= htmlspecialchars($food['name']) ?>
            </h3>

            <p>
                <?= htmlspecialchars($food['category']) ?>
            </p>

            <div class="nutrition-values">

                <div class="nutrition-value">
                    <strong>
                        <?= $food['calories'] ?>
                    </strong>
                    <small>Calories</small>
                </div>

                <div class="nutrition-value">
                    <strong>
                        <?= $food['protein'] ?>g
                    </strong>
                    <small>Protein</small>
                </div>

                <div class="nutrition-value">
                    <strong>
                        <?= $food['carbs'] ?>g
                    </strong>
                    <small>Carbs</small>
                </div>

                <div class="nutrition-value">
                    <strong>
                        <?= $food['fat'] ?>g
                    </strong>
                    <small>Fat</small>
                </div>

            </div>

            <br>

            <p>
                <strong>Ingredients:</strong>
                <?= htmlspecialchars($food['ingredients']) ?>
            </p>

        </div>

    </div>

<?php endforeach; ?>

</div>

<?php include '../includes/footer.php'; ?>