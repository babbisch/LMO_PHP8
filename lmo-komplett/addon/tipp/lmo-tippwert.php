<?
// 
// LigaManager Online 3.02
// Copyright (C) 1997-2002 by Frank Hollwitz
// webmaster@hollwitz.de / http://php.hollwitz.de
// 
// Tippspiel-AddOn 1.20
// Copyright (C) 2002 by Frank Albrecht
// fkalbrecht@web.de
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
if ($endtab == 0) {
  if (isset($anzst)) {
    $endtab = $anzst;
  }
  $tabdat = "";
} else {
  $tabdat = $endtab.". ".$text[2];
}
 
//  if($stwertmodus=="bis" ){$endtab=$anzst;}
if ($all == 1) {
  $endtab = 0;
  $tabdat = "";
  $anzst = 0;
} else {
  $st = $endtab;
}
if (!isset($wertung)) {
  $wertung = "einzel";
}
if (!isset($gewicht)) {
  $gewicht = "absolut";
}
if (!isset($stwertmodus)) {
  $stwertmodus = "bis";
}
if (($tabdat != "" && $stwertmodus == "nur") || $all == 1) {
  $tipp_showstsiege = 0;
}
if (!isset($tipp_anzseite1)) {
  $tipp_anzseite1 = 30;
}
if (!isset($von)) {
  $von = 1;
}
if (!isset($start)) {
  $start = 1;
}
if (!isset($eigpos)) {
  $eigpos = 1;
}
if ($tipp_anzseite1 < 1) {
  $tipp_anzseite1 = 30;
}
 
if ($endtab > 1 && $tabdat != "" && $stwertmodus != "nur") {
  $endtab--;
  if ($wertung == "einzel" || $wertung == "intern") {
    require(PATH_TO_ADDONDIR."/tipp/lmo-tippcalcwert.php");
  } else {
    require(PATH_TO_ADDONDIR."/tipp/lmo-tippcalcwertteam.php");
  }
   
  if ($wertung == "team") {
    $anztipper = $teamsanzahl;
  }
  $platz1 = array("");
  $platz1 = array_pad($array, $anztipper+1, "");
  for($x = 0; $x < $anztipper; $x++) {
    $x3 = intval(substr($tab0[$x], -7));
    $platz1[$x3] = $x+1;
  }
  $endtab++;
}
if ($wertung == "einzel" || $wertung == "intern") {
  require(PATH_TO_ADDONDIR."/tipp/lmo-tippcalcwert.php");
} else {
  require(PATH_TO_ADDONDIR."/tipp/lmo-tippcalcwertteam.php");
}
 
if ($wertung == "team") {
  $anztipper = $teamsanzahl;
}
$platz0 = array("");
if (!isset($anztipper)) {
  $anztipper = 0;
}
$platz0 = array_pad($array, $anztipper+1, "");
for($x = 0; $x < $anztipper; $x++) {
  $x3 = intval(substr($tab0[$x], -7));
  $platz0[$x3] = $x+1;
}
if ($tabdat == "") {
  $addt1 = $_SERVER['PHP_SELF']."?action=tipp&amp;todo=wert&amp;all=".$all."&amp;file=".$file."&amp;gewicht=".$gewicht."&amp;wertung=";
} else {
  $addt1 = $_SERVER['PHP_SELF']."?action=tipp&amp;todo=wert&amp;stwertmodus=".$stwertmodus."&amp;file=".$file."&amp;gewicht=".$gewicht."&amp;endtab=".$endtab."&amp;wertung=";
}
$addr = $_SERVER['PHP_SELF']."?action=tipp&amp;todo=wert&amp;stwertmodus=".$stwertmodus."&amp;gewicht=".$gewicht."&amp;all=".$all."&amp;file=".$file."&amp;wertung=".$wertung."&amp;teamintern=".str_replace(" ", "%20", $teamintern)."&amp;endtab=";
if ($tabdat == "") {
  $addt3 = $_SERVER['PHP_SELF']."?action=tipp&amp;todo=wert&amp;stwertmodus=".$stwertmodus."&amp;gewicht=".$gewicht."&amp;all=".$all."&amp;file=".$file."&amp;wertung=".$wertung."&amp;teamintern=".str_replace(" ", "%20", $teamintern)."&amp;start=";
} else {
  $addt3 = $_SERVER['PHP_SELF']."?action=tipp&amp;todo=wert&amp;stwertmodus=".$stwertmodus."&amp;gewicht=".$gewicht."&amp;all=".$all."&amp;file=".$file."&amp;wertung=".$wertung."&amp;teamintern=".str_replace(" ", "%20", $teamintern)."&amp;endtab=".$endtab."&amp;start=";
}
$addt4 = $_SERVER['PHP_SELF']."?action=tipp&amp;todo=wert&amp;gewicht=".$gewicht."&amp;file=".$file."&amp;endtab=".$endtab."&amp;wertung=".$wertung."&amp;teamintern=".str_replace(" ", "%20", $teamintern)."&amp;stwertmodus=";
if ($tabdat == "") {
  $addt5 = $_SERVER['PHP_SELF']."?action=tipp&amp;todo=wert&amp;all=".$all."&amp;file=".$file."&amp;wertung=".$wertung."&amp;teamintern=".str_replace(" ", "%20", $teamintern)."&amp;gewicht=";
} else {
  $addt5 = $_SERVER['PHP_SELF']."?action=tipp&amp;todo=wert&amp;stwertmodus=".$stwertmodus."&amp;file=".$file."&amp;endtab=".$endtab."&amp;wertung=".$wertung."&amp;teamintern=".str_replace(" ", "%20", $teamintern)."&amp;gewicht=";
}
?>

<table class="lmoInner" cellspacing="0" cellpadding="0" border="0">
  <caption><? if($_SESSION["lmotipperok"]==5){echo $lmotippername;if($lmotipperverein!=""){echo " - ".$lmotipperverein;}}else{echo $text['tipp'][158];} ?></caption><? 
if($tipp_tipperimteam>=0){?>
  <tr>
    <td align="center">
      <table class="lmoMenu" width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
          <th class="nobr"><?
  if ($wertung == "einzel") {
    echo $text['tipp'][61];
  } else {
    echo "<a href=\"".$addt1."einzel\" title=\"".$text['tipp'][59]."\">".$text['tipp'][61]."</a>";
  }?>
          </th>
          <th class="nobr"><?
  if ($wertung == "team") {
    echo $text['tipp'][62];
  } else {
    echo "<a href=\"".$addt1."team\" title=\"".$text['tipp'][60]."\">".$text['tipp'][62]."</a>";
  }?>
          </th><?
  if ($lmotipperverein != "" || $wertung == "intern") {?>
          <th class="nobr"><?
    if ($wertung == "intern") {
      echo $text['tipp'][144];
    } else {
      echo "<a href=\"".$addt1."intern&amp;teamintern=".rawurlencode($lmotipperverein)."\" title=\"".$text['tipp'][144]."\">".$text['tipp'][144]."</a>";
    }?>
          </th><?
  }?>
        </tr>
      </table>
    </td>
  </tr><? 
}
if($all!=1){ ?>
  <tr>
    <td align="center"><?include(PATH_TO_LMO."/lmo-spieltagsmenu.php");?></td>
  </tr><? 
} //if($all!=1)

$dummy = " align=\"right\"";
if ($wertung == "intern") {
  $start = 1;
  $tipp_anzseite1 = $anztipper;
}
if ($tipp_anzseite1 > 0) {
  $tipp_anzseiten = $anztipper/$tipp_anzseite1;
}
if ($tipp_anzseiten > 1) {
?> 
  <tr>
    <td align="center">
      <table cellspacing="0" cellpadding="0" border="0">
        <tr><?
  echo "<td class=\"active\">".$text['tipp'][205]."&nbsp;</td>";
  for($i = 0; $i < $tipp_anzseiten; $i++) {
    $von = ($i * $tipp_anzseite1)+1;
    $bis = ($i+1) * $tipp_anzseite1;
    if ($bis > $anztipper) {
      $bis = $anztipper;
    }
    if ($von != $start) {
      echo "<td ><a href=\"".$addt3.$von."\">";
    } else {
      echo "<td class=\"active\">";
    }
    echo $von."-".$bis;
    if ($von != $start) {
      echo "</a>";
    }
    echo "&nbsp;</td>";
  }?>
        </tr>
      </table>
    </td>
  </tr><?
} /* ende if($tipp_anzseiten>1) */?>
  <tr>
    <td align="center">
      <table class="lmoInner" cellspacing="0" cellpadding="0" border="0">
        <caption><?
if($tabdat!=""){ 
  if ($stwertmodus == "nur") {
    echo $text['tipp'][202];
  } else {
    echo "<a href=\"".$addt4."nur\" title=\"".$text['tipp'][202]."\">".$text['tipp'][202]."</a>";
  }
  echo "&nbsp;";
  if ($stwertmodus == "bis") {
    echo $text['tipp'][203];
  } else {
    echo "<a href=\"".$addt4."bis\" title=\"".$text['tipp'][203]."\">".$text['tipp'][203]."</a>";
  }
}?>     </caption>
        <tr>
          <th class="nobr" colspan="3"> <?
if (isset($lmtype) && $lmtype == 1 && $tabdat != "") {
  if ($st == $anzst) {
    $j = $text[374];
  } elseif($st == $anzst-1) {
    $j = $text[373];
  } elseif($st == $anzst-2) {
    $j = $text[372];
  } elseif($st == $anzst-3) {
    $j = $text[371];
  } else {
    $j = $st.". ".$text[370];
  }
  echo $j;
} else {
  echo $tabdat;
}?>       </th><?
if( $wertung=="einzel"  || $wertung=="intern"){
  if( $tipp_tipperimteam>=0){?>
          <th class="nobr"> <?=$text['tipp'][27]; /* Team */?> </th><?
  }
} else { /* Teamwertung*/?>
          <th class="nobr" align="right"> <?=$text['tipp'][26]; /* Anzahl Tipper*/ ?> </th>
          <th class="nobr" align="right"> <?=$text['tipp'][26]."�"; /* Anzahl Tipper Durchschnitt*/ ?> </th><? 
}?>
          <th class="nobr" <?=$dummy; ?>> <? 
if($gewicht!="spiele"){
  echo "<a href=\"".$addt5."spiele\">";
}
echo $text['tipp'][123]; // Spiele getippt
if($gewicht!="spiele"){
  echo "</a>";
}?>       </th><?
if($tipp_showzus==1){
  if($tipp_tippmodus==1){
    if($tipp_rergebnis>0){ ?>
          <th class="nobr" align="right"> <?=$text['tipp'][221]; /* RE */?> </th><? 
    } 
    if($tipp_rtendenzdiff>$tipp_rtendenz){ ?>
          <th class="nobr" align="right"> <?=$text['tipp'][222]; /* RTD */?> </th><? 
    }
    if($tipp_rtendenz>0){ ?>
          <th class="nobr" align="right"> <?=$text['tipp'][223]; /* RT */?> </th><? 
    } 
    if($tipp_rtor>0){ ?>
          <th class="nobr" align="right"> <?=$text['tipp'][224]; /* RG */?> </th><? 
    } 
  } // ende if($tipp_tippmodus==1) 
  if($tipp_rremis>0){ ?>
          <th class="nobr" align="right"> <?=$text['tipp'][225]; /* UB */?> </th><? 
  } 
  if($tipp_jokertipp==1){ ?>
          <th class="nobr" align="right"> <?=$text['tipp'][226]; /* JP */?> </th><? 
  }
} // ende if($tipp_showzus==1) 
if($tipp_showstsiege==1){ ?>
          <th class="nobr" align="right"> <?=$text['tipp'][90]; /* GS */?> </th><? 
}?>
          <th class="nobr" <?=$dummy; ?>> <? 
if ($gewicht != "relativ") {
  echo "<a href=\"".$addt5."relativ\" title=\"".$text['tipp'][150]."\">";
}
if ($tipp_tippmodus == 1) {
  echo $text['tipp'][123]."�";
} else {
  echo $text['tipp'][123]."%";
}
if ($gewicht != "relativ") {
  echo "</a>";
}?>
          </th>
          <th class="nobr" <?=$dummy; ?>> <? 
if ($gewicht != "absolut") {
  echo "<a href=\"".$addt5."absolut\" title=\"".$text['tipp'][149]."\">";
}
if ($tipp_tippmodus == 1) {
  echo $text[37];
} else {
  echo $text['tipp'][122];
}
if ($gewicht != "absolut") {
  echo "</a>";
}?>
          </th>
        </tr><?
$eigplatz = $anztipper+2;
$j = 1;
$ende = $start+$tipp_anzseite1-1;
if ($ende > $anztipper) {
  $ende = $anztipper;
}
if (!isset($lx)) {
  $lx = 1;
}
if (!isset($lax)) {
  $lax = 0;
}
if ($anztipper > 0) {
  $laeng = strlen($tab0[0]);
}
for($x = 1; $x <= $anztipper; $x++) {
  $i = intval(substr($tab0[$x-1], -7));
  if (($x >= $start && $x <= $ende) || $i == $eigpos) {
     
    $poswechs = 1;
    if ($x > 1) {
      for($k = 0; $k <= $laeng-24; $k += 8) {
        if (intval(substr($tab0[$x-1], $k+1, 7)) != intval(substr($tab0[$x-2], $k+1, 7))) {
          break;
        }
        if ($k == $laeng-24) {
          $poswechs = 0;
        }
      }
    }
    if ($x == 1 || $poswechs == 1) {
      $lx = $x;
    }
     
    if ($wertung != "intern" || $teamintern == $tipperteam[$i]) {
      if ($lx == $x) {
        $lax = $x;
      }
      if ($i == $eigpos) {
        $eigplatz = $x;
      }
      if (($x == $start && $eigplatz < $x-1) || ($x == $eigplatz && $x > $ende+1)) {?>
        <tr>
          <td align="right">...</td>
        </tr><?      
      }

      if ((($wertung == "einzel" || $wertung == "intern") && $lmotippername == $tippernick[$i]) || ($wertung == "team" && $lmotipperverein == $team[$i])) {
        $dummy = "<strong>";
        $dumm2 = "</strong>";
      } else {
        $dummy = "";
        $dumm2 = "";
      }
       
      $dumm1 = "lmost5";
      if ((($wertung != "intern" && $lax == 1) || ($wertung == "intern" && $lx == 1)) && $tipppunktegesamt[$i] > 0) {
        $dumm1 = "lmoTabelleMeister nobr";
      }
      if ((($wertung != "intern" && $lax == 2) || ($wertung == "intern" && $lx == 2)) && $tipppunktegesamt[$i] > 0) {
        $dumm1 = "lmoTabelleCleague nobr";
      }
      if ((($wertung != "intern" && $lax == 3) || ($wertung == "intern" && $lx == 3)) && $tipppunktegesamt[$i] > 0) {
        $dumm1 = "lmoTabelleCleaguequali nobr";
      }
       
      if ($wertung == "team" || $tippernick[$i] != "") {?>
        <tr>
          <td class="<?=$dumm1; ?>" align="right"><?
        if ($lax == $x) {
          echo $dummy.$x.$dumm2;
        } elseif($wertung == "intern" && $lax != $lx) {
          echo $dummy.$lx.$dumm2;
          $lax = $lx;
        } else {
          echo "&nbsp;";
      }?>
          </td><?
      $y = 0;
      if (($endtab > 1) && ($tabdat != "") && $tipppunktegesamt[intval(substr($tab0[0], -7))] > 0 && $stwertmodus != "nur") {
        if ($platz0[$i] < $platz1[$i]) {
          $y = 1;
        } elseif($platz0[$i] > $platz1[$i]) {
          $y = 2;
        }
      }
      if ($tabdat != "" && $stwertmodus != "nur") {
        echo "<td class=\"".$dumm1."\"";
        echo "><img src='".URL_TO_IMGDIR."/lmo-tab".$y.".gif' width=\"9\" height=\"9\" border=\"0\">";
        echo "</td>";
      } else {
        echo "<td class=\"".$dumm1."\">&nbsp;</td>";
      }
      
      if( $wertung=="einzel" || $wertung=="intern"){?>
          <td class="<?=$dumm1; ?>">
            <nobr><?
        echo $dummy;
        if ($tipp_showname == 1) {
          if ($tipp_showemail == 1) {
            echo "<a href=mailto:".$tipperemail[$i].">";
          }
          echo $tippername[$i];
          if ($tipp_showemail == 1) {
            echo "</a>";
          }
        }
        if ($tipp_shownick == 1 || ($tipp_showemail == 0 && $tipp_showname == 0)) {
          if ($tipp_showname == 1) {
            echo " (";
          }
          if ($tipp_showname == 0 && $tipp_showemail == 1) {
            echo "<a href=mailto:".$tipperemail[$i].">";
          }
          echo $tippernick[$i];
          if ($tipp_showname == 0 && $tipp_showemail == 1) {
            echo "</a>";
          }
          if ($tipp_showname == 1) {
            echo ")";
          }
        } elseif($tipp_showemail == 1 && $tipp_showname == 0) {
          echo "<a href=mailto:".$tipperemail[$i].">".$tipperemail[$i]."</a>";
        }
        echo $dumm2;?>
            </nobr>
          </td><?
      } else {?>
          <td class="<?=$dumm1; ?>"><? if($wertung!="intern" && $team[$i]!=" "){echo "<a href=\"".$addt1."intern&amp;teamintern=".str_replace(" ","%20",$team[$i])."\" title=\"".$text['tipp'][144]."\">";} echo $dummy.$team[$i].$dumm2; if($wertung!="intern" && $team[$i]!=" "){echo "</a>";} ?></td><?
      }

      if ($tipp_tipperimteam >= 0) {
        if ($wertung == "einzel" || $wertung == "intern") {
          if ($tipperteam[$i] == "") {
            $tipperteam[$i] = "&nbsp;";
          }?>
          
          <td class="<?=$dumm1; ?>"><nobr><? if($wertung!="intern" && $tipperteam[$i]!="&nbsp;"){echo "<a href=\"".$addt1."intern&amp;teamintern=".str_replace(" ","%20",$tipperteam[$i])."\" title=\"".$text['tipp'][144]."\">";} echo $dummy.$tipperteam[$i].$dumm2; if($wertung!="intern" && $tipperteam[$i]!="&nbsp;"){echo "</a>";} ?></nobr></td><?
        } else {?>
          
          <td class="<?=$dumm1; ?>" align="right"><?=$dummy.$tipp_tipperimteam[$i].$dumm2; ?></td>
          
          <td class="<?=$dumm1; ?>" align="right"><?=$dummy.number_format($tipppunktegesamt[$i]/$tipp_tipperimteam[$i],2,".",",").$dumm2; ?></td><?
        }
      }
      echo "<td class=\"".$dumm1."\" align=\"right\">";
      if ($gewicht == "spiele") {
        echo "<strong>";
      } else {
        echo $dummy;
      }
      echo $spielegetipptgesamt[$i];
      if ($gewicht == "spiele") {
        echo "</strong>";
      } else {
        echo $dumm2;
      }
      echo "</td>";
       
      if ($tipp_showzus == 1) {
        if ($tipp_tippmodus == 1) {
          
          if ($tipp_rergebnis > 0) {
            if ($punkte1gesamt[$i] == "") {
              $punkte1gesamt[$i] = "&nbsp;";
            }?>
          
          <td class="<?=$dumm1; ?>" align="right"><?=$dummy.$punkte1gesamt[$i].$dumm2; ?></td><? 
          }
          
          if ($tipp_rtendenzdiff > $tipp_rtendenz) {
            if ($punkte2gesamt[$i] == "") {
              $punkte2gesamt[$i] = "&nbsp;";
            }?>
          
          <td class="<?=$dumm1; ?>" align="right"><?=$dummy.$punkte2gesamt[$i].$dumm2; ?></td><? 
          } else {
            $punkte3gesamt[$i]+=$punkte2gesamt[$i];
          }
          
          if($tipp_rtendenz>0){
            if($punkte3gesamt[$i]==""){
              $punkte3gesamt[$i]="&nbsp;";
            }?>
          
          <td class="<?=$dumm1; ?>" align="right"><?=$dummy.$punkte3gesamt[$i].$dumm2; ?></td><? 
          }
          
          if($tipp_rtor>0){
            if($punkte4gesamt[$i]==""){
              $punkte4gesamt[$i]="&nbsp;";
            }?>
          
          <td class="<?=$dumm1; ?>" align="right"><?=$dummy.$punkte4gesamt[$i].$dumm2; ?></td><? 
          }
        } // ende if($tipp_tippmodus==1)
        
        if($tipp_rremis>0){
          if($punkte5gesamt[$i]==""){
            $punkte5gesamt[$i]="&nbsp;";
          }?>
          
          <td class="<?=$dumm1; ?>" align="right"><?=$dummy.$punkte5gesamt[$i].$dumm2; ?></td><? 
        }
        
        if($tipp_jokertipp==1){
          if($punkte6gesamt[$i]==""){
            $punkte6gesamt[$i]="&nbsp;";
          }?>
          
          <td class="<?=$dumm1; ?>" align="right"><?=$dummy.$punkte6gesamt[$i].$dumm2; ?></td><? 
        }
      } // ende if($tipp_showzus==1)
      
      if($tipp_showstsiege==1){
        if($stsiege[$i]==""){
          $stsiege[$i]="&nbsp;";
        }?>
          
          <td class="<?=$dumm1; ?>" align="right"><?=$dummy.$stsiege[$i].$dumm2; ?></td><? 
      }
      
      $quotegesamt[$i] = number_format($quotegesamt[$i]/100, 2, ".", ",");
      echo "<td class=\"".$dumm1."\" align=\"right\">";
      if ($gewicht == "relativ") {
        echo "<strong>";
      } else {
        echo $dummy;
      }
      echo $quotegesamt[$i];
      if ($gewicht == "relativ") {
        echo "</strong>";
      } else {
        echo $dumm2;
      }
      echo "</td>";
       
      echo "<td class=\"".$dumm1."\" align=\"right\">";
      if ($gewicht == "absolut") {
        echo "<strong>";
      } else {
        echo $dummy;
      }
      echo $tipppunktegesamt[$i];
      if ($gewicht == "absolut") {
        echo "</strong>";
      } else {
        echo $dumm2;
      }
      echo "</td>";
      } /* ende if($wertung!="intern" || $teamintern==$tipperteam[$i])*/?>
        </tr><?
    } /* ende   if($wertung=="team" || $tippernick[$i]!="")*/
  } /* ende   if(($x>=$start && $x<=$ende) || $i==$eigpos)*/
} /* ende for($x=1;$x<=$anztipper;$x++)*/?>

      </table>
    </td>
  </tr><? 
if($tipp_anzseiten>1){ ?> 
  <tr>
    <td align="center">
      <table cellspacing="0" cellpadding="0" border="0">
        <tr><?
  echo "<td class=\"active\">".$text['tipp'][205]."&nbsp;</td>";
  for($i = 0; $i < $tipp_anzseiten; $i++) {
    $von = ($i * $tipp_anzseite1)+1;
    $bis = ($i+1) * $tipp_anzseite1;
    if ($bis > $anztipper) {
      $bis = $anztipper;
    }
    if ($von != $start) {
      echo "<td ><a href=\"".$addt3.$von."\">";
    } else {
      echo "<td class=\"active\">";
    }
    echo $von."-".$bis;
    if ($von != $start) {
      echo "</a>";
    }
    echo "&nbsp;</td>";
  }?>
        </tr>
      </table>
    </td>
  </tr><? 
} // ende if($tipp_anzseiten>1)
if($tabdat!=""){ ?>
  <tr>
    <td>
      <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr><?
  $st0 = $endtab-1;
  if ($endtab > 1) {
    echo "<td align='left'><a href=\"".$addr.$st0."\" title=\"".$text[43]."\">".$text[5]."</a></td>";
  }
  $st0 = $endtab+1;
  if ($endtab < $anzst) {
    echo "<td align=\"right\"><a href=\"".$addr.$st0."\" title=\"".$text[44]."\">".$text[7]."</a></td>";
  }?>
        </tr>
      </table>
    </td>
  </tr><? 
}?>
</table>