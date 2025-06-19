<?php
require_once __DIR__ . '/../config/session.php';

SessionManager::logout();
header('Location: /GI/Public/login.php');
exit;
?>