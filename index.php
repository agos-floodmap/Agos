<?php

require_once __DIR__ . '/models/db_model.php';

if (!empty($_SESSION['user'])) {
    header('Location: controllers/cdrrmo/cdrrmo_controller.php?page=flood_reports');
    exit;
}

header('Location: controllers/auth_controller.php');
exit;
