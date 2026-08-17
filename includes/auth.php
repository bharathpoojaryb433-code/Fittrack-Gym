<?php

require_once __DIR__ . '/../config/config.php';

function requireLogin()
{
    if (!isset($_SESSION['user'])) {
        header("Location: ../index.php");
        exit;
    }
}

function requireOwner()
{
    requireLogin();

    if ($_SESSION['user']['role'] !== 'owner') {
        header("Location: ../index.php");
        exit;
    }
}

function requireMember()
{
    requireLogin();

    if ($_SESSION['user']['role'] !== 'member') {
        header("Location: ../index.php");
        exit;
    }
}
?>