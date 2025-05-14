<?php
$servername = "localhost";
$username   = "root";        // substitua se seu usuário for diferente
$password   = "";            // coloque a senha do seu MySQL, se houver
$dbname     = "demo"; // substitua pelo nome do seu banco

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
