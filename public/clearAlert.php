<?php
require_once __DIR__ . '/bootstrap.php';

if (array_key_exists("userId",$_SESSION))
{
    $userId = $_SESSION['userId'];
    if ($_REQUEST && array_key_exists("alert",$_REQUEST))
    {
        $alertId = $_REQUEST['alert'];
        updateUserAlert($userId,$alertId);
    }
}
