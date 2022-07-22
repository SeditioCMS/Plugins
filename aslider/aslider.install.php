<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome
https://www.seditio.org

[BEGIN_SED]
File=plugins/slider/slider.install.php
Version=179
Updated=2020-feb-26
Type=Plugin
Author=Amro
Description=
[END_SED]

==================== */

if (!defined('SED_CODE') || !defined('SED_ADMIN')) { die('Wrong URL.'); }

$sql = sed_sql_query("CREATE TABLE sed_aslider (
  page_id int(11) unsigned NOT NULL auto_increment,
  page_state tinyint(1) unsigned NOT NULL default '0',
  page_type tinyint(1) default '0',
  page_title varchar(255) default NULL,
  page_desc varchar(255) default NULL,
  page_alan1 varchar(255) default NULL,
  page_alan2 varchar(255) default NULL,	  
  page_date int(11) NOT NULL default '0',
  page_resimurl varchar(255) default NULL,
  page_aktif tinyint(1) default '0',
  PRIMARY KEY  (page_id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");

sed_cache_clear('sed_aslider');

?>