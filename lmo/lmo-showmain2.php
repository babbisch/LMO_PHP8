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
$addm = $_SERVER['PHP_SELF'] . '?file=' . $file . '&amp;action=';

if ($file != '') {
    require (PATH_TO_LMO . '/lmo-openfile.php');
    if (empty($_GET['endtab'])) {
        $endtab = $anzst;
        $ste = $st;
        $tabdat = '';
    } else {
        $endtab = $_GET['endtab'];
        $tabdat = $endtab . '. ' . $text[2];
        $ste = $endtab;
    }
    if (!empty($_GET['st'])) {
        $tabdat = $st . '. ' . $text[2];
    }
    if (empty($_REQUEST['action']) && $action == '') {
        if (!isset($onrun))
            $onrun = '0';
        switch ($onrun) {
            case '0':
                $action = 'results';
                break;
            case '1':
                $action = 'table';
                break;
            case '2':
                $action = 'program';
                break;
            case '3':
                $action = 'cross';
                break;
            case '4':
                $action = 'graph';
                break;
            case '5':
                $action = 'stats';
                break;
            case '6':
                $action = 'cal';
                break;
            case '7':
                $action = 'spieler';
                break;
        }
    }
}

// Alle Teile für die Startansicht
$output_titel = '';
$output_sprachauswahl = '';
$output_kalender = '';
$output_ergebnisse = '';
$output_tabelle = '';
$output_spielplan = '';
$output_kreuztabelle = '';
$output_fieberkurve = '';
$output_ligastatistik = '';
$output_spielerstatistik = '';
$output_info = '';
$output_hauptteil = '';
$output_ligenuebersicht = '';
$output_savehtml = '';
$output_letzteauswertung = '';
$output_berechnungszeit = '';
$output_stylesheet = '';
$output_stylesheet2 = '';
$p1 = '';

if (!defined('LMO_TEMPLATE'))
    define('LMO_TEMPLATE', 'lmo-standard.tpl.php');

// Wenn ein Template der Form [liganame].tpl.php existiert, wird dieses benutzt. Das ermöglicht
// die Nutzung verschiedener Templates für unterschiedliche Ligen
$template = new HTML_Template_IT(PATH_TO_TEMPLATEDIR);
if (file_exists(PATH_TO_TEMPLATEDIR . '/' . basename($file) . '.tpl.php')) {
    $template->loadTemplatefile(basename($file) . '.tpl.php');
} else {
    $template->loadTemplatefile(LMO_TEMPLATE);
}

// if ($action!="tipp") {

// Titel
if ($file != '') {
    $output_titel .= $titel;
} else {
    $output_titel .= $action == 'tipp' ? $text['tipp'][0] : $text[53];
}

// CSSonly
$output_stylesheet = "  <link type='text/css' rel='stylesheet' href='" . URL_TO_TEMPLATEDIR . "/style.css'>";

// Sprachauswahl
if ($einsprachwahl == 1) {
    $output_sprachauswahl = getLangSelector();
}

ob_start();
if ($file != '') {
    // Für normale Ligen
    if ($lmtype == 0) {
        // Kalenderlink
        if ($datc == 1) {
            $output_kalender .= $action != 'cal' ? "<li class='nav-item'><a href='{$addm}cal&amp;st={$st}' class='nav-link'>{$text[140]}</a></li>" : "<li class='nav-item active'><a href='#' class='nav-link active'>$text[140]</a></li>";
        }
        // Ergebnis/Tabelle
        if ($tabonres == 0) {
            if ($ergebnis == 1) {
                $output_ergebnisse .= $action != 'results' ? "<li class='nav-item'><a href='{$addm}results&amp;st={$ste}' class='nav-link'>{$text[10]}</a></li>" : "<li class='nav-item active'><a href='#' class='nav-link active'>$text[10]</a></li>";
            }
            if ($tabelle == 1) {
                $output_tabelle .= $action != 'table' ? "<li class='nav-item'><a href='{$addm}table' class='nav-link'>{$text[16]}</a></li>" : "<li class='nav-item active'><a href='#' class='nav-link active'>$text[16]</a></li>";
            }
            // Kombinierte Ansicht
        } else {
            if ($ergebnis == 1) {
                $output_ergebnisse .= $action != 'results' && $action != 'table' ? "<li class='nav-item'><a href='{$addm}results' class='nav-link'>{$text[10]}/{$text[16]}</a></li>" : "<li class='nav-item active'><a href='#' class='nav-link active'>$text[10]/$text[16]</a></li>";
            }
        }

        // Kreuztabelle
        if ($kreuz == 1) {
            $output_kreuztabelle .= $action != 'cross' ? "<li class='nav-item'><a href='{$addm}cross' class='nav-link'>{$text[14]}</a></li>" : "<li class='nav-item active'><a href='#' class='nav-link active'>$text[14]</a></li>";
        }
        // Spielplan
        if ($plan == 1) {
            $output_spielplan .= $action != 'program' ? "<li class='nav-item'><a href='{$addm}program' class='nav-link'>{$text[12]}</a></li>" : "<li class='nav-item active'><a href='#' class='nav-link active'>$text[12]</a></li>";
        }
        // Fieberkurve
        if ($kurve == 1) {
            $output_fieberkurve .= $action != 'graph' ? "<li class='nav-item'><a href='{$addm}graph&amp;stat1={$stat1}&amp;stat2={$stat2}' class='nav-link'>{$text[133]}</a></li>" : "<li class='nav-item active'><a href='#' class='nav-link active'>$text[133]</a></li>";
        }
        // Ligastatistiken
        if ($ligastats == 1) {
            $output_ligastatistik .= $action != 'stats' ? "<li class='nav-item'><a href='{$addm}stats&amp;stat1={$stat1}&amp;stat2={$stat2}' class='nav-link'>{$text[18]}</a></li>" : "<li class='nav-item active'><a href='#' class='nav-link active'>$text[18]</a></li>";
        }
        // Pokalligen
    } else {
        // Kalenderlink
        if ($datc == 1) {
            $output_kalender .= $action != 'cal' ? "<li class='nav-item'><a href='{$addm}cal&amp;st={$st}' class='nav-link'>{$text[140]}</a></li>" : "<li class='nav-item active'><a href='#' class='nav-link active'>$text[140]</a></li>";;
        }
        // Ergebnisse
        if ($ergebnis == 1) {
            $output_ergebnisse .= $action != 'results' ? "<li class='nav-item'><a href='{$addm}results&amp;st={$ste}' class='nav-link'>{$text[10]}</a></li>" : "<li class='nav-item active'><a href='#' class='nav-link active'>$text[10]</a></li>";
        }
        // Spielplan
        if ($plan == 1) {
            $output_spielplan .= $action != 'program' ? "<li class='nav-item'><a href='{$addm}program' class='nav-link'>{$text[12]}</a></li>" : "<li class='nav-item active'><a href='#' class='nav-link active'>$text[12]</a></li>";
        }
    }
    $output_info .= $action != 'info' ? "<li class='nav-item'><a href='{$addm}info' class='nav-link'>{$text[20]}</a></li>" : "<li class='nav-item active'><a href='#' class='nav-link active'>$text[20]</a></li>";

    $druck = 0;

    if ($action != 'tipp') {
        if ($lmtype == 0) {
            // Normal
            switch ($action) {
                case 'cal':
                    if ($datc == 1) {
                        require (PATH_TO_LMO . '/lmo-cal.php');
                    }
                    break;
                case 'results':
                    if ($ergebnis == 1) {
                        $druck = 1;
                        require (PATH_TO_LMO . '/lmo-showrestab.php');
                    }
                    break;
                case 'table':
                    if ($tabelle == 1) {
                        $druck = 1;
                        require (PATH_TO_LMO . '/lmo-showrestab.php');
                    }
                    break;
                case 'cross':
                    if ($kreuz == 1) {
                        require (PATH_TO_LMO . '/lmo-showcross.php');
                    }
                    break;
                case 'program':
                    if ($plan == 1) {
                        require (PATH_TO_LMO . '/lmo-showprogram.php');
                    }
                    break;
                case 'graph':
                    if ($kurve == 1) {
                        require (PATH_TO_LMO . '/lmo-showgraph.php');
                    }
                    break;
                case 'stats':
                    if ($ligastats == 1) {
                        require (PATH_TO_LMO . '/lmo-showstats.php');
                    }
                    break;
                case '': /* Auswahlseite */ break;
            }
            // Pokal
        } else {
            switch ($action) {
                case 'cal':
                    if ($datc == 1) {
                        require (PATH_TO_LMO . '/lmo-kocal.php');
                    }
                    break;
                case 'results':
                    if ($ergebnis == 1) {
                        require (PATH_TO_LMO . '/lmo-showkoresults.php');
                    }
                    break;
                case 'program':
                    if ($plan == 1) {
                        require (PATH_TO_LMO . '/lmo-showkoprogram.php');
                    }
                    break;
            }
        }
        // Spieler-Addon
        if ($action == 'spieler') {
            if ($mittore == 1) {
                require (PATH_TO_ADDONDIR . '/spieler/lmo-statshow.php');
            }
        }
        // Spieler-Addon
    }
    if ($action == 'info') {
        require (PATH_TO_LMO . '/lmo-showinfo.php');
    }
    $p0 = 'p1';
    $$p0 = c(1) . c(0);
} elseif ($backlink == 1 && $action != 'tipp') {
    require (PATH_TO_LMO . '/lmo-showdir.php');
}

if ($action == 'tipp' && $eintippspiel == 1) {
    require (PATH_TO_ADDONDIR . '/tipp/lmo-tippstart.php');
}
$output_hauptteil .= ob_get_contents();
ob_end_clean();

if ($file != '') {
    // Letzte Auswertung
    $output_letzteauswertung .= $text[406] . ':&nbsp;' . $stand;

    // SaveHTML
    if ($einsavehtml == 1) {
        ob_start();
        include (PATH_TO_LMO . '/lmo-savehtml.php');
        include (PATH_TO_LMO . '/lmo-savehtml1.php');
?><div class="col-2 offset-3 text-start"><?php
        if ($lmtype == 0 && $druck == 1 && file_exists(PATH_TO_LMO . '/' . $diroutput . basename($file) . '-st.html')) {
            echo "<a href='" . URL_TO_LMO . '/' . $diroutput . basename($file) . "-st.html'>{$text[478]}</a>";
        }
        ?>
            </div>
            <div class="col-2 offset-3 text-end"><?php
        if ($lmtype == 0 && $druck == 1 && file_exists(PATH_TO_LMO . '/' . $diroutput . basename($file) . '-sp.html')) {
            echo "<a href='" . URL_TO_LMO . '/' . $diroutput . basename($file) . "-sp.html'>{$text[480]}</a>";
        }
        ?>
            </div><?php
        $output_savehtml .= ob_get_contents();
        ob_end_clean();
    }
}

// Ligenübersicht
if ($backlink == 1 && ($file != '' || $action == 'tipp')) {
    if (basename($file) == $file) {
        $output_ligenuebersicht .= "<a href='" . $_SERVER['PHP_SELF'] . "' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-html='true' title='{$text[392]}'>{$text[391]}</a>";
    } else {
        $output_ligenuebersicht .= "<a href='" . $_SERVER['PHP_SELF'] . '?subdir=' . dirname($file) . "/' data-bs-toggle='tooltip' data-bs-placement='top' data-bs-html='true' title='{$text[392]}'>{$text[391]}</a>";
    }
}

// Berechnungszeit
if ($calctime == 1) {
    $output_berechnungszeit .= $text[471] . ': ' . number_format((getmicrotime() - $startzeit), 4, '.', ',') . ' sek.<br>';
}

// Spieler-Addon
if ($file != '' && $einspieler == 1 && $mittore == 1) {
    include (PATH_TO_ADDONDIR . '/spieler/lmo-statloadconfig.php');
    $output_spielerstatistik .= $action != 'spieler' ? "<li class='nav-item'><a href='{$addm}spieler' class='nav-link'>{$spieler_ligalink}</a></li>" : "<li class='nav-item active'><a href='#' class='nav-link active'>$spieler_ligalink</a></li>";
}
// Spieler-Addon

// Ticker-Addon
$output_newsticker = '';
if ($file != '' && $nticker == 1) {
    ob_start();
    $tickerligen = $file;
    include (PATH_TO_ADDONDIR . '/ticker/ticker.php');
    $output_newsticker .= ob_get_contents();
    ob_end_clean();
}
// Ticker-Addon
// Tippspiel-Addon
$output_tippspiel = '';
if ($eintippspiel == 1) {
    if ($tipp_immeralle == 1 || str_contains($tipp_ligenzutippen, substr(basename($file), 0, -4))) {
        $output_tippspiel .= $action != 'tipp' ? "<li class='nav-item'><a href='{$addm}tipp' class='nav-link'>{$text['tipp'][0]}</a></li>" : "<li class='nav-item active pull-right'><a href='#' class='nav-link active'>{$text['tipp'][0]}</a></li>";
    }
}
e($template->toString());
// Tippspiel-Addon

// Template ausgeben
$template->setVariable('Ligenuebersicht', $output_ligenuebersicht);
$template->setVariable('Berechnungszeit', $output_berechnungszeit);
$template->setVariable('LetzteAuswertung', $output_letzteauswertung);
$template->setVariable('Savehtml', $output_savehtml);
$template->setVariable('Hauptteil', $output_hauptteil);
$template->setVariable('Tabelle', $output_tabelle);
$template->setVariable('Kreuztabelle', $output_kreuztabelle);
$template->setVariable('Fieberkurve', $output_fieberkurve);
$template->setVariable('Spielerstatistik', $output_spielerstatistik);
$template->setVariable('Ligastatistik', $output_ligastatistik);
$template->setVariable('Kalender', $output_kalender);
$template->setVariable('Ergebnisse', $output_ergebnisse);
$template->setVariable('Spielplan', $output_spielplan);
$template->setVariable('Info', $output_info);
$template->setVariable('Infolink', $p1);
$template->setVariable('Sprachauswahl', $output_sprachauswahl);
$template->setVariable('Titel', $output_titel);
$template->setVariable('Stylesheet', $output_stylesheet);
// Ticker-Addon
$template->setVariable('Newsticker', $output_newsticker);
// Ticker-Addon
// Tippspiel-Addon
$template->setVariable('Tippspiel', $output_tippspiel);
// Bootstrap-Version
$template->setVariable('Bootstrap', $bootstrap);
$template->setVariable('BootstrapIcon', $bootstrapIcon);
// Chart.js-Version
$template->setVariable('Chartjs', $chartjs);
$template->show();

// write to cache
/*$lmo_cache->end();
} else {
//Result was cached!
if (isset($_SESSION['debug'])) echo "real time due caching: ".number_format((getmicrotime()-$startzeit),4,".",",")." sek.<br>";
}*/
?>
