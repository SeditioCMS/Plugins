<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
http://www.seditiocms.com
[BEGIN_SED]
File=plugins/aslider/aslider.index.php
Version=175+
Updated=2019-08-28
Type=Plugin
Author=Kaan
Description=
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=aslider
Part=main
File=aslider.index
Hooks=index.tags
Tags=index.tpl:{PLUGIN_SLIDER}
Order=10
[END_SED_EXTPLUGIN]
==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

$sqlx = sed_sql_query("SELECT * FROM sed_aslider WHERE page_id ORDER by page_id ASC LIMIT ".$cfg['plugin']['aslider']['limit']."");

$ii = 1;
while ($pagx = sed_sql_fetcharray($sqlx))
        {	
	   $ii++;
$pagx['page_date'] = sed_build_date($cfg['dateformat'], $pagx['page_date']);

$durum = $pagx['page_aktif'];
if ($durum==1) {

$slider .= "<div class=\"item active\">
					<img src=\"".$pagx['page_resimurl']."\" alt=\"".$pagx['page_title']."\" width=\"1920\" height=\"801\"/>	
					<div class=\"carousel-caption\">
						<div class=\"container\">
							<div class=\"col-md-6 col-sm-8 col-xs-8 ow-pull-right no-padding\">
								<h4 data-animation=\"animated bounceInLeft\">".$pagx['page_title']."</h4>
								<h3 data-animation=\"animated fadeInDown\">".$pagx['page_alan1']."<span>".$pagx['page_alan2']."</span></h3>
								<p data-animation=\"animated bounceInRight\">".$pagx['page_desc']."</p>
								<a href=\"page.php?id=".$pagx['page_id']."\" title=\"".$pagx['page_title']."\" data-animation=\"animated zoomInUp\">Detay</a>
							</div>
						</div>
					</div>
				</div>";
} 


$slider .= "<div class=\"item\">			
<img src=\"".$pagx['page_resimurl']."\" alt=\"".$pagx['page_title']."\" width=\"1920\" height=\"801\"/>			
<div class=\"carousel-caption\">				
<div class=\"container\">					
<div class=\"col-md-6 col-sm-8 col-xs-8 ow-pull-right no-padding\">							
<h4 data-animation=\"animated bounceInLeft\">".$pagx['page_title']."</h4>						
<h3 data-animation=\"animated fadeInDown\">".$pagx['page_alan1']."<span>".$pagx['page_alan2']."</span></h3>							
<p data-animation=\"animated bounceInRight\">".$pagx['page_desc']."</p>							
<a href=\"page.php?id=".$pagx['page_id']."\" title=\"".$pagx['page_title']."\" data-animation=\"animated zoomInUp\">Detay</a>
							
</div>					
</div>				
</div>		
</div>";
		}
		
$t-> assign(array(
	"PLUGIN_SLIDER" => $slider
	));

?>