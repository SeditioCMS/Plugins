<?php
/* ====================
[BEGIN_SED_EXTPLUGIN]
Code=metadesc
Part=page
File=metadesc.page
Hooks=header.tags
Tags=header.tpl:{OG_META_IMG},{OG_META_TITLE},{OG_META_DESC},{OG_META_URL}
Order=20
[END_SED_EXTPLUGIN]
==================== */

defined('SED_CODE') or die('Wrong URL');


if(!defined('SED_INDEX') && !defined('SED_MESSAGE') && !defined('SED_USERS') && !defined('SED_ADMIN') && !defined('SED_PLUG') && !defined('SED_FORUMS') )
{

$img = $cfg['mainurl']."/".$pag['page_extra4'];
$title = $pag['page_title']." - ".$cfg['subtitle'];
//$desc = strip_tags(sed_cutstring(stripslashes(sed_cary($pag['page_text'])),300));
$desc = strip_tags(sed_cary(sed_cutstring(stripslashes($pag['page_text']),100)));
$url = $cfg['mainurl']."/".$pag['page_pageurl']; 

$t-> assign(array(
	"OG_META_IMG" => $img,
	"OG_META_TITLE" => $title,
	"OG_META_DESC" => $desc, 
	"OG_META_URL" => $url, 
	));
}



?>
