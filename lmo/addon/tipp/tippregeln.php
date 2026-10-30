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
require (__DIR__ . '/../../init.php');
$_SESSION['lmouserlang'] = isset($_GET['lmouserlang']) ? $_GET['lmouserlang'] : (isset($_SESSION['lmouserlang']) ? $_SESSION['lmouserlang'] : 'Deutsch');

$lang = array(
    'Deutsch' => array(
        'LANG' => 'DE',
        'HEADER' => 'Tippspielregeln',
        'ABS_1' => 'Anleitung für das Tippspiel',
        'ABS_1_text1' => 'Nach der  Anmeldung zum Tippspiel hat der Tipper die Möglichkeit, eine <strong>oder</strong> mehrere Tippspiele zu abonnieren.',
        'ABS_2' => 'Verfahren zum Abonnieren und Spielen einzelner Ligen',
        'ABS_2_text1' => 'Anmelden und Verwalten',
        'ABS_2_text2' => 'Im Login-Bereich auf "<strong>anmelden</strong>" klicken .',
        'ABS_2_text3' => 'Alle Anmeldedaten eintragen und auswählen, welche Liga abonniert werden möchte.<br /><strong>Hinweis</strong>: Weitere Ligen können jederzeit nach der Erstanmeldung unter Ihrem Usernamen nachträglich abonniert erden!',
        'ABS_2_text4' => 'Nach der Anmeldung erfolgt der Logint bzw. ist der Login mit dem Nickname jederzeit möglich.',
        'ABS_2_text5' => 'Im User-Bereich des Tippspiels kann man:',
        'ABS_2_text6' => 'Eine abonnierte <strong>Liga tippen</strong>',
        'ABS_2_text7' => 'Punktstände anschauen',
        'ABS_2_text8' => 'Daten ändern',
        'ABS_2_text9' => 'andere bzw. neue Ligen in den Tippschein aufnehmen',
        'ABS_2_text10' => 'Passwort ändern',
        'ABS_2_text11' => '<strong>Tipp-Account löschen</strong> (<strong>Achtung</strong>: Alle abonnierten Tippspiele Ihres Nicknames werden gelöscht!)',
        'ABS_2_text12' => 'Aus dem Tippspiel ausloggen',
        'ABS_2_text13' => 'Liga tippen',
        'ABS_2_text14' => 'Nach dem Einloggen im Tippspielbereich eine abonnierte Liga zum Tippen auswählen.',
        'ABS_2_text15' => 'Im Ansetzungsbereich Tipps für die einzelnen Spieltage abgeben.',
        'ABS_2_text16' => 'Nach Eingabe der Tipps <strong>eines Spieltages</strong> klicken auf <strong>Tipps speichern</strong>',
        'ABS_2_text17' => 'Jederzeit auf einen anderen Spieltag wechseln und weitere Tipps abgeben.',
        'ABS_2_text18' => 'Es besteht auch die Möglichkeit pro Spieltag einen <strong>Joker</strong> zu setzen. Die für diesen Spieltag gewonnen Punkte werden dann mit einem bestimmten Faktor multipliziert.',
        'ABS_2_text19' => 'Hinweise zur Tippabgabe',
        'ABS_2_text20' => 'Die Tippzeit läuft für jedes Spiel einzeln ab.',
        'ABS_2_text21' => 'Ablauf der Tippzeit ist jeweils',
        'ABS_2_text21_1' => 'Minuten vor Anpfiff.',
        'ABS_2_text22' => 'Sollten <strong>ohne</strong> unsere Kenntnis einzelne Spiele vorgezogen werden, bitten wir das zu entschuldigen. Wir versuchen jedoch immer <strong>vor</strong> einem Spieltag alle veränderten Anstoßzeiten zu aktualisieren.',
        'ABS_3' => 'Spielwertung und Ligawertung',
        'ABS_3_text1' => 'Die Spielwertung (Punktverteilung)',
        'ABS_3_text2' => 'Ergebnis richtig: <strong>',
        'ABS_3_text2_1' => 'Punkte</strong>',
        'ABS_3_text3' => 'nur Tendenz und Tordifferenz richtig: <strong>',
        'ABS_3_text4' => 'nur Tendenz richtig: <strong>',
        'ABS_3_text5' => 'nur eine Toranzahl richtig: <strong>',
        'ABS_3_text6' => 'Jokermultiplikator:',
        'ABS_3_text7' => 'Es besteht auch die Möglichkeit pro Spieltag einen <strong>Joker</strong> zu setzen. Die für diesen Spieltag gewonnen Punkte werden dann doppelt gewertet.',
        'ABS_3_text8' => 'Die Liga- und Spieltagswertung',
        'ABS_3_text9' => 'Die Gesamtligawertung kann in der Tippspiel-Übersicht eine abonnierte Liga unter dem Punkt: <strong>Punktestände anschauen</strong> betrachtet werdeb.',
        'ABS_3_text10' => 'Sie erreichen die Gesamtligawertung auch, wenn Sie im Tippbereich auf - <strong>Ligawertung</strong> wechseln',
        'ABS_3_text11' => 'Die erzielten Punkte der <strong>einzelnen</strong> Spiele können über den Abruf eines <strong>absolvierten Spieltag</strong> betrachtet werden.',
        'ABS_3_text12' => '<strong>Gesamtsieger</strong> ist, wer nach einer Spielsaison die meisten Punkte auf seinem Spielkonto verbuchen kann.',
        'ABS_3_text13' => 'Zusätzlich können unter <strong>Tippeinsicht</strong> die Tipps der Mitspieler eingesehen werden',
        'ABS_3_text14' => 'Die <strong>Tipp-Tabelle</strong> ist eine Zusatzanzeige, also eine Tabelle erzeugt nach Ihren abgegebenen Tipps',
        'ABS_3_text15' => 'Hinweise zum Zeitpunkt der Tippauswertung',
        'ABS_3_text16' => 'Die technische Auswertung der Spieltipps erfolgt in der Regel nach jedem absolvierten Spieltag.',
        'ABS_3_text17' => 'Bitte beachten Sie, dass sich aus organisatorischen Gründen die Tippauswertung auch einmal um <strong>1 bis 2 Tage</strong> verzögern kann.',
        'ABS_4' => 'Haftungsausschluß',
        'ABS_4_text1' => 'Für etwaige Übertragungsfehler und sonstige technische Schwierigkeiten ist der Veranstalter in keiner Weise verantwortlich zu machen.',
        'ABS_4_text2' => 'Mit der Anmeldung zum Spiel akzeptieren Sie die Bedingungen. Dieses Spiel dient dem reinen Unterhaltungszweck. Wer hackt, verfälscht, oder sich mehrmals unter verschiedenen Namen anmeldet, wird mit Spielsperre bestraft.',
        'ABS_4_text3' => 'Der Rechtsweg ist ausgeschlossen.',
    ),
);
$userlan = $_SESSION['lmouserlang'];

if (isset($lang[$userlan])) {
    $userlang = $userlan;
} else {
    $userlang = 'Deutsch';
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
					"http://www.w3.org/TR/html4/loose.dtd">
<html lang="<?php echo $lang[$userlang]['LANG']; ?>">
<head>
<title><?php echo $lang[$userlang]['HEADER']; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<link href="//cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
<link href="//cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet" >
</head>
<body>
<div class="container">
<div class="row">
<div class="col-8 offset-2">
<div class="p-3 text-center"><h1><?php echo $lang[$userlang]['ABS_1']; ?></h1></div>
<div class="p-3 text-center"><?php echo $lang[$userlang]['ABS_1_text1']; ?></div>
<div class="p-1 bg-subtle-info"><h4><?php echo $lang[$userlang]['ABS_2']; ?></h4></div>
<dl>
  <dt class="fg-danger"><?php echo $lang[$userlang]['ABS_2_text1']; ?></dt>
  <dd><?php echo $lang[$userlang]['ABS_2_text2']; ?></dd>
  <dd><?php echo $lang[$userlang]['ABS_2_text3']; ?></dd>
  <dd><?php echo $lang[$userlang]['ABS_2_text4']; ?></dd>
  <dd><?php echo $lang[$userlang]['ABS_2_text5']; ?>
    <ul>
      <li><?php echo $lang[$userlang]['ABS_2_text6']; ?></li>
      <li><strong><?php echo $lang[$userlang]['ABS_2_text7']; ?></strong></li>
      <li><strong><?php echo $lang[$userlang]['ABS_2_text8']; ?></strong></li>
      <li><strong><?php echo $lang[$userlang]['ABS_2_text9']; ?></strong></li>
      <li><strong><?php echo $lang[$userlang]['ABS_2_text10']; ?></strong></li>
      <li><?php echo $lang[$userlang]['ABS_2_text11']; ?></li>
      <li><strong><?php echo $lang[$userlang]['ABS_2_text12']; ?></strong></li>
    </ul>
  </dd>
  <dt class="fg-danger"><?php echo $lang[$userlang]['ABS_2_text13']; ?></dt>
  <dd><?php echo $lang[$userlang]['ABS_2_text14']; ?></dd>
  <dd><?php echo $lang[$userlang]['ABS_2_text15']; ?></dd>
  <dd><?php echo $lang[$userlang]['ABS_2_text16']; ?></dd>
  <dd><?php echo $lang[$userlang]['ABS_2_text17']; ?></dd><?php
if ($tipp_jokertipp == 1) {
?>
  <dd><?php echo $lang[$userlang]['ABS_2_text18']; ?></dd><?php
}
?>  
  <dt class="fg-danger"><?php echo $lang[$userlang]['ABS_2_text19']; ?>
  <dd><?php echo $lang[$userlang]['ABS_2_text20']; ?></dd>
  <dd><?php echo $lang[$userlang]['ABS_2_text21']; ?> <?php echo $tipp_tippBis; ?> <?php echo $lang[$userlang]['ABS_2_text21_1']; ?></dd>
  <dd><?php echo $lang[$userlang]['ABS_2_text22']; ?></dd>
</dl>
<div class="p-1 bg-subtle-info"><h4><?php echo $lang[$userlang]['ABS_3']; ?></h2></div>
<dl>
  <dt class="fg-danger"><?php echo $lang[$userlang]['ABS_3_text1']; ?></dt>
  <dd>
    <ul>
      <li><?php echo $lang[$userlang]['ABS_3_text2']; ?> <?php echo $tipp_rergebnis; ?> <?php echo $lang[$userlang]['ABS_3_text2_1']; ?></li>
      <li><?php echo $lang[$userlang]['ABS_3_text3']; ?> <?php echo $tipp_rtendenzdiff; ?> <?php echo $lang[$userlang]['ABS_3_text2_1']; ?></li>
      <li><?php echo $lang[$userlang]['ABS_3_text4']; ?> <?php echo $tipp_rtendenz; ?> <?php echo $lang[$userlang]['ABS_3_text2_1']; ?></li>
      <li><?php echo $lang[$userlang]['ABS_3_text5']; ?> <?php echo $tipp_rtor; ?>  <?php echo $lang[$userlang]['ABS_3_text2_1']; ?></li>
<?php if ($tipp_jokertipp == 1) { ?>
      
      <li><?php echo $lang[$userlang]['ABS_3_text6']; ?> <strong><?php echo $tipp_jokertippmulti; ?></strong></li><?php
}
?>  
    </ul><?php
if ($tipp_jokertipp == 1) {
    ?>
     <dd><?php echo $lang[$userlang]['ABS_3_text7']; ?></dd><?php
}
?>  
  </dd>
  <dt class="fg-danger" class="fg-danger"><?php echo $lang[$userlang]['ABS_3_text8']; ?></dt>
  <dd><?php echo $lang[$userlang]['ABS_3_text9']; ?></dd>
  <dd><?php echo $lang[$userlang]['ABS_3_text11']; ?></dd>
  <dd><?php echo $lang[$userlang]['ABS_3_text12']; ?></dd>
  <dd><?php echo $lang[$userlang]['ABS_3_text13']; ?></dd>
  <dd><?php echo $lang[$userlang]['ABS_3_text14']; ?></dd>
  
  <dt class="fg-danger"><?php echo $lang[$userlang]['ABS_3_text15']; ?></dt>
  <dd><?php echo $lang[$userlang]['ABS_3_text16']; ?></dd>
  <dd><?php echo $lang[$userlang]['ABS_3_text17']; ?></dd>
</dl>
<div class="p-1 bg-subtle-info"><h4><?php echo $lang[$userlang]['ABS_4']; ?></h4></div>
<dl>
  <dd><?php echo $lang[$userlang]['ABS_4_text1']; ?></dd>
  <dd><?php echo $lang[$userlang]['ABS_4_text2']; ?></dd>
  <dd><strong><?php echo $lang[$userlang]['ABS_4_text3']; ?></strong></dd>
</dl>
</div>
</div>
</div>
</body>
</html>
