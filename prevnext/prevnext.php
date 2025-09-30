<?php
/* ====================
Seditio - Website engine
Copyright Seditio Team
https://seditio.com.tr
[BEGIN_SED]
File=plugins/prevnext/prevnext.php
Version=180
Updated=2025-04-15
Type=Plugin
Author=Kaan
Description=Kategori içindeki önceki ve sonraki sayfa geçişi
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=prevnext
Part=main
File=prevnext
Hooks=page.tags
Tags=page.tpl: {PREV_PAGE},{NEXT_PAGE}
Minlevel=0
Order=10
[END_SED_EXTPLUGIN]
==================== */

// Sayfa listesini çekiyoruz
$sqlprevnext = sed_sql_query("SELECT page_id, page_title, page_alias, page_cat 
                              FROM $db_pages 
                              WHERE page_state = 0 AND page_cat = '" . sed_sql_prep($pag['page_cat']) . "' 
                              ORDER BY page_date ASC");

$prevnext = [];
$prevnextalias = [];
$prevnexttitle = [];
$find_ipn = null;
$ipn = 1;

while ($row = sed_sql_fetchassoc($sqlprevnext)) {
    $prevnext[$ipn] = $row['page_id'];
    $prevnextalias[$row['page_id']] = $row['page_alias'];
    $prevnexttitle[$row['page_id']] = $row['page_title'];

    if ($row['page_id'] == $pag['page_id']) {
        $find_ipn = $ipn;
    }
    $ipn++;
}

$prevnext_count = count($prevnext);
$prev_id = $next_id = null;

// Önceki ve sonraki ID'leri güvenli şekilde belirleme
if ($find_ipn !== null) {
    // Önceki sayfa
    $prev_id = ($find_ipn == 1) ? $prevnext[$prevnext_count] : $prevnext[$find_ipn - 1];
    // Sonraki sayfa
    $next_id = ($find_ipn == $prevnext_count) ? $prevnext[1] : $prevnext[$find_ipn + 1];
}

// Önceki sayfa URL
if (!empty($prev_id) && isset($prevnexttitle[$prev_id])) {
    $prev_title = $prevnexttitle[$prev_id];
    $prev_alias = !empty($prevnextalias[$prev_id]) ? $prevnextalias[$prev_id] : $prev_id;
    $prev_url = '<a href="' . sed_url("page", "al=" . $prev_alias) . '" title="' . esc($prev_title) . '">'
              . mb_substr($prev_title, 0, 40, 'UTF-8')
              . (mb_strlen($prev_title, 'UTF-8') > 40 ? '...' : '') 
              . ' →</a>';
} else {
    $prev_url = '';
}

// Sonraki sayfa URL
if (!empty($next_id) && isset($prevnexttitle[$next_id])) {
    $next_title = $prevnexttitle[$next_id];
    $next_alias = !empty($prevnextalias[$next_id]) ? $prevnextalias[$next_id] : $next_id;
    $next_url = '<a href="' . sed_url("page", "al=" . $next_alias) . '" title="' . esc($next_title) . '">'
              . '← ' . mb_substr($next_title, 0, 40, 'UTF-8')
              . (mb_strlen($next_title, 'UTF-8') > 40 ? '...' : '') 
              . '</a>';
} else {
    $next_url = '';
}

$t->assign("PREV_PAGE", $prev_url);
$t->assign("NEXT_PAGE", $next_url);

// Güvenlik için küçük yardımcı fonksiyon
function esc($s) {
    return htmlspecialchars($s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
?>