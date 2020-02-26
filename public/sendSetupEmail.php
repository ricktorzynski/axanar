<?php
/**
 * Created by JetBrains PhpStorm.
 * User: wwatters
 * Date: 7/6/16
 * Time: 7:55 PM
 * To change this template use File | Settings | File Templates.
 */
require_once __DIR__ . '/bootstrap.php';

if (!array_key_exists("userId",$_REQUEST))
{
    echo '{"status":"missing param"}';
    die();
}

if (!array_key_exists("msg",$_REQUEST))
{
    echo '{"status":"missing param"}';
    die();
}

$userId = $_REQUEST['userId'];
$msg    = $_REQUEST['msg'];

$u = getUserRecord($userId);
if ($u && is_array($u) && count($u)>0)
{
    $u = $u[0];
}

switch($msg)
{
    case "setup":
        $email = $u['email'];
        $password = setResetLink($email);
        if (!is_null($password))
        {
        sendSetupEmail($email, $password);
        echo '{"status":"ok"}';
        } else {
            echo '{"status":"error"}';
        }
        die();
        break;
}

