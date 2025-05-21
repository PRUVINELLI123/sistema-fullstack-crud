<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    // Se não estiver logado, redireciona para o login
    header("Location: /sistema-fullstack-crud/login.php");
    exit;
}
?>
