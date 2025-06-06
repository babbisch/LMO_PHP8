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
if ($file != '') {
    $addk = $_SERVER['PHP_SELF'] . '?action=cal&amp;file=' . $file . '&amp;cal=';
    $addr = $_SERVER['PHP_SELF'] . '?action=results&amp;file=' . $file . '&amp;st=';
    $me = array('0', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $mb = date('mY', strtotime('now'));
    $cal = isset($_GET['cal']) ? $_GET['cal'] : null;

    // Anzeigezeitraum festlegen
    if (isset($cal)) {  // Zeitraum vorgegeben
        if (strlen($cal) > 4) {
            $lmo_month_prev = strtotime('1 ' . $me[intval(substr($cal, 0, 2))] . ' ' . substr($cal, 2) . ' -1 month');
            $lmo_month_this = strtotime('1 ' . $me[intval(substr($cal, 0, 2))] . ' ' . substr($cal, 2));
            $lmo_month_next = strtotime('1 ' . $me[intval(substr($cal, 0, 2))] . ' ' . substr($cal, 2) . ' +1 month');
        } else {
            $lmo_month_prev = strtotime('1 ' . $me[1] . ' ' . substr($cal, 2) . ' -1 year');
            $lmo_month_this = strtotime('1 ' . $me[1] . ' ' . substr($cal, 2));
            $lmo_month_next = strtotime('1 ' . $me[1] . ' ' . substr($cal, 2) . ' +1 year');
        }
    } else {
        $lmo_termine = array();
        $lmo_termine = array_filter($mterm[$st - 1], 'filterZero');  // Nullwerte filtern
        if (!empty($lmo_termine)) {
            $datum = explode('.', date('d.m.Y', min($lmo_termine)));
            $lmo_month_prev = strtotime($datum[0] . ' ' . $me[intval($datum[1])] . ' ' . $datum[2] . ' -1 month');
            $lmo_month_this = strtotime($datum[0] . ' ' . $me[intval($datum[1])] . ' ' . $datum[2]);
            $lmo_month_next = strtotime($datum[0] . ' ' . $me[intval($datum[1])] . ' ' . $datum[2] . ' +1 month');
        } else {
            $lmo_month_prev = strtotime('-1 month');
            $lmo_month_this = strtotime('now');
            $lmo_month_next = strtotime('+1 month');
        }
    }

    // Datenformate generieren
    if ($lmo_month_this != -1) {
        if (!isset($cal)) {
            $cal = date('mY', $lmo_month_this);
        }
        if (strlen($cal) > 4) {  // Monatsanzeige
            $ma = date('mY', $lmo_month_prev);
            $mc = date('mY', $lmo_month_next);
            $md = date('F Y', $lmo_month_this);
            $ml = date('Y', $lmo_month_this);
            $mj = ' ' . $me[intval(date('m', $lmo_month_this))] . ' ' . date('Y', $lmo_month_this);
            $dat1 = getdate(strtotime('1' . $mj));
            $erster = $dat1['wday'];
        } else {  // Jahresanzeige
            $ma = date('Y', $lmo_month_prev);
            $mc = date('Y', $lmo_month_next);
            $md = date('Y', $lmo_month_this);
            $mj = ' ' . date('Y', $lmo_month_this);
        }
    }

    if (strlen($cal) > 4) {  // Monatsanzeige
        $lmo_arrays = 32;
        $lmo_daterule = 'F Y';
        $lmo_daterule2 = 'd';
    } else {  // Jahresanzeige
        $lmo_arrays = 13;
        $lmo_daterule = 'Y';
        $lmo_daterule2 = 'm';
    }

    $lmo_stlink = array_pad(array(), $lmo_arrays, '');
    for ($j = 0; $j < $anzst; $j++) {
        $lmo_stlink_title = array_pad(array(), $lmo_arrays, '');

        for ($i = 0; $i < $anzsp; $i++) {
            if (!empty($mterm[$j][$i]) && date($lmo_daterule, $mterm[$j][$i]) == $md) {  // konkretes Spieldatum vorhanden
                $a = intval(date($lmo_daterule2, $mterm[$j][$i]));
                if (($teama[$j][$i] != 0) && ($teamb[$j][$i] != 0)) {
                    if (!empty($lmo_stlink_title[$a])) {
                        $lmo_stlink_title[$a] = $lmo_stlink_title[$a] . ', &#10;';
                    } else {
                        $lmo_stlink_title[$a] = ($j + 1) . '. ' . $text[2] . ': &#10;';
                    }
                    $lmo_stlink_title[$a] = $lmo_stlink_title[$a] . $teams[$teama[$j][$i]] . ' - ' . $teams[$teamb[$j][$i]];
                }
            }
        }

        // Spieltagsdatum
        if (!empty($datum1[$j])) {
            $datum = explode('.', $datum1[$j]);
            $lmo_stdatum1 = strtotime($datum[0] . ' ' . $me[intval($datum[1])] . ' ' . $datum[2]);
        } else {
            $lmo_stdatum1 = '';
        }
        if (!empty($datum2[$j])) {
            $datum = explode('.', $datum2[$j]);
            $lmo_stdatum2 = strtotime($datum[0] . ' ' . $me[intval($datum[1])] . ' ' . $datum[2]);
        } else {
            $lmo_stdatum2 = '';
        }

        $z = array_filter($lmo_stlink_title, 'filterZero');
        if (!empty($lmo_stdatum1) && empty($z) && date($lmo_daterule, $lmo_stdatum1) == $md) {  // Nur Von... vorhanden
            $a = intval(date($lmo_daterule2, $lmo_stdatum1));
            $lmo_stlink_title[$a] = ($j + 1) . '. ' . $text[2] . ' &#10;(' . $text[155] . ')';
            if (!empty($lmo_stdatum2) && $lmo_stdatum2 > $lmo_stdatum1) {  // Von ... bis ... vorhanden
                for ($k = $a; $k <= intval(date($lmo_daterule2, $lmo_stdatum2)); $k++) {
                    $lmo_stlink_title[$k] = ($j + 1) . '. ' . $text[2] . ' &#10;(' . $text[155] . ')';
                }
            }
        }
        if (!empty($lmo_stdatum2) && empty($z) && date($lmo_daterule, $lmo_stdatum2) == $md) {  // Nur ...Bis vorhanden
            $a = intval(date($lmo_daterule2, $lmo_stdatum2));
            $lmo_stlink_title[$a] = ($j + 1) . '. ' . $text[2] . ' &#10;(' . $text[155] . ')';
        }

        // Links generieren
        for ($i = 0; $i < count($lmo_stlink_title); $i++) {
            if (!empty($lmo_stlink_title[$i])) {
                $lmo_stlink[$i] = $lmo_stlink[$i] . '&nbsp;&nbsp;<a href="' . $addr . ($j + 1) . '" title="' . $lmo_stlink_title[$i] . '">' . ($j + 1) . '. ' . $text[145] . '</a><br>';;
            }
        }
    }  // for $anzst
    include (PATH_TO_LMO . '/lmo-showcal.php');
}
?>