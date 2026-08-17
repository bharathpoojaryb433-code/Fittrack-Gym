<?php

require_once '../config/config.php';
require_once '../config/json.php';
require_once '../includes/auth.php';

requireOwner();

$foods = readJson('foods.json');

?>

<?php include '../includes/header.php'; ?>

<div class="dashboard-header">

    <p class="welcome-text">
        NUTRITION MANAGEMENT
    </p>

    <h1>🥗 Healthy Foods</h1>

    <p>Add healthy food information for gym members.</p>

</div>


<div class="form-card">

    <h2>Add Healthy Food</h2>

    <br>

    <form method="POST">

        <div class="form-row">

            <div class="form-group">

                <label>Food Name</label>

                <input
                    type="text"
                    name="name"
                    placeholder="Chicken Breast"
                    required
                >

            </div>


            <div class="form-group">

                <label>Category</label>

                <select name="category">

                    <option>High Protein</option>
                    <option>Healthy Carbs</option>
                    <option>Fruits</option>
                    <option>Vegetables</option>
                    <option>Healthy Fats</option>

                </select>

            </div>

        </div>


        <div class="form-row">

            <div class="form-group">

                <label>Calories</label>

                <input
                    type="number"
                    name="calories"
                    required
                >

            </div>


            <div class="form-group">

                <label>Protein (g)</label>

                <input
                    type="number"
                    step="0.1"
                    name="protein"
                >

            </div>

        </div>


        <div class="form-row">

            <div class="form-group">

                <label>Carbs (g)</label>

                <input
                    type="number"
                    step="0.1"
                    name="carbs"
                >

            </div>


            <div class="form-group">

                <label>Fat (g)</label>

                <input
                    type="number"
                    step="0.1"
                    name="fat"
                >

            </div>

        </div>


        <div class="form-group">

            <label>Ingredients</label>

            <textarea
                name="ingredients"
                placeholder="Chicken, spices..."
            ></textarea>

        </div>


        <button
            type="submit"
            class="primary-btn"
        >
            ➕ Add Food
        </button>

    </form>

</div>


<br>


<div class="food-grid">

<?php foreach ($foods as $food): ?>

    <div class="food-card">

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
                <?= htmlspecialchars($food['ingredients']) ?>
            </p>

        </div>

    </div>

<?php endforeach; ?>

</div>


<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $foods[] = [

        'id' => getNextId($foods),

        'name' => trim($_POST['name']),

        'category' => trim($_POST['category']),

        'calories' => (int)$_POST['calories'],

        'protein' => (float)$_POST['protein'],

        'carbs' => (float)$_POST['carbs'],

        'fat' => (float)$_POST['fat'],

        'ingredients' =>
            trim($_POST['ingredients']),

        'image' =>
            'assets/images/foods/default.jpg'

    ];

    writeJson('foods.json', $foods);

    header("Location: foods.php");

    exit;
}

?>

<?php include '../includes/footer.php'; ?>