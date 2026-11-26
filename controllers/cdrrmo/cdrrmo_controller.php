<?php

$basePath = '../../';
require_once __DIR__ . '/../../models/db_model.php';
$user = requireLogin($basePath);
require_once __DIR__ . '/../../models/ReportData.php';

$pages = [
    'flood_reports' => ['title' => 'City Flood Reports',   'active' => 'flood'],
    'hazard_map'    => ['title' => 'Hazard Map',           'active' => 'map'],
    'areas_roads'   => ['title' => 'City Areas and Roads', 'active' => 'map'],
    'alerts'        => ['title' => 'Publish City Alert',   'active' => 'alerts'],
    'records'       => ['title' => 'City Flood Records',   'active' => 'records'],
];

$page = $_GET['page'] ?? 'flood_reports';
if (!isset($pages[$page])) {
    http_response_code(404);
    exit;
}

$bodyClass  = 'app-page';
$showTopbar = true;
$withApp    = true;
$opsLabel   = 'CDRRMO Operations Center';
$pageScript = 'assets/cdrrmo.js';
$pageTitle  = $pages[$page]['title'];
$activePage = $pages[$page]['active'];

$reports      = cdrrmoReports();
$pendingCount = count(array_filter($reports, fn($r) => $r['status'] === 'pending'));

if ($page === 'hazard_map' || $page === 'areas_roads') {
    $rows = areasAndRoads();
} elseif ($page === 'records') {
    $rows   = cityRecords();
    $places = array_values(array_unique(array_column($rows, 'place')));
}

require __DIR__ . '/../../view/cdrrmo/' . $page . '.php';
