<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
http://www.neocrome.net
http://www.seditiocms.com
[BEGIN_SED]
File=aslider.add.inc.php
Version=175
Updated=2012-dec-31
Type=Core
Author=Neocrome
Description=aSlider
[END_SED]
==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

$id = sed_import('id','G','INT');

if ($a=='add')
	{
	sed_shield_protect();
	$newpagetitle = sed_import('newpagetitle','P','TXT');
	$newpagedesc = sed_import('newpagedesc','P','TXT');
	$newpagealan1 = sed_import('newpagealan1','P','TXT');
	$newpagealan2 = sed_import('newpagealan2','P','TXT');
	$resimurl = sed_import('imagesUpload','P','TXT');
	
  $newpagetype = ($usr['isadmin'] && ($cfg['textmode']=='bbcode')) ? sed_import('newpagetype','P','INT') : 0;  
  if ($cfg['textmode']=='html') { $newpagetype = 1; }  
	$newpagepublish = sed_import('newpagepublish', 'P', 'ALP');
	$newpagestate = (($newpagepublish == "OK") && $usr['isadmin']) ? 0 : 1;

////////////////////////////////
foreach ($_FILES["imagesUpload"]["error"] as $upload => $error) { 
    if ($error == UPLOAD_ERR_OK) {  
        $img_source = $_FILES["imagesUpload"]["tmp_name"][$upload];
        $img_name = $_FILES["imagesUpload"]["name"][$upload];
		$img_name  = str_replace("\'",'',$img_name );
		$img_name  = trim(str_replace("\"",'',$img_name ));
		$img_name = sed_newname($usr['id']."-".$img_name, TRUE);
		$resimveritabani = "plugins/aslider/resim/".$usr['id']."/".$img_name."";
		$resim = "plugins/aslider/resim/".$usr['id']."/";
		@mkdir($resim, 0777);
		$img_target = "plugins/aslider/resim/".$usr['id']."/"; 
		move_uploaded_file($img_source,$img_target.'/'.$img_name);
		$error_string = '';
	}else{ 
		$error_string .= "Bir resim seçmelisiniz!<br />";	
	}
}
/////////////////////////////////////////////

	$error_string .= (mb_strlen($newpagetitle)<6) ? $L['pag_titletooshort']."<br />" : '';

	if (empty($error_string))
		{

		$sql = sed_sql_query("INSERT into sed_aslider
			(page_state,
			page_type,
			page_title,
			page_desc,
			page_alan1,
			page_alan2,
			page_date,
			page_resimurl
			)
			VALUES
			(".(int)$newpagestate.",
			".(int)$newpagetype.",
			'".sed_sql_prep($newpagetitle)."',
			'".sed_sql_prep($newpagedesc)."',
			'".sed_sql_prep($newpagealan1)."',
			'".sed_sql_prep($newpagealan2)."',
			".(int)$sys['now_offset'].",
			'".sed_sql_prep($resimveritabani)."')");

		sed_shield_update(30, "New Slider");
		sed_redirect('index.php?module=admin&m=tools&p=aslider&n=main');
		
		exit;
		}
	}

$plugin_body .= "<h4>Slider Ekle</h4>

<div class=\"error\">".$error_string."</div>

<form action=\"index.php?module=admin&m=tools&p=aslider&n=add&a=add\" method=\"post\" name=\"newpage\" enctype=\"multipart/form-data\">
  
			<table class=\"cells striped\" class=\"simple tableforms\">
			<tr>
				<td>Başlık: </td>
				<td><input type=\"text\" class=\"text\" name=\"newpagetitle\" value=\"".sed_cc($newpagetitle)."\" size=\"96\" maxlength=\"255\" /></td>
			</tr>
		
			<tr>
				<td>Açıklama: </td>
				<td><input type=\"text\" class=\"text\" name=\"newpagedesc\" value=\"".sed_cc($newpagedesc)."\" size=\"96\" maxlength=\"255\" /></td>
			</tr>
		
			<tr>
			<td>Resim: </td>
		    <td><input name=\"imagesUpload[]\" type=\"file\" /> </td>
		  </tr>   	
		
		
		<tr>
				<td>Alan 1: </td>
				<td><input type=\"text\" class=\"text\" name=\"newpagealan1\" value=\"".sed_cc($newpagealan1)."\" size=\"96\" maxlength=\"255\" /></td>
			</tr>
		
		
			<tr>
				<td>Alan 2: </td>
				<td><input type=\"text\" class=\"text\" name=\"newpagealan2\" value=\"".sed_cc($newpagealan2)."\" size=\"96\" maxlength=\"255\" /></td>
			</tr>
						
		  </table>
		
		
			<div class=\"centered\">
				<input type=\"submit\" class=\"submit btn btn-big\" name=\"newpagepublish\" value=\"Yayınla\" />
				
			</div>

</form>";

?>
