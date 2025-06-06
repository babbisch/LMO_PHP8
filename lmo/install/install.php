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
session_start();

$min_php_version = '8.0.0';

// check if the call is from maindir (lmo.php) or install/install.php directly
if (is_readable('includes/FTP.php')) {
    // check for ftp capabilities
    if (!function_exists('ftp_connect')) {
        if (function_exists('fsockopen')) {
            require_once 'includes/Socket.php';
        } else {
            // not ftp, no sockets -> manual
            $_REQUEST['man'] = 1;
        }
    }
    require_once 'includes/FTP.php';
} else {
    if (!function_exists('ftp_connect')) {
        if (function_exists('fsockopen')) {
            require_once '../includes/Socket.php';
        } else {
            // not ftp, no sockets -> manual
            $_REQUEST['man'] = 1;
        }
    }
    require_once '../includes/FTP.php';
}

if (!isset($_SESSION['ftpserver'])) {
    $_SESSION['ftpserver'] = '';
}
if (!isset($_SESSION['ftpuser'])) {
    $_SESSION['ftpuser'] = '';
}
if (!isset($_SESSION['ftppass'])) {
    $_SESSION['ftppass'] = '';
}
$_SESSION['userlang'] = isset($_GET['userlang']) ? $_GET['userlang'] : (isset($_SESSION['userlang']) ? $_SESSION['userlang'] : 'DE');
$userlang = $_SESSION['userlang'];

$filelist = array(
    777 => array('ligen', 'output', 'config', 'config/viewer', 'addon/tipp/tipps', 'addon/tipp/tipps/auswert', 'addon/tipp/tipps/einsicht', 'addon/tipp/tipps/auswert/vereine', 'addon/spieler/stats'),
    666 => array('config/cfg.txt', 'config/lmo-auth.php', 'config/tipp/cfg.txt', 'config/spieler/cfg.txt', 'config/ticker/cfg.txt', 'config/mini/cfg.txt', 'config/classlib/cfg.txt', 'addon/tipp/lmo-tipperauth.php', 'ligen/*.l98')
);
$lang = array(
    'DE' => array(
        'HEADER' => 'Installation des Liga Manager Online 4',
        'PROCEED' => 'Weiter',
        'SUCCESS' => 'Erfolg',
        'ERROR' => 'Fehler',
        'CHECK_AGAIN' => 'Neu prüfen',
        'ERROR_WRONG_PATH' => 'Der Pfad ist nicht korrekt!',
        'ERROR_CONFIRM' => 'Es sind noch Fehler vorhanden! Der LMO wird NICHT funktionieren. Trotzdem fortfahren?',
        'ERROR_PHP' => 'Dieser LMO benötigt mindestens PHP '.$min_php_version,
        'STEP0' => 'FTP-Zugangsdaten',
        'STEP0_DESCRIPTION' => 'Um den LMO vollautomatisch zu installieren, ist ein Zugang per FTP notwendig.
         Dazu müssen Sie die Logindaten für Ihren FTP-Zugang angeben. Die Daten werden vom LMO
         nicht gespeichert oder in irgendeiner anderen Weise weiterverwendet. Falls Sie
         manuell installieren möchten gelangen Sie
         <a href="' . $_SERVER['PHP_SELF'] . '?lmo_install_step=2&amp;man=1">hier zur manuellen Installation.</a>',
        'STEP0_FTP_SERVER' => 'Geben sie hier die Adresse ihres FTP-Servers ein',
        'STEP0_FTP_SERVER_EXAMPLE' => 'ftp.beispiel.de',
        'STEP0_FTP_LOGIN' => 'Geben Sie hier Ihren Usernamen und Ihr Passwort ein',
        'STEP0_FTP_NO_CONNECTION' => 'Keine Verbindung zu "' . $_SESSION['ftpserver'] . '" möglich. Korrigieren Sie die Adresse oder <a href="' . $_SERVER['PHP_SELF'] . '?lmo_install_step=2&amp;man=1">installieren Sie manuell</a>',
        'STEP0_FTP_NO_LOGIN' => 'Fehler beim Einloggen. Korrigieren Sie die Benutzerdaten oder <a href="' . $_SERVER['PHP_SELF'] . '?lmo_install_step=2&amp;man=1">installieren Sie manuell</a>',
        'STEP1' => 'LMO-Verzeichnis auswählen',
        'STEP1_SELECT_FTP_DIR' => 'Wählen Sie das LMO Verzeichnis aus',
        'STEP2' => 'Dateirechte setzen',
        'STEP2_MANUAL' => '<p><strong>Kopieren Sie den Inhalt des Ordners <code>install</code> mit einem FTP-Programm über Ihr LMO-Verzeichnis.</strong></p>
         <p><img src="img/manual_copy.png" alt="Kopieren der Dateien mittels FTP-Programm" width="696"></p>
         <p><strong>Setzen Sie danach die benötigten Rechte über ihr FTP-Programm.</strong></p>
         <p><img src="img/manual_chmod.png" alt="Setzen der Rechte mittels FTP-Programm" width="427"></p>
         <p>Aktualisieren Sie diese Seite <a href="#" onclick="location.reload();return false;">[Reload]</a>, um
         zu überprüfen, ob alle Rechte richtig gesetzt sind. <a href="' . $_SERVER['PHP_SELF'] . '">[Zurück zur automatischen Installation (falls verfügbar)]</a></p>',
        'STEP3' => 'Konfigurationsdatei erstellen',
        'STEP3_PATH' => 'Geben Sie hier den <strong>kompletten Pfad</strong> zum LMO an',
        'STEP3_PATH_EXAMPLE' => '/home/www/htdocs/lmo',
        'STEP3_PATH_CORRECT' => 'Der Pfad ist korrekt!',
        'STEP3_PATH_WRONG' => 'Der Pfad ist nicht korrekt!',
        'STEP3_URL' => 'Geben Sie hier die absolute URL zum LMO an',
        'STEP3_URL_CORRECT' => ' Wenn Sie hier ein Bild sehen, ist die URL richtig!',
        'STEP3_URL_EXAMPLE' => '//www.beispiel.de/lmo',
        'STEP3_ERROR_INI_FILE_NOT_OPENABLE' => 'Konnte Datei <code>config/init-parameters.php</code> nicht öffnen! Bitte setzen Sie die Rechte auf chmod 666 und <a href="#" onclick="location.reload();return false;">aktualisieren Sie diese Seite</a>, um den Vorgang zu wiederholen.',
        'STEP3_ERROR_INI_FILE_NOT_WRITEABLE' => 'Konnte die Konfiguration nicht speichern. Vergewissern Sie sich, dass die Datei <code>config/init-parameters.php</code> die Rechte 666 besitzt. Bitte setzen Sie die Rechte auf chmod 666 und <a href="#" onclick="location.reload();return false;">aktualisieren Sie diese Seite</a>, um den Vorgang zu wiederholen.',
        'STEP3_SUCCESS_INI_FILE' => 'Die Konfiguration wurde erfolgreich gespeichert',
        'STEP4' => 'Installation erfolgreich',
        'STEP4_TEXT1' => 'Der Liga Manager Online 4 ist installiert worden!',
        'STEP4_TEXT2' => 'Falls Fehler aufgetreten sind, wiederholen sie die Installation oder installieren Sie den LMO manuell, indem Sie
    die Datei <code>config/init-parameters.php</code> mit einem Texteditor anpassen und die Schreibrechte mit einem FTP-Programm
    manuell vergeben.',
        'STEP4_TEXT3' => 'Bitte löschen Sie jetzt unbedingt den Ordner <code>install</code> vom Server oder geben Sie dem Ordner chmod 000.',
        'STEP4_TEXT4' => '<ul class="attention">
                        <li><strong>Link zum <acronym title="Liga Manager Online">LMO</acronym>:</strong> <a href="%s">%s</a></li>
                        <li><strong>Link zum Adminbereich:</strong> <a href="%s">%s</a> <small>(Standardlogin ist <kbd>admin</kbd> / <kbd>lmo</kbd>)</small></li>
                        <li><strong>Link zur Benutzeranleitung:</strong> <a href="%s">%s</a></li>
                      </ul>',
        'STEP4_TEXT5' => 'Unterstützen Sie den LMO durch eine Spende: <form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="paypal">
                      <input type="hidden" name="cmd" value="_s-xclick">
                      <input type="image" src="https://www.paypal.com/de_DE/i/btn/x-click-but04.gif" name="submit" alt="Spenden Sie für den LMO!">
                      <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
"></form>',
        'STEP4_TEXT6' => 'Viel Spaß!',
    ),
    'EN' => array(
        'HEADER' => 'Installation of Liga Manager Online 4',
        'PROCEED' => 'Proceed',
        'SUCCESS' => 'Success',
        'ERROR' => 'Error',
        'CHECK_AGAIN' => 'Test again',
        'ERROR_WRONG_PATH' => 'Incorrect path!',
        'ERROR_CONFIRM' => 'There are still errors left! Proceed?',
        'ERROR_PHP' => 'This LMO requires at least PHP '.$min_php_version,
        'STEP0' => 'FTP login data',
        'STEP0_DESCRIPTION' => 'To install the LMO automaticly you must insert your FTP login data.
        The data will not saved nor published. If you want to install manually use
         <a href="' . $_SERVER['PHP_SELF'] . '?lmo_install_step=2&amp;man=1">this link</a>.',
        'STEP0_FTP_SERVER' => 'FTP server address',
        'STEP0_FTP_SERVER_EXAMPLE' => 'ftp.example.com',
        'STEP0_FTP_LOGIN' => 'Insert your username and password',
        'STEP0_FTP_NO_CONNECTION' => 'Can not establish connection to "' . $_SESSION['ftpserver'] . '". Please correct the address of server or <a href="' . $_SERVER['PHP_SELF'] . '?lmo_install_step=2&amp;man=1">install manually</a>',
        'STEP0_FTP_NO_LOGIN' => 'Login error. Please correct your user data or <a href="' . $_SERVER['PHP_SELF'] . '?lmo_install_step=2&amp;man=1">install manually</a>',
        'STEP1' => 'Select LMO folder',
        'STEP1_SELECT_FTP_DIR' => 'Please select your LMO folder',
        'STEP2' => 'CHMOD files',
        'STEP2_MANUAL' => '<p><strong>Copy the content of folder <code>install</code> into the directory of LMO.</strong></p>
         <p><img src="img/manual_copy.png" alt="Copying files using a FTP tool" width="696"></p>
         <p>Please chmod these file with your FTP tool.</p>
         <p><img src="img/manual_chmod.png" alt="Chmod files using a FTP tool" width="427"></p>
         <p>Press <a href="#" onclick="location.reload();return false;">[Reload]</a> for
         a check. <a href="' . $_SERVER['PHP_SELF'] . '">back to automatic installation (if available)</a><p>',
        'STEP3' => 'Create configuration file',
        'STEP3_PATH' => 'Please insert the <strong>absolute path</strong> to LMO',
        'STEP3_PATH_EXAMPLE' => '/home/www/htdocs/lmo',
        'STEP3_PATH_CORRECT' => 'Path seems to be correct!',
        'STEP3_PATH_WRONG' => 'Path seems to be incorrect!',
        'STEP3_URL' => 'Please insert the <strong>absolute URL</strong> to LMO',
        'STEP3_URL_EXAMPLE' => '//www.example.com/lmo>',
        'STEP3_URL_CORRECT' => ' If you can see a picture in front of this message then the URL is correct!',
        'STEP3_ERROR_INI_FILE_NOT_OPENABLE' => 'Could not open <code>config/init-parameters.php</code>! Please chmod the file with 666 and <a href="#" onclick="location.reload();return false;">[Reload]</a> this page to repeat the check.',
        'STEP3_ERROR_INI_FILE_NOT_WRITEABLE' => 'Could not save configuration! Please make sure that the file <code>config/init-parameters.php</code> has the correct chmod of 666. Please chmod the file with 666 and <a href="#" onclick="location.reload();return false;">[Reload]</a> this page to repeat the check.',
        'STEP3_SUCCESS_INI_FILE' => 'Configuration successfully saved',
        'STEP4' => 'Installation successful',
        'STEP4_TEXT1' => 'Liga Manager Online 4 is successfully installed!',
        'STEP4_TEXT2' => 'If you experienced errors repeat the installation or install manually. To install manually edit the file
    <code>config/init-parameters.php</code> with an common text editor and chmod the files with your FTP tool.',
        'STEP4_TEXT3' => 'Please delete the folder <code>install</code> or chmod it to 000.',
        'STEP4_TEXT4' => '<ul class="attention">
                        <li><strong>Link to <acronym title="Liga Manager Online">LMO</acronym>:</strong> <a href="%s">%s</a></li>
                        <li><strong>Link to admin area:</strong> <a href="%s">%s</a> <small>(Login is <kbd>admin</kbd> / <kbd>lmo</kbd>)</small></li>
                        <li><strong>Link to Help:</strong> <a href="%s">%s</a></li>
                      </ul>',
        'STEP4_TEXT5' => 'Support LMO: <form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="paypal">
                      <input type="hidden" name="cmd" value="_s-xclick">
                      <input type="image" src="https://www.paypal.com/de_DE/i/btn/x-click-but04.gif" name="submit" alt="Spenden Sie für den LMO!">
                      <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
"></form>',
        'STEP4_TEXT6' => 'Have fun!',
    ),
    'FR' => array(
        'HEADER' => 'Installation du Liga Manager Online 4',
        'PROCEED' => 'Continuer',
        'SUCCESS' => 'Succès',
        'ERROR' => 'Erreur',
        'CHECK_AGAIN' => 'Vérifier de nouveau',
        'ERROR_WRONG_PATH' => "Le chemin n'est pas correct!",
        'ERROR_CONFIRM' => 'Il y a encore des erreurs! Désirez-vous quand même continuer?',
        'ERROR_PHP' => 'Ce LMO nécessite au moins PHP '.$min_php_version,
        'STEP0' => "Données d'accès FTP",
        'STEP0_DESCRIPTION' => "Pour pouvoir installer le LMO automatiquement, un accès FTP est nécessaire.
         Pour cela vous devez entrer les données d'accès de votre serveur FTP. Ces informations ne seront pas sauvegarder ou utiliser pour d'autres fins dans le LMO.
         Si vous voulez installer manuellement les paramètres vous pouvez le faire
         <a href=\"" . $_SERVER['PHP_SELF'] . '?lmo_install_step=2&amp;man=1">ici pour continuer avec l\'installation manuelle.</a>',
        'STEP0_FTP_SERVER' => "Veuillez donner l'adresse de votre serveur FTP",
        'STEP0_FTP_SERVER_EXAMPLE' => 'ftp.exemple.fr',
        'STEP0_FTP_LOGIN' => 'Veuillez entrer votre identifiant et votre mot de passe',
        'STEP0_FTP_NO_CONNECTION' => 'Aucune connection sur "' . $_SESSION['ftpserver'] . '" possible. Veuillez corriger l\'adresse ou bien <a href="' . $_SERVER['PHP_SELF'] . '?lmo_install_step=2&amp;man=1">installez-le manuellement</a>',
        'STEP0_FTP_NO_LOGIN' => 'Erreur de connection. Veuillez corriger l\'identifiant ou <a href="' . $_SERVER['PHP_SELF'] . '?lmo_install_step=2&amp;man=1">installez-le manuellement</a>',
        'STEP1' => 'Choissisez le répertoire du LMO',
        'STEP1_SELECT_FTP_DIR' => 'Veuillez choissir le répertoire du LMO',
        'STEP2' => "Définir les droits d'accès des fichiers",
        'STEP2_MANUAL' => '<p><strong>Veuillez placer les droits d\'accès requéris des fichiers avec votre programme FTP.</strong></p>
      <p><img src="img/manual_copy.png" alt="" width="696"></p>
      <p><img src="img/manual_chmod.png" alt="" width="427"></p>
      <p>Veuillez ensuite actualiser cette page avec un <a href="#" onclick="location.reload();return false;">[Rafraîchir]</a>, pour vérifier , que tout les droits ont été placé correctement. <a href="' . $_SERVER['PHP_SELF'] . '">retourner à l\'installation automatique</a></p>',
        'STEP3' => 'Création du fichier de configuration',
        'STEP3_PATH' => 'Veuillez entrer ici le <strong>chemin complet</strong> pour accèder au LMO',
        'STEP3_PATH_EXAMPLE' => '/home/www/htdocs/lmo',
        'STEP3_PATH_CORRECT' => 'Le chemin est correct!',
        'STEP3_PATH_WRONG' => 'Le chemin est incorrect!',
        'STEP3_URL' => "Veuillez entrer ici l'adresse URL pour accèder au LMO",
        'STEP3_URL_CORRECT' => " Si vous voyez une image, l'adresse URL est correcte!",
        'STEP3_URL_EXAMPLE' => '//www.exemple.fr/lmo',
        'STEP3_ERROR_INI_FILE_NOT_OPENABLE' => "Impossible d'ouvrir le fichier <code>config/init-parameters.php</code>!  Veuillez définir les droits d'accès sur chmod 666 et actualisez cette page ([F5]), pour répeter cette étape.",
        'STEP3_ERROR_INI_FILE_NOT_WRITEABLE' => "Veuillez vérifier avant l'installation que le fichier <code>config/init-parameters.php</code> a bien les droits d'accès 666. Veuillez définir les droits d'accès sur chmod 666 et actualisez cette page, pour répeter cette étape.",
        'STEP3_SUCCESS_INI_FILE' => 'La configuration a été sauvegardé avec succès',
        'STEP4' => "L'installation a été couronné de succès",
        'STEP4_TEXT1' => 'Le Liga Manager Online 4 a été installé!',
        'STEP4_TEXT2' => "Si des erreurs apparaissent, veuillez répéter l'installation ou bien installer le LMO manuellement en adaptant le fichier <code>config/init-parameters.php</code> avec un éditeur de texte et donner les droits d'accès manuellement avec un programme FTP.",
        'STEP4_TEXT3' => 'Veuillez supprimer à tout prix le répertoire <code>install</code> de votre serveur ou bien lui donner les droits d\accès chmod 000.',
        'STEP4_TEXT4' => '<ul class="attention">
                        <li><strong>Le <acronym title="Liga Manager Online">LMO</acronym>:</strong> <code><a href="%s">%s</a></code>
                        <li><strong>Le secteur d\'administration:</strong> <code><a href="%s">%s</a></code> (L\'indentifiant par défaut est <kbd>admin</kbd>/<kbd>lmo</kbd>)
                        <li><strong>Description d\'utlisation:</strong> <code><a href="%s">%s</a></code>
                      </ul>',
        'STEP4_TEXT5' => '<form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="paypal">
                      <input type="hidden" name="cmd" value="_s-xclick">
                      <input type="image" src="https://www.paypal.com/fr_FR/i/btn/x-click-but04.gif" name="submit" alt="Spenden Sie für den LMO!">
                      <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
"></form>',
        'STEP4_TEXT6' => 'Bon courage!',
    ),
    'ES' => array(
        'HEADER' => 'Installación de Liga Manager Online 4',
        'PROCEED' => 'Proceder',
        'SUCCESS' => 'Exitoso',
        'ERROR' => 'Error',
        'CHECK_AGAIN' => 'Intenta otra vez',
        'ERROR_WRONG_PATH' => 'Directorio incorrecto!',
        'ERROR_CONFIRM' => 'Aun hay errores! Continuar?',
        'ERROR_PHP' => 'Este LMO requiere al menos PHP '.$min_php_version,
        'STEP0' => 'Datos de conexión FTP',
        'STEP0_DESCRIPTION' => 'Para instalar LMO automaticamente debe insertar sus datos de la conexión FTP. Datos no guardados ni publicados. Si desea instalar manualmente use <a href="' . $_SERVER['PHP_SELF'] . '?step=2&amp;man=1">este link</a>.',
        'STEP0_FTP_SERVER' => 'Dirección servidor FTP',
        'STEP0_FTP_SERVER_EXAMPLE' => 'ftp.ejemplo.com',
        'STEP0_FTP_LOGIN' => 'Ingrese su nombre de usuario y contraseña',
        'STEP0_FTP_NO_CONNECTION' => 'No se puede establecer conección a "' . $_SESSION['ftpserver'] . '". Por favor corrija la dirección del servidor o <a href="' . $_SERVER['PHP_SELF'] . '?step=2&amp;man=1">instale manualmente</a>',
        'STEP0_FTP_NO_LOGIN' => 'Error en conección. Por favor corrija los datos de usuario o <a href="' . $_SERVER['PHP_SELF'] . '?step=2&amp;man=1">instale manualmente</a>',
        'STEP1' => 'Seleccione la carpeta de LMO',
        'STEP1_SELECT_FTP_DIR' => 'Seleccione por favor su carpeta de LMO',
        'STEP2' => 'Archivos CHMOD',
        'STEP2_MANUAL' => 'Por favor dele permisos chmod a estos archivos con su herramienta FTP y presione <a href="#" onclick="location.reload();return false;">[Recargar]</a> para un chequeo. <a href="' . $_SERVER['PHP_SELF'] . '">volver a la instalación automática</a>',
        'STEP3' => 'Cree el archivo de configuración',
        'STEP3_PATH' => 'Por favor ingrese el <strong>directorio absoluto</strong> a LMO',
        'STEP3_PATH_EXAMPLE' => '/home/www/htdocs/lmo',
        'STEP3_PATH_CORRECT' => 'El directorio parece ser correcto!',
        'STEP3_PATH_WRONG' => 'El directorio parece ser incorrecto!',
        'STEP3_URL' => 'Por favor ingrese la <strong>URL absoluta</strong> a LMO',
        'STEP3_URL_EXAMPLE' => '//www.ejemplo.com/lmo',
        'STEP3_URL_CORRECT' => ' Si usted puede ver una imagen delante de este mensaje entonces la URL es correcta!',
        'STEP3_ERROR_INI_FILE_NOT_OPENABLE' => 'No se puede abrir init-parameters.php! Por favor cambie los permisos del archivo a 666 y <a href="#" onclick="location.reload();return false;">[Recargue]</a> esta página para repetir el chequeo.',
        'STEP3_ERROR_INI_FILE_NOT_WRITEABLE' => 'No se puede guardar la configuración! Por favor aseguresé que el archivo <code>init-parameters.php</code> tiene permisos chmod de 666. Por favor cambie los permisos chmod del archivo a 666 y <a href="#" onclick="location.reload();return false;">[Recargue]</a> esta página para repetir el chequeo.',
        'STEP3_SUCCESS_INI_FILE' => 'Configuración guardada con éxito',
        'STEP4' => 'Instalación exitosa',
        'STEP4_TEXT1' => 'Liga Manager Online 4 instalada exitosamente!',
        'STEP4_TEXT2' => 'Si usted experimenta errores repita la instalación o instale manualmente. Para instalar manualmente edite el archivo <code>init-parameters.php</code> con un editor de textos común y cambie los permisos chmod de los archivos con su herramienta FTP.',
        'STEP4_TEXT3' => 'Por favor elimine el archivo <code>install.php</code> o cambie los permisos chmod a 000.',
        'STEP4_TEXT4' => '<acronym title="Liga Manager Online">LMO</acronym> ahora está disponible en <code><a href="lmo.php">lmo.php</a></code>. El área de la administración está disponible en <code><a href="lmoadmin.php">lmoadmin.php</a></code> (la conexión estándar es <kbd>admin</kbd>/<kbd>lmo</kbd>).',
        'STEP4_TEXT5' => 'Por favor consulte el <a href="http://www.liga-manager-online.de/">manual en nuestro sitio web</a> para obtener ayuda.',
        'STEP4_TEXT6' => 'Disfrútalo!',
    )
);

/* Configbereich Ende */

















if (!empty($_GET['debug']) || !empty($_SESSION['debug'])) {
    $_SESSION['debug'] = true;
    @error_reporting(E_ALL);
    @ini_set('display_errors', 'On');
} else {
    @error_reporting(E_ERROR | E_PARSE);
    @ini_set('display_errors', 'Off');
}
$lmo_install_step = isset($_REQUEST['lmo_install_step']) ? $_REQUEST['lmo_install_step'] : 0;
if (isset($_POST['check']))
    $lmo_install_step = 3;
$_SESSION['man'] = !empty($_REQUEST['man']) ? TRUE : FALSE;

$patherror = $urlerror = $installerror = $loginerror = '';
$error = 0;

$lmo_dir = dirname(__DIR__);

$path = str_replace('\\', '/', $lmo_dir);
if (str_contains(dirname($_SERVER['SCRIPT_NAME']), '/install')) {
    $url = '//' . $_SERVER['HTTP_HOST'] . dirname(dirname($_SERVER['SCRIPT_NAME']));
} else {
    $url = '//' . $_SERVER['HTTP_HOST'] . dirname(($_SERVER['SCRIPT_NAME']));
}

if ($lmo_install_step == 1) {
    // FTP-Daten testen

    $ftp = new Net_FTP();
    $_SESSION['ftpserver'] = isset($_POST['ftpserver']) ? trim($_POST['ftpserver']) : (!empty($_SESSION['ftpserver']) ? $_SESSION['ftpserver'] : '');
    $_SESSION['ftpuser'] = isset($_POST['ftpuser']) ? trim($_POST['ftpuser']) : (!empty($_SESSION['ftpuser']) ? $_SESSION['ftpuser'] : '');
    $_SESSION['ftppass'] = isset($_POST['ftppass']) ? trim($_POST['ftppass']) : (!empty($_SESSION['ftppass']) ? $_SESSION['ftppass'] : '');
    if ($ftp->connect($_SESSION['ftpserver'], 25) !== TRUE) {
        $urlerror .= '<p class="error"><i class="bi bi-x-square-fill text-danger" alt="' . $lang[$userlang]['ERROR'] . '"></i> ' . $lang[$userlang]['STEP0_FTP_NO_CONNECTION'] . '</p>';
        $lmo_install_step = 0;
    } else {
        if ($ftp->login($_SESSION['ftpuser'], $_SESSION['ftppass']) !== TRUE) {
            $ftp->disconnect();
            $loginerror .= '<p class="error"><i class="bi bi-x-square-fill text-danger" alt="' . $lang[$userlang]['ERROR'] . '"></i> ' . $lang[$userlang]['STEP0_FTP_NO_LOGIN'] . '</p>';
            $lmo_install_step = 0;
        }
    }

    if ($lmo_install_step != 0) {
        $_SESSION['ftpdir'] = isset($_POST['ftpdir']) ? trim(str_replace('../', '', $_POST['ftpdir'])) : '';
        $ftpdir = $_SESSION['ftpdir'];
        if (empty($_POST['ftpdir'])) {
            // Pfad aussuchen

            $_SESSION['view'] = isset($_GET['view']) ? trim(str_replace('../', '', $_GET['view'])) : '';
            $filelist = filecollect($ftp, $_SESSION['view']);
        } else {
            // Pfad ausgesucht -> Rechte setzen

            $ftp->cd($ftpdir);
            if (PEAR::isError($ftp->size('init.php'))) {
                // Pathtest
                $ftp->cd('..');
                $patherror .= '<p class="error"><i class="bi bi-x-square-fill text-danger" alt="' . $lang[$userlang]['ERROR'] . '"></i> "' . $ftpdir . '": ' . $lang[$userlang]['ERROR_WRONG_PATH'] . '</p>';
                $filelist = filecollect($ftp, $_SESSION['view']);
                $lmo_install_step = 1;
            } else {
                foreach ($filelist as $chmod => $files) {
                    foreach ($files as $file) {
                        if (str_contains($file, '*')) {
                            $ligen = $ftp->ls('.', NET_FTP_FILES_ONLY);
                            foreach ($ligen as $liga) {
                                if (substr($liga['name'], -4) == substr($file, -4)) {
                                    $ftp->chmod($liga, $chmod);
                                }
                            }
                        } else {
                            // Handle config files
                            if (str_contains($file, 'cfg.txt') || str_contains($file, 'auth')) {
                                if (!file_exists($lmo_dir . '/' . $file)) {
                                    if (str_contains($file, 'lmo-auth.php') && file_exists($lmo_dir . '/lmo-auth.php')) {
                                        // copy old auth-file into new one
                                        $auth_old = file($lmo_dir . '/lmo-auth.php');
                                        $auth_file = fopen($lmo_dir . '/' . $file, 'wb');
                                        fwrite($auth_file, "<?php exit(); ?>\n");
                                        foreach ($auth_old as $old) {
                                            fwrite($auth_file, $old . "\n");
                                        }
                                        fclose($auth_file);
                                    }
                                    // Copy install/cfg.txt  if cfg.txt not exists
                                    $ftp->put(__DIR__ . '/' . $file, $file);
                                    $ftp->chmod($file, $chmod);
                                } else {
                                    if (strpos($file, 'cfg.txt') !== FALSE) {
                                        // Merge config files
                                        // read config files
                                        $cfg_old = parse_ini_file($lmo_dir . '/' . $file);
                                        $cfg_new = parse_ini_file(__DIR__ . '/' . $file);
                                        // merge config files
                                        foreach ($cfg_new as $new_key => $new_value) {
                                            if (!array_key_exists($new_key, $cfg_old)) {
                                                $cfg_old[$new_key] = $new_value;
                                            }
                                        }
                                        // make cfg.txt writable
                                        $ftp->chmod($file, $chmod);
                                        // write merged configuration
                                        $mergedfile = fopen($lmo_dir . '/' . $file, 'wb');
                                        foreach ($cfg_old as $merged_key => $merged_value) {
                                            fwrite($mergedfile, $merged_key . '=' . $merged_value . "\n");
                                        }
                                    }
                                }
                            }
                            $ftp->chmod($file, $chmod);
                        }
                    }
                }
                $lmo_install_step = 2;
            }
        }
        $ftp->disconnect();
    }
}

if ($lmo_install_step == 3) {
    $path = isset($_POST['path']) ? $_POST['path'] : $path;
    $url = isset($_POST['url']) ? $_POST['url'] : $url;

    $path = substr($path, -1) == '/' ? substr($path, 0, -1) : $path;
    $url = substr($url, -1) == '/' ? substr($url, 0, -1) : $url;

    $_SESSION['url1'] = $url;

    $filename = $path . '/config/init-parameters.php';
    $somecontent = "<?php \n\t\$lmo_dateipfad='" . $path . "'; //Dateipfad zum LMO\n\t\$lmo_url='" . $url . "'; //abolute URL zum LMO\n?>";
    // Sichergehen, dass die Datei existiert und beschreibbar ist
    if (!$handle = fopen($filename, 'wb')) {
        $installerror .= '<p class="error"><i class="bi bi-x-square-fill text-danger" alt="' . $lang[$userlang]['ERROR'] . '"></i> ' . $lang[$userlang]['STEP3_ERROR_INI_FILE_NOT_OPENABLE'] . '</p>';
    } else {
        if (!fwrite($handle, $somecontent)) {
            $installerror .= '<p class="error"><i class="bi bi-x-square-fill text-danger" alt="' . $lang[$userlang]['ERROR'] . '"></i> ' . $lang[$userlang]['STEP3_ERROR_INI_FILE_NOT_WRITEABLE'] . '</p>';
        } else {
            $installerror .= '<p><em><i class="bi bi-check text-success" alt="' . $lang[$userlang]['SUCCESS'] . '"></i> ' . $lang[$userlang]['STEP3_SUCCESS_INI_FILE'] . '</em></p>';
        }
        fclose($handle);
    }
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="<?php echo $userlang ?>">
  <head>
    <title><?php echo $lang[$userlang]['HEADER']; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
    <style>
        /*CSS3-values*/
        .error {-moz-border-radius:8px;-webkit-border-radius:8px;border-radius:8px; color: #f00;}
      }
    </style>
    <link href="//cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="//cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" >
  </head>
  <body>
  <div class="container">
    <div class="row p-2">
      <div class="col"><h1><?php echo $lang[$userlang]['HEADER']; ?></h1></div>
    </div>
    <div class="row p-2">
      <div class="col"><?php
echo $patherror;
if ($lmo_install_step == 0) {
?>
  <?php
    if (!$_SESSION['man'] && !isset($_REQUEST['man'])) {
        if (version_compare(PHP_VERSION, $min_php_version, '<')) {
?>
         <div class="alert alert-danger" role="alert">
             <h2 class="alert-heading"><?php echo $lang[$userlang]['ERROR'] ?></h2>
             <?php echo $lang[$userlang]['ERROR_PHP'];
            $error++; ?>
         </div>
    <?php
        }

        ?>
        <h2><?php echo $lang[$userlang]['STEP0'] ?></h2>
      </div>
    </div>
    <div class="row p-2">
      <div class="col"> 
         <?php echo $lang[$userlang]['STEP0_DESCRIPTION'] ?>
      </div>
    </div>
    <div class="row p-1">
      <div class="col">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="row">
          <div class="row p-1">
            <div class="col-auto"><?php echo $lang[$userlang]['STEP0_FTP_SERVER'] ?></div>
            <div class="col-auto"><input name="ftpserver" type="text" class="form-control" value="<?php echo isset($_SESSION['ftpserver']) ? $_SESSION['ftpserver'] : $_SERVER['SERVER_NAME']; ?>" placeholder="<?php echo $lang[$userlang]['STEP0_FTP_SERVER_EXAMPLE']; ?>"></div>
          </div>
          <div class="row">
            <div class="col p-1"><?php echo $urlerror; ?></div>
          </div>
          <div class="row p-1">
            <div class="col-auto"><?php echo $lang[$userlang]['STEP0_FTP_LOGIN'] ?></div>
            <div class="col-auto"><input name="ftpuser" type="text" class="form-control" value="<?php echo $_SESSION['ftpuser'] ?>" placeholder="User"></div>
            <div class="col-auto"><input name="ftppass" type="password" class="form-control" value="<?php echo $_SESSION['ftppass'] ?>" placeholder="Pass"></div>
          </div>
          <div class="row p-1">
            <div class="col"><?php echo $loginerror; ?></div>
          </div>
          <div class="row p-1">
            <div class="col">
              <input type="hidden" name="lmo_install_step" value="1">
              <input type="submit" class="btn btn-sm btn-primary" value="<?php echo $lang[$userlang]['PROCEED'] ?>">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div><?php
    } else {
        $lmo_install_step = 2;
    }
}

if ($lmo_install_step == 1) {
?>
  <div class="row">
    <div class="col"><h2><?php echo $lang[$userlang]['STEP1'] ?></h2></div>
  </div>
  <div class="row">
    <div class="col">
      <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="row">
        <div class="row">
          <div class="col"><?php echo $lang[$userlang]['STEP1_SELECT_FTP_DIR'] ?></div>
        </div>
        <?php
        if ($_SESSION['view'] != '') {
            echo "<dd>&nbsp;<a href='" . $_SERVER['PHP_SELF'] . '?lmo_install_step=1&amp;view=' . dirname($_SESSION['view']) . "'>..</a></dd>";
        }
        if (!empty($filelist)) {
            foreach ($filelist as $ftpdir) {
                echo "<div class='row'>
        <div class='col'>
          <input type='radio' class='form-control' value='$ftpdir' name='ftpdir'> <a href='" . $_SERVER['PHP_SELF'] . "?lmo_install_step=1&amp;view=$ftpdir'>" . basename($ftpdir) . '</a>
        </div>
      </div>';
            }
        }
        ?>

        <div class="row">
          <div class="col">
            <input type="hidden" name="lmo_install_step" value="1">
            <input type="submit" class="btn btn-sm btn-primary" value="<?php echo $lang[$userlang]['PROCEED'] ?>">
          </div>
        </div>
      </form>
    </div>
  </div>

    <?php
}

if ($lmo_install_step == 2) {
    // Manuell
    ?>
  <div class="row">
    <div class="col"><h2><?php echo $lang[$userlang]['STEP2'] ?></h2></div>
  </div><?php
    if ($_SESSION['man']) {
?>
   <div class="row">
     <div class="col"><?php echo $lang[$userlang]['STEP2_MANUAL'] ?></div>
   </div><?php
    }
    ?>
    <div class="row">
      <div class="col">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" onSubmit="return check();" class="row">
          <div class="row">
            <div class="col">
              <ul><?php
    $error = 0;
    foreach ($filelist as $chmod => $files) {
        echo '<br><strong>chmod ' . ($chmod) . '</strong>';
        foreach ($files as $file) {
            echo '<li>';
            if (str_contains($file, '*')) {
                $handle = opendir($lmo_dir . '/' . dirname($file));
                while (false !== ($file2 = readdir($handle))) {
                    if ($file2 != '.' && $file2 != '..' && !is_dir($lmo_dir . '/' . dirname($file) . "/$file2")) {
                        if (is_writable($lmo_dir . '/' . dirname($file) . "/$file2")) {
                            echo "<i class='bi bi-check text-success' alt='" . $lang[$userlang]['SUCCESS'] . "'></i> " . dirname($file) . "/$file2" . ' <small>(' . ($chmod) . ')</small><li>';
                        } else {
                            echo "<i class='bi bi-x-square-fill text-danger' alt='" . $lang[$userlang]['ERROR'] . "'></i> " . dirname($file) . "/$file2" . ' <small>(' . ($chmod) . ')</small><li>';
                            $error++;
                        }
                    }
                }
            } else {
                if (is_writable($lmo_dir . '/' . $file)) {
                    echo "<i class='bi bi-check text-success' alt='" . $lang[$userlang]['SUCCESS'] . "'></i> $file <small>(" . ($chmod) . ')</small>';
                } else {
                    echo "<i class='bi bi-x-square-fill text-danger' alt='" . $lang[$userlang]['ERROR'] . "'></i> $file <small>(" . ($chmod) . ')</small>';
                    $error++;
                }
            }
        }
    }
    ?>
              </li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <input type="hidden" name="lmo_install_step" value="3">
            <input type="submit" class="btn btn-sm btn-primary" value="<?php echo $lang[$userlang]['PROCEED'] ?>">
          </div>
        </div>
      </form>
        <script type="text/javascript">
        function check() {
          if (<?php echo $error ?> > 0) {
            return confirm("<?php echo $lang[$userlang]['ERROR_CONFIRM'] ?>");
          }
          return true;
        }
        </script>
    </div>
   </div>
  </div><?php
}

if ($lmo_install_step == 3) {
?>
  <div class="row p-2">
    <div class="col"><h2><?php echo $lang[$userlang]['STEP3'] ?></h2></div>
  </div>
  <div class="row">
    <div class="col">
      <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="row">
        <div class="row p-2">
          <div class="col"><?php echo $lang[$userlang]['STEP3_PATH'] ?></div>
        </div>
        <div class="row p-1">
          <div class="col-auto">
            <?php echo $patherror ?>
            <a href="#" class="btn" onclick="document.getElementsByName('path')[0].value='<?php echo $path; ?>';return false;">[Auto detect]</a>
          </div>
          <div class="col-3">
            <input name="path" type="text" class="form-control" value="<?php echo $path ?>" placeholder="<?php echo $lang[$userlang]['STEP3_PATH_EXAMPLE'] ?>">
          </div>
        </div>
        <div class="row p-1">
          <div class="col-4"><?php
    if (file_exists($path . '/config/init-parameters.php')) {
        echo "<i class='bi bi-check text-success' alt='" . $lang[$userlang]['SUCCESS'] . "'></i> " . $lang[$userlang]['STEP3_PATH_CORRECT'];
    } else {
        echo "<i class='bi bi-x-square-fill text-danger' alt='" . $lang[$userlang]['ERROR'] . "'></i> " . $lang[$userlang]['STEP3_PATH_WRONG'];
        $error = 1;
    }
    ?>
          </div>
        </div>
        <div class="row">
          <div class="col"><?php echo $lang[$userlang]['STEP3_URL'] ?></div>
        </div>
        <div class="row p-1">
          <div class="col-auto">
             <?php echo $urlerror ?>
             <a href="#" class="btn" onclick="document.getElementsByName('url')[0].value='<?php echo addslashes($url) ?>';return false;">[Auto detect]</a>
           </div>
           <div class="col-3">
             <input name="url" type="text" class="form-control" value="<?php echo $url ?>" placeholder="<?php echo $lang[$userlang]['STEP3_URL_EXAMPLE']; ?>">
          </div>
        </div>
        <div class="row">
          <div class="col-4"><?php
    echo "<i class='bi bi-check text-success' alt='" . $lang[$userlang]['SUCCESS'] . "'></i> " . $lang[$userlang]['STEP3_PATH_CORRECT'];
    ?>
          </div>
        </div>
        <div class="row pt-3">
          <div class="col">
            <input type="hidden" name="lmo_install_step" value="4">
            <input type="submit" class="btn btn-sm btn-warning" name="check" value="<?php echo $lang[$userlang]['CHECK_AGAIN'] ?>">
            <input type="submit" class="btn btn-sm btn-primary" value="<?php echo $lang[$userlang]['PROCEED'] ?>">
          </div>
        </div>
          <script type="text/javascript">
            function check() {
              if (<?php echo $error; ?> > 0) {
                return confirm("<?php echo $lang[$userlang]['ERROR_CONFIRM'] ?>");
              }
              return true;
            }
          </script>
        </form>
      </div>
    </div>
  </div>
</div><?php
}

if ($lmo_install_step == 4) {
?>
  <div class="row">
    <div class="col"><h2><?php echo $lang[$userlang]['STEP4'] ?></h2></div>
  </div>
  <div class="row">
    <div class="col">
      <p><?php echo $lang[$userlang]['STEP4_TEXT1'] ?></p>
      <p><?php echo $lang[$userlang]['STEP4_TEXT2'] ?></p>
      <p class="error"><?php echo $lang[$userlang]['STEP4_TEXT3'] ?></p>
      <?php echo sprintf($lang[$userlang]['STEP4_TEXT4'], $_SESSION['url1'] . '/lmo.php', $_SESSION['url1'] . '/lmo.php', $_SESSION['url1'] . '/lmoadmin.php', $_SESSION['url1'] . '/lmoadmin.php', $_SESSION['url1'] . '/help/Deutsch/index.html', $_SESSION['url1'] . '/help/Deutsch/index.html') ?>
      <p><?php echo $lang[$userlang]['STEP4_TEXT5'] ?></p>
      <?php echo $lang[$userlang]['STEP4_TEXT6'] ?>
     </div>
  </div><?php
}
?>

  <div class="container">
    <div class="row pt-4">
      <div class="col-auto">
        <a href="<?php echo $_SERVER['PHP_SELF']; ?>">Restart</a>
      </div>
      <div class="col-auto">
        <a href="<?php echo $_SERVER['PHP_SELF']; ?>?userlang=FR"><img src="img/Francais.svg" alt="FR" width="16"></a>
        <a href="<?php echo $_SERVER['PHP_SELF']; ?>?userlang=EN"><img src="img/English.svg" alt="EN" width="16"></a>
        <a href="<?php echo $_SERVER['PHP_SELF']; ?>?userlang=ES"><img src="img/Espanol.svg" alt="ES" width="16"></a>
        <a href="<?php echo $_SERVER['PHP_SELF']; ?>?userlang=DE"><img src="img/Deutsch.svg" alt="DE" width="16"></a>
      </div>
        <div class="col-auto text-end">© René Marth/<a href="http://liga-manager-online.de/">LMO Group</a></div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="//cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>

<?php

function filecollect(&$ftp, $dir = '.')
{
    $ftp->cd($dir);
    $list = $ftp->ls('.', NET_FTP_DIRS_ONLY);
    if ($list === false)
        echo 'LIST FAILS!';
    else {
        foreach ($list as $entry) {
            if ($entry['name'] != '.' && $entry['name'] != '..') {
                $return[] = $dir . '/' . $entry['name'];
            }
        }
    }
    return $return;
}
