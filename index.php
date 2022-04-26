<?php

include('inc/lib.php') ;
include('inc/webFunction.php') ;

include ("inc/gpon.php");






if ( formatujPOST('addServer') == 'Add' AND formatujPOST('ip') != 'NULL' AND formatujPOST('community') != 'NULL' ) {
    
  mysql_q("insert into setting set ip='".formatujPOST('ip')."',community='".formatujPOST('community')."'  ");

}


if ( formatujGET('method') == 'del' AND formatujGET('id') != 'NULL' ) {
    
  mysql_q("delete from setting where id='".formatujGEt('id')."' limit 1  ");

}


if (formatujPOST('search') != NULL AND formatujPOST('dsnw') != NULL ){


  $g = new gpon();
 
  if ( formatujPOST('ip') == NULL ) { $searchIP = 'ALL';} else { $searchIP = formatujPOST('ip'); }

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

}
} 


?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content=""Simply GPON search ONU">
    <meta name="author" content=sell24.cz">

    <title>Gpon v2.1</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/navbars/">

    

    <!-- Bootstrap core CSS -->
<link href="bootstrap/assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="navbar.css" rel="stylesheet">
  </head>
  <body>
    




  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light rounded" aria-label="Eleventh navbar example">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><b>G</b>pOn</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample09">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="index.php">Search</a>
            </li>

            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="index.php?action=setting">Setting</a>
            </li>

          </ul>

        </div>
      </div>
    </nav>

<br /> 
<?php 

if (formatujGET('action') != 'setting') {

  echo '

    <div>
      <div class="bg-light p-5 rounded">
        <div class="col-sm-8 mx-auto">


        <form class="row gy-2 gx-3 align-items-center" method="post" >

<select name="ip" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
';
echo '<option value="all" selected>ALL</option>';
$polacz = NEW BAZA ;
$zapytanie = GetSQL ("select * from  setting  ");
while($row = sql_fetch_array($zapytanie)) {


echo '<option value="'.$row['ip'].'">'.$row['ip'].'</option>';



}
echo'
</select>

          <input name="dsnw" class="form-control" type="text" placeholder="Search" aria-label="Search">

          <input class="form-control" type="submit" name="search"  value="Search" placeholder="Search" >


        </form>


';

if (formatujPOST('search') != NULL ){

  

echo '

<br/><br/>

<p>



<div class="row">
  <div class="col-6">
    <div class="list-group" id="list-tab" role="tablist">
    <a href="#" class="list-group-item list-group-item-primary ">DSNW: '.formatujPOST('dsnw').'
    <a href="#" class="list-group-item list-group-item-action">Model: '.$model.'</a>
    <a href="#" class="list-group-item list-group-item-action list-group-item-success"> Signal: '.$signal.'</a>

    <a href="#" class="list-group-item list-group-item-action list-group-item-secondary">Status: '.$status.'</a>
    <a href="#" class="list-group-item list-group-item-warning ">ONU Profil: '.$profil.'
    </a>

    <a href="#" class="list-group-item list-group-item-action list-group-item-secondary"> Uptime: '.$uptime.'</a>
    <a href="#" class="list-group-item list-group-item-action ">ActiveTime: '.$ActiveTime.' </a>
    <a href="#" class="list-group-item list-group-item-action list-group-item-secondary">InActiveTime: '.$InActiveTime.' </a>
    

 
    </div>
  </div>
  <div class="col-6">
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane active" id="list-prince" role="tabpanel" aria-labelledby="list-prince-list">
      
 ';

 $model = trim("$model");
 if ($model == NULL ) {$model = 'H660GM';} ;

 echo '<img style="width:100%;" src="img/'.$model.'.png"> ';  

 echo '

 </div>
    </div>
  </div>
</div>


<div class="row">
  <div class="col-6">
    <div class="list-group" id="list-tab" role="tablist">
    
    
    
    

    <a href="#" class="list-group-item list-group-item-action list-group-item-secondary">    DeactiveReason: '.$DeactiveReason.'    </a>
    <a href="#" class="list-group-item list-group-item-action ">ONU ID: '.$ONU_ID.'</a>
    <a href="#" class="list-group-item list-group-item-action list-group-item-secondary">ONU Distance information: '.$distance.'</a>
    <a href="#" class="list-group-item list-group-item-action ">Onu Block Status: '.$block.'</a>
    <a href="#" class="list-group-item list-group-item-action list-group-item-secondary">ONU ActiveFirmware: '.$ActiveFirmware.'</a>


 
    </div>
  </div>
  <div class="col-6">
    <div class="list-group" id="list-tab" role="tablist">

  
';

foreach($IP as $value){

  $i = explode(' ',$value) ;

  echo " <a href=\"http://".$i[1]."\" target=\"_blank\" class=\"list-group-item list-group-item-action list-group-item-secondary\"  >".$i[0]. ".".$i[1]." </a> <br>";


}

echo '
    
    
    <a href="#" class="list-group-item list-group-item-action "> 
';

foreach($WAN as $value){
  echo $value . "<br>";
}

echo'
 </a>
    </div>
  </div>
</div>

</div>
';

}

}
?>
</p>


<p>


<?php

if (formatujGET('action') == 'setting' ) {

echo '

<h2>GPON List</h2>
<form class="row gy-2 gx-3 align-items-center" method="post">
<div class="input-group mb-3">

  <input type="text" class="form-control" name="ip" placeholder="IP" aria-label="IP">
  <span class="input-group-text">and</span>
  <input type="text" class="form-control" name="community" placeholder="Comunity" aria-label="Comunity">
  <input type="submit" class="form-control" value="Add" name="addServer">
  
</div>
    </form>

    <table class="table table-striped">
    <thead>
    <tr>

      <th scope="col">IP</th>
      <th scope="col">Comunity</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>


';



$polacz = NEW BAZA ;
$zapytanie = GetSQL ("select * from  setting  ");
while($row = sql_fetch_array($zapytanie)) {

$cm = '********';
if ($row['community'] == NULL ) {$cm = 'NULL';} 

echo '
<tr>
<td >'.$row['ip'].'</td>
<td >'.$cm.'</td>
<td ><a class="link-danger" href="index.php?id='.$row['id'].'&action=setting&method=del">delete</a></td>
</tr>

';


}


echo '
  </tbody>
</table>
';
}

?>

 </p>

        </div>
    
      </div>
      <hr>
      <center>GPON v1.2</center>
      <br />
    </div>


  </div>



    <script src="bootstrap/assets/dist/js/bootstrap.bundle.min.js"></script>

      
  </body>
</html>
