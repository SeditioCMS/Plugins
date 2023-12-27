<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome
https://seditio.org

[BEGIN_SED]
File=plugins/tableofcontents/tableofcontents.page.edit.first.php
Version=179
Updated=2023-may-02
Type=Plugin
Author=Amro
Description=
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=tableofcontents
Part=page
File=tableofcontents.page.edit.first
Hooks=page.edit.update.first
Tags=
Minlevel=0
Order=11
[END_SED_EXTPLUGIN]

==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

$tbc_extraslot = $cfg['plugin']['tableofcontents']['tbc_extra'];

$rpagetbcextra = 'rpage'.$tbc_extraslot;
$pagetbcextra = 'page_'.$tbc_extraslot;


?>