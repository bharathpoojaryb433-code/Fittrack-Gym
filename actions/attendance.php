<?php

require_once '../config/config.php';
require_once '../config/json.php';
require_once '../includes/auth.php';

requireLogin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../member/dashboard.php");
    exit;
}

$attendance = readJson('attendance.json');

$memberId = (int)($_POST['memberId'] ?? 0);

$date = date('Y-m-d');
$time = date('H:i:s');


// Check whether already attended today
$alreadyChecked = false;

foreach ($attendance as $record) {

    if (
        $record['memberId'] === $memberId &&
        $record['date'] === $date
    ) {
        $alreadyChecked = true;
        break;
    }
}


if ($alreadyChecked) {

    $_SESSION['message'] =
        "You have already checked in today.";

} else {

    $attendance[] = [

        'id' => getNextId($attendance),

        'memberId' => $memberId,

        'date' => $date,

        'time' => $time,

        'status' => 'Present'

    ];

    writeJson('attendance.json', $attendance);

    $_SESSION['message'] =
        "Attendance marked successfully.";

}


$role = $_SESSION['user']['role'];

if ($role === 'owner') {

    header("Location: ../owner/attendance.php");

} else {

    header("Location: ../member/dashboard.php");

}

exit;
?>