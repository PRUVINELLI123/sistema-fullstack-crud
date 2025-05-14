<?php
include_once './include/logado.php';
include_once './include/conexao.php';
include_once './include/header.php'; // Adicione esta linha
 
// Busca todos os usuários cadastrados
$sql = "SELECT nome, email FROM usuarios";
$result = $conn->query($sql);
 
// Usuário logado
$usuario_logado = $_SESSION['usuario'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Usuários do Sistema</title>
    <link rel="stylesheet" href="./assets/style.css">
    <style>
        .usuario-logado {
            color: green;
            font-weight: bold;
        }
        table {
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <!-- O header.php já deve abrir o <header> com as opções de navegação -->
    <main>
        <table border="1" cellpadding="8">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nome']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</body>
</html>