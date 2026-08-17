<?php

function readJson($file)
{
    $path = DATA_PATH . $file;

    if (!file_exists($path)) {
        return [];
    }

    $data = file_get_contents($path);
    $json = json_decode($data, true);

    return is_array($json) ? $json : [];
}

function writeJson($file, $data)
{
    $path = DATA_PATH . $file;

    file_put_contents(
        $path,
        json_encode($data, JSON_PRETTY_PRINT)
    );

    return true;
}

function getNextId($data)
{
    if (empty($data)) {
        return 1;
    }

    $ids = array_column($data, 'id');

    return max($ids) + 1;
}
?>