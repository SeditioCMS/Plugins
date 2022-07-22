<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
http://www.neocrome.net
http://www.seditiocms.com

[BEGIN_SED]
File=plugins/indexcat/indexcat.php
Version=175
Updated=2013-jul-08
Type=Plugin
Author=Neocrome
Description=
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=indexcat
Part=main
File=indexcat
Hooks=index.tags
Tags=index.tpl:{PLUGIN_MENU}
Minlevel=0
Order=10
[END_SED_EXTPLUGIN]

==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

/* ============ MASKS FOR THE HTML OUTPUTS =========== */

$sqlq = sed_sql_query("SELECT DISTINCT(page_cat), COUNT(*) FROM $db_pages WHERE 1 GROUP BY page_cat");
    
    	while ($rowq = sed_sql_fetchassoc($sqlq))
    		{ $pagecount[$rowq['page_cat']] = $rowq['COUNT(*)']; }

$sqlxd = sed_sql_query("SELECT * FROM $db_structure where structure_id
AND structure_code NOT LIKE 'system' ORDER by structure_path ASC, structure_code ASC");
    
while ($rowx = sed_sql_fetchassoc($sqlxd))
    		{
$structure_code = $rowx['structure_code'];
$structure_title = $rowx['structure_title'];
$structure_icon = $rowx['structure_icon'];				
$structure_path = $rowx['structure_path'];
$pathfieldlen = (mb_strpos($structure_path, ".")==0) ? 3 : 9;
$pathfieldimg = (mb_strpos($structure_path, ".")==0) ? '' : "<img src=\"system/img/admin/join2.gif\" alt=\"\" /> ";
$pagecount[$structure_code] = (!$pagecount[$structure_code]) ? "0" : $pagecount[$structure_code];
    
$menux .= " <li><a href=\"".sed_cc($structure_code)."/\">".$pathfieldimg." ".sed_cc($structure_title)." (".$pagecount[$structure_code].")</a>
                                        <span class=\"checkmark\"></span></li>";
}
	
$t-> assign(array(
	"PLUGIN_MENU" => $menux  
	));

?>