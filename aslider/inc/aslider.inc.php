<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
http://www.neocrome.net
http://www.seditiocms.com
[BEGIN_SED]
File=aslider.inc.php
Version=175
Updated=2019-08-24
Type=Core
Author=Neocrome
Description=aSlider
[END_SED]
==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

$id = sed_import('id','G','INT');
$sqlx = sed_sql_query("SELECT * FROM sed_aslider WHERE page_date ORDER by page_id ASC LIMIT 10");


$set = sed_import('set','G','ALP');
if ($set == "up")
{
	$sql = sed_sql_query("UPDATE sed_aslider SET page_aktif='1' WHERE page_id='".$id."' limit 1");	
	sed_redirect('index.php?module=admin&m=tools&p=aslider&n=main');
}

$setx = sed_import('setx','G','ALP');
if ($setx == "upx")
{
	$sql = sed_sql_query("UPDATE sed_aslider SET page_aktif='0' WHERE page_id='".$id."' limit 1");	
	sed_redirect('index.php?module=admin&m=tools&p=aslider&n=main');
}



$adminmain .= " <h2>Slider Sayfalar</h2>";

$adminmain .= '<table class="cells"><tr>';
$adminmain .= '
<li><a href="index.php?module=admin&m=tools&p=aslider&n=main">Yazılar</a> | <a href="index.php?module=admin&m=tools&p=aslider&n=add">Slider Ekle</a></li>';
$adminmain .= '</tr></table>';

$out['ic_edit'] = "<img src=\"system/img/admin/edit.png\" alt=\"\" />";
$out['ic_checked'] = "<img src=\"system/img/admin/checked.png\" alt=\"\" />";
$out['img_unchecked'] = "<img src=\"system/img/admin/unchecked.png\" alt=\"\" />";


$ii = 1;
while ($pagx = sed_sql_fetcharray($sqlx))
        {	
$ii++;   
$pagx['page_date'] = sed_build_date($cfg['dateformat'], $pagx['page_date']);

//$aktifolan = ($pagx['page_aktif'] == 0) ? $out['img_checked'] : $out['img_unchecked'];	
$aktifyap = ($pagx['page_aktif'] == 1) ? $out['ic_checked'] : "<a href=\"index.php?module=admin&m=tools&p=aslider&n=main&set=up&id=".$pagx['page_id']."\">".$out['ic_set']."</a>";
$pasifyap = ($pagx['page_aktif'] == 0) ? $out['img_unchecked'] : "<a href=\"index.php?module=admin&m=tools&p=aslider&n=main&setx=upx&id=".$pagx['page_id']."\">".$out['ic_set']."</a>";

$edit = "<a href=\"index.php?module=admin&m=tools&p=aslider&n=edit&id=".$pagx['page_id']."\">".$out['ic_edit']."</a>";

$adminmain .= "
<table class=\"cells striped\" class=\"simple tableforms\">
		
			<tr>
			<td>".$pagx['page_id']."</td>
				<td>".$pagx['page_title']."</td>
				<td>".$pagx['page_desc']."</td>
			
				<td>".$pagx['page_alan1']."</td>
				<td>".$pagx['page_alan2']."</td>
				<td>".$pagx['page_date']."</td>
				<td><img src=\"".$pagx['page_resimurl']."\" width=\"50\" height=\"50\" /></td>
				<td>".$edit." ".$aktifyap."  ".$pasifyap."</td>
				
			</tr>						
		  </table>
		";
		}


?>