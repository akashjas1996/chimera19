<?php
    include('/lib/qrgenerator/qrlib.php');
    $data = $_GET['data'];
    $name = $_GET['name'];
	header('Content-Type: application/png');
	header('Content-Disposition: attachment; filename="'.$name.'.png"');
	$image=QRcode::png($data,false, QR_ECLEVEL_L, 6);
	imagepng($image);
?>
