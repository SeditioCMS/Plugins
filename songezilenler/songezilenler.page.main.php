<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
https://seditio.org

[BEGIN_SED]
File=plugins/songezilenler/songezilenler.page.main.php
Version=179
Updated=2013-jul-08
Type=Plugin
Author=Seditio Team
Description=
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=songezilenler
Part=mainpage
File=songezilenler.page.main
Hooks=page.tags
Tags=
Minlevel=0
Order=10
[END_SED_EXTPLUGIN]

==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

// Kullanıcı oturumu kontrolü
if ($usr['id'] > 0) {
    // Sayfa URL'sini ve başlığını alın
    $sayfa_url = $out['canonical_url'];
    $sayfa_baslik = $pag['page_title'];

    // Daha önce ziyaret edilen sayfaları al
    $son_ziyaretler = isset($_COOKIE['son_ziyaretler']) ? unserialize($_COOKIE['son_ziyaretler']) : [];
    if (!is_array($son_ziyaretler)) {
        $son_ziyaretler = [];
    }

    // Eğer sayfa daha önce ziyaret edilmemişse ekle
    if (!in_array($sayfa_url, array_column($son_ziyaretler, 'url'))) {
        // Son ziyaret edilen sayfalara yeni sayfayı ekle
        $son_ziyaretler[] = ['url' => $sayfa_url, 'baslik' => $sayfa_baslik];

        // Eğer limit 500 ise ilk elemanı kaldır
        if (count($son_ziyaretler) > 250) {
            array_shift($son_ziyaretler);
		// İlk eklenen satırı sil
		$sql = sed_sql_query("DELETE FROM visited_pages WHERE userid = '".$usr['id']."' ORDER BY visited_at ASC LIMIT 1");
		}

        // Güncellenmiş veriyi tekrar cookie'ye kaydet
        setcookie('son_ziyaretler', serialize($son_ziyaretler), [
            'expires' => time() + (86400 * 30),
            'path' => '/',
            'secure' => true,   // HTTPS kullanıyorsanız true yapın
            'httponly' => true, // JavaScript erişimini engeller
            'samesite' => 'Lax' // Çerez paylaşımını sınırlar
        ]);

        $simdikizaman = date("Y-m-d H:i:s");

        // Veritabanında aynı URL'nin olup olmadığını kontrol edin
        $checkQuery = "SELECT COUNT(*) FROM visited_pages WHERE userid = '".$usr['id']."' AND pageurl = '".sed_cc($sayfa_url)."'";
        $existingCount = sed_sql_result(sed_sql_query($checkQuery), 0, 0);

        if ($existingCount == 0) {
            // MySQL sorgusu ile veritabanına ekle
            $QuerySql = "INSERT INTO visited_pages (userid, pageurl, pagetitle, pagecat, visited_at) 
                         VALUES ('".$usr['id']."', '".sed_sql_prep($sayfa_url)."', '".sed_sql_prep($sayfa_baslik)."', '".sed_cc($sed_cat[$pag['page_cat']]['title'])."', '$simdikizaman')";
            sed_sql_query($QuerySql);
        }
    }
}


?>
