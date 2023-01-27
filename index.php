<?php
ini_set("display_errors", 1);
error_reporting(E_ERROR);

include('inc/lib.php') ;
include('inc/notice.php') ;
include('inc/webFunction.php') ;

include ("/var/www/dasan/inc/gpon.php");
$notice = new notice ;
$g = new gpon();

require __DIR__ . '/vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__ . '/templates');
$twig = new Environment($loader);

if (formatujPOST('ip') != NULL AND formatujPOST('dsnw') != NULL )
{
  $searchIP = formatujPOST('ip');
//  if ( formatujPOST('ip') == NULL ) { $searchIP = 'ALL';} else { $searchIP = formatujPOST('ip'); }

  if( $g->search("".formatujPOST('dsnw')."","".$searchIP."" ))
  {

	$model =  $g->getSnmpOnuModel();
	$signal = $g->getSnmpOnuSygnal();
	$status = $g->toOnuStatus($g->getSnmpOnuStatus());
	$profil = $g->getSnmpOnuProfil();
	$uptime = $g->toTime($g->getSnmpOnuUpTime());
	$ActiveTime = $g->toTime($g->getSnmpOnuActiveTime());
	$InActiveTime = $g->toTime($g->getSnmpOnuInActiveTime());
	$DeactiveReason = $g->toDeactiveReason($g->getSnmpOnuDeactiveReason());;
	$ONU_ID = $g->getSnmpOnuId();
	$distance = $g->getSnmpOnuDystans();
	$block = $g->toOnuBlokada($g->getSnmpOnuBlokada());
	$ActiveFirmware = $g->getSnmpOnuActiveFirmware();
	$IP = $g->getSnmpOnuIpWan();
	$WAN =  $g->getSnmpOnuMacWan();
	$marker = $g->getMarker();
	$ipolt = $g->getOLTIp();
	$modelolt = 'Dasan';

//	echo $znacznik;
//	echo "M: ". $model;

}

} 

$ipOLT= $g->getAllOLT();
//array('83.242.95.227', '2.2.2.2');

// load contents 

echo $twig->render('main.html.twig', 
[
'dsnw' => formatujPOST('dsnw'), 
'model' => $model, 
'signal' => $signal, 
'status' => $status, 
'onuprofil' => $profil, 
'uptime' => $uptime, 
'deactivation' => $DeactiveReason, 
'onuid' => $ONU_ID,
'onublockstatus' => $block, 
'onufirmware' => $ActiveFirmware, 
'status' => $status, 
'activetime' => $ActiveTime, 
'inactivetime' => $InActiveTime, 
'onudistance' => $distance,
'marker' => $marker,
'ipolt' => $ipolt,
'ip' => $IP,
'ipOLT' => $ipOLT,
'modelolt' => $modelolt  
]);



if ( formatujPOST('addServer') == 'Add' AND formatujPOST('ip') != 'NULL' AND formatujPOST('community') != 'NULL' ) {
	mysql_q("insert into setting set ip='".formatujPOST('ip')."',community='".formatujPOST('community')."', model='Dasan'  ");
	$notice->showAlertOK();
  }

  if ( formatujPOST('method') == 'Delete' AND formatujPOST('ip') != 'NULL' ) {
	mysql_q("delete from setting where ip='".formatujPOST('ip')."' limit 1  ");
	$notice->showAlertOK();
  }



?>

