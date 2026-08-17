<?php

require_once '../config/config.php';
require_once '../config/json.php';
require_once '../includes/auth.php';

requireMember();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../member/profile.php");
    exit;
}

$members = readJson('members.json');

$userId = $_SESSION['user']['id'];

$name = trim($_POST['name'] ?? '');
$age = (int)($_POST['age'] ?? 0);
$height = (float)($_POST['height'] ?? 0);
$weight = (float)($_POST['weight'] ?? 0);
$goal = trim($_POST['goal'] ?? '');
$level = trim($_POST['level'] ?? '');
$phone = trim($_POST['phone'] ?? '');


foreach ($members as &$member) {

    if ($member['userId'] == $userId) {

        $member['name'] = $name;
        $member['age'] = $age;
        $member['height'] = $height;
        $member['weight'] = $weight;
        $member['goal'] = $goal;
        $member['level'] = $level;
        $member['phone'] = $phone;

        break;
    }
}

unset($member);

writeJson('members.json', $members);


// Update session name
$_SESSION['user']['name'] = $name;

$_SESSION['message'] =
    "Profile updated successfully.";

header("Location: ../member/profile.php");
exit;
?>