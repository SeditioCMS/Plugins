<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome
http://www.neocrome.net

[BEGIN_SED]
File=plugins/songezilenler/songezilenler.install.php
Version=110
Updated=2006-Oct-9
Type=Plugin
Author=T3-Design.com
Description=Installer/Uninstaller Fuctions for songezilenler
[END_SED]
==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

	$sql = sed_sql_query("DROP TABLE IF EXISTS visited_pages;");
	$sql = sed_sql_query("CREATE TABLE visited_pages (
						id INT AUTO_INCREMENT PRIMARY KEY,
						userid INT,  -- Kullanıcı ID'si, örnek olarak eklenmiştir
						pageurl VARCHAR(255) NOT NULL,
						pagetitle VARCHAR(255) NOT NULL,
						pagecat VARCHAR(64) NOT NULL,
						visited_at DATETIME DEFAULT CURRENT_TIMESTAMP
						)ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");					


?>