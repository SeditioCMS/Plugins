<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
http://www.seditiocms.com
[BEGIN_SED]
File=plugins/aslider/aslider.php
Version=175+
Updated=2018-dec-09
Type=Plugin
Author=Kaan
Description=
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=aslider
Part=admin
File=aslider
Hooks=tools
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

$id = sed_import('id','G','INT');
$n = sed_import('n', 'G', 'ALP');


switch($n)
	{
	case 'add':
	require('plugins/aslider/inc/aslider.add.inc.php');
	break;

	case 'edit':
	require('plugins/aslider/inc/aslider.edit.inc.php');
	break;

	case 'main':
	require('plugins/aslider/inc/aslider.inc.php');
	break;

	default:
$plugin_body .= '<table class="cells"><tr>';
$plugin_body = <<<END
<ul>
<li><a href="index.php?module=admin&m=tools&p=aslider&n=main">Yazılar</a></li>
<li><a href="index.php?module=admin&m=tools&p=aslider&n=add">Slider Ekle</a></li>
</ul>
END;
$plugin_body .= '</tr></table>';
break;
	}


?>
