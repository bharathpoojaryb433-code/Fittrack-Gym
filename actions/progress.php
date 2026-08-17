<?php

require_once '../config/config.php';
require_once '../config/json.php';
require_once '../includes/auth.php';

requireMember();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../member/progress.php");
    exit;
}

$progress = readJson('progress.json');

$userId = $_SESSION['user']['id'];

$weight = (float)($_POST['weight'] ?? 0);
$workoutCount = (int)($_POST['workoutCount'] ?? 0);
$calories = (int)($_POST['calories'] ?? 0);

$date = date('Y-m-d');


// Calculate BMI
$members = readJson('members.json');

$height = 0;

foreach ($members as $member) {

    if ($member['userId'] == $userId) {
        $height = (float)$member['height'];
        break;
    }
}

$bmi = 0;

if ($height > 0 && $weight > 0) {

    $heightMeters = $height / 100;

    $bmi = round(
        $weight / ($heightMeters * $heightMeters),
        1
    );
}


$progress[] = [

    'id' => getNextId($progress),

    'userId' => $userId,

    'date' => $date,

    'weight' => $weight,

    'bmi' => $bmi,

    'workoutCount' => $workoutCount,

    'calories' => $calories

];

writeJson('progress.json', $progress);


// Also update current member weight
foreach ($members as &$member) {

    if ($member['userId'] == $userId) {

        $member['weight'] = $weight;

        break;
    }
}

unset($member);

writeJson('members.json', $members);

$_SESSION['message'] =
    "Progress saved successfully.";

header("Location: ../member/progress.php");
exit;
?>