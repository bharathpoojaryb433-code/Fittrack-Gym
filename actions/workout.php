<?php

require_once '../config/config.php';
require_once '../config/json.php';
require_once '../includes/auth.php';

requireMember();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../member/workouts.php");
    exit;
}

$workouts = readJson('workouts.json');

$userId = $_SESSION['user']['id'];

$exerciseId = (int)($_POST['exerciseId'] ?? 0);

$exerciseName = trim($_POST['exerciseName'] ?? '');

$sets = (int)($_POST['sets'] ?? 0);

$reps = (int)($_POST['reps'] ?? 0);

$weight = (float)($_POST['weight'] ?? 0);

$duration = (int)($_POST['duration'] ?? 0);

$calories = (int)($_POST['calories'] ?? 0);

$date = date('Y-m-d');
$time = date('H:i:s');


$newWorkout = [

    'id' => getNextId($workouts),

    'userId' => $userId,

    'exerciseId' => $exerciseId,

    'exerciseName' => $exerciseName,

    'sets' => $sets,

    'reps' => $reps,

    'weight' => $weight,

    'duration' => $duration,

    'calories' => $calories,

    'date' => $date,

    'time' => $time,

    'status' => 'Completed'

];


$workouts[] = $newWorkout;

writeJson('workouts.json', $workouts);

$_SESSION['message'] =
    "Workout completed successfully! 💪";

header("Location: ../member/workouts.php");

exit;
?>