<?php
$confirmLoggedIn = true;
require_once __DIR__ . '/bootstrap.php';
if (!array_key_exists("hash",$_REQUEST))
{
    die();
}
$hash = $_REQUEST['hash'];
$qry = encrypt_decrypt("decrypt",$hash);
$qryElelements = explode(":",$qry);
//var_dump($qryElelements);
//die();
if (!is_array($qryElelements))
    die();
if (count($qryElelements)<2)
    die();
$userId = $qryElelements[0];
if ($userId!=getUserId())
    die();
$skuId = $qryElelements[1];
$el = getSkuItem($skuId);
if (!is_array($el) || count($el) < 1)
{
    die();
}
$itm = $el[0];

switch($itm['type']) {
    case 1:
        echo "<script>location='" . $itm['link'] . "';</script>";
        break;
    case 2:
        echo "<script>location='" . $itm['link'] . "';</script>";
        break;
    case 3:
    case 4:
        echo "<script>location='" . $itm['link'] . "';</script>";
        break;
}

addToAudit("assetDownloaded",$skuId,"");
