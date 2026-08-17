<?php

require_once '../config/config.php';
require_once '../config/json.php';
require_once '../includes/auth.php';

requireOwner();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../owner/members.php");
    exit;
}

$action = $_POST['action'] ?? '';

$members = readJson('members.json');


// =========================
// ADD MEMBER
// =========================
if ($action === 'add') {

    $name = trim($_POST['name'] ?? '');
    $age = (int)($_POST['age'] ?? 0);
    $height = (float)($_POST['height'] ?? 0);
    $weight = (float)($_POST['weight'] ?? 0);
    $goal = trim($_POST['goal'] ?? '');
    $level = trim($_POST['level'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $membershipId = (int)($_POST['membershipId'] ?? 0);

    if ($name === '') {
        $_SESSION['message'] = "Member name is required.";
        header("Location: ../owner/add-member.php");
        exit;
    }

    $newMember = [
        'id' => getNextId($members),
        'userId' => 0,
        'name' => $name,
        'age' => $age,
        'height' => $height,
        'weight' => $weight,
        'goal' => $goal,
        'level' => $level,
        'membershipId' => $membershipId,
        'phone' => $phone,
        'profileImage' => ''
    ];

    $members[] = $newMember;

    writeJson('members.json', $members);

    $_SESSION['message'] = "Member added successfully.";

    header("Location: ../owner/members.php");
    exit;
}


// =========================
// EDIT MEMBER
// =========================
if ($action === 'edit') {

    $id = (int)($_POST['id'] ?? 0);

    foreach ($members as &$member) {

        if ($member['id'] === $id) {

            $member['name'] = trim($_POST['name'] ?? '');
            $member['age'] = (int)($_POST['age'] ?? 0);
            $member['height'] = (float)($_POST['height'] ?? 0);
            $member['weight'] = (float)($_POST['weight'] ?? 0);
            $member['goal'] = trim($_POST['goal'] ?? '');
            $member['level'] = trim($_POST['level'] ?? '');
            $member['phone'] = trim($_POST['phone'] ?? '');
            $member['membershipId'] =
                (int)($_POST['membershipId'] ?? 0);

            break;
        }
    }

    unset($member);

    writeJson('members.json', $members);

    $_SESSION['message'] = "Member updated successfully.";

    header("Location: ../owner/members.php");
    exit;
}


// =========================
// DELETE MEMBER
// =========================
if ($action === 'delete') {

    $id = (int)($_POST['id'] ?? 0);

    $members = array_values(
        array_filter(
            $members,
            function ($member) use ($id) {
                return $member['id'] !== $id;
            }
        )
    );

    writeJson('members.json', $members);

    $_SESSION['message'] = "Member deleted successfully.";

    header("Location: ../owner/members.php");
    exit;
}


header("Location: ../owner/members.php");
exit;
?>