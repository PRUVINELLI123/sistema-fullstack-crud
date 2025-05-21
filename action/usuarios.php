<?php
// include dos arquivos
include_once '../include/logado.php';
include_once '../include/conexao.php';

// captura a acao dos dados
$acao = $_GET['acao'] ?? '';

// validacao
switch ($acao) {
    case 'cadastrar':
        $email = $_POST['email'];
        $nome  = $_POST['nome'];
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (Email, Nome, Senha) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $email, $nome, $senha);
        $stmt->execute();

        header("Location: ../lista-usuarios.php");
        break;

    case 'editar':
        $id    = $_POST['id'];
        $email = $_POST['email'];
        $nome  = $_POST['nome'];

        $sql = "UPDATE usuarios SET Email = ?, Nome = ? WHERE UserId = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $email, $nome, $id);
        $stmt->execute();

        header("Location: ../lista-usuarios.php");
        break;

    case 'excluir':
        $id = $_GET['id'];

        $sql = "DELETE FROM usuarios WHERE UserId = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        header("Location: ../lista-usuarios.php");
        break;

    default:
        header("Location: ../erro.php");
        break;
}
?>
