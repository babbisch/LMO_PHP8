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
$save = isset($_REQUEST['save']) ? $_REQUEST['save'] : 0;
$liga = isset($_REQUEST['liga']) ? $_REQUEST['liga'] : '';

if ($save == 2) {
    require (PATH_TO_ADDONDIR . '/tipp/lmo-tippsavewert.php');
}
if ($save == 4) {
    require (PATH_TO_ADDONDIR . '/tipp/lmo-tippsavewertgesamt.php');
}
if ($save == 3) {
    require (PATH_TO_ADDONDIR . '/tipp/lmo-tippsaveeinsicht.php');
}

include (PATH_TO_ADDONDIR . '/tipp/lmo-admintippmenu.php');
?>

<div class="container">
  <div class="row">
    <div class="col d-flex justify-content-center"><h1><?php echo $text['tipp'][63] ?></h1></div>
  </div>
  <div class="row">
    <div class="col"><?php echo $text['tipp'][64]; ?></div>
  </div><?php
$ftype = '.l98';
$iptype = 'auswert';
require (PATH_TO_ADDONDIR . '/tipp/lmo-tippnewdir.php');
if ($tipp_gesamt == 1) {
?>
  <div class="row p-3">
    <div class="col-4 col-md-2 offset-md-4 text-end"><strong><?php echo $text['tipp'][56]; ?></strong></div>
    <div class="col-3">
      <form name="lmoedit" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="hidden" name="action" value="admin">
        <input type="hidden" name="todo" value="tipp">
        <input type="hidden" name="save" value="4">
        <input class="btn btn-sm btn-secondary" type="submit" name="best" value="<?php echo $text['tipp'][236]; ?>">
      </form>
    </div>
  </div><?php } ?>
  <div class="row">
    <div class="col"><?php echo $text['tipp'][155]; ?></div>
  </div><?php
$ftype = '.l98';
$iptype = 'einsicht';
require (PATH_TO_ADDONDIR . '/tipp/lmo-tippnewdir.php');
?>
  </div>
</div>