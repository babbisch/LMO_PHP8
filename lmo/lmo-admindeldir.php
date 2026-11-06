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
$addi = $_SERVER['PHP_SELF'] . '?action=admin&amp;todo=delete&amp;del=1&amp;dfile=';
if ($ftype != '') {
    $verz = opendir(substr($dirliga, 0, -1));
    $dummy = array('');
    while ($files = readdir($verz)) {
        if (strtolower(substr($files, -4)) == $ftype) {
            array_push($dummy, $files);
        }
    }
    closedir($verz);
    array_shift($dummy);
    sort($dummy);
    $i = 0;
    $j = 0;
    echo "<div class='list-group'>";
    for ($k = 0; $k < count($dummy); $k++) {
        $files = $dummy[$k];
        $sekt = '';
        $t0 = '';
        $datei = fopen($dirliga . $files, 'rb');
        if ($datei) {
            while (!feof($datei)) {
                $zeile = fgets($datei, 1000);
                $zeile = chop($zeile);
                $zeile = trim($zeile);
                if ((substr($zeile, 0, 1) == '[') && (substr($zeile, -1) == ']')) {
                    $sekt = substr($zeile, 1, -1);
                } elseif ((str_contains($zeile, '=')) && (substr($zeile, 0, 1) != ';') && ($sekt == 'Options')) {
                    $schl = substr($zeile, 0, strpos($zeile, '='));
                    $wert = substr($zeile, strpos($zeile, '=') + 1);
                    if ($schl == 'Name') {
                        $t0 = $wert;
                        break;
                    }
                }
            }
        }
        fclose($datei);
        $i++;
        if ($t0 == '') {
            $j++;
            $t0 = $text[507] . " $j";
        }
        ?>
              <button type="button" class="btn-solid btn-sm theme-secondary" data-bs-toggle="dialog" data-bs-target="#del_<?php echo $files?>"><?php echo $t0; ?></button>
              <dialog class="dialog" id="del_<?php echo $files?>">
                <div class="dialog-header">
                  <h1 class="dialog-title"><?php echo $text[295]; ?></h1>
                  <button type="button" class="btn-close" data-bs-dismiss="dialog" aria-label="Close"></button>
                </div>
                <div class="dialog-body">
                  <p><?php echo $text[296]; ?></p>
                </div>
                <div class="dialog-footer">
                  <a href='<?php echo $addi . $dirliga . $files; ?>' type="button" class="btn-solid theme-danger"><?php echo $text[82]; ?></a>
                </div>
              </dialog>
              <p></p>
        <?php
    }
    if ($i == 0) {
        echo $text[223];
    }
    echo '</div>';
}
