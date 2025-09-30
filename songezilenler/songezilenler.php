<?php
/* ====================
Seditio - Website engine
Copyright Neocrome
http://www.neocrome.net
[BEGIN_SED]
File=plugins/songezilenler/songezilenler.php
Version=178+
Updated=2023-apr-15
Type=Plugin
Author=Kaan
Description=Son Gezilen Sayfalar
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=songezilenler
Part=main
File=songezilenler
Hooks=standalone
Tags=
Minlevel=0
Order=10
[END_SED_EXTPLUGIN]
==================== */

if (!defined('SED_CODE')) { die("Hacking attempt."); }

// Giriş kontrolü
if ($usr['id'] < 1) {
    header("Location: ".$cfg['mainurl']."/login");
    exit;
}

$songezilenler = ''; // Başlangıçta tanımla

$d = sed_import('d','G','INT');
$id = sed_import('id','G','INT');
$a = sed_import('a','G','TXT');

if (empty($d)) { $d = 0; }

// Toplam kayıt ve pagination
$totall = sed_sql_result(sed_sql_query("SELECT COUNT(*) FROM visited_pages WHERE userid='".$usr['id']."'"), 0, 0);
$pagi = sed_pagination(sed_url("plug", "e=songezilenler&id=".$id), $d, $totall, $cfg['plugin']['songezilenler']['maxpage']);
list($pageprev, $pagenext) = sed_pagination_pn(sed_url("plug", "e=songezilenler&id=".$id), $d, $totall, $cfg['plugin']['songezilenler']['maxpage'], TRUE);

// Silme işlemi
if ($a == 'sil' && $id) {
    sed_check_xg();
    $sql_check = sed_sql_query("SELECT id FROM visited_pages WHERE id='$id' AND userid='".$usr['id']."' LIMIT 1");
    if ($row_del = sed_sql_fetchassoc($sql_check)) {
        sed_sql_query("DELETE FROM visited_pages WHERE id='$id'");
        header("Location: ".$_SERVER['HTTP_REFERER']);
        exit;
    }
}

// Son gezilenleri çek
$sql_pages = sed_sql_query("SELECT * FROM visited_pages WHERE userid='".$usr['id']."' ORDER BY id DESC LIMIT $d, ".$cfg['plugin']['songezilenler']['maxpage']);

$songezilenler .= '<div class="card mb-3">
    <div class="card-body">
        <div class="row flex-between-center">
            <div class="col-sm-auto mb-2 mb-sm-0">
                <h6 class="mb-0"><a href="plug/userpanel">Kontrol Panel</a> » <a href="plug/songezilenler">Son Gezilen Sayfalar</a></h6>
            </div>
            <div class="col-sm-auto">
                <div class="row gx-2 align-items-left">
                    <div class="col-auto pe-0"><span class="fas fa-list-ul"></span></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="card">
        <div class="table-responsive scrollbar">
            <div class="card-body p-0">
                <table class="table table-sm table-striped fs--1 mb-0 overflow-hidden">
                    <thead class="bg-200 text-900">
                        <tr>
                            <th class="sort pe-1 align-middle white-space-nowrap">#ID</th>
                            <th class="sort pe-1 align-middle white-space-nowrap">Kategori</th>
                            <th class="sort pe-1 align-middle white-space-nowrap">Sayfa</th>
                            <th class="sort pe-1 align-middle white-space-nowrap">Ziyaret Tarihi</th>
                            <th>Sil</th>
                        </tr>
                    </thead>
                    <tbody>';

while ($row = sed_sql_fetcharray($sql_pages)) {
    $songezilenler .= '<tr>
        <td class="id align-middle white-space-nowrap py-2">'.$row['id'].'</td>
        <td class="date align-middle white-space-nowrap py-2">'.$row['pagecat'].'</td>
        <td class="link align-middle white-space-nowrap py-2"><a href="'.$row['pageurl'].'">'.$row['pagetitle'].'</a></td>
        <td class="date align-middle white-space-nowrap py-2">'.$row['visited_at'].'</td>
        <td class="link align-middle white-space-nowrap py-2">
            <a href="plug/songezilenler?a=sil&id='.$row['id'].'&'.sed_xg().'"><i class="ic-trash"></i></a>
        </td>
    </tr>';
}

$songezilenler .= '</tbody></table></div></div>
<div class="card-tools">
    <ul class="pagination pagination-sm">
        <li class="page-item">'.$pageprev.'</li>
        <li class="page-item">'.$pagi.'</li>
        <li class="page-item">'.$pagenext.'</li>
    </ul>
</div>
</div>
</div>';

$plugin_body = $songezilenler;
?>
