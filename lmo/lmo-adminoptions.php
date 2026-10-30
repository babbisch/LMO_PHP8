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
isset($_POST['save']) ? $save = $_POST['save'] : $save = 0;
isset($_REQUEST['show']) ? $show = $_REQUEST['show'] : $show = 0;
if ($save == 1) {
    switch ($show) {
        case 0:
            $dirliga = trim($_POST['xdirliga']);
            if ($dirliga == '') {
                $dirliga = './';
            }
            $dirliga = str_replace('\\', '/', $dirliga);  // (Falschen) Backslash -> Slash
            if (substr($dirliga, -1) != '/')
                $dirliga .= '/';  // Slash ergänzen falls nicht vorhanden
            $ArchivDir = $dirliga . 'archiv/';

            $deflang = isset($_POST['xdeflang']) ? trim($_POST['xdeflang']) : $deflang;

            // Zeitformat kontrollieren
            $deftime = isset($_POST['xdeftime']) ? $_POST['xdeftime'] : '15:30';
            $datum_tmp = explode(':', $deftime);
            $deftime = date('H:i', mktime($datum_tmp[0], $datum_tmp[1]));

            if (!empty($_POST['xdefdateselect'])) {
                $defdateformat = isset($_POST['xdefdateformat']) ? $_POST['xdefdateformat'] : $defdateformat;
            } else {
                $defdateformat = isset($_POST['xdefdateformat2']) ? $_POST['xdefdateformat2'] : $defdateformat;
            }
            $timezone = isset($_POST['xtimezone']) ? $_POST['xtimezone'] : '';
            $aadr = isset($_POST['xadr']) ? $_POST['xadr'] : '';

            $liga_sort = isset($_POST['xliga_sort']) ? $_POST['xliga_sort'] : 'liga_name';
            $liga_sort_direction = isset($_POST['xliga_sort_direction']) ? $_POST['xliga_sort_direction'] : 'asc';

            break;
        case 1:
            $tabpkt = isset($_POST['xtabpkt']) ? trim($_POST['xtabpkt']) : $tabpkt;
            $tabonres = isset($_POST['xtabonres']) ? trim($_POST['xtabonres']) : $tabonres;
            break;
        case 2:
            $backlink = isset($_POST['xbacklink']) ? 1 : 0;
            $archivlink = isset($_POST['xarchivlink']) ? 1 : 0;
            $calctime = isset($_POST['xcalctime']) ? 1 : 0;
            $einsavehtml = isset($_POST['xeinsavehtml']) ? 1 : 0;
            $einsprachwahl = isset($_POST['xeinsprachwahl']) ? 1 : 0;
            $einspieler = isset($_POST['xeinspieler']) ? 1 : 0;
            $eintippspiel = isset($_POST['xeintippspiel']) ? 1 : 0;
            $einspielfrei = isset($_POST['xeinspielfrei']) ? 1 : 0;
            $einzutore = isset($_POST['xeinzutore']) ? 1 : 0;
            $einzutoretab = isset($_POST['xeinzutoretab']) ? 1 : 0;
            // /$einhinrueck=isset($_POST["xeinhinrueck"])?1:0;
            $einzustats = isset($_POST['xeinzustats']) ? 1 : 0;
            break;
    }
    require (PATH_TO_LMO . '/lmo-savecfg.php');
    require (PATH_TO_LMO . '/init.php');
}
?>

<nav class="p-3">
  <ul class="nav nav-pills justify-content-center">
    <li class="nav-item"><a href="#" class="nav-link active"><?php echo $text[319] ?></a></li>
    <li class="nav-item"><a href="<?php echo $addr_addons ?>" class="nav-link" title="<?php echo $text[498] ?>"><?php echo $text[497] ?></a></li>
    <li class="nav-item"><a href="<?php echo $addr_user ?>" class="nav-link" title="<?php echo $text[318] ?>"><?php echo $text[317] ?></a></li>
  </ul>
</nav>
<div class="container">
  <div class="row d-flex justify-content-center">
    <div class="col-auto"><h1><?php echo $text[225] ?></h1></div>
  </div>
  <div class="row">
    <div class="col-3">
      <div class="container">
        <div class="row p-1">
          <div class="col-auto text-end"><?php if ($show == 0) {
    echo "<p class='btn-outline btn-sm theme-info'>$text[99]</p>"; ?><?php } else { ?> <a class="btn-solid btn-sm" href="<?php echo $_SERVER['PHP_SELF'] . '?action=admin&amp;todo=options&amp;show=0'; ?>"><?php echo $text[99]; ?></a><?php } ?></div>
        </div>
        <div class="row p-1">
          <div class="col-auto text-end"><?php if ($show == 1) {
    echo "<p class='btn-outline btn-sm theme-info'>$text[226]</p>"; ?><?php } else { ?> <a class="btn-solid btn-sm" href="<?php echo $_SERVER['PHP_SELF'] . '?action=admin&amp;todo=options&amp;show=1'; ?>"><?php echo $text[226]; ?></a><?php } ?></div>
        </div>
        <div class="row p-1">
          <div class="col-auto text-end"><?php if ($show == 2) {
    echo "<p class='btn-outline btn-sm theme-info'>$text[250]</p>"; ?><?php } else { ?> <a class="btn-solid btn-sm" href="<?php echo $_SERVER['PHP_SELF'] . '?action=admin&amp;todo=options&amp;show=2'; ?>"><?php echo $text[250]; ?></a><?php } ?></div>
        </div>
      </div>
    </div>
    <div class="col-9 sm:col-6">
      <form name="lmoedit" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onSubmit="return chklmopass()">
        <input type="hidden" name="action" value="admin">
        <input type="hidden" name="todo" value="options">
        <input type="hidden" name="save" value="1">
        <input type="hidden" name="file" value="<?php echo $file; ?>">
        <input type="hidden" name="show" value="<?php echo $show; ?>">
        <div class="container"><?php
if ($show == 0) {
    ?>
          <div class="row align-items-center pb-1">
            <div class="col-5 text-end" data-bs-toggle="tooltip" data-bs- title="<?php echo $text[506] ?>"><?php echo $text[505]; ?></div>
            <div class="col-4 text-start">
              <select class="form-control" name="xdeflang" ><?php
    $handle = opendir(PATH_TO_LANGDIR);
    while (false !== ($f = readdir($handle))) {
        if (preg_match('/^lang-?(.*)?\.txt$/', $f, $lang) > 0) {
            ?>
                <option<?php if ($lang[1] == $deflang) echo ' selected'; ?>><?php echo $lang[1]; ?></option><?php
        }
    }
    closedir($handle);
    ?>
              </select>
            </div>
          </div><?php
    if (version_compare(PHP_VERSION, '5.1.0') >= 0) {
        ?>
          <div class="row align-items-center pb-1">
            <div class="col-5 text-end" data-bs-toggle="tooltip" data-bs- title="<?php echo $text[575] ?>"><?php echo $text[574]; ?></div>
            <div class="col-4 text-start">
              <select class="form-control w-7 select2" name="xtimezone" ><?php
        $timezones = get_timezones();
        foreach ($timezones as $continent => $zones) {
            ?>
                <optgroup label="<?php echo $continent; ?>"><?php
            foreach ($zones as $zone_value => $zone_name) {
                ?>
                  <option value="<?php echo $zone_value; ?>" <?php if ($zone_value == $timezone) echo 'selected'; ?>><?php echo $zone_name; ?></option><?php
            }
            ?>
            </optgroup><?php
        }
        ?>
              </select>
            </div>
          </div><?php
    }
    ?>
          <div class="row align-items-center pb-1">
            <div class="col-5 text-end" data-bs-toggle="tooltip" data-bs- title="<?php echo $text[222] ?>"><?php echo $text[221]; ?></div>
            <div class="col-3 text-start"><input class="form-control w-7" type="text" name="xdirliga" size="25" maxlength="80" value="<?php echo $dirliga; ?>" ></div>
          </div>
          <div class="row align-items-center pb-1">
            <div class="col-5 text-end" data-bs-toggle="tooltip" data-bs- title="<?php echo $text[240] ?>"><?php echo $text[239]; ?></div>
            <div class="col-2 text-start"><input class="form-control w-7" type="time" name="xdeftime" size="25" maxlength="5" value="<?php echo $deftime; ?>" ></div>
          </div>
          <div class="row align-items-center pb-1">
            <div class="col-5 text-end" data-bs-toggle="tooltip" data-bs- title="<?php echo $text[256] ?>"><?php echo $text[257]; ?>&nbsp;</div>
            <div class="col-5 text-start">
              <input type="text" class="form-control w-12" name="xdefdateformat2" value="<?php echo $defdateformat ?>">
            </div>
          </div>
          <div class="row align-items-center pb-1">
            <div class="col-5 text-end" data-bs-toggle="tooltip" data-bs- title="<?php echo $text[344] ?>"><?php echo $text[343]; ?></div>
            <div class="col-4 text-start"><input class="form-control w-12" type="text" name="xadr" size="25" maxlength="128" value="<?php echo $aadr; ?>" ></div>
          </div>
          <div class="row align-items-center pb-1">
            <div class="col-5 text-end" data-bs-toggle="tooltip" data-bs- title="<?php echo $text[532] ?>"><?php echo $text[533]; ?></div>
            <div class="col-4">
              <select class="form-control w-12" name="xliga_sort" >
                <option value="liga_name"<?php if ($liga_sort == 'liga_name') echo ' selected'; ?>><?php echo $text[529] ?></option>
                <option value="file_date"<?php if ($liga_sort == 'file_date') echo ' selected'; ?>><?php echo $text[530] ?></option>
                <option value="file_name"<?php if ($liga_sort == 'file_name') echo ' selected'; ?>><?php echo $text[531] ?></option>
              </select>
            </div>
            <div class="col-3 text-start form-field">
              <input type="radio" class="radio" id="gridRadio1" name="xliga_sort_direction"  value="asc"<?php if ($liga_sort_direction == 'asc') echo ' checked'; ?>>
              <label for="gridRadio1"><?php echo $text[527] ?></label>
              <input type="radio" class="radio" id="gridRadio2" name="xliga_sort_direction"  value="desc"<?php if ($liga_sort_direction == 'desc') echo ' checked'; ?>>
              <label for="gridRadio2"><?php echo $text[528] ?></label>
            </div>
          </div><?php
} elseif ($show == 1) {
    ?>
          <div class="row align-items-center pb-1">
            <div class="col-5 text-end" data-bs-toggle="tooltip" data-bs- title="<?php echo $text[228] ?>"><?php echo $text[227]; ?></div>
            <div class="col-7 text-start">
              <select class="form-control" name="xtabpkt" >
                <option value="0"<?php if ($tabpkt == 0) { echo ' selected'; } ?>><?php echo $text[229] ?></option>
                <option value="1"<?php if ($tabpkt == 1) { echo ' selected'; } ?>><?php echo $text[230] ?></option>
              </select>
            </div>
          </div>
          <div class="row align-items-center pb-1">
            <div class="col-5 text-end" data-bs-toggle="tooltip" data-bs- title="<?php echo $text[232] ?>"><?php echo $text[231] ?></div>
            <div class="col-7 text-start">
              <select class="form-control" name="xtabonres" >
                <option value="0"<?php if ($tabonres == 0) { echo ' selected'; } ?>><?php echo $text[233] ?></option>
                <option value="1"<?php if ($tabonres == 1) { echo ' selected'; } ?>><?php echo $text[234] ?></option>
              </select>
            </div>
          </div><?php
} elseif ($show == 2) {
    ?>
          <div class="row align-items-center pb-1">
            <div class="col-5 text-end" data-bs-toggle="tooltip" data-bs-title="<?php echo $text[390] ?>"><?php echo $text[389]; ?></div>
            <div class="col-1"><input type="checkbox" class="check" name="xbacklink" <?php if ($backlink == 1) { echo ' checked'; } ?>></div>
            <div class="col-6 form-field"><input type="checkbox" class="check" name="xarchivlink" <?php if ($archivlink == 1) { echo ' checked'; } ?>>
            <label><?php echo $text[509]; ?></label></div>
          </div>
          <div class="row align-items-center pb-1">
            <div class="col-5 text-end" data-bs-toggle="tooltip" data-bs- title="<?php echo $text[473] ?>"><?php echo $text[472]; ?></div>
            <div class="col-1"><input type="checkbox" class="check" name="xcalctime" <?php if ($calctime == 1) { echo ' checked'; } ?>></div>
            <div class="col-6 form-field"><input type="checkbox" class="check" name="xeinsavehtml" <?php if ($einsavehtml == 1) { echo ' checked'; } ?>>
            <label><?php echo $text[483]; ?></label></div>
          </div>
          <div class="row align-items-center pb-1">
            <div class="col-5 text-end" data-bs-toggle="tooltip" data-bs-title="<?php echo $text[486] ?>"><?php echo $text[485]; ?></div>
            <div class="col-1"><input type="checkbox" class="check" name="xeinspieler" <?php if ($einspieler == 1) { echo ' checked'; } ?>></div>
            <div class="col-6 form-field"><input type="checkbox" class="check" name="xeinzustats" <?php if ($einzustats == 1) { echo ' checked'; } ?>>
            <label><?php echo $text[495]; ?></label></div>
          </div>
          <div class="row align-items-center pb-1">
            <div class="col-5 text-end" data-bs-toggle="tooltip" data-bs-title="<?php echo $text[535] ?>"><?php echo $text[534]; ?></div>
            <div class="col-1"><input type="checkbox" class="check" name="xeinspielfrei" <?php if ($einspielfrei == 1) { echo ' checked'; } ?>></div>
            <div class="col-6 form-field"><input type="checkbox" class="check" name="xeintippspiel" <?php if ($eintippspiel == 1) { echo ' checked'; } ?>>
            <label><?php echo $text[487]; ?></label></div>
          </div>
          <div class="row align-items-center pb-1">
            <div class="col-6"></div>
            <div class="col-6 form-field"><input type="checkbox" class="check" name="xeinsprachwahl" <?php if ($einsprachwahl == 1) { echo ' checked'; } ?>>
            <label><?php echo $text[519]; ?></label></div>
          </div>
          <div class="row align-items-center pb-1">
            <div class="col-5 text-end" data-bs-toggle="tooltip" data-bs-title="<?php echo $text[490] ?>"><?php echo $text[489]; ?></div>
            <div class="col-1"></div>
            <div class="col-6 text-start form-field">
              <input type="checkbox" class="check" name="xeinzutoretab" <?php if ($einzutoretab == 1) { echo ' checked'; } ?>><label><?php echo $text[491] ?></label>
              <input type="checkbox" class="check" name="xeinzutore" <?php if ($einzutore == 1) { echo ' checked'; } ?>><label><?php echo $text[492] ?></label>
            </div>
          </div><?php
}
?>
          <div class="row p-3">
            <div class="col-auto">
              <input title="<?php echo $text[114] ?>" class="btn-solid btn-sm theme-primary" type="submit" name="best" value="<?php echo $text[188]; ?>">
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>