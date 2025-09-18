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
if (!file_exists(__DIR__ . '/config/init-parameters.php') || isset($_POST['lmo_install_step'])) {
    include (__DIR__ . '/install/install.php');
} else {
    define('LMO_AUTH', 1);
    require (__DIR__ . '/init.php');
    $subdir = '';
    if (!isset($_SESSION['lmouserok'])) {
        $_SESSION['lmouserok'] = 0;
    }
    if (!isset($_SESSION['lmousername'])) {
        $_SESSION['lmousername'] = '';
    }
    if (!isset($_SESSION['lmouserpass'])) {
        $_SESSION['lmouserpass'] = '';
    }
    if (!isset($_SESSION['lmouserfile'])) {
        $_SESSION['lmouserfile'] = '';
    }
    if (!isset($_SESSION['lmouserokerweitert'])) {
        $_SESSION['lmouserokerweitert'] = 0;
    }

    $todo = isset($_REQUEST['todo']) ? $_REQUEST['todo'] : '';
    $st = isset($_REQUEST['st']) ? $_REQUEST['st'] : NULL;
    if ($todo == 'logout') {
        $_SESSION['lmouserok'] = 0;
        $_SESSION['lmouserpass'] = '';
    }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
					"http://www.w3.org/TR/html4/loose.dtd">
<html lang="de">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=0.8">
    <title>LMO Admin</title>
    <link href="//cdn.jsdelivr.net/npm/bootstrap@<?php echo $bootstrap ?>/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="//cdn.jsdelivr.net/npm/bootstrap-icons@<?php echo $bootstrapIcon ?>/font/bootstrap-icons.css" rel="stylesheet" >
    <link type='text/css' rel='stylesheet' href='<?php echo URL_TO_TEMPLATEDIR ?>/style.css'>
    <link type='text/css' rel='stylesheet' href='<?php echo URL_TO_TEMPLATEDIR ?>/select2.css'>
  </head>
  <body>
    <div class="container"><?php

    $action = 'admin';
    $array = array();
    require (PATH_TO_LMO . '/lmo-adminauth.php');
    if (isset($_SESSION['lmouserok']) && $_SESSION['lmouserok'] > 0) {
        $file = !empty($_REQUEST['file']) ? $_REQUEST['file'] : '';
        if (!empty($file) && ($todo == 'open' || $todo == ''))
            $todo = 'edit';
        if ((!empty($file) && check_hilfsadmin($file)) || empty($file))
            require (PATH_TO_LMO . '/lmo-adminmain.php');
    }
    ?>
    </div>
    <!-- JavaScript Bundle with Popper -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/bootstrap@<?php echo $bootstrap ?>/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script type="text/javascript" src='//cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js'></script>
    <script type="text/javascript" src="<?php echo URL_TO_JSDIR ?>/select2.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
  </body>
</html><?php
}
?>
