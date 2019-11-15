<?php
    include('/lib/qrgenerator/qrlib.php');
    $param = $_GET['data'];
	QRcode::png($param,false, QR_ECLEVEL_L, 6);
?>
