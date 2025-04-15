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

$sqlprevnext = sed_sql_query("SELECT page_id, page_title, page_alias, page_cat FROM $db_pages WHERE page_state = 0 AND page_cat = '" . sed_sql_prep($pag['page_cat']) . "' ORDER BY page_date ASC");

$sys['catcode'] = $pag['page_cat'];
$ipn = 1;
$find_ipn = null;
$prevnext = [];
$prevnextalias = [];
$prevnexttitle = [];

while ($rowprevnext = sed_sql_fetchassoc($sqlprevnext)) {
    $prevnext[$ipn] = $rowprevnext['page_id'];
    $prevnextalias[$rowprevnext['page_id']] = $rowprevnext['page_alias'];
    $prevnexttitle[$rowprevnext['page_id']] = $rowprevnext['page_title'];

    if ($rowprevnext['page_id'] == $pag['page_id']) { 
        $find_ipn = $ipn; 
    }
    $ipn++;
}

$prevnext_count = count($prevnext);

if (isset($find_ipn) && $find_ipn > 1 && $find_ipn < $prevnext_count) {
    $prev_id = $prevnext[$find_ipn - 1];
    $next_id = $prevnext[$find_ipn + 1];
} elseif (isset($find_ipn) && $find_ipn == 1) {
    $prev_id = $prevnext[$prevnext_count];
    $next_id = $prevnext[$find_ipn + 1];
} elseif (isset($find_ipn) && $find_ipn == $prevnext_count) {
    $prev_id = $prevnext[$find_ipn - 1];
    $next_id = $prevnext[1];
} else {
    $prev_id = $next_id = null;
}

$next_url = !empty($prevnextalias[$next_id]) 
    ? '<a href="' . sed_url("page", "al=" . $prevnextalias[$next_id]) . '" title="' . $prevnexttitle[$next_id] . '"> ← ' . mb_substr($prevnexttitle[$next_id], 0, 40) . (mb_strlen($prevnexttitle[$next_id]) > 40 ? '...' : '') . ' </a>'
    : '<a href="' . sed_url("page", "id=" . $next_id) . '" title="' . $prevnexttitle[$next_id] . '">' . mb_substr($prevnexttitle[$next_id], 0, 40) . (mb_strlen($prevnexttitle[$next_id]) > 40 ? '...' : '') . '</a>';

$prev_url = !empty($prevnextalias[$prev_id]) 
    ? '<a href="' . sed_url("page", "al=" . $prevnextalias[$prev_id]) . '" title="' . $prevnexttitle[$prev_id] . '">' . mb_substr($prevnexttitle[$prev_id], 0, 40) . (mb_strlen($prevnexttitle[$prev_id]) > 40 ? '...' : '') . ' → </a>'
    : '<a href="' . sed_url("page", "id=" . $prev_id) . '" title="' . $prevnexttitle[$prev_id] . '">' . mb_substr($prevnexttitle[$prev_id], 0, 40) . (mb_strlen($prevnexttitle[$prev_id]) > 40 ? '...' : '') . '</a>';

$t->assign("PREV_PAGE", $prev_url);
$t->assign("NEXT_PAGE", $next_url);
?>
