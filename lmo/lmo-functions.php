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
function check_hilfsadmin($datei)
{
    $hilfsadmin_berechtigung = FALSE;
    if (isset($_SESSION['lmouserok']) && $_SESSION['lmouserok'] == 1) {
        $hilfsadmin_ligen = explode(',', $_SESSION['lmouserfile']);
        if (isset($hilfsadmin_ligen)) {
            foreach ($hilfsadmin_ligen as $hilfsadmin_liga) {
                if ($hilfsadmin_liga . '.l98' == basename($datei)) {
                    $hilfsadmin_berechtigung = TRUE;
                }
            }
        }
    } else {
        $hilfsadmin_berechtigung = TRUE;
    }
    return $hilfsadmin_berechtigung;
}

function applyFactor($value, $factor)
{
    if (is_numeric($value) && $value != 0) {
        return ($value / $factor);
    }
    return $value;
}

function magicQuotesRemove(&$array)
{
    // if(!get_magic_quotes_gpc())
    // return;
    foreach ($array as $key => $elem) {
        if (is_array($elem))
            magicQuotesRemove($elem);
        else
            $array[$key] = stripslashes($elem);
    }
}

function get_dir($verz)
{
    $ret = array();
    if (substr($verz, -1) != '/')
        $verz .= '/';

    $handle = opendir(PATH_TO_LMO . '/' . $verz);
    if ($handle) {
        while ($file = readdir($handle)) {
            if ($file != '.' && $file != '..') {
                if (is_dir(PATH_TO_LMO . '/' . $verz . $file)) {
                    $ret[] = $file;
                }
            }
        }
        closedir($handle);
    }
    return $ret;
}

function filterZero($a)
{
    return (!empty($a));
}

/**
 * Returns a formatted (error) Message
 *
 * @param        string     $message       Message to return
 * @param        bool       $error         Default FALSE, Is this an error message?
 * @return       string     Formatted (error) message
 */
function getMessage($message, $error = FALSE)
{
    if ($error) {
        return '<p class="d-flex justify-content-center"><i class="bi bi-x-circle-fill text-danger"> ' . $message . '</i></p>';
    } else {
        return '<p class="d-flex justify-content-center"><i class="bi bi-check-circle-fill text-success"> ' . $message . '</i></p>';
    }
}

/**
 * Returns which team is the winner on a
 *
 * @param        string     $gst
 * @param        string     $gsp
 * @param        string     $gmod	modus (0->regular / 1-> KO / 2->KO with 2 games / 3->best of 3 / 5->best of 5 / 7->best of 7)
 * @param        array	    $m1		results of home team
 * @param        array	    $m2		results of away team
 * @return       int        $erg	winner(home / away)
 */
function gewinn($gst, $gsp, $gmod, $m1, $m2)
{
    $erg = 0;
    if ($gmod == 1) {
        if ($m1[0] > $m2[0]) {
            $erg = 1;
        } elseif ($m1[0] < $m2[0]) {
            $erg = 2;
        }
    } elseif ($gmod == 2) {
        if ($m1[1] != '_') {
            if (($m1[0] + $m1[1]) > ($m2[0] + $m2[1])) {
                $erg = 1;
            } elseif (($m1[0] + $m1[1]) < ($m2[0] + $m2[1])) {
                $erg = 2;
            } else {
                if ($m2[1] > $m1[1]) {
                    $erg = 2;
                } elseif ($m2[1] < $m1[1]) {
                    $erg = 1;
                }
            }
        }
    } else {
        $erg1 = 0;
        $erg2 = 0;
        for ($k = 0; $k < $gmod; $k++) {
            if (($m1[$k] != '_') && ($m2[$k] != '_')) {
                if ($m1[$k] > $m2[$k]) {
                    $erg1++;
                } elseif ($m1[$k] < $m2[$k]) {
                    $erg2++;
                }
            }
        }
        if ($erg1 > ($gmod / 2)) {
            $erg = 1;
        } elseif ($erg2 > ($gmod / 2)) {
            $erg = 2;
        }
    }
    return $erg;
}

function getLangSelector()
{
    $output_sprachauswahl = '';
    $border = 0;

    $handle = opendir(PATH_TO_LANGDIR);
    while (false !== ($f = readdir($handle))) {
        if (preg_match('/^lang-?(.*)?\.txt$/', $f, $lang) > 0) {
            if ($lang[1] == '')
                return '';
            $imgfile = URL_TO_IMGDIR . '/' . $lang[1] . '.svg';
            if ($lang[1] == $_SESSION['lmouserlang']) //{
                $border=2;
            $output_sprachauswahl .= "<a href='{$_SERVER['PHP_SELF']}?" . htmlentities(preg_replace('/&?lmouserlang=.+?\b/', '', $_SERVER['QUERY_STRING'])) . "&amp;lmouserlang={$lang[1]}' title='{$lang[1]}'><img src='{$imgfile}' title='{$lang[1]}' border='$border' width='20' alt='{$lang[1]}'></a>\n";
            $border=0;
        }
    }
    closedir($handle);
    if (isset($_SESSION['lmouserok']) && $_SESSION['lmouserok'] == '2') {
        // $output_sprachauswahl .= "&nbsp<a href='".URL_TO_LMO."/lang/translate.php'> » ".$GLOBALS['text'][573]."</a>";
    }
    return $output_sprachauswahl;
}

function get_timezones()
{
    // load avail timezones
    if (function_exists('timezone_identifiers_list')) {
        $zones = array_reverse(timezone_identifiers_list());

        foreach ($zones as $zone) {
            $zone = explode('/', $zone);  // 0 => Continent, 1 => City

            // Only use "friendly" continent names
            if ($zone[0] == 'Africa' ||
                    $zone[0] == 'America' ||
                    $zone[0] == 'Antarctica' ||
                    $zone[0] == 'Arctic' ||
                    $zone[0] == 'Asia' ||
                    $zone[0] == 'Atlantic' ||
                    $zone[0] == 'Australia' ||
                    $zone[0] == 'Europe' ||
                    $zone[0] == 'Indian' ||
                    $zone[0] == 'Pacific') {
                if (isset($zone[1]) != '') {
                    $locations[$zone[0]][$zone[0] . '/' . $zone[1]] = str_replace('_', ' ', $zone[1]);  // Creates array(DateTimeZone => 'Friendly name')
                }
            }
        }
    } else {
        return array();
    }
    return array_reverse($locations);
}


// Redirect browser using the header function
function redirect($location)
{
    header('Location: ' . $location);
}
?>