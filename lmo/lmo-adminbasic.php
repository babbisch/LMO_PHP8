<?php

/**
 * Liga Manager Online 4
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
 */
require_once (PATH_TO_LMO . '/lmo-admintest.php');
if ($file != '') {
    require_once (PATH_TO_LMO . '/lmo-openfile.php');
    $show = isset($_REQUEST['show']) ? $_REQUEST['show'] : 0;
    $save = isset($_POST['save']) ? $_POST['save'] : 0;
    if ($save == 1) {
        switch ($show) {
            case 0:
                if ($_SESSION['lmouserok'] == 2 || $_SESSION['lmouserokerweitert'] == 1) {
                    $titel = isset($_POST['xtitel']) ? trim($_POST['xtitel']) : $titel;
                    if ($titel == '') {
                        $titel = 'No Name';
                    }
                    $goalfaktor = isset($_POST['xgoalfaktor']) && is_numeric($_POST['xgoalfaktor']) ? $_POST['xgoalfaktor'] : $goalfaktor;
                    $pointsfaktor = isset($_POST['xpointsfaktor']) && is_numeric($_POST['xpointsfaktor']) ? $_POST['xpointsfaktor'] : $pointsfaktor;
                }
                $favteam = isset($_POST['xfavteam']) ? trim($_POST['xfavteam']) : $favteam;
                $selteam = isset($_POST['xselteam']) ? trim($_POST['xselteam']) : $selteam;
                if ($lmtype == 0) {
                    $stat1 = isset($_POST['xstat1']) ? trim($_POST['xstat1']) : $stat1;
                    $stat2 = isset($_POST['xstat2']) ? trim($_POST['xstat2']) : $stat2;
                    $namepkt = isset($_POST['xnamepkt']) ? trim($_POST['xnamepkt']) : $namepkt;
                    if ($namepkt == $orgpkt) {
                        $namepkt = '';
                    }
                    $nametor = isset($_POST['xnametor']) ? trim($_POST['xnametor']) : $nametor;
                    if ($nametor == $orgtor) {
                        $nametor = '';
                    }
                }
                break;
            case 2:
                if ($_SESSION['lmouserok'] == 2 || $_SESSION['lmouserokerweitert'] == 1) {
                    $enablegamesort = isset($_POST['xenablegamesort']) ? 1 : 0;
                    $datm = isset($_POST['xdatm']) ? 1 : 0;
                    if (!empty($_POST['xdatfselect'])) {
                        $datf = isset($_POST['xdatf']) ? $_POST['xdatf'] : $defdateformat;
                    } else {
                        $datf = isset($_POST['xdatf2']) ? $_POST['xdatf2'] : $datf;
                    }
                    $dats = isset($_POST['xdats']) ? 1 : 0;
                    $plan = isset($_POST['xplan']) ? 1 : 0;
                    $ergebnis = isset($_POST['xergebnis']) ? 1 : 0;
                    if ($einspieler == 1) {
                        $mittore = isset($_POST['xmittore']) ? 1 : 0;
                    }
                    $datc = isset($_POST['xdatc']) ? 1 : 0;
                    if (($dats == 0) && ($datm == 0)) {
                        $datc = 0;
                    }
                    if ($lmtype == 0) {
                        $onrun = isset($_POST['xonrun']) ? $_POST['xonrun'] : $onrun;
                        $kurve = isset($_POST['xkurve']) ? 1 : 0;
                        $kreuz = isset($_POST['xkreuz']) ? 1 : 0;
                        if ($tabonres == 0) {
                            $tabelle = isset($_POST['xtabelle']) ? 1 : 0;
                        }
                        $ligastats = isset($_POST['xligastats']) ? 1 : 0;
                    } else {
                        $klfin = isset($_POST['xklfin']) ? 1 : 0;
                        $playdown = isset($_POST['xplaydown']) ? 1 : 0;
                    }

                    $urlt = isset($_POST['xurlt']) ? 1 : 0;
                    $urlb = isset($_POST['xurlb']) ? 1 : 0;
                }
                break;
            case 3:
                if (($_SESSION['lmouserok'] == 2 || $_SESSION['lmouserokerweitert'] == 1) && $lmtype == 0) {
                    $minus = isset($_POST['xminus']) ? 2 : 1;
                    $spez = isset($_POST['xspez']) ? 1 : 0;
                    $hidr = isset($_POST['xhidr']) ? 1 : 0;
                    $direkt = isset($_POST['xdirekt']) ? 1 : 0;
                    $kegel = isset($_POST['xkegel']) ? 1 : 0;
                    $hands = isset($_POST['xhands']) ? 1 : 0;

                    $pns = isset($_POST['xpns']) ? trim($_POST['xpns']) : $pns;
                    $pnu = isset($_POST['xpnu']) ? trim($_POST['xpnu']) : $pnu;
                    $pnn = isset($_POST['xpnn']) ? trim($_POST['xpnn']) : $pnn;
                    $pxs = isset($_POST['xpxs']) ? trim($_POST['xpxs']) : $pxs;
                    $pxu = isset($_POST['xpxu']) ? trim($_POST['xpxu']) : $pxu;
                    $pxn = isset($_POST['xpxn']) ? trim($_POST['xpxn']) : $pxn;
                    $pps = isset($_POST['xpps']) ? trim($_POST['xpps']) : $pps;
                    $ppu = isset($_POST['xppu']) ? trim($_POST['xppu']) : $ppu;
                    $ppn = isset($_POST['xppn']) ? trim($_POST['xppn']) : $ppn;
                }
                break;
            case 4:
                if (($_SESSION['lmouserok'] == 2 || $_SESSION['lmouserokerweitert'] == 1) && $lmtype == 0) {
                    $einhinrueck = isset($_POST['xeinhinrueck']) ? 1 : 0;
                    $einheimausw = isset($_POST['xeinheimausw']) ? 1 : 0;
                    $champ = isset($_POST['xchamp']) ? 1 : 0;
                    $anzcl = isset($_POST['xanzcl']) ? trim($_POST['xanzcl']) : $anzcl;
                    $anzck = isset($_POST['xanzck']) ? trim($_POST['xanzck']) : $anzck;
                    $anzuc = isset($_POST['xanzuc']) ? trim($_POST['xanzuc']) : $anzuc;
                    $anzar = isset($_POST['xanzar']) ? trim($_POST['xanzar']) : $anzar;
                    $anzab = isset($_POST['xanzab']) ? trim($_POST['xanzab']) : $anzab;
                }
                break;
            case 5:
                if (($_SESSION['lmouserok'] == 2 || $_SESSION['lmouserokerweitert'] == 1) && $lmtype == 0) {
            	    for ($j = $anzsp; $j < 40; $j++) {
                	$teama[$i][$j] = 0;
                	$teamb[$i][$j] = 0;
                	$goala[$i][$j] = -1;
                	$goalb[$i][$j] = -1;
                	$msieg[$i][$j] = 0;
                	$mterm[$i][$j] = '';
                	$mnote[$i][$j] = '';
                	$mberi[$i][$j] = '';
                	$mspez[$i][$j] = '_';
            	    }
        	}
        	for ($i = $anzst; $i < 116; $i++) {
            	    for ($j = 0; $j < 40; $j++) {
                	$teama[$i][$j] = 0;
                	$teamb[$i][$j] = 0;
                	$goala[$i][$j] = -1;
                	$goalb[$i][$j] = -1;
                	$msieg[$i][$j] = 0;
                	$mterm[$i][$j] = '';
                	$mnote[$i][$j] = '';
                	$mberi[$i][$j] = '';
                	$mspez[$i][$j] = '_';
            	    }
        	}
        	$anzst = trim($_POST['xanzst']);
        	$anzsp = trim($_POST['xanzsp']);
        	if ($stx > $anzst) {
            	    $stx = $anzst;
        	}
                break;
        }
        require (PATH_TO_LMO . '/lmo-savefile.php');
    }
    $addr = $_SERVER['PHP_SELF'] . '?action=admin&amp;todo=edit&amp;file=' . $file . '&amp;st=';
    $addb = $_SERVER['PHP_SELF'] . '?action=admin&amp;todo=tabs&amp;file=' . $file . '&amp;st=';

    include (PATH_TO_LMO . '/lmo-adminsubnavi.php');
    ?>

<div class="container">
  <div class="row p-3">
    <div class="col d-flex justify-content-center"><h1><?php echo $titel ?></h1></div>
  </div>
  <div class="row">
    <div class="col-3 text-end">
    <?php if ($show == 0) {
        echo "<p class='btn-outline theme-info'>$text[183]</p>";
    } else { ?>
     <p><a class="btn-solid btn-sm" href="<?php echo $_SERVER['PHP_SELF'] . "?action=admin&amp;todo=edit&amp;show=0&amp;file=$file&amp;st=-1"; ?>"><?php echo $text[183]; ?></a></p><?php
    }
    if ($_SESSION['lmouserok'] == 2 || $_SESSION['lmouserokerweitert'] == 1) {
        if ($show == 2) {
            echo "<p class='btn-outline theme-info'>$text[250]</p>";
        } else {
            ?>
          <p><a class="btn-solid btn-sm" href="<?php echo $_SERVER['PHP_SELF'] . "?action=admin&amp;todo=edit&amp;show=2&amp;file=$file&amp;st=-1"; ?>"><?php echo $text[250]; ?></a></p><?php
        }
        if ($lmtype == 0) {
            if ($show == 3) {
                echo "<p class='btn-outline theme-info'>$text[178]</p>";
            } else {
                ?>
            <p><a class="btn-solid btn-sm" href="<?php echo $_SERVER['PHP_SELF'] . "?action=admin&amp;todo=edit&amp;show=3&amp;file=$file&amp;st=-1"; ?>"><?php echo $text[178]; ?></a></p><?php
            }
            if ($show == 4) {
                echo "<p class='btn-outline theme-info'>$text[40]</p>";
            } else {
                ?>
            <p><a class="btn-solid btn-sm" href="<?php echo $_SERVER['PHP_SELF'] . "?action=admin&amp;todo=edit&amp;show=4&amp;file=$file&amp;st=-1"; ?>"><?php echo $text[40]; ?></a></p><?php
            }
            ?>
        <p><a class="btn-solid btn-sm" href="<?php echo $_SERVER['PHP_SELF'] . "?action=admin&amp;todo=edit&amp;show=5&amp;file=$file&amp;st=-1"; ?>"><?php echo $text[338]; ?></a></p><?php
        }
    }
    ?>
    </div>
    <div class="col-8">
      <form name="lmoedit" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onSubmit="return chklmopass()">
        <input type="hidden" name="action" value="admin">
        <input type="hidden" name="todo" value="edit">
        <input type="hidden" name="save" value="1">
        <input type="hidden" name="show" value="<?php echo $show ?>">
        <input type="hidden" name="file" value="<?php echo $file; ?>">
        <input type="hidden" name="st" value="<?php echo $st; ?>">
        <div class="container"><?php
    if ($show == 0) {
        if ($_SESSION['lmouserok'] == 2 || $_SESSION['lmouserokerweitert'] == 1) {
            ?>
          <div class="row pb-1">
            <div class="col-7 md:col-3 md:offset-2 text-end"><input class="form-control" type="text" name="xtitel" maxlength="60" value="<?php echo $titel; ?>" ></div>
            <div class="col-auto text-start " data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?php echo $text[118]; ?>"><?php echo $text[113]; ?></acronym></div>
          </div><?php if ($lmtype == 0) { ?>
          <div class="row pb-1">
            <div class="col-7 md:col-3 md:offset-2 text-end"><input class="form-control" type="text" name="xnamepkt" maxlength="60" value="<?php if ($namepkt == '') { echo $text[37]; } else { echo $namepkt; } ?>" ></div>
            <div class="col-auto text-start " data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?php echo $text[66]; ?>"><?php echo $text[65] . ' ' . $text[37]; ?></acronym></div>
          </div>
          <div class="row pb-1">
            <div class="col-7 md:col-3 md:offset-2 text-end"><input class="form-control" type="text" name="xnametor" maxlength="60" value="<?php if ($nametor == '') { echo $text[38]; } else { echo $nametor; } ?>" ></div>
            <div class="col-auto text-start " data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?php echo $text[66]; ?>"><?php echo $text[65] . ' ' . $text[38]; ?></acronym></div>
          </div><?php
            }
            ?>
          <div class="row pb-1">
            <div class="col-7 md:col-3 md:offset-2 text-end">
              <select class="form-control" name="xpointsfaktor" >
                <option value="1"<?php if ($pointsfaktor == 1) echo ' selected'; ?>><?php echo $text[553] ?></option>
                <option value="10"<?php if ($pointsfaktor == 10) echo ' selected'; ?>><?php echo $text[554] ?></option>
                <option value="100"<?php if ($pointsfaktor == 100) echo ' selected'; ?>><?php echo $text[555] ?></option>
                <option value="1000"<?php if ($pointsfaktor == 1000) echo ' selected'; ?>><?php echo $text[556] ?></option>
              </select>
            </div>
            <div class="col-auto text-start " data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?php echo $text[558]; ?>"><?php echo $text[557]; ?> <?php echo $text[37]; ?></acronym></div>
          </div>
          <div class="row pb-1">
            <div class="col-7 md:col-3 md:offset-2 text-end">
              <select class="form-control" name="xgoalfaktor" >
                <option value="1"<?php if ($goalfaktor == 1) echo ' selected'; ?>><?php echo $text[553] ?></option>
                <option value="10"<?php if ($goalfaktor == 10) echo ' selected'; ?>><?php echo $text[554] ?></option>
                <option value="100"<?php if ($goalfaktor == 100) echo ' selected'; ?>><?php echo $text[555] ?></option>
                <option value="1000"<?php if ($goalfaktor == 1000) echo ' selected'; ?>><?php echo $text[556] ?></option>
              </select>
            </div>
            <div class="col-auto text-start " data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?php echo $text[558]; ?>"><?php echo $text[557]; ?> <?php echo $text[38]; ?></acronym></div>
          </div><?php
        }
        ?>
          <div class="row pb-1">
            <div class="col-7 md:col-3 md:offset-2 text-end">
              <select class="form-control" name="xfavteam" ><?php
        for ($y = 0; $y <= $anzteams; $y++) {
            ?>
                <option value="<?php echo $y ?>"<?php if ($y == $favteam) { echo ' selected'; } ?>><?php echo $teams[$y] ?></option><?php
        }
        ?>
              </select>
            </div>
            <div class="col-auto text-start " data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?php echo $text[190]; ?>"><?php echo $text[189]; ?></acronym></div>
          </div>
          <div class="row pb-1">
            <div class="col-7 md:col-3 md:offset-2 text-end">
              <select class="form-control" name="xselteam" ><?php
        for ($y = 0; $y <= $anzteams; $y++) {
            ?>
                <option value="<?php echo $y ?>"<?php if ($y == $selteam) { echo ' selected'; } ?>><?php echo $teams[$y] ?></option><?php
        }
        ?>
              </select>
            </div>
            <div class="col-auto text-start " data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?php echo $text[195]; ?>"><?php echo $text[194]; ?></acronym></div>
          </div><?php if ($lmtype == 0) { ?>
          <div class="row pb-1">
            <div class="col-7 md:col-3 md:offset-2 text-end">
              <select class="form-control" name="xstat1" ><?php
            for ($y = 0; $y <= $anzteams; $y++) {
                ?>
                <option value="<?php echo $y ?>"<?php if ($y == $stat1) { echo ' selected'; } ?>><?php echo $teams[$y] ?></option><?php
            }
            ?>
              </select>
            </div>
            <div class="col-auto text-start " data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?php echo $text[197]; ?>"><?php echo $text[196]; ?></acronym></div>
          </div>
          <div class="row pb-1">
            <div class="col-7 md:col-3 md:offset-2 text-end"><select class="form-control" name="xstat2" ><?php
            for ($y = 0; $y <= $anzteams; $y++) {
                ?>
                <option value="<?php echo $y ?>"<?php if ($y == $stat2) { echo ' selected'; } ?>><?php echo $teams[$y] ?></option><?php
            }
            ?>
              </select>
            </div>
          </div><?php }
    } elseif ($show == 2) {
        if ($_SESSION['lmouserok'] == 2 || $_SESSION['lmouserokerweitert'] == 1) { ?>
          <div class="row pb-1">
            <div class="col-6 md:col-4 text-end " data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?php echo $text[570]; ?>"><?php echo $text[569]; ?></acronym></div>
            <div class="col-1 text-start"><input type="checkbox" class="check" name="xenablegamesort" <?php if ($enablegamesort == 1) { echo ' checked'; } ?>></div>
          </div><?php
            if ($lmtype == 1) {
                ?>
          <div class="row pb-1">
            <div class="col-6 md:col-4 text-end " data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?php echo $text[418]; ?>"><?php echo $text[417]; ?></acronym></div>
            <div class="col-1 text-start"><input type="checkbox" class="check" name="xklfin" <?php if ($klfin == 1) { echo ' checked'; } ?>></div>
          </div>
          <div class="row pb-1">
            <div class="col-6 md:col-4 text-end " data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?php echo $text[552]; ?>"><?php echo $text[551]; ?></acronym></div>
            <div class="col-1 text-start"><input type="checkbox" class="check" name="xplaydown" <?php if ($playdown == 1) { echo ' checked'; } ?>></div>
          </div><?php }
            if ($lmtype == 0) { ?>
          <div class="row pb-1">
            <div class="col-6 md:col-4 text-end " data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?php echo $text[400]; ?>"><?php echo $text[399]; ?></acronym></div>
            <div class="col-6 md:col-3 text-start">
              <select class="form-control" name="xonrun" >
                <option value="0"<?php if ($ergebnis == '0') { echo ' disabled'; } elseif ($onrun == 0) { echo ' selected'; } ?>><?php echo $text[10] ?></option>
                <option value="1"<?php if ($tabelle == '0') { echo ' disabled'; } elseif ($onrun == 1) { echo ' selected'; } ?>><?php echo $text[16] ?></option>
                <option value="2"<?php if ($plan == '0') { echo ' disabled'; } elseif ($onrun == 2) { echo ' selected'; } ?>><?php echo $text[12] ?></option>
                <option value="3"<?php if ($kreuz == '0') { echo ' disabled'; } elseif ($onrun == 3) { echo ' selected'; } ?>><?php echo $text[14] ?></option>
                <option value="4"<?php if ($kurve == '0') { echo ' disabled'; } elseif ($onrun == 4) { echo ' selected'; } ?>><?php echo $text[133] ?></option>
                <option value="5"<?php if ($ligastats == '0') { echo ' disabled'; } elseif ($onrun == 5) { echo ' selected'; } ?>><?php echo $text[18] ?></option>
                <option value="6"<?php if ($dats == '0') { echo ' disabled'; } elseif ($onrun == 6) { echo ' selected'; } ?>><?php echo $text[140] ?></option>
                <option value="7"<?php if ($mittore == '0') { echo ' disabled'; } elseif ($onrun == 7) { echo ' selected'; } ?>><?php echo $text[485] ?></option>
		<option value="8"<?php if ($stats == '0') { echo ' disabled'; } elseif ($onrun == 8) { echo ' selected'; } ?>><?php echo $text['stats'][0] ?></option>
              </select>
            </div>
          </div><?php } ?>
          <div class="row pb-1">
            <div class="col-6 md:col-4 text-end " data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?php echo $text[254]; ?>"><?php echo $text[253]; ?></acronym></div>
            <div class="col-auto text-start"><input type="checkbox" class="check" name="xdatm" <?php if ($datm == 1) { echo ' checked'; } ?>></div>
          </div>
          <div class="row pb-1">
            <div class="col-6 md:col-4 text-end " data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?php echo $text[252]; ?>"><?php echo $text[251]; ?></acronym></div>
            <div class="col-auto text-start"><input type="checkbox" class="check" name="xdats" <?php if ($dats == 1) { echo ' checked'; } ?>></div>
          </div>
          <div class="row pb-1"><?php
            if ($lmtype == 0 && $tabonres == 0) {
                ?>
            <div class="col-6 md:col-4 text-end " data-bs-toggle="tooltip" data-bs-placement="ritopght" data-bs-title="<?php echo $text[512]; ?>"><?php echo $text[10]; ?></acronym></div>
            <div class="col-auto text-start"><input type="checkbox" class="check" name="xergebnis" <?php if ($ergebnis == 1) { echo ' checked'; } ?>></div>
          </div>
          <div class="row pb-1">
            <div class="col-6 md:col-4 text-end " data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?php echo $text[513]; ?>"><?php echo $text[16]; ?></acronym></div>
            <div class="col-auto text-start"><input type="checkbox" class="check" name="xtabelle" <?php if ($tabelle == 1) { echo ' checked'; } ?>></div><?php
            }
            if ($lmtype == 1) {
                ?>
            <div class="col-6 md:col-4 text-end " data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?php echo $text[512]; ?>"><?php echo $text[10]; ?></acronym></div>
            <div class="col-auto text-start"><input type="checkbox" class="check" name="xergebnis" <?php if ($ergebnis == 1) { echo ' checked'; } ?>></div><?php
            }
            if ($lmtype == 0 && $tabonres >= 1) {
                ?>
            <div class="col-6 md:col-4 text-end " data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?php echo $text[512]; ?>"><?php echo $text[10] . '/' . $text[16]; ?></acronym></div>
            <div class="col-auto text-start"><input type="checkbox" class="check" name="xergebnis" <?php if ($ergebnis == 1) { echo ' checked'; } ?>></div><?php
            }
            ?>
          </div>
          <div class="row pb-1">
            <div class="col-6 md:col-4 text-end " data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?php echo $text[256]; ?>"><?php echo $text[255]; ?></acronym></div>
            <div class="col-auto text-start"><input type="checkbox" class="check" name="xdatc" <?php if ($datc == 1) { echo ' checked'; } ?>></div>
          </div>
          <div class="row pb-1">
            <div class="col-6 md:col-4 text-end " data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?php echo $text[511]; ?>"><?php echo $text[12]; ?></acronym></div>
            <div class="col-auto text-start"><input type="checkbox" class="check" name="xplan" <?php if ($plan == 1) { echo ' checked'; } ?>></div>
          </div>
	  <div class="row pb-1">
            <div class="col-6 md:col-4 text-end"><?php echo $text['stats'][0]; ?></div>
            <div class="col-auto text-start"><input type="checkbox" class="check" name="xstats" <?php if ($stats == 1) { echo ' checked'; } ?>></div>
          </div><?php if ($lmtype == 0) { ?>
          <div class="row pb-1">
            <div class="col-6 md:col-4 text-end " data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?php echo $text[468]; ?>"><?php echo $text[467]; ?></acronym></div>
            <div class="col-auto text-start"><input type="checkbox" class="check" name="xkreuz" <?php if ($kreuz == 1) { echo ' checked'; } ?>></div>
          </div>
          <div class="row pb-1">
            <div class="col-6 md:col-4 text-end " data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?php echo $text[238]; ?>"><?php echo $text[237]; ?></acronym></div>
            <div class="col-auto text-start"><input type="checkbox" class="check" name="xkurve" <?php if ($kurve == 1) { echo ' checked'; } ?>></div>
          </div><?php
            }
            if ($einspieler == 1) {
                ?>
          <div class="row pb-1">
            <div class="col-6 md:col-4 text-end " data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?php echo $text['spieler'][19]; ?>"><?php echo $text['spieler'][18]; ?></acronym></div>
            <div class="col-auto text-start"><input type="checkbox" class="check" name="xmittore" <?php if ($mittore == 1) { echo ' checked'; } ?>></div>
          </div><?php
            }
            if ($lmtype == 0) {
                ?>
          <div class="row pb-1">
            <div class="col-6 md:col-4 text-end " data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?php echo $text[514]; ?>"><?php echo $text[18]; ?></acronym></div>
            <div class="col-auto text-start"><input type="checkbox" class="check" name="xligastats" <?php if ($ligastats == 1) { echo ' checked'; } ?>></div>
          </div><?php
            }
            ?>
          <div class="row p-2">
            <div class="col"><strong><?php echo $text[264]; ?></strong></div>
          </div>
          <div class="row pb-1">
            <div class="col-6 md:col-4 text-end " data-bs-toggle="tooltip" data-bs-placement="rtopight" data-bs-title="<?php echo $text[268]; ?>"><?php echo $text[267]; ?></acronym></div>
            <div class="col-auto text-start"><input type="checkbox" class="check" name="xurlt" <?php if ($urlt == 1) { echo ' checked'; } ?>></div>
          </div>
          <div class="row pb-1">
            <div class="col-6 md:col-4 text-end " data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?php echo $text[266]; ?>"><?php echo $text[265]; ?></acronym></div>
            <div class="col-auto text-start"><input type="checkbox" class="check" name="xurlb" <?php if ($urlb == 1) { echo ' checked'; } ?>></div>
          </div><?php }
    } elseif ($show == 3) {
        if (($_SESSION['lmouserok'] == 2 || $_SESSION['lmouserokerweitert'] == 1) && $lmtype == 0) { ?>
          <div class="row pb-1">
            <div class="col-1 offset-2 text-end"><input type="checkbox" class="check" name="xminus" <?php if ($minus == 2) { echo ' checked'; } ?>></div>
            <div class="col-8 md:col-auto text-start " data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?php echo $text[180]; ?>"><?php echo $text[179]; ?></acronym></div>
          </div>
          <div class="row pb-1">
            <div class="col-1 offset-2 text-end"><input type="checkbox" class="check" name="xspez" <?php if ($spez == 1) { echo ' checked'; } ?>></div>
            <div class="col-8 md:col-auto text-start " data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?php echo $text[185]; ?>"><?php echo $text[184]; ?></acronym></div>
          </div>
          <div class="row pb-1">
            <div class="col-1 offset-2 text-end"><input type="checkbox" class="check" name="xhidr" <?php if ($hidr == 1) { echo ' checked'; } ?>></div>
            <div class="col-8 md:col-auto text-start " data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?php echo $text[242]; ?>"><?php echo $text[241]; ?></acronym></div>
          </div>
          <div class="row pb-1">
            <div class="col-1 offset-2 text-end"><input type="checkbox" class="check" name="xdirekt" <?php if ($direkt == 1) { echo ' checked'; } ?>></div>
            <div class="col-8 md:col-auto text-start " data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?php echo $text[187]; ?>"><?php echo $text[186]; ?></acronym></div>
          </div>
          <div class="row pb-1">
            <div class="col-1 offset-2 text-end"><input type="checkbox" class="check" name="xkegel" <?php if ($kegel == 1) { echo ' checked'; } ?>></div>
            <div class="col-8 md:col-auto text-start " data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?php echo $text[396]; ?>"><?php echo $text[395]; ?></acronym></div>
          </div>
          <div class="row pb-1">
            <div class="col-1 offset-2 text-end"><input type="checkbox" class="check" name="xhands" <?php if ($hands == 1) { echo ' checked'; } ?>></div>
            <div class="col-8 md:col-auto text-start " data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?php echo $text[408]; ?>"><?php echo $text[407]; ?></acronym></div>
          </div>
          <div class="row p-2">
            <div class="col"><strong><?php echo $text[198]; ?></strong></div>
          </div>
          <div class="row pb-1">
            <div class="col">
              <div class="container">
                <div class="row pb-1">
                  <div class="col-5"></div>
                  <div class="col-1 text-center " data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?php echo $text[199]; ?>"><?php echo $text[34]; ?></acronym></div>
                  <div class="col-1 text-center " data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?php echo $text[200]; ?>"><?php echo $text[35]; ?></acronym></div>
                  <div class="col-1 text-center " data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?php echo $text[201]; ?>"><?php echo $text[36]; ?></acronym></div>
                </div>
                <div class="row pb-1">
                  <div class="col-5 text-end"><?php echo $text[202]; ?></div>
                  <div class="col-1"><input class="form-control w-4" type="number" name="xpns"  value=<?php echo $pns ?>></div>
                  <div class="col-1"><input class="form-control w-4" type="number" name="xpnu"  value=<?php echo $pnu ?>></div>
                  <div class="col-1"><input class="form-control w-4" type="number" name="xpnn"  value=<?php echo $pnn ?>></div>
                </div>
                <div class="row pb-1">
                  <div class="col-5 text-end"><?php echo $text[203]; ?></div>
                  <div class="col-1"><input class="form-control w-4" type="number" name="xpxs"  value=<?php echo $pxs ?>></div>
                  <div class="col-1"><input class="form-control w-4" type="number" name="xpxu"  value=<?php echo $pxu ?>></div>
                  <div class="col-1"><input class="form-control w-4" type="number" name="xpxn"  value=<?php echo $pxn ?>></div>
                </div>
                <div class="row pb-1">
                  <div class="col-5 text-end"><?php echo $text[204]; ?></div>
                  <div class="col-1"><input class="form-control w-4" type="number" name="xpps"  value=<?php echo $pps ?>></div>
                  <div class="col-1"><input class="form-control w-4" type="number" name="xppu"  value=<?php echo $ppu ?>></div>
                  <div class="col-1"><input class="form-control w-4" type="number" name="xppn"  value=<?php echo $ppn ?>></div>
                </div>
              </div>
            </div>
          </div><?php }
    } elseif ($show == 4) {
        if ($_SESSION['lmouserok'] == 2 || $_SESSION['lmouserokerweitert'] == 1) { ?>
          <div class="row p-2">
            <div class="col"><strong><?php echo $text[264]; ?></strong></div>
          </div>
          <div class="row pb-1">
            <div class="col-10 md:col-6 text-end " data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?php echo $text[494]; ?>"><?php echo $text[493]; ?></acronym></div>
            <div class="col-auto"><input type="checkbox" class="check" name="xeinhinrueck" <?php if ($einhinrueck == 1) { echo ' checked'; } ?>></div>
          </div>
           <div class="row pb-1">
            <div class="col-10 md:col-6 text-end " data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?php echo $text[566]; ?>"><?php echo $text[565]; ?></acronym></div>
            <div class="col-auto"><input type="checkbox" class="check" name="xeinheimausw" <?php if ($einheimausw == 1) { echo ' checked'; } ?>></div>
          </div>
          <div class="row p-2">
            <div class="col"><strong><?php echo $text[378]; ?></strong></div>
          </div>
          <div class="row pb-1">
            <div class="col-10 md:col-6 text-end " data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?php echo $text[380]; ?>"><?php echo $text[379]; ?></acronym></div>
            <div class="col-auto"><input type="checkbox" class="check" name="xchamp" <?php if ($champ == 1) { echo ' checked'; } ?>></div>
          </div>
          <div class="row pb-1">
          <div class="col-8 md:col-6 text-end " data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?php echo $text[382]; ?>"><?php echo $text[381]; ?></acronym></div>
            <div class="col-auto"><select class="form-control" name="xanzcl" ><?php
            for ($i = 0; $i < 5; $i++) {
                ?>
                <option value="<?php echo $i ?>"<?php if ($anzcl == $i) { echo ' selected'; } ?>><?php echo $i ?></option><?php
            }
            ?>
              </select>
            </div>
          </div>
          <div class="row pb-1">
          <div class="col-8 md:col-6 text-end " data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?php echo $text[384]; ?>"><?php echo $text[383]; ?></acronym></div>
            <div class="col-auto">
              <select class="form-control" name="xanzck" ><?php
            for ($i = 0; $i < 5; $i++) {
                ?>
                <option value="<?php echo $i ?>"<?php if ($anzck == $i) { echo ' selected'; } ?>><?php echo $i ?></option><?php
            }
            ?>
              </select>
            </div>
          </div>
          <div class="row pb-1">
          <div class="col-8 md:col-6 text-end " data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?php echo $text[386]; ?>"><?php echo $text[385]; ?></acronym></div>
            <div class="col-auto">
              <select class="form-control" name="xanzuc" ><?php
            for ($i = 0; $i < 5; $i++) {
                ?>
                <option value="<?php echo $i ?>"<?php if ($anzuc == $i) { echo ' selected'; } ?>><?php echo $i ?></option><?php
            }
            ?>
              </select>
            </div>
          </div>
          <div class="row pb-1">
            <div class="col-8 md:col-6 text-end " data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?php echo $text[394]; ?>"><?php echo $text[393]; ?></acronym></div>
            <div class="col-auto">
              <select class="form-control" name="xanzar" ><?php
            for ($i = 0; $i < 5; $i++) {
                ?>
                <option value="<?php echo $i ?>"<?php if ($anzar == $i) { echo ' selected'; } ?>><?php echo $i ?></option><?php
            }
            ?>
              </select>
            </div>
          </div>
          <div class="row pb-1">
            <div class="col-8 md:col-6 text-end " data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?php echo $text[388]; ?>"><?php echo $text[387]; ?></acronym></div>
            <div class="col-auto">
              <select class="form-control" name="xanzab" ><?php
            for ($i = 0; $i < 5; $i++) {
                ?>
                <option value="<?php echo $i ?>"<?php if ($anzab == $i) { echo ' selected'; } ?>><?php echo $i ?></option><?php
            }
            ?>
              </select>
            </div>
          </div><?php }
    } elseif ($show == 5) {
        if ($_SESSION['lmouserok'] == 2 || $_SESSION['lmouserokerweitert'] == 1) { ?>
          <div class="row">
            <div class="col"><strong><?php echo $text[340]; ?></strong></div>
          </div>
          <div class="row">
            <div class="col fg-danger"><?php echo getMessage($text[561], TRUE); ?></div>
          </div>
          <div class="row pb-1">
            <div class="col-5 text-end " data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?php echo $text[275] ?>"><?php echo $text[274]; ?></acronym></div>
            <div class="col-1 text-start"><input class="form-control w-4" type="number" name="xanzst" size="3" maxlength="3" value="<?php echo $anzst ?>"></div>
          </div>
          <div class="row pb-1">
            <div class="col-5 text-end " data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="<?php echo $text[278] ?>"><?php echo $text[277]; ?></acronym></div>
            <div class="col-1 text-start"><input class="form-control w-4" type="number" name="xanzsp" size="2" maxlength="2" value="<?php echo $anzsp ?>"></div>
          </div>        
    <?php }
    } ?>
          <div class="row pt-3">
            <div class="col">
              <input title="<?php echo $text[114]; ?>" class="btn-solid btn-sm theme-primary" type="submit" name="best" value="<?php echo $text[188]; ?>">
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div><?php
}
?>