<?
// 
// LigaManager Online 3.02
// Copyright (C) 1997-2002 by Frank Hollwitz
// webmaster@hollwitz.de / http://php.hollwitz.de
// 
// Spielerstatistik-Addon 1.1
// Copyright (C) 2002 by Rene Marth
// marth@tsvschlieben.de / http://www.tsvschlieben.de
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License as
// published by the Free Software Foundation; either version 2 of
// the License, or (at your option) any later version.
// 
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
// General Public License for more details.
// 
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 675 Mass Ave, Cambridge, MA 02139, USA.
// 
//Datei auslesen
$filename=array_pop(explode("/",$file));
$configfile=PATH_TO_ADDONDIR."/spieler/stats/".substr($filename,0,strlen($filename)-4).".cfg";
$filename=PATH_TO_ADDONDIR."/spieler/stats/".substr($filename,0,strlen($filename)-4).".stat";
$spieler_ligalink=$text['spieler'][18];
if ($config=@file($configfile)) {
	for ($i=0;$i<count($config);$i++){
		$row=explode("=",$config[$i],2);
		switch ($row[0]) {
			case $text['spieler'][20]:$spieler_spielerbildbreite=$row[1];break;
			case $text['spieler'][21]:$spieler_standard_sortierung=(int)$row[1];break;
			case $text['spieler'][22]:$spieler_anzeige_pro_seite=(int)$row[1];break;
			case $text['spieler'][42]:$spieler_adminbereich_anzeige_pro_seite=(int)$row[1];break;
			case $text['spieler'][23]:$spieler_nullwerte_anzeigen=(int)$row[1];break;
			case $text['spieler'][24]:$spieler_keine_namensortierung=(int)$row[1];break;
			case $text['spieler'][31]:$spieler_adminbereich_hilfsadmin_zulassen=(int)$row[1];break;
			case $text['spieler'][46]:$spieler_adminbereich_hilfsadmin_fuer_spalten=(int)$row[1];break;
			case $text['spieler'][40]:$spieler_adminbereich_standard_sortierung=$row[1];break;
			case $text['spieler'][41]:$spieler_ligalink=$row[1];break;
		}
	}
}
?>