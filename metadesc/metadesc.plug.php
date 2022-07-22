<?php
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=metadesc
Part=plug
File=metadesc.plug
Hooks=header.tags
Tags=header.tpl:{OG_META_IMG},{OG_META_TITLE},{OG_META_DESC},{OG_META_URL}
Order=20
[END_SED_EXTPLUGIN]
==================== */

defined('SED_CODE') or die('Wrong URL');


if(!defined('SED_INDEX') && !defined('SED_MESSAGE') && !defined('SED_USERS') && !defined('SED_ADMIN') && !defined('SED_PAGE') && !defined('SED_FORUMS'))
{
$img = $cfg['mainurl']."/resim-yok.png";
$title = sed_cc($plugin_title);
$desc = $cfg['subtitle'];
$url = $sys['canonical_url']; 

$t-> assign(array(
	"OG_META_IMG" => $img,
	"OG_META_TITLE" => $title,
	"OG_META_DESC" => $desc, 
	"OG_META_URL" => $url, 
	));
}



?>
