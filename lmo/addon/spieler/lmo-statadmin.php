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
 *
 * $Id$
 */
require_once (__DIR__ . '/../../init.php');

if (isset($_REQUEST['ligalink'])) {
    $spieler_ligalink = $_REQUEST['ligalink'];
}
else
    $spieler_ligalink = $text['spieler'][11];
if (isset($_REQUEST['sort'])) {
    $spieler_sort = $_REQUEST['sort'];
}
else
    $spieler_sort = '';
if (isset($_REQUEST['statstart'])) {
    $statstart = $_REQUEST['statstart'];
}
else
    $spieler_statstart = 0;
if (isset($_REQUEST['option'])) {
    $spieler_option = $_REQUEST['option'];
}
else
    $spieler_option = '';
if (isset($_REQUEST['wert'])) {
    $wert = $_REQUEST['wert'];
}
else
    $spieler_wert = '';

// Datei auslesen
if (isset($file) && $file != '') {
    // Konfiguration auslesen
    require (PATH_TO_ADDONDIR . '/spieler/lmo-statloadconfig.php');

    // Adminkontrolle
    if ($_SESSION['lmouserok'] == 2 || ($_SESSION['lmouserok'] == 1 && $spieler_adminbereich_hilfsadmin_zulassen == 1)) {
        // zu speichernde Konfiguration
        if (isset($_REQUEST['standard_sortierung'])) {
            $spieler_standard_sortierung = $_REQUEST['standard_sortierung'];
        }
        if (isset($_REQUEST['standard_richtung'])) {
            $spieler_standard_richtung = $_REQUEST['standard_richtung'];
        }
        if (isset($_REQUEST['adminbereich_standard_sortierung'])) {
            $spieler_adminbereich_standard_sortierung = $_REQUEST['adminbereich_standard_sortierung'];
        }
        if (isset($_REQUEST['ligalink'])) {
            $spieler_ligalink = $_REQUEST['ligalink'];
        }
        if (isset($_REQUEST['anzeige_pro_seite'])) {
            $spieler_anzeige_pro_seite = $_REQUEST['anzeige_pro_seite'];
        }
        if (isset($_REQUEST['nullwerte_anzeigen']))
            $spieler_nullwerte_anzeigen = 1;
        else {
            if ($spieler_option == 'saveconfig')
                $spieler_nullwerte_anzeigen = 0;
        }
        if (isset($_REQUEST['vereinsweise_anzeigen']))
            $spieler_vereinsweise_anzeigen = 1;
        else {
            if ($spieler_option == 'saveconfig')
                $spieler_vereinsweise_anzeigen = 0;
        }
        if (isset($_REQUEST['extra_sortierspalte']))
            $spieler_extra_sortierspalte = 1;
        else {
            if ($spieler_option == 'saveconfig')
                $spieler_extra_sortierspalte = 0;
        }
        if ($_SESSION['lmouserok'] == 2) {
            if (isset($_REQUEST['adminbereich_hilfsadmin_zulassen']))
                $spieler_adminbereich_hilfsadmin_zulassen = 1;
            else {
                if ($spieler_option == 'saveconfig')
                    $spieler_adminbereich_hilfsadmin_zulassen = 0;
            }
            if (isset($_REQUEST['adminbereich_hilfsadmin_fuer_spalten']))
                $spieler_adminbereich_hilfsadmin_fuer_spalten = 1;
            else {
                if ($spieler_option == 'saveconfig')
                    $spieler_adminbereich_hilfsadmin_fuer_spalten = 0;
            }
        }
        if ($spieler_sort == '')
            $spieler_sort = intval($spieler_adminbereich_standard_sortierung);

        if (file_exists($filename))
            $filepointer = fopen($filename, 'r+b');
        else
            $filepointer = fopen($filename, 'w+b');
        $spalten = array();
        $data = array();
        $spalten = fgetcsv($filepointer, 1000, '#');  // Zeile mit Spaltenbezeichnern
        $typ = array();  // Spaltentyp (TRUE=String)
        $zeile = 0;
        if ($spalten == FALSE) {  // Datei war leer
            $spalten = array();
            $spalten[0] = $text['spieler'][2];  // Name der ersten Spalte
            set_file_buffer($filepointer, 0);
            fwrite($filepointer, $spalten[0] . "\n");  // Erste Zeile/Spalte in Datei schreiben
        }
        // Wenn in einer Spalte ne Formel steht, wurde an den Namen *_*-* angehängt
        $formel_ges = 0;
        $speicher_spalten = $spalten;
        $formel = array();
        for ($i = 0; $i < count($spalten); $i++) {
            $formel[$i] = false;
            if (strstr($spalten[$i], '*_*-*')) {
                $formel_ges++;
                $formel[$i] = true;
                $spalten[$i] = substr($spalten[$i], 0, strlen($spalten[$i]) - 5);
            }
        }
        if ($formel_ges > 0) {
            $formel_str = array();
            $formel_str = fgetcsv($filepointer, 1000, '#');  // Zeile mit Spaltenbezeichnern
        }
        while ($data[$zeile] = fgetcsv($filepointer, 10000, '#')) {
            for ($i = 0; $i < count($data[$zeile]); $i++) {
                if (!is_numeric($data[$zeile][$i]))
                    $typ[$i] = true;
            }
            $zeile++;
        }
        array_pop($data);
        if ($spieler_option != 'statupdate') {
            if (!isset($typ[intval($spieler_sort)]))
                usort($data, 'cmpInt');
            else {
                usort($data, 'cmpStr');
            }
        }
        $spaltenzahl = count($spalten);
        fclose($filepointer);

        switch ($spieler_option) {
            case 'addplayer':  // Spieler hinzufügen
                if ($wert != '') {
                    $filepointer = @fopen($filename, 'w+b');
                    set_file_buffer($filepointer, 0);
                    fputs($filepointer, join('#', $speicher_spalten) . "\n");
                    if ($formel_ges > 0) {
                        fputs($filepointer, join('#', $formel_str) . "\n");
                        formel_berechnen($formel, $formel_str, $spalten);
                    }
                    $data[$zeile][0] = $wert;
                    for ($i1 = 0; $i1 < $zeile; $i1++) {
                        fputs($filepointer, join('#', $data[$i1]) . "\n");
                    }
                    $newplayer = $wert;
                    $data[$zeile][0] = $wert;
                    for ($i = 1; $i < $spaltenzahl; $i++) {
                        if ($zeile == 0) {
                            if ($spalten[$i] == $text['spieler'][25] || $spalten[$i] == $text['spieler'][32]) {
                                $data[0][$i] = $text['spieler'][43];
                                $newplayer .= '#' . $text['spieler'][43];
                            } else {
                                $data[0][$i] = '0';
                                $newplayer .= '#0';
                            }
                        } else {
                            if (is_numeric($data[$zeile - 1][$i])) {
                                $data[$zeile][$i] = '0';
                                $newplayer .= '#0';
                            } else {
                                $data[$zeile][$i] = $text['spieler'][43];
                                $newplayer .= '#' . $text['spieler'][43];
                            }
                        }
                    }
                    fputs($filepointer, $newplayer . "\n");
                    $zeile++;
                    fclose($filepointer);
                    $statstart = $zeile;
                    if ($statstart < 0)
                        $statstart = 0;
                    @touch(PATH_TO_LMO . '/' . $dirliga . $file);
                } else {
                    echo $text['spieler'][4];
                }
                break;
            case 'delplayer':
                if ($wert != '') {
                    $filepointer = @fopen($filename, 'w+b');
                    set_file_buffer($filepointer, 0);
                    fputs($filepointer, join('#', $speicher_spalten) . "\n");
                    if ($formel_ges > 0) {
                        fputs($filepointer, join('#', $formel_str) . "\n");
                    }
                    for ($i1 = 0; $i1 < $zeile; $i1++) {
                        if ($i1 != $wert) {
                            fputs($filepointer, join('#', $data[$i1]) . "\n");
                        }
                    }
                    $zeile = 0;
                    fclose($filepointer);
                    $filepointer = fopen($filename, 'rb');
                    $spalten = fgetcsv($filepointer, 1000, '#');  // Zeile mit Spaltenbezeichnern
                    if ($formel_ges > 0) {
                        fgetcsv($filepointer, 1000, '#');  // Zeile mit Formeln übergehen
                    }
                    while ($data[$zeile] = fgetcsv($filepointer, 10000, '#')) {
                        $zeile++;
                    }
                    $spaltenzahl = count($spalten);
                    fclose($filepointer);
                    @touch(PATH_TO_LMO . '/' . $dirliga . $file);
                }
                break;
            case 'addcolumn':  // Spalte hinzufügen
                if ($wert != '') {
                    if (isset($_REQUEST['type']))
                        $val = $_REQUEST['type'];
                    else
                        $val = '0';
                    if ($wert == $text['spieler'][25])
                        $val = $text['spieler'][43];
                    if ($wert == $text['spieler'][32])
                        $val = $text['spieler'][43];
                    $filepointer = @fopen($filename, 'w+b');
                    set_file_buffer($filepointer, 0);
                    $spalten[$spaltenzahl] = $wert;
                    $speicher_spalten[$spaltenzahl] = $wert;
                    if ($val == 'F') {
                        if ($formel_ges == 0) {
                            for ($i = 0; $i < $spaltenzahl; $i++) {
                                $formel_str[$i] = '0';
                            }
                        }

                        $formel_ges++;
                        $speicher_spalten[$spaltenzahl] .= '*_*-*';
                        $val = '0';
                        $formel[$spaltenzahl] = true;
                    } else {
                        $formel[$spaltenzahl] = false;
                    }
                    $formel_str[$spaltenzahl] = '0';
                    fputs($filepointer, join('#', $speicher_spalten) . "\n");  // Spaltenbezeichner schreiben
                    for ($i = 0; $i < $zeile; $i++) {  // Spalte nullen
                        $data[$i][$spaltenzahl] = $val;
                    }
                    if ($formel_ges > 0) {
                        fputs($filepointer, join('#', $formel_str) . "\n");
                        formel_berechnen($formel, $formel_str, $spalten);
                    }
                    for ($i = 0; $i < $zeile; $i++) {
                        fputs($filepointer, join('#', $data[$i]) . "\n");
                    }
                    $spaltenzahl++;
                    fclose($filepointer);
                    @touch(PATH_TO_LMO . '/' . $dirliga . $file);
                } else {
                    echo $text['spieler'][3];
                }
                break;
            case 'delcolumn':
                if ($wert > 0) {
                    $filepointer = @fopen($filename, 'w+b');
                    set_file_buffer($filepointer, 0);
                    if ($formel[$wert])
                        $formel_ges--;
                    array_splice($spalten, $wert, 1);
                    array_splice($speicher_spalten, $wert, 1);
                    array_splice($formel, $wert, 1);
                    $spaltenzahl--;
                    fputs($filepointer, join('#', $speicher_spalten) . "\n");  // Spaltenbezeichner schreiben
                    for ($i = 0; $i < $zeile; $i++) {
                        array_splice($data[$i], $wert, 1);
                    }
                    if ($formel_ges > 0) {
                        array_splice($formel_str, $wert, 1);
                        fputs($filepointer, join('#', $formel_str) . "\n");
                        formel_berechnen($formel, $formel_str, $spalten);
                    }
                    for ($i = 0; $i < $zeile; $i++) {
                        fputs($filepointer, join('#', $data[$i]) . "\n");
                    }
                    fclose($filepointer);
                    @touch(PATH_TO_LMO . '/' . $dirliga . $file);
                }
                break;
            case 'sortieren':
                $filepointer = @fopen($filename, 'w+b');
                set_file_buffer($filepointer, 0);
                fputs($filepointer, join('#', $speicher_spalten) . "\n");
                if ($formel_ges > 0) {
                    fputs($filepointer, join('#', $formel_str) . "\n");
                }
                for ($i1 = 0; $i1 < $zeile; $i1++) {
                    fputs($filepointer, join('#', $data[$i1]) . "\n");
                }
                fclose($filepointer);
                break;
            case 'statupdate':  // Statistik updaten
                $filepointer = @fopen($filename, 'w+b');
                set_file_buffer($filepointer, 0);
                for ($i0 = 0; $i0 < $spaltenzahl; $i0++) {
                    if (isset($_REQUEST['spalten' . $i0])) {
                        $spalten[$i0] = $_REQUEST['spalten' . $i0];
                        if ($formel[$i0]) {
                            $speicher_spalten[$i0] = $_REQUEST['spalten' . $i0] . '*_*-*';
                        } else {
                            $speicher_spalten[$i0] = $_REQUEST['spalten' . $i0];
                        }
                    }
                    if (isset($_REQUEST['formel_str' . $i0])) {
                        $formel_str[$i0] = $_REQUEST['formel_str' . $i0];
                    }
                }
                fputs($filepointer, join('#', $speicher_spalten) . "\n");
                for ($i1 = 0; $i1 < $zeile; $i1++) {
                    for ($i2 = 0; $i2 < $spaltenzahl; $i2++) {
                        if (isset($_REQUEST['data' . $i1 . '|' . $i2])) {
                            $data[$i1][$i2] = $_REQUEST['data' . $i1 . '|' . $i2];
                        }
                    }
                }
                if ($formel_ges > 0) {
                    fputs($filepointer, join('#', $formel_str) . "\n");
                    formel_berechnen($formel, $formel_str, $spalten);
                }
                for ($i1 = 0; $i1 < $zeile; $i1++) {
                    fputs($filepointer, join('#', $data[$i1]) . "\n");
                }
                fclose($filepointer);
                @touch(PATH_TO_LMO . '/' . $dirliga . $file);
                // if (!isset($typ[intval($spieler_sort)])) usort($data, 'cmpInt'); else {usort($data, 'cmpStr');}
                break;
            case 'saveconfig':  // Konfiguration sichern
                $filepointer = @fopen($configfile, 'w+b');
                flock($filepointer, LOCK_EX);
                set_file_buffer($filepointer, 0);
                fputs($filepointer, $text['spieler'][21] . '=' . $spieler_standard_sortierung . "\n");
                fputs($filepointer, $text['spieler'][13] . '=' . $spieler_standard_richtung . "\n");
                fputs($filepointer, $text['spieler'][40] . '=' . $spieler_adminbereich_standard_sortierung . "\n");
                fputs($filepointer, $text['spieler'][22] . '=' . $spieler_anzeige_pro_seite . "\n");
                fputs($filepointer, $text['spieler'][23] . '=' . $spieler_nullwerte_anzeigen . "\n");
                fputs($filepointer, $text['spieler'][24] . '=' . $spieler_extra_sortierspalte . "\n");

                fputs($filepointer, $text['spieler'][50] . '=' . $spieler_vereinsweise_anzeigen . "\n");
                if ($_SESSION['lmouserok'] == 2)
                    fputs($filepointer, $text['spieler'][31] . '=' . $spieler_adminbereich_hilfsadmin_zulassen . "\n");
                if ($_SESSION['lmouserok'] == 2)
                    fputs($filepointer, $text['spieler'][46] . '=' . $spieler_adminbereich_hilfsadmin_fuer_spalten . "\n");
                fputs($filepointer, $text['spieler'][41] . '=' . $spieler_ligalink . "\n");
                flock($filepointer, LOCK_UN);
                fclose($filepointer);
                break;
        }
        $addr = $_SERVER['PHP_SELF'] . '?action=admin&amp;todo=edit&amp;file=' . $file . '&amp;st=';
        $addb = $_SERVER['PHP_SELF'] . '?action=admin&amp;todo=tabs&amp;file=' . $file . '&amp;st=';
        include (PATH_TO_LMO . '/lmo-adminsubnavi.php');
?>

<script type="text/javascript">
function change(op,x) {
	var el=document.getElementsByName(x)[0];
  	var a=el.value;
	if(!isNaN(a)){
		a=parseInt(a);
		document.getElementsByName(x)[0].value=eval(a+op+"1");
	}
  	lmotest=false;
  	mark(el);
  	return false;
}
function sel(x) {
	document.getElementsByName(x)[0].select();
}
function mark(el){
  el.className="lmoTabelleMeister";
}

</script>
<div class="container">
	<div class="row pt-3">
		<div class="col d-flex justify-content-center"><h1><?php echo $text['spieler'][18] ?></h1></div>
	</div>
	<div class="row">
		<div class="col">
			<div class="container">
				<div class="row p-1">
					<div class="col-3 offset-3">
						<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="row">
							<div class="col">
								<input type="text" class="form-control" name="wert" placeholder="<?php echo $text['spieler'][6] ?>">
							</div>
							<div class="col-auto">
								<input class="btn btn-sm btn-success" type="submit" value="+">
							</div>
							<div class="col-auto">
								<input type="hidden" name="option" value="addplayer">
								<input type="hidden" name="sort" value="<?php echo $spieler_sort ?>">
								<input type="hidden" name="todo" value="edit">
								<input type="hidden" name="st" value="<?php echo $st; ?>">
								<input type="hidden" name="file" value="<?php echo $file ?>">
							</div>
						</form>
					</div>
					<div class="col-3 text-start">
						<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="row">
							<div class="col">
								<select class="form-select" name="wert"><?php
        for ($x = 0; $x < $zeile; $x++) {
            ?>
									<option value="<?php echo $x ?>"><?php echo htmlentities(stripslashes($data[$x][0]), ENT_COMPAT); ?></option><?php
        }
        ?>
								</select>
							</div>
							<div class="col-auto">
								<input class="btn btn-sm btn-warning" type="submit" value="&minus;">
							</div>
							<div class="col-auto">
								<input type="hidden" name="option" value="delplayer">
								<input type="hidden" name="sort" value="<?php echo $spieler_sort ?>">
								<input type="hidden" name="todo" value="edit">
								<input type="hidden" name="st" value="<?php echo $st; ?>">
								<input type="hidden" name="file" value="<?php echo $file ?>">
							</div>
						</form>
					</div>
				</div><?php
        if ($_SESSION['lmouserok'] == 2 || ($_SESSION['lmouserok'] == 1 && $spieler_adminbereich_hilfsadmin_zulassen == 1 && $spieler_adminbereich_hilfsadmin_fuer_spalten == 1)) {
            ?>
				<div class="row p-1">
					<div class="col-3 offset-3 text-start">
						<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="spalten" class="row">
							<div class="row">
								<div class="col">
									<input type="text" class="form-control" name="wert" placeholder="<?php echo $text['spieler'][5] ?>">
								</div>
								<div class="col-auto">
									<input class="btn btn-sm btn-success" type="submit" value="+">
								</div>
							</div>
							<div class="row">
								<div class="col">
								<?php echo $text['spieler'][38] ?>:
									<input type="radio" class="form-check-input" name="type" value="0" checked>&nbsp;<?php echo $text['spieler'][52] ?>
									<input type="radio" class="form-check-input" name="type" value="<?php echo $text['spieler'][43] ?>">&nbsp;<?php echo $text['spieler'][53] ?>
									<input type="radio" class="form-check-input" name="type" value="F">&nbsp;<?php echo $text['spieler'][54] ?>
									<input type="hidden" name="option" value="addcolumn">
									<input type="hidden" name="sort" value="<?php echo $spieler_sort ?>">
									<input type="hidden" name="todo" value="edit">
									<input type="hidden" name="st" value="<?php echo $st; ?>">
									<input type="hidden" name="file" value="<?php echo $file ?>">
								</div>
							</div>
						</form>
					</div>
					<div class="col-3 text-start">
						<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="spieler" class="row">
							<div class="col">
								<select class="form-select" name="wert"><?php
            for ($x = 0; $x < $spaltenzahl; $x++) {
                ?>
									<option value="<?php echo $x ?>"<?php if ($x == 0) { ?> disabled<?php
                }
                if ($x == 1) {
?> selected<?php
                }
?>><?php echo htmlentities(stripslashes($spalten[$x]), ENT_COMPAT); ?></option><?php
            }
            ?>
								</select>
							</div>
							<div class="col-auto">
								<input class="btn btn-sm btn-warning" type="submit" value="&minus;">
							</div>
								<div class="col-auto">
								<input type="hidden" name="option" value="delcolumn">
								<input type="hidden" name="todo" value="edit">
								<input type="hidden" name="st" value="<?php echo $st; ?>">
								<input type="hidden" name="sort" value="<?php echo $spieler_sort ?>">
								<input type="hidden" name="file" value="<?php echo $file ?>">
							</div>
						</form>
					</div>
				</div><?php
        }
        ?>
			</div>
		</div>
	</div>
	<div class="row pt-3">
		<div class="col d-flex justify-content-center"><h1><?php echo $text['spieler'][1] ?></h1></dov>
	</div>
	<div class="row pt-3">
	        <div class="col">
			<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
				<div class="container">
					<div class="row"><?php
        for ($i = 0; $i < $spaltenzahl; $i++) {
            $stat_sort = $_SERVER['PHP_SELF'] . '?action=admin&amp;todo=statistik&amp;sort=' . $i . '&amp;file=' . $file . '&amp;direction=';
            ?>
						<div class="col-1">
							<input type="text" class="form-control" name="spalten<?php echo $i ?>" onChange="mark(this)" value="<?php echo $spalten[$i] ?>" size="<?php echo strlen($spalten[$i]); ?>">
						</div><?php
        }
        ?>
					</div><?php
        if ($formel_ges > 0) {
            ?>
              <div class="row p-1"><?php
            for ($i = 0; $i < $spaltenzahl; $i++) {
                if ($formel[$i]) {
                    ?>
                    <div class="col-2"><input type="text" class="form-control" onClick="sel('formel_str<?php echo $i ?>')" onChange="mark(this)" name="formel_str<?php echo $i ?>" value="<?php echo $formel_str[$i] ?>" size="<?php echo strlen($formel_str[$i]); ?>"></div><?php
                } elseif ($i == 0) {
                    ?>
                    <div class="col-1"><strong><?php echo $text['spieler'][54]; ?>:</strong></div><?php
                } else {
                    ?>
                    <div class="col-1"></div><?php
                }
            }
            ?>
              </div>
            <?php
        }
        $display = $zeile;
        $statstart = 0;
        if ($display > $zeile)
            $display = $zeile;
        for ($j1 = $statstart; $j1 < $display; $j1++) {
            ?>
				     <div class="row p-1"><?php
            for ($j2 = 0; $j2 < $spaltenzahl; $j2++) {
                $data[$j1][$j2] = htmlentities(stripslashes($data[$j1][$j2]), ENT_COMPAT);
                if (isset($formel[$j2]) && $formel[$j2] == 1) {
                    ?>
    			    <div class="col-1"><input type="text" class="form-control" name="data<?php echo $j1 . '|' . $j2 ?>" value="<?php echo $data[$j1][$j2] ?>" size="<?php echo strlen($data[$j1][$j2]); ?>" disabled></div><?php
                } elseif (is_numeric($data[$j1][$j2])) {
?>
			  <div class="col-1"><input type="number" class="form-control" name="data<?php echo $j1 . '|' . $j2 ?>" value="<?php echo $data[$j1][$j2] ?>" size="<?php echo strlen($data[$j1][$j2]); ?>"></div><?php
                } else {
                    if ($spalten[$j2] == $text['spieler'][25]) {
                        ?>
							<div class="col-1">
  							<select name="data<?php echo $j1 . '|' . $j2 ?>" size="1"><?php
                        for ($j = 0; $j <= $anzteams; $j++) {
                            ?>
  									<option <?php if (htmlentities($teams[$j]) == $data[$j1][$j2]) echo 'selected'; ?>><?php echo htmlentities($teams[$j]) ?></option><?php
                        }
                        ?>
  							</select>
							</div><?php
                    } else {
                        ?>
							<div class="col-1"><input type="text" class="form-control" name="data<?php echo $j1 . '|' . $j2 ?>"value="<?php echo $data[$j1][$j2] ?>" size="<?php echo strlen($data[$j1][$j2]); ?>"></div><?php
                    }
                }
            }
            ?>
						</div><?php
        }
        ?>
				</div>
				<div class="row p-3 text-end">
						<div class="col-1 offset-8">
							<input type="hidden" name="option" value="statupdate">
							<input type="hidden" name="todo" value="edit">
							<input type="hidden" name="st" value="<?php echo $st; ?>">
							<input type="hidden" name="sort" value="<?php echo $spieler_sort ?>">
							<input type="hidden" name="file" value="<?php echo $file ?>">
							<input class="btn btn-primary btn-sm" type="submit" value="Statistik updaten">
						</div>
				</div>
      			</form>
		</div>
	</div>
	<div class="row pt-5">
	        <div class="col">
	        	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="form1">
				<input type="hidden" name="option" value="saveconfig">
				<input type="hidden" name="todo" value="edit">
        			<input type="hidden" name="st" value="<?php echo $st; ?>">
				<input type="hidden" name="file" value="<?php echo $file ?>">
				<div class="container">
					<div class="row p-2">
						<div class="col"><h3><?php echo $text['spieler'][39] ?></h3></div>
					</div>

					<div class="row p-2">
						<div class="col-3"><?php echo $text['spieler'][22] ?>: </div>
						<div class="col-auto">
							<input class="form-control" type="text" name="anzeige_pro_seite"value="<?php echo $spieler_anzeige_pro_seite ?>" size="<?php echo strlen($spieler_anzeige_pro_seite); ?>">
						</div>
					</div>
					<div class="row p-2">
						<div class="col-3"><?php echo $text['spieler'][21] ?>: </div>
						<div class="col-auto">
	  						<select class="form-select" name="standard_sortierung" onChange="mark(this)" size="1"><?php
        for ($x = 0; $x < $spaltenzahl; $x++) {
            ?>
  								<option value="<?php echo $x ?>" <?php if ($x == $spieler_standard_sortierung) echo 'selected'; ?>><?php echo $spalten[$x] ?></option><?php
        }
        ?>
	  						</select>
						</div>
					</div>
			          	<div class="row p-2">
            					<div class="col-3"><?php echo $text['spieler'][13] ?>: </div>
            					<div class="col-auto">
            						<input type="radio" class="form-check-input" name="standard_richtung" onClick="mark(this)" value="1"<?php if ($spieler_standard_richtung == 1) echo ' checked'; ?>> <?php echo $text['spieler'][48] ?>
            						<br>
            						<input type="radio" class="form-check-input" name="standard_richtung" onClick="mark(this)" value="0"<?php if ($spieler_standard_richtung == 0) echo ' checked'; ?>> <?php echo $text['spieler'][47] ?>
            					</div>
          				</div>
          				<div class="row p-2">
						<div class="col-3"><?php echo $text['spieler'][23] ?>: </div>
						<div class="col-auto"><input type="checkbox" class="form-check-input" name="nullwerte_anzeigen" onClick="mark(this)" value="<?php echo $spieler_nullwerte_anzeigen ?>" <?php if ($spieler_nullwerte_anzeigen == 1) echo 'checked'; ?>></div>
					</div>
					<div class="row p-2">
						<div class="col"><input class="btn btn-primary btn-sm" type="submit" value="<?php echo $text['spieler'][58] ?>"></div>
					</div>
				</div>
			</form>
	        </div>
	</div>
</div>
<?php
    } else {
        echo $text['spieler'][33];
    }  // Hilfsadmin
}  // Datei existiert

function cmpInt($a1, $a2)
{
    global $spieler_sort;
    if ($a2[$spieler_sort] == $a1[$spieler_sort])
        return 0;
    return ($a1[$spieler_sort] > $a2[$spieler_sort]) ? -1 : 1;
}

function cmpStr($a2, $a1)
{
    global $spieler_sort;
    $a1[$spieler_sort] = strtr($a1[$spieler_sort], '¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ', 'YuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy');
    $a2[$spieler_sort] = strtr($a2[$spieler_sort], '¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ', 'YuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy');
    $c = strnatcasecmp($a2[$spieler_sort], $a1[$spieler_sort]);
    if (!$c)
        $c = strnatcasecmp($a1[$spieler_sort], $a2[$spieler_sort]);
    return $c;
}

function cmpstrlength($a, $b)
{
    if (strlen($a) == strlen($b))
        return 0;
    return (strlen($a) > strlen($b)) ? -1 : 1;
}

function formel_berechnen($formel, $formel_str, $spalten)
{
    global $data;
    uasort($spalten, 'cmpstrlength');
    for ($i = 0; $i < count($spalten); $i++) {
        if ($formel[$i]) {
            $formel_str[$i] = strtoupper($formel_str[$i]);
            $help_str = $formel_str[$i];
            foreach ($spalten as $key => $value) {
                if ($i != $key) {
                    $help_str = str_replace(strtoupper($value), '', $help_str);
                    $formel_str[$i] = str_replace(strtoupper($value), "\$data[\$j][$key]", $formel_str[$i]);
                }
            }
            $help_str = strtr($help_str, '+-*/0123456789.(),', '                  ');
            echo (chop($help_str));
            if (strlen(trim($help_str)) == 0 || trim($help_str) == 'MAX' || trim($help_str) == 'MIN') {
                $formel_str[$i] = '$help2=round(' . $formel_str[$i] . ',2);';
            } else {
                $formel_str[$i] = '$help2="' . $text['spieler'][55] . '";';
            }
        }
    }
    for ($i = 0; $i < count($spalten); $i++) {
        if ($formel[$i]) {
            for ($j = 0; $j < count($data); $j++) {
                $help2 = 0.0;
                @eval($formel_str[$i]);
                $data[$j][$i] = $help2;
            }
        }
    }
}
?>
