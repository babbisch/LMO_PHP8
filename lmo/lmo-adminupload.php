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
if (($action == 'admin') && ($todo == 'upload') && ($_SESSION['lmouserok'] == 2)) {
    $adda = $_SERVER['PHP_SELF'] . '?action=admin&amp;todo=';
    if (isset($_POST['upl']) && isset($_FILES['userfile'])) {
        $tempfilename = $_FILES['userfile']['tmp_name'];
        $namefilename = $_FILES['userfile']['name'];
        if (substr($namefilename, -4) != '.l98') {
            echo getMessage($text[304], TRUE);
            exit;
        }
        $i = 0;
        $ufile = $dirliga . $namefilename;
        while (file_exists($ufile)) {
            $i++;
            if ($i > 0) {
                $ufile = $dirliga . $i . '_' . $namefilename;
            }
        }
        if (move_uploaded_file($tempfilename, $ufile)) {
            echo getMessage($text[303] . ':<br>' . $ufile);
        } else {
            echo getMessage($text[304], TRUE);
        }
        @chmod($ufile, 0644);
    }
?>
<div class="container">
  <div class="row">
    <div class="col d-flex justify-content-center"><h1><?php echo $text[299]; ?></h1></div>
  </div>
  <div class="row justify-content-center">
    <div class="col-md-auto">
      <form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="mb-3">
          <acronym title="<?php echo $text[302] ?>"><?php echo $text[300]; ?>:</acronym>
        </div>
        <div class="input-group mb-3">
          <input type="hidden" name="action" value="admin">
          <input type="hidden" name="todo" value="upload">
          <input type="hidden" name="upl" value="1">
          <input type="file" name="userfile" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary m-3" value=""><?php echo $text[301]; ?></button>
      </form>
    </div>
  </div>
</div><?php
}
?>