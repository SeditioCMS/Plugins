<?php
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=metadesc
Part=header
File=metadesc.header
Hooks=header.tags
Tags=header.tpl:{OG_META_IMG},{OG_META_TITLE},{OG_META_DESC},{OG_META_URL}
Order=10
[END_SED_EXTPLUGIN]
==================== */

defined('SED_CODE') or die('Wrong URL');

if(!defined('SED_LIST') && !defined('SED_MESSAGE') && !defined('SED_USERS') && !defined('SED_PAGE') && !defined('SED_FORUMS') && !defined('SED_ADMIN'))
{

$img = $cfg['mainurl']."/resim-yok.png";
$title = $cfg['maintitle'];
$desc = $cfg['subtitle'];
$url = $cfg['mainurl'];

$t-> assign(array(
	"OG_META_IMG" => $img,
	"OG_META_TITLE" => $title,
	"OG_META_DESC" => $desc, 
	"OG_META_URL" => $url, 
	));
}
?>
