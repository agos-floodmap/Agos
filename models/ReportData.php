<?php

function sampleReports(): array
{
    return [
        ['id' => 'FLD-2026-LPZ01', 'location' => 'Lopez Jaena',   'zone' => 'Zone 3 - Lowland Corridor', 'level' => '0.5 m', 'severity' => 'High',     'road' => 'Not passable', 'time' => '3:42 PM', 'by' => 'Mother Leader',   'status' => 'Pending'],
        ['id' => 'FLD-2026-SBN04', 'location' => 'Sabang',        'zone' => 'Zone 1',                    'level' => '0.3 m', 'severity' => 'Moderate', 'road' => 'Light vehicles with caution', 'time' => '2:10 PM', 'by' => 'Barangay Tanod',  'status' => 'Verified'],
        ['id' => 'FLD-2026-SMT02', 'location' => 'Santa Barbara', 'zone' => 'Zone 2',                    'level' => '0.1 m', 'severity' => 'Low',      'road' => 'Passable',     'time' => '1:25 PM', 'by' => 'Resident',        'status' => 'Verified'],
        ['id' => 'FLD-2026-PIT07', 'location' => 'Pinagbarilan',  'zone' => 'Zone 5',                    'level' => '0.8 m', 'severity' => 'High',     'road' => 'Not passable', 'time' => '12:50 PM', 'by' => 'Mother Leader',  'status' => 'Rejected'],
        ['id' => 'FLD-2026-TIB09', 'location' => 'Tiaong',        'zone' => 'Zone 4',                    'level' => '0.2 m', 'severity' => 'Low',      'road' => 'Passable',     'time' => '11:05 AM', 'by' => 'Resident',       'status' => 'Verified'],
    ];
}

function cdrrmoReports(): array
{
    return [
        ['id' => 'C-001', 'title' => 'DRT Highway, Ultramega area', 'level' => '0.5 m', 'road' => 'Not passable to light vehicles', 'source' => 'Resident',           'time' => '3:20 PM', 'media' => 'Video', 'status' => 'pending'],
        ['id' => 'C-002', 'title' => 'Concepcion Subdivision',       'level' => '0.5 m', 'road' => 'Not passable',                   'source' => 'Barangay personnel', 'time' => '3:28 PM', 'media' => 'Photo', 'status' => 'pending'],
        ['id' => 'C-003', 'title' => 'Tibag, near Bustos bridge',    'level' => '0.3 m', 'road' => 'Passable',                       'source' => 'Response team',      'time' => '3:35 PM', 'media' => 'Photo', 'status' => 'pending'],
    ];
}

function areasAndRoads(): array
{
    return [
        ['area' => 'DRT Highway',            'water' => '0.5 m', 'road' => 'Not passable to light vehicles', 'updated' => '3:30 PM', 'status' => 'Affected'],
        ['area' => 'Concepcion Subdivision', 'water' => '0.5 m', 'road' => 'Not passable',                   'updated' => '3:38 PM', 'status' => 'Affected'],
        ['area' => 'Tibag',                  'water' => '0.3 m', 'road' => 'Passable',                       'updated' => '3:42 PM', 'status' => 'Affected'],
        ['area' => 'Sabang',                 'water' => 'None',  'road' => 'Passable',                       'updated' => '2:10 PM', 'status' => 'Cleared'],
    ];
}

function cityRecords(): array
{
    return [
        ['date' => '2026-11-19', 'label' => 'Nov 19, 3:20 PM', 'place' => 'DRT Highway', 'water' => '0.5 m', 'road' => 'Not passable', 'report' => 'Verified', 'alert' => 'Sent'],
        ['date' => '2026-11-19', 'label' => 'Nov 19, 3:28 PM', 'place' => 'Concepcion',  'water' => '0.5 m', 'road' => 'Not passable', 'report' => 'Verified', 'alert' => 'Sent'],
        ['date' => '2026-11-19', 'label' => 'Nov 19, 3:35 PM', 'place' => 'Tibag',       'water' => '0.3 m', 'road' => 'Passable',     'report' => 'Verified', 'alert' => 'Sent'],
        ['date' => '2026-10-24', 'label' => 'Oct 24, 1:05 PM', 'place' => 'Sabang',      'water' => '0.3 m', 'road' => 'Passable',     'report' => 'Verified', 'alert' => 'None'],
        ['date' => '2026-10-24', 'label' => 'Oct 24, 1:30 PM', 'place' => 'Makinabang',  'water' => 'None',  'road' => 'None',         'report' => 'Rejected', 'alert' => 'None'],
    ];
}
