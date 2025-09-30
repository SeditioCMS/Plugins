<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome
http://www.neocrome.net

[BEGIN_SED]
File=plugins/songezilenler/songezilenler.setup.php
Version=100
Updated=2006-jan-01
Type=Plugin
Author=Neocrome
Description=
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=songezilenler
Name=Son Gezilen Sayfalar
Description=Üyelerin son gezdiği sayfalar.
Version=100
Date=2006-jan-01
Author=Kaan
Copyright=
Notes=
Config=seditio.com.tr
SQL=
Auth_guests=R
Lock_guests=W12345A
Auth_members=R
Lock_members=W12345A
[END_SED_EXTPLUGIN]

[BEGIN_SED_EXTPLUGIN_CONFIG]
maxpage=01:select:0,1,2,3,4,5,6,7,8,9,10,15,20,25,30,40,50,100:20:Max lines per list
[END_SED_EXTPLUGIN_CONFIG]
==================== */

if ( !defined('SED_CODE') ) { die("Wrong URL."); }

?>