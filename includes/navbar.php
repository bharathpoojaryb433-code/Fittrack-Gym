<header class="navbar">

    <button
        class="menu-button"
        onclick="toggleSidebar()">

        ☰

    </button>

    <div>

        <h3>FITTRACK GYM</h3>

        <small>
            Fitness Management System
        </small>

    </div>

    <div class="user-area">

        <span>
            👤
            <?= htmlspecialchars($_SESSION['user']['name']) ?>
        </span>

    </div>

</header>