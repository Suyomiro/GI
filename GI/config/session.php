<?php
session_start();

class SessionManager {
    public static function login($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['user_nom'] = $user['nom'];
        $_SESSION['user_prenom'] = $user['prenom'];
    }
    
    public static function logout() {
        session_destroy();
    }
    
    public static function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }
    
    public static function getUser() {
        if (self::isLoggedIn()) {
            return [
                'id' => $_SESSION['user_id'],
                'email' => $_SESSION['user_email'],
                'role' => $_SESSION['user_role'],
                'nom' => $_SESSION['user_nom'],
                'prenom' => $_SESSION['user_prenom']
            ];
        }
        return null;
    }
    
    public static function requireLogin() {
        if (!self::isLoggedIn()) {
            header('Location: /GI/Public/login.php');
            exit;
        }
    }
    
    public static function requireRole($role) {
        self::requireLogin();
        if ($_SESSION['user_role'] !== $role) {
            header('Location: /GI/Public/login.php');
            exit;
        }
    }
}
?>