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
// First line of XSS-Identification
$get = array();
$get = $_GET;
foreach ($get as $value) {
    if (str_starts_with($value, '<'))
        die('XSS-Scripting detected');
}
include ('includes/kint.phar');

$fp = fopen('access_log', 'a+');
fwrite($fp, "\nAgent: " . $_SERVER['HTTP_USER_AGENT']);
fwrite($fp, "\nURI: " . $_SERVER['REQUEST_URI']);
fwrite($fp, "\nIP: " . $_SERVER['REMOTE_ADDR']);
fwrite($fp, "\nDate: " . date('d.m.Y H:i:s', $_SERVER['REQUEST_TIME']));
fclose($fp);

/*
 * $content = "Date: ".date("d.m.y H:i:s")."\n";
 * $content .= "GET: ".$_SERVER['QUERY_STRING']."\n";
 * $content .= "Host: ".gethostbyaddr($_SERVER['REMOTE_ADDR'])."\n";
 * $content .= "Server: ".$_SERVER['REMOTE_ADDR']."\n";
 * $content .= "Proxy: ".$_SERVER['HTTP_X_FORWARDED_FOR']."\n";
 *
 * $access = fopen("access_log", "a");
 * fwrite($access, $content);
 * fclose($access);
 */

@ini_set('session.use_trans_sid', '1');
@ini_set('arg_separator.output', '&amp;');

if (session_id() == '')
    session_start();
require (__DIR__ . '/config/init-parameters.php');

if (isset($_GET['debug']) || isset($_SESSION['debug'])) {
    $_SESSION['debug'] = TRUE;
    @error_reporting(E_ALL);
    @ini_set('display_errors', '1');
}
$_SERVER['QUERY_STRING'] = isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : '';

// Path-Contants
if (!defined('PATH_TO_LMO'))
    define('PATH_TO_LMO', $lmo_dateipfad);
if (!defined('PATH_TO_ADDONDIR'))
    define('PATH_TO_ADDONDIR', PATH_TO_LMO . '/addon');
if (!defined('PATH_TO_TEMPLATEDIR'))
    define('PATH_TO_TEMPLATEDIR', PATH_TO_LMO . '/template');
if (!defined('PATH_TO_IMGDIR'))
    define('PATH_TO_IMGDIR', PATH_TO_LMO . '/img');
if (!defined('PATH_TO_LANGDIR'))
    define('PATH_TO_LANGDIR', PATH_TO_LMO . '/lang');
if (!defined('PATH_TO_CONFIGDIR'))
    define('PATH_TO_CONFIGDIR', PATH_TO_LMO . '/config');
if (!defined('PATH_TO_JSDIR'))
    define('PATH_TO_JSDIR', PATH_TO_LMO . '/js');

if (!defined('URL_TO_LMO'))
    define('URL_TO_LMO', $lmo_url);
if (!defined('URL_TO_ADDONDIR'))
    define('URL_TO_ADDONDIR', URL_TO_LMO . '/addon');
if (!defined('URL_TO_TEMPLATEDIR'))
    define('URL_TO_TEMPLATEDIR', URL_TO_LMO . '/template');
if (!defined('URL_TO_IMGDIR'))
    define('URL_TO_IMGDIR', URL_TO_LMO . '/img');
if (!defined('URL_TO_LANGDIR'))
    define('URL_TO_LANGDIR', URL_TO_LMO . '/lang');
if (!defined('URL_TO_CONFIGDIR'))
    define('URL_TO_CONFIGDIR', URL_TO_LMO . '/config');
if (!defined('URL_TO_JSDIR'))
    define('URL_TO_JSDIR', URL_TO_LMO . '/js');

// Check Path
if (!file_exists(PATH_TO_LMO . '/init.php')) {
    echo "Invalid Path to LMO: '" . PATH_TO_LMO . "' - please reinstall or correct manually.";
    exit();
}

// Configuration
require (PATH_TO_LMO . '/lmo-cfgload.php');

if (!defined('LMO_VERSION')) {
    define('LMO_VERSION', $cfgarray['lmoVersion']);
}

// Language
if (isset($_GET['lmouserlang'])) {
    $_SESSION['lmouserlang'] = $_GET['lmouserlang'];
}
if (isset($_POST['lmouserlang'])) {
    $_SESSION['lmouserlang'] = $_POST['lmouserlang'];
}
if (isset($_SESSION['lmouserlang'])) {
    $lmouserlang = $_SESSION['lmouserlang'];
} else {
    $lmouserlang = $deflang;
    $_SESSION['lmouserlang'] = $deflang;
}

require (PATH_TO_LMO . '/lmo-langload.php');
// Dateformat
$fmt = new IntlDateFormatter(
    $text['704'],
    IntlDateFormatter::FULL,  /* Datum */
    IntlDateFormatter::SHORT,  /* Uhrzeit */
    $cfgarray['timezone'],
    IntlDateFormatter::GREGORIAN,
    $cfgarray['defdateformat']
);

// Functions
require_once (PATH_TO_LMO . '/lmo-functions.php');
// Übergang Classlib
require_once (PATH_TO_ADDONDIR . '/classlib/ini.php');
// Template System
require_once (PATH_TO_LMO . '/includes/IT.php');

// Remove Magic Quotes if necessary
magicQuotesRemove($_GET);
magicQuotesRemove($_POST);
magicQuotesRemove($_COOKIE);
// Workaround for register_globals TODO: fix that!!!
if (!function_exists('ini_get') || !ini_get('register_globals')) {
    @extract($_GET);
    @extract($_POST);
    @extract($_COOKIE);
}
?>
