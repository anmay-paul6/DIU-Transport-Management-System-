<?php

require_once '../core/Controller.php';

require_once '../core/Database.php';

// Get the current URL (e.g. auth/login, admin/dashboard)
$url = isset($_GET['url']) ? explode('/', trim($_GET['url'], '/')) : [];

// Route the request
require_once __DIR__ . '/../core/Router.php';
Router::route($url);

