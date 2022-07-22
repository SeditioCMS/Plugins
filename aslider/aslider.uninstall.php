<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome
https://www.seditio.org

[BEGIN_SED]
File=plugins/aslider/aslider.uninstall.php
Version=179
Updated=2020-feb-26
Type=Plugin
Author=Amro
Description=
[END_SED]

==================== */

if (!defined('SED_CODE') || !defined('SED_ADMIN')) { die('Wrong URL.'); }

$sql = sed_sql_query("DROP TABLE sed_aslider");

?>