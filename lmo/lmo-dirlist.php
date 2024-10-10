<?php
/** Liga Manager Online 4
  *
  * http://lmo.sourceforge.net/
  *
  * This program is free software; you can redistribute it and/or
  * modify it under the terms of the GNU General Public License as
  * published by the Free Software Foundation; either version 2 of
  * the License, or (at your option) any later version.
  *
  * This program is distributed in the hope that it will be useful,
  * but WITHOUT ANY WARRANTY; without even the implied warranty of
  * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
  * General Public License for more details.
  *
  * REMOVING OR CHANGING THE COPYRIGHT NOTICES IS NOT ALLOWED!
  *
  * $Id$
  */


$todo=isset($_GET['todo']) && $_GET['todo'] != "" ? $_GET['todo'] : (isset($_GET['file']) && $_GET['file'] != "" ? 'edit' : '');
$addi=$_SERVER["PHP_SELF"]."?todo=".$todo."&amp;file=";

$_SESSION['liga_sort']=isset($_REQUEST['liga_sort'])?$_REQUEST['liga_sort']:$liga_sort;
$_SESSION['liga_sort_direction']=isset($_REQUEST['liga_sort_direction'])?$_REQUEST['liga_sort_direction']:$liga_sort_direction;
$subdir=str_replace(array('../','./'),array('',''),$subdir);
$verz=substr($dirliga.$subdir,-1)=='/'?opendir(substr(PATH_TO_LMO."/".$dirliga.$subdir,0,-1)):opendir(PATH_TO_LMO."/".$dirliga.$subdir);
$liga_counter=0;
$unbenannte_liga_counter=0;
$ligadatei=array();
while($files=readdir($verz)){
  if(strtolower(substr($files,-4))==".l98"){
    $sekt="";
    $datei = fopen(PATH_TO_LMO."/".$dirliga.$subdir.$files,"rb");
    if ($datei && check_hilfsadmin($files)) {

      $ligadatei[$liga_counter]['file_date']=filemtime(PATH_TO_LMO."/".$dirliga.$subdir.$files); //Datum
      $ligadatei[$liga_counter]['file_name']=$files;

      $ligadatei[$liga_counter]['liga_name']="";  //Liganame
      $ligadatei[$liga_counter]['aktueller_spieltag']="";  //Aktueller Spieltag
      $ligadatei[$liga_counter]['anz_teams']="";  //Anzahl der Mannschaften
      $ligadatei[$liga_counter]['icon']="";  //Liga-Icon
      $ligadatei[$liga_counter]['rundenbezeichnung']=$text[2];  //Spieltag oder Pokalrunde
      while (!feof($datei)) {
        $zeile = fgets($datei,1000);
        $zeile=trim($zeile);
        if((substr($zeile,0,1)=="[") && (substr($zeile,-1)=="]")){  //Sektion
          $sekt=substr($zeile,1,-1);
        }elseif((strpos($zeile,"=")!==false) && (substr($zeile,0,1)!=";") && ($sekt=="Options")){  //Wert
          $option=explode("=",$zeile,2);
          $option_name=$option[0];
          $option_wert=isset($option[1])?$option[1]:'';
          if($option_name=="Name"){$ligadatei[$liga_counter]['liga_name']=$option_wert;}
          if($option_name=="Actual"){$ligadatei[$liga_counter]['aktueller_spieltag']=$option_wert;}
          if($option_name=="Teams"){$ligadatei[$liga_counter]['anz_teams']=$option_wert;}
          if($option_name=="icon"){$ligadatei[$liga_counter]['icon']=$option_wert;}
          if($option_name=="Type"){
            $ligadatei[$liga_counter]['liga_typ']=$option_wert;
            if($option_wert=="1"){$ligadatei[$liga_counter]['rundenbezeichnung']=$text[370];}
          }
          //Alle benötigten Werte gefunden -> Abbruch
          if($ligadatei[$liga_counter]['liga_name']!="" &&
             $ligadatei[$liga_counter]['aktueller_spieltag']!="" &&
             $ligadatei[$liga_counter]['anz_teams']!='') break;
        }
      }
      fclose($datei);
      if($ligadatei[$liga_counter]['liga_name']==""){
        $unbenannte_liga_counter++;
        $ligadatei[$liga_counter]['liga_name']=$text[507]." ".$unbenannte_liga_counter;
      }
      if($ligadatei[$liga_counter]['aktueller_spieltag']!=""){
        if($ligadatei[$liga_counter]['rundenbezeichnung']!=$text[2]){  //Pokal
          $t5=strlen(decbin($ligadatei[$liga_counter]['anz_teams']));
          $Number_of_teams = $ligadatei[$liga_counter]['anz_teams'];
          switch ($ligadatei[$liga_counter]['aktueller_spieltag']) {
            case ($t5):
              if ($Number_of_teams == 24) {  // Falls das KO-Turnier mit 24 Mannschaften erstellt wurde - Finale
                $ligadatei[$liga_counter]['rundenbezeichnung'] = $text[374];
              }
              break;
            case ($t5-1):
              if ($Number_of_teams == 24) {  // Falls das KO-Turnier mit 24 Mannschaften erstellt wurde - vierte Runde (Halbfinale)
                $ligadatei[$liga_counter]['rundenbezeichnung']=$text[373];
              } else {
                $ligadatei[$liga_counter]['rundenbezeichnung']=$text[374];
              }
              break;
            case ($t5-2):
              if ($Number_of_teams == 24) {  // Falls das KO-Turnier mit 24 Mannschaften erstellt wurde - dritte Runde (Viertelfinale)
                $ligadatei[$liga_counter]['rundenbezeichnung']=$text[372];
              } else {
                $ligadatei[$liga_counter]['rundenbezeichnung']=$text[373];
              }
              break;
            case ($t5-3):
              if ($Number_of_teams == 24) {  // Falls das KO-Turnier mit 24 Mannschaften erstellt wurde - zweite Runde (Achtelfinale)
                $ligadatei[$liga_counter]['rundenbezeichnung']=$text[371];
              } else {
                $ligadatei[$liga_counter]['rundenbezeichnung']=$text[372];
              }
              break;
            case ($t5-4):
              if ($Number_of_teams == 24) {  // Falls das KO-Turnier mit 24 Mannschaften erstellt wurde - erste Runde (Runde 1)
                $ligadatei[$liga_counter]['rundenbezeichnung']=$text[370]." 1";  // Habe hier fest die Zahl 1 eingfügt weil in Deiner lmo-dirlist.php die Variable ['aktueller_spieltag'] in einem KO-Turnier nicht dargestellt wird. Auch wenn es bei Turnieren ab 32 Teams Runden vorher gibt.
              } else {
                $ligadatei[$liga_counter]['rundenbezeichnung']=$text[371];
              }
              break;
          }
        }
      }else{
        $ligadatei[$liga_counter]['rundenbezeichnung']="";
      }
      $liga_counter++;
    }
  }
}
closedir($verz);

usort($ligadatei,'cmp');
if (isset($_SESSION['liga_sort_direction']) && $_SESSION['liga_sort_direction']=='desc') $ligadatei=array_reverse($ligadatei);?>

<div class="container">
	<div class="row">
		<div class="col-4 offset-1 text-start d-none d-lg-block"><b><?php echo $text[529];?></b></div>
		<div class="col text-start d-lg-none"><b><?php echo $text[529];?></b></div>
		<?php
  if (isset($_SESSION['lmouserok']) && $_SESSION['lmouserok']>0) {?>
		<div class="col-2 text-start d-none d-lg-block"><b><?php echo $text[531];?></b></div><?php
  }?>
		<div class="col-2 text-start d-none d-lg-block"><b><?php echo $text[2]."/".$text[370];?></b></div>
		<div class="col-2 text-start d-none d-lg-block"><b><?php echo $text[530];?></b></div>
	</div>
<?php foreach($ligadatei as $liga){?>
	<div class="row">
		<div class="col-4 offset-1 text-start d-none d-lg-block"><a href="<?php echo $addi.$subdir.$liga['file_name']."&amp;st=".$liga['aktueller_spieltag']?>"><?php echo  HTML_smallLigaIcon($liga['icon'],"alt='' width='24'","");?><?php echo $liga['liga_name']?></a></div>
		<div class="col text-start d-lg-none"><a href="<?php echo $addi.$subdir.$liga['file_name']."&amp;st=".$liga['aktueller_spieltag']?>"><?php echo $liga['liga_name']?></a></div>
		<?php
  if (isset($_SESSION['lmouserok']) && $_SESSION['lmouserok']>0) {?>
      		<div class="col-2 text-start d-none d-lg-block"><?php echo $liga['file_name']?></div><?php
  }?>
		<div class="col-2 text-start d-none d-lg-block">
		<?php echo $liga['rundenbezeichnung'];
		if($liga['liga_typ'] == 0) {
		   echo " ".$liga['aktueller_spieltag'];
		}
		?></div>
		<div class="col-2 text-start d-none d-lg-block"><?php echo datefmt_format($fmt, filemtime(PATH_TO_LMO."/".$dirliga.$subdir.$liga['file_name']))?>
		<?php //echo date($defdateformat, filemtime(PATH_TO_LMO."/".$dirliga.$subdir.$liga['file_name']))?></div>
	</div><?php
}
if($liga_counter==0){echo "<div class='col'>[".$text[223]."]</div>";}
?>
</div>
<?php

function cmp ($a1, $a2) {
  $sort=(isset($_SESSION['liga_sort']) && isset($a1[$_SESSION['liga_sort']]) && isset($a1[$_SESSION['liga_sort']]))?$_SESSION['liga_sort']:'liga_name';
  if (is_numeric($a1[$sort]) && is_numeric($a2[$sort])) {  //Numerischer Vergleich
    if ($a2[$sort]==$a1[$sort]) return 0;
    return ($a1[$sort]>$a2[$sort]) ? 1 : -1;
  }else{ //Stringvergleich
    $a1[$sort]=strtr($a1[$sort],"¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ","YuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy");
    $a2[$sort]=strtr($a2[$sort],"¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ","YuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy");
    return  strnatcasecmp($a1[$sort],$a2[$sort]);
  }
}
?>
