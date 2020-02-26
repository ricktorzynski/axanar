<?php
require_once __DIR__ . '/bootstrap.php';

$campaigns = getCampaigns();
$cList = "";
foreach ($campaigns as $campaign) {
    $cList .= "<a href='#c" . $campaign['campaign_id'] . "'>" . $campaign['name'] . "</a> &nbsp; &mdash; &nbsp; ";
}

?>
<style>
    :target {
        background-color: #ffa;
        margin-top: -500pt;
        border: 2px red solid;
    }
</style>
<div style="text-align:center;">
    <?php echo $cList; ?>
</div>
<?php
foreach ($campaigns as $campaign) {
    ?>

    <div>
        <p><a name="c<?php echo $campaign['campaign_id']; ?>"></a></p>
        <h1><?php echo $campaign['name']; ?> Donors</h1>
        </p>
        <p>
            <?php
            $donors = getDonorsForCampaign($campaign['campaign_id']);
            $nameList = [];
            foreach ($donors as $donor) {
                $altName = $donor['full_name'];
                if (!empty($donor['firstName'])) {
                    $altName = $donor['firstName'] . " " . $donor['lastName'];
                }
                if (!empty($donor['altName'])) {
                    $altName = $donor['altName'];
                }
                $uid = $donor['user_id'];
                if (!empty($altName) && $altName != " ") {
                    array_push($nameList, $altName . ":" . $uid);
                }
            }
            sort($nameList);

            foreach ($nameList as $name) {
                $u = explode(":", $name);
                echo "<span style='width:280px;min-width:280px;max-width:280px;display:inline-block;'><a name='" . $u[1] . "'>" . $u[0] . "</a></span>";
            }
            ?>
        </p>

    </div>

    <?php
}
?>
