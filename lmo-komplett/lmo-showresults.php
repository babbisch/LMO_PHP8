<?PHP
// 
// LigaManager Online 3.02b
// Copyright (C) 1997-2002 by Frank Hollwitz
// webmaster@hollwitz.de / http://php.hollwitz.de
// 
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License as
// published by the Free Software Foundation; either version 2 of
// the License, or (at your option) any later version.
// 
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
// General Public License for more details.
// 
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 675 Mass Ave, Cambridge, MA 02139, USA.
// 
if($file!=""){
  $addp=$PHP_SELF."?action=program&amp;file=".$file."&amp;selteam=";
  $addr=$PHP_SELF."?action=results&amp;file=".$file."&amp;st=";
  $breite=10;
  if($spez==1){$breite=$breite+2;}
  if($datm==1){$breite=$breite+1;}
?>

<table class="lmosta" cellspacing="0" cellpadding="0" border="0">
  <tr>
    <td align="center"><table cellspacing="0" cellpadding="0" border="0"><tr>
<?PHP
  for($i=1;$i<=$anzst;$i++){
    echo "<td align=\"right\" ";
    if($i<>$st){
      echo "class=\"lmost0\"><a href=\"".$addr.$i."\" title=\"".$text[9]."\">".$i."</a>";
      }
    else{
      echo "class=\"lmost1\">".$i;
      }
    echo "&nbsp;</td>";
    if(($anzst>49) && (($anzst%4)==0)){
      if(($i==$anzst/4) || ($i==$anzst/2) || ($i==$anzst/4*3)){echo "</tr><tr>";}
      }
    elseif(($anzst>38) && (($anzst%3)==0)){
      if(($i==$anzst/3) || ($i==$anzst/3*2)){echo "</tr><tr>";}
      }
    elseif(($anzst>29) && (($anzst%2)==0)){
      if($i==$anzst/2){echo "</tr><tr>";}
      }
    }
?>
    <tr></table></td>
  </tr>
  <tr><td align="center" class="lmost3"><table class="lmostb" cellspacing="0" cellpadding="0" border="0"><tr>
    <td class="lmost4" colspan="<?PHP echo $breite; ?>"><?PHP echo $st; ?>. <?PHP echo $text[2]; ?>
<?PHP if($dats==1){ ?>
  <?PHP if($datum1[$st-1]!=""){echo " ".$text[3]." ".$datum1[$st-1];} ?>
  <?PHP if($datum2[$st-1]!=""){echo " ".$text[4]." ".$datum2[$st-1];} ?>
<?PHP } ?>
    </td>
  </tr>

<?PHP for($i=0;$i<$anzsp;$i++){ if(($teama[$st-1][$i]>0) && ($teamb[$st-1][$i]>0)){ ?>
  <tr>

<?PHP if($datm==1){
  if($mterm[$st-1][$i]>0){$dum1=strftime($datf, $mterm[$st-1][$i]);}else{$dum1="";}
?>
    <td class="lmost5"><nobr><?PHP echo $dum1; ?></nobr></td>
<?PHP } ?>

    <td class="lmost5" width="2">&nbsp;</td>
    <td class="lmost5" align="right"><nobr>

<?PHP
  echo "<a href=\"".$addp.$teama[$st-1][$i]."\" title=\"".$text[269]."\">";
  if(($favteam>0) && ($favteam==$teama[$st-1][$i])){echo "<b>";}
  echo $teams[$teama[$st-1][$i]];
  if(($favteam>0) && ($favteam==$teama[$st-1][$i])){echo "</b>";}
  echo "</a>";
?>

    </nobr></td>
    <td class="lmost5" align="center" width="10">-</td>
    <td class="lmost5"><nobr>

<?PHP
  echo "<a href=\"".$addp.$teamb[$st-1][$i]."\" title=\"".$text[269]."\">";
  if (($favteam>0) && ($favteam==$teamb[$st-1][$i])){echo "<b>";}
  echo $teams[$teamb[$st-1][$i]];
  if (($favteam>0) && ($favteam==$teamb[$st-1][$i])){echo "</b>";}
  echo "</a>";
?>

    </nobr></td>
    <td class="lmost5" width="2">&nbsp;</td>
    <td class="lmost5" align="right"><?PHP echo $goala[$st-1][$i]; ?></td>
    <td class="lmost5" align="center" width="8">:</td>
    <td class="lmost5"><?PHP echo $goalb[$st-1][$i]; ?></td>
  <?PHP if($spez==1){ ?>
    <td class="lmost5" width="2">&nbsp;</td>
    <td class="lmost5"><?PHP echo $mspez[$st-1][$i]; ?></td>
  <?PHP } ?>
    <td class="lmost5" width="2">&nbsp;</td>
    <td class="lmost5">

<?PHP
  if($urlb==1){
    if($mberi[$st-1][$i]!=""){echo "<a href=\"".$mberi[$st-1][$i]."\" target=\"_blank\" title=\"".$text[270]."\"><img src=\"lmo-st1.gif\" width=\"16\" height=\"16\" border=\"0\"></a>";}else{echo "&nbsp;";}
    }
  if(($mnote[$st-1][$i]!="") || ($msieg[$st-1][$i]>0)){
    $dummy=addslashes($teams[$teama[$st-1][$i]]." - ".$teams[$teamb[$st-1][$i]]." ".$goala[$st-1][$i].":".$goalb[$st-1][$i]);
    if($msieg[$st-1][$i]==3){$dummy=$dummy." / ".$goalb[$st-1][$i].":".$goala[$st-1][$i];}
    if($spez==1){$dummy=$dummy." ".$mspez[$st-1][$i];}
    if($msieg[$st-1][$i]==1){$dummy=$dummy."\\n\\n".$text[219].":\\n".addslashes($teams[$teama[$st-1][$i]]." ".$text[211]);}
    if($msieg[$st-1][$i]==2){$dummy=$dummy."\\n\\n".$text[219].":\\n".addslashes($teams[$teamb[$st-1][$i]]." ".$text[211]);}
    if($msieg[$st-1][$i]==3){$dummy=$dummy."\\n\\n".$text[219].":\\n".addslashes($text[212]);}
    if($mnote[$st-1][$i]!=""){$dummy=$dummy."\\n\\n".$text[22].":\\n".$mnote[$st-1][$i];}
    echo "<a href=\"javascript:alert('".$dummy."');\" title=\"".str_replace("\\n","&#10;",$dummy)."\"><img src=\"lmo-st2.gif\" width=\"16\" height=\"16\" border=\"0\"></a>";
    }
  else{
    echo "&nbsp;";
    }
?>

    </td>
  </tr>

		
  
<?PHP 
// * Spielfrei-Hack-Beginn1	- Autor: Bernd Hoyer - eMail: info@salzland-info.de
	if (($anzteams-($anzst/2+1))!=0){
	$spielfreia[$i]=$teama[$st-1][$i];
	$spielfreib[$i]=$teamb[$st-1][$i];
	}
// * Spielfrei-Hack-Ende1- Autor: Bernd Hoyer - eMail: info@salzland-info.de 	
}}

 ?>

  </table></td></tr>
  <tr>
    <td><table width="100%" cellspacing="0" cellpadding="0" border="0"><tr>
<?PHP $st0=$st-1;if($st>1){echo "<td class=\"lmost2\"><a href=\"".$addr.$st0."\" title=\"".$text[6]."\">".$text[5]."</a></td>";} ?>
<?PHP $st0=$st+1;if($st<$anzst){echo "<td align=\"right\" class=\"lmost2\"><a href=\"".$addr.$st0."\" title=\"".$text[8]."\">".$text[7]."</a></td>";} ?>
    </tr></table></td>
  </tr>
<!-- * LMO-Zustat-Addon-Beginn	- Autor: Bernd Hoyer - eMail: info@salzland-info.de -->
<tr>  
<td class="lmomain2" align="center">

<?PHP
if ($einzutore==1) {  
$strs=".l98";
$stre=".l98.php";
$str=basename($file);
$file16=str_replace($strs,$stre,$str);
$temp11=basename($zustatdir);
if (file_exists("$temp11/$file16")){
require("$temp11/$file16");

echo $text[4000].$text[38].": ".$zutore[$st]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"." ".$text[38]."&nbsp;".$text[4001].": ".$dstore[$st];

}
} ?>
</td>
</tr>
<!-- * LMO-Zustat-Addon-ENDE	- Autor: Bernd Hoyer - eMail: info@salzland-info.de -->

<!-- * Spielfrei-Hack-Beginn2 - Ab hier bis zum Dateiende wurde alles ersetzt (�berschrieben!). - Autor: Bernd Hoyer - eMail: info@salzland-info.de-->
<tr>  
<td class="lmost2" align="center">

<?PHP } 
if ($einspielfrei==1) { 
if (($anzteams-($anzst/2+1))!=0){
	$spielfreic=array_merge($spielfreia,$spielfreib);
	$hoy5=1;
	for ($hoy8=1;$hoy8<$anzteams+1;$hoy8++) {
		if (in_array($hoy8,$spielfreic)) {
		}
		else {
			if ($hoy5==1) {echo $text[4004].": ";}
			else {echo "";}
			echo "<a href=\"".$addp.$teams[$hoy8[$hoy8]].$hoy8."\" title=\"".$text[269]."\">";
			echo "&nbsp;".$teams[$hoy8]."&nbsp;&nbsp;";
			echo "</a>";
			$hoy5=$hoy5+1;
			
		}
	}
}
}

?>
</td> 
</tr>
</table>
<!-- * Spielfrei-Hack-Ende2 - Autor: Bernd Hoyer - eMail: info@salzland-info.de-->