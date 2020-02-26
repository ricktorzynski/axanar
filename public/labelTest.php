<?php
require('USPSLabel.php');

echo '<pre>'; print_r(USPSLabel()); echo '</pre>';
$USPSResponse = USPSLabel();
$USPSLabel = $USPSResponse['DeliveryConfirmationV3.0Response']['DeliveryConfirmationLabel']['VALUE'];



?>