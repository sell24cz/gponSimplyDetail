<?php
include ("inc/lib.php");
include ("inc/gpon.php");

$timeS = date("H:i");

$g = new gpon();

$dsnw = "";
$signal = "";
$ip = "";
$marker = "";
$model = "";

if (isset ($_POST['dsnw']))
{
    $dsnw = formatujPOST('dsnw');
}

if (isset ($_POST['modelolt']))
{
    $model = formatujPOST('modelolt');
}

if (isset ($_POST['marker']))
{
    $marker = formatujPOST('marker');
}
 
if (isset ($_POST['ipolt']))
{
    $ip = formatujPOST('ipolt');
}


if( $marker != "" && $ip != "" && $model != "" )
{

    
    $g->setMarker($marker);
    $g->setIP($ip);
    $community = $g->getCommunity($ip);
    $g->setCommunity($community);
    $g->setModel($model);
    $signal = $g->getSnmpOnuSygnal();
    if ( $signal == '0.00') 
    {
	$signal = '-40';
    }
}


if( $signal != "" )
{
    echo '{ "name": "'. $timeS.'", "values": { "dBm": '.$signal .'}}';
}


?>
