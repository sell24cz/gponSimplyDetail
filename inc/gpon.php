<?php

    include_once ("inc/lib.php");
    class gpon {
	public $znacznik;
	public $IP;
	public $Model;
	public $Community;

	function constructor()
	{
	    $this->IP = "";
	    $this->Community = "";
	    $this->znacznik = "";
	    $this->Model = "";
	}
	private function getMib($nazwa)
	{
	    $mib = mysql_q("select mib from mib where UPPER(model) = UPPER('$this->Model') and nazwa = '$nazwa'");
	    return( $mib );
	}
	private function getSnmpZnacznik($sn)
	{
	    $this->znacznk = "";
	    $mib = $this->getMib('getSnmpZnacznik');
	    if( $this->IP != "" && $this->Community != "" && $mib != "")
	    {
		snmp_set_oid_output_format(SNMP_OID_OUTPUT_NUMERIC);
	        $snmp_sn = snmp2_real_walk($this->IP, $this->Community, $mib);
    		$q = "STRING: \"$sn\""; 
    		$b = array_search(strtoupper($q),array_map('strtoupper',$snmp_sn) );
		if( $b != "" )
		{
		    $p=explode(".", trim($b));
    		    $this->znacznik = $p[sizeof($p)-2] . '.'.$p[sizeof($p)-1];
		}
	    }
    	    return ($this->znacznik);
	}
	function toOnuBlokada($var)
	{
	    $wynik = "";
	    switch($var)
	    {
		case '1':
		    $wynik = 'autoblock (1)';
		    break;
		case '2':
		    $wynik = 'manualblock (2)';
		    break;
		case '255':
		    $wynik = 'unblock (255)';
		    break;
		default:
		    $wynik = 'unknow';
		    break;
	    }
	    return ($wynik);
	    
	}
    	function toOnuStatus($var)
	{
	    $wynik = "";
	    switch($var)
	    {
		case '0':
		    $wynik = 'invalid (0)';
		    break;
		case '1':
		    $wynik = 'inactive (1)';
		    break;
		case '2':
		    $wynik = 'active (2)';
		    break;
		case '3':
		    $wynik = 'running (3)';
		    break;
		case '4':
		    $wynik = 'activePending (4)';
		    break;
		case '5':
		    $wynik = 'deactivePending (5)';
		    break;
		case '6':
		    $wynik = 'disablePending (6)';
		case '7':
		    $wynik = 'disable (7)';
		    break;
		case '255':
		    $wynik = 'unknown (255)';
		    break;
		default:
		    $wynik = 'unknown';
		    break;
	    }
	    return($wynik);
	}
	function toDeactiveReason($var)
	{
	    $wynik = "";
	    switch($var)
	    {
	    case '1':
		$wynik='none (1)';
		break;
	    case '2':
		$wynik='dgi (2)';
		break;
            case '3':
		$wynik='losi (3)';
		break;
            case '4':
		$wynik='lofi (4)';
		break; 
	    case '5':
		$wynik='sfi (5)';
		break;
	    case '6':
		$wynik='sufi (6)';
		break;
	    case '7':
		$wynik='loai (7)';
		break;
	    case '8':
		$wynik='loami (8)';
		break;
	    case '9':
		$wynik='loki (9)';
		break;
	    case '10':
		$wynik='adminReset (10)';
		break;
	    case '11':
		$wynik='adminActiveChange (11)';
		break;
	    case '12':
		$wynik='adminOltConfiguration (12)';
		break;
	    case '13':
		$wynik='adminSlotRestart (13)';
		break;
	    case '14':
		$wynik='adminSlotRemove (14)';
		break;
	    case '15':
		$wynik='adminRogueOnuCandidate (15)';
		break;
	    case '16':
		$wynik='adminRogueOnu (16)';
		break;
	    case '17':
		$wynik='adminRogueOnuSelfDetectBlock (17)';
		break;
	    case '18':
		$wynik='adminTxOffOptic (18)';
		break;
	    case '19':
		$wynik='adminDeactivate (19)';
		break;
	    case '20':
		$wynik='adminOltDeactivate (20)';
		break;
	    case '21':
		$wynik='adminOmccDown (21)';
		break;
	    case '22':
		$wynik='adminSetRedundancy (22)';
		break;
	    case '23':
		$wynik='adminRemoveOnu (23)';
		break;
	    case '100':
		$wynik='los (100)';
		break;
	    case '101':
		$wynik='onuDeactReasonRanging (101)';
		break;
	    case '102':
		$wynik='onuDeactReasonPasswdAuthentication (102)';
		break;
	    case '103':
		$wynik='onuDeactReasonPasswdInconsistency (103)';
		break;
	    case '104':
		$wynik='onuDeactReasonPasswdMismatch (104)';
		break;
	    case '105':
		$wynik='onuDeactReasonPasswdTimeout (105)';
		break;
	    case '106':
		$wynik='onuDeactReasonPasswdOnuAlarm (106)';
		break;
	    case '107':
		$wynik='onuDeactReasonPasswdDisableEvent (107)';
		break;
	    case '255':
		$wynik='unknown (255)';
		break;
	    default:
		$wynik='unknown';
		break;
	    }
	    return ($wynik);
	}

	function toTime($uptime)
	{
	    $wynik = NULL;
	    if( $uptime != "" )
	    {
		$days = explode(".",(($uptime % 31556926) / 86400));
        	$hours = explode(".",((($uptime % 31556926) % 86400) / 3600));
        	$minutes = explode(".",(((($uptime % 31556926) % 86400) % 3600) / 60));
        	$seconds = explode(".",((((($uptime % 31556926) % 86400) % 3600) %60) ));
        	$strdni = "";
        	if( $days[0] == 1 )
            	    $strdni = "$days[0] Dzień";
        	elseif( $days[0] > 1 )
            	    $strdni = "$days[0] Dni";
        	$wynik = "$strdni  " .  str_pad($hours[0], 2, 0, STR_PAD_LEFT).":". str_pad($minutes[0], 2, 0, STR_PAD_LEFT).":". str_pad($seconds[0], 2, 0, STR_PAD_LEFT);
	    }
    	    return (trim($wynik));
	}
	function search($sn, $IPLokal)
	{
	    $wynik = FALSE;
	    $warunek = "";
	    if( $IPLokal != "all" )
	    {
		$warunek = " where ip = '$IPLokal'";
	    }
	    $this->IP = "";
	    $this->Community = "";
	    $this->znacznik = "";
	    $res = GetSQL("select * from setting $warunek");
	    if( $res )
	    {
		while( $w = $res->fetch_array())
		{
		    $this->IP = $w['ip'];
		    $this->Community = $w['community'];
		    $this->Model = $w['model'];
		    $this->znacznik = $this->getSnmpZnacznik( $sn );
		    
		    if( $this->znacznik != "" )
		    {
		//	echo "jest znacznik $znacznik $IP $Community";
			$wynik = TRUE;
			break;
		    }
		}
	    }
	    return $wynik;
	}
	function getZnacznik()
	{
	    return($this->znacznik);
	}
	function getSnmpOnuModel()
	{
            $wynik = "";
	    $w = NULL;
	    $mib = $this->getMib('getSnmpOnuModel');
    	    $w = snmp2_get($this->IP, $this->Community, $mib . $this->znacznik);
    	    $b = explode(":", $w );
    	    $wynik = str_replace('"', '', $b[1]);
    	    return trim($wynik);
	}

	function getSnmpOnuUpTime()
	{
    	    $wynik = "";
    	    $w = NULL;
	    $mib = $this->getMib('getSnmpOnuUpTime');
	    $w = snmp2_get($this->IP, $this->Community, $mib . $this->znacznik);
            $uptime =  explode( ":", $w);
            $wynik = $uptime[1];
    	    return (trim($wynik ));
	}

	function getSnmpOnuActiveTime()
	{
    	    $wynik = "";
    	    $w = NULL;
	    $mib = $this->getMib('getSnmpOnuActiveTime');
	    $w = snmp2_get($this->IP, $this->Community, $mib . $this->znacznik);
            $uptime =  explode( ":", $w);
            $wynik = $uptime[1];
	    return (trim($wynik ));
	}

	function getSnmpOnuInActiveTime()
	{
    	    $wynik = "";
    	    $w = NULL;
	    $mib = $this->getMib('getSnmpOnuInActiveTime');
	    $w = snmp2_get($this->IP, $this->Community, $mib . $this->znacznik);
            $uptime =  explode( ":", $w);
            $wynik = $uptime[1];
	    return (trim($wynik ));
	}

	function getSnmpOnuSygnal()
	{
    	    $wynik = "";
    	    $w = NULL;
	    $mib = $this->getMib('getSnmpOnuSygnal');
	    $w = snmp2_get($this->IP, $this->Community, $mib . $this->znacznik);
            $wynik =  explode( ":", $w);
	    $wynik = number_format($wynik[1] / 10,2);
	    return (trim($wynik) );
	}

    	function getSnmpOnuStatus()
	{
    	    $wynik = "";
    	    $w = NULL;
	    $mib = $this->getMib('getSnmpOnuStatus');
	    $w = snmp2_get($this->IP, $this->Community, $mib . $this->znacznik);
            $wynik =  explode( ":", $w);
            $wynik = $wynik[1];
	    return (trim($wynik ));
	}

	function getSnmpOnuDeactiveReason()
	{
    	    $wynik = "";
    	    $w = NULL;
	    $mib = $this->getMib('getSnmpOnuDeactiveReason');
	    $w = snmp2_get($this->IP, $this->Community, $mib . $this->znacznik);
            $wynik =  explode( ":", $w);
            $wynik = $wynik[1];
	    return (trim($wynik ));
	}
	function getSnmpOnuId()
	{
	    $wynik = "";
    	    $w = NULL;
	    $mib = $this->getMib('getSnmpOnuId');
	    $w = snmp2_get($this->IP, $this->Community, $mib . $this->znacznik);
            $wynik =  explode( ":", $w);
            $wynik = $wynik[1];
	    return (trim($wynik ));
	}
    	function getSnmpOnuIpWan()
	{
	    $wynik = NULL;
	    $mib = $this->getMib('getSnmpOnuIPWan');
    	    $wynik = snmp2_real_walk($this->IP, $this->Community , $mib . $this->znacznik);
    	    return ( $wynik);
	}
	function getSnmpOnuMacWan()
	{
	    $wynik = NULL;
	    $mib = $this->getMib('getSnmpOnuMACWan');
    	    $wynik = snmp2_real_walk($this->IP, $this->Community , $mib . $this->znacznik);
    	    return ( $wynik);
	}
	function getSnmpOnuDystans()
	{
	    $wynik = "";
    	    $w = NULL;
	    $mib = $this->getMib('getSnmpOnuDystans');
	    $w = snmp2_get($this->IP, $this->Community, $mib . $this->znacznik);
            $wynik =  explode( ":", $w);
            $wynik = $wynik[1];
	    return (trim($wynik) );
	}
	function getSnmpOnuProfil()
	{
	    $wynik = "";
    	    $w = NULL;
	    $mib = $this->getMib('getSnmpOnuProfil');
	    $w = snmp2_get($this->IP, $this->Community, $mib . $this->znacznik);
            $wynik =  explode( ":", $w);
	    $wynik = str_replace('"', '', $wynik[1]);
	    return (trim($wynik) );
	}
	function getSnmpOnuBlokada()
	{
	    $wynik = "";
    	    $w = NULL;
	    $mib = $this->getMib('getSnmpOnuBlokada');
	    $w = snmp2_get($this->IP, $this->Community, $mib . $this->znacznik);
            $wynik =  explode( ":", $w);
            $wynik = $wynik[1];
	    return (trim($wynik ));
	}
	function getSnmpOnuActiveFirmware()
	{
	    $wynik = "";
    	    $w = NULL;
	    $mib = $this->getMib('getSnmpOnuActiveFirmware');
	    $w = snmp2_get($this->IP, $this->Community, $mib . $this->znacznik);
            $wynik =  explode( ":", $w);
	    $wynik = str_replace('"', '', $wynik[1]);
	    return (trim($wynik ));
	}
    }
?>
