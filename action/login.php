<?php
// include dos arquivos
include_once '../include/conexao.php';

// captura a acao dos dados
$acao = $_GET['acao'] ?? '';

// validacao
switch ($acao) {
    case 'login':
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = "SELECT * FROM usuarios WHERE Email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $usuario = $resultado->fetch_assoc();
            if ($senha==$usuario['Senha']) {
                session_start();
                $_SESSION['usuario'] = $usuario;
                header("Location: ../index.php");
                exit;
            }
        }
        header("Location: ../login.php?erro=1");
        break;

    case 'logout':
        session_start();
        session_destroy();
        header("Location: ../login.php");
        break;

    default:
        header("Location: ../erro.php");
        break;
}
?>
