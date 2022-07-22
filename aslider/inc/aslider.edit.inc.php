<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
http://www.neocrome.net
http://www.seditiocms.com
[BEGIN_SED]
File=page.inc.php
Version=175
Updated=2012-dec-31
Type=Core
Author=Neocrome
Description=Pages
[END_SED]
==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }


$id = sed_import('id','G','INT');


if ($a=='update')
	{
			
	$sql1 = sed_sql_query("SELECT * FROM sed_aslider WHERE page_id='".$id."' LIMIT 1");
	$row1 = sed_sql_fetchassoc($sql1);

	$rpagetype = sed_import('rpagetype','P','INT');
	$rpagetitle = sed_import('rpagetitle','P','TXT');
	$rpagedesc = sed_import('rpagedesc','P','TXT');
	$rpagealan1 = sed_import('rpagealan1','P','TXT');
	$rpagealan2 = sed_import('rpagealan2','P','TXT');
	$rpageresimurl = sed_import('imagesUpload','P','TXT');
	$rpagedatenow = sed_import('rpagedatenow','P','BOL');
	$ryear = sed_import('ryear','P','INT');
	$rmonth = sed_import('rmonth','P','INT');
	$rday = sed_import('rday','P','INT');
	$rhour = sed_import('rhour','P','INT');
	$rminute = sed_import('rminute','P','INT');
	$rpagedelete = sed_import('rpagedelete','P','BOL');

	$error_string .= (mb_strlen($rpagetitle)<2) ? $L['pag_titletooshort']."<br />" : '';
	
	if (empty($error_string) || $rpagedelete)
		{
		if ($rpagedelete)
			{
			$sqld = sed_sql_query("SELECT * FROM sed_aslider WHERE page_id='$id' LIMIT 1");

			if ($row = sed_sql_fetchassoc($sqld))
				{
				$sql = sed_sql_query("DELETE FROM sed_aslider WHERE page_id='$id'");	
				@unlink($row['page_resimurl']);		
				sed_redirect('index.php?module=admin&m=tools&p=aslider&n=main');
				exit;
				}
			}
		else
			{
			$rpagedate = ($rpagedatenow) ? $sys['now_offset'] : sed_mktime($rhour, $rminute, 0, $rmonth, $rday, $ryear) - $usr['timezone'] * 3600;
			$rpagetype = ($cfg['textmode']=='html') ? 1 : $rpagetype;
			$rpagestate = $row1['page_state'];
			$rpagepublish = sed_import('rpagepublish', 'P', 'ALP');
			$rpagestate = (($rpagepublish == "NO") && $usr['isadmin']) ? 1 : $rpagestate; 

 ////////////////////////////////
foreach ($_FILES["imagesUpload"]["error"] as $upload => $error) { 
    if ($error == UPLOAD_ERR_OK) { 
        $img_source = $_FILES["imagesUpload"]["tmp_name"][$upload];
        $img_name = $_FILES["imagesUpload"]["name"][$upload];
		$img_name  = str_replace("\'",'',$img_name );
		$img_name  = trim(str_replace("\"",'',$img_name ));
		$img_name = sed_newname($usr['id']."-".$img_name, TRUE);
		@unlink($row1['page_resimurl']);	
		$rpageresimurl = "plugins/aslider/resim/".$usr['id']."/".$img_name;
		$resim = "plugins/aslider/resim/".$usr['id']."/";
		@mkdir($resim, 0777);
		$img_target = "plugins/aslider/resim/".$usr['id']."/"; 
		move_uploaded_file($img_source,$img_target.'/'.$img_name);
	}
}
/////////////////////////////////////////////
				
			$sql = sed_sql_query("UPDATE sed_aslider SET
				page_state = '".$rpagestate."',
				page_type = '".sed_sql_prep($rpagetype)."',
				page_title = '".sed_sql_prep($rpagetitle)."',
				page_desc = '".sed_sql_prep($rpagedesc)."',
				page_alan1='".sed_sql_prep($rpagealan1)."',
				page_alan2='".sed_sql_prep($rpagealan2)."',
				page_date = '".(int)$rpagedate."',
				page_resimurl = '".sed_sql_prep($rpageresimurl)."'				
				WHERE page_id='".$id."'");
			    sed_redirect('index.php?module=admin&m=tools&p=aslider&n=main');
			exit;
			}
		}
	}

$sqlw = sed_sql_query("SELECT * FROM sed_aslider WHERE page_id='".$id."' LIMIT 1");
$pag = sed_sql_fetchassoc($sqlw);

$pag['page_date'] = sed_selectbox_date($pag['page_date'] + $usr['timezone'] * 3600,'long');
$page_form_delete =  sed_radiobox("rpagedelete", $yesno_arr, 0);

$plugin_body .= " <h2>Slider Düzenle #".$pag['page_id']."</h2>";

$plugin_body .= '<table><tr>';
$plugin_body .= '
<li><a href="index.php?module=admin&m=tools&p=aslider&n=main">Yazılar</a></li>
<li><a href="index.php?module=admin&m=tools&p=aslider&n=add">Slider Ekle</a></li>';
$plugin_body .= '</tr></table>';


$plugin_body .= " <div class=\"error\">".$error_string."</div>

<form action=\"index.php?module=admin&m=tools&p=aslider&n=edit&a=update&id=".$pag['page_id']."\" method=\"post\" name=\"newpage\" enctype=\"multipart/form-data\">
  
<table class=\"cells striped\" class=\"simple tableforms\">
<tr><td>Başlık: </td>
<td><input type=\"text\" class=\"text\" name=\"rpagetitle\" value=\"".$pag['page_title']."\" size=\"96\" maxlength=\"255\" /></td>
</tr>
		
<tr><td>Açıklama: </td>
<td><input type=\"text\" class=\"text\" name=\"rpagedesc\" value=\"".sed_cc($pag['page_desc'])."\" size=\"96\" maxlength=\"255\" /></td>
</tr>
		
<tr><td>Resim: </td>
<td><input name=\"imagesUpload[]\" type=\"file\"/> <input type=\"hidden\" name=\"imagesUpload\" value=\"".$pag['page_resimurl']."\"><img src=\"".$pag['page_resimurl']."\" width=\"30\" height=\"30\" /> 
</td></tr>   	
		
<tr><td>Alan 1: </td>
<td><input type=\"text\" class=\"text\" name=\"rpagealan1\" value=\"".sed_cc($pag['page_alan1'])."\" size=\"96\" maxlength=\"255\" /></td>
</tr>
		
<tr><td>Alan 2: </td>
<td><input type=\"text\" class=\"text\" name=\"rpagealan2\" value=\"".sed_cc($pag['page_alan2'])."\" size=\"96\" maxlength=\"255\" /></td>
</tr>
			
<tr><td>Tarih: </td>
<td>".$pag['page_date']."</td>
</tr>
			
<tr><td>Slideri Sil: </td>
<td>".$page_form_delete."</td>
</tr>
</table>

<div class=\"centered\">
<input type=\"submit\" class=\"submit btn btn-big\" name=\"rpagepublish\" value=\"Güncelle\" />
</div>
</form>";

?>