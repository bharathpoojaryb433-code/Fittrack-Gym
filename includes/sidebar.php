<aside class="sidebar">

    <div class="logo">
        FIT<span>TRACK</span>
    </div>

    <?php if ($_SESSION['user']['role'] === 'owner'): ?>

        <nav>

            <a href="dashboard.php">🏠 Dashboard</a>

            <a href="members.php">👥 Members</a>

            <a href="memberships.php">💳 Memberships</a>

            <a href="attendance.php">📅 Attendance</a>

            <a href="workouts.php">🏋️ Workouts</a>

            <a href="exercises.php">💪 Exercises</a>

            <a href="progress.php">📊 Progress</a>

            <a href="foods.php">🥗 Healthy Food</a>

            <a href="settings.php">⚙️ Settings</a>

        </nav>

    <?php else: ?>

        <nav>

            <a href="../member/dashboard.php">
                🏠 Dashboard
            </a>

            <a href="../member/workouts.php">
                🏋️ Workouts
            </a>

            <a href="../member/progress.php">
                📊 Progress
            </a>

            <a href="../member/nutrition.php">
                🥗 Nutrition
            </a>

            <a href="../member/membership.php">
                💳 Membership
            </a>

            <a href="../member/profile.php">
                👤 Profile
            </a>

        </nav>

    <?php endif; ?>

    <a class="logout-link"
       href="../logout.php">

        🚪 Logout

    </a>

</aside>