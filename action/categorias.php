<?php
include_once '../include/logado.php';
include_once '../include/conexao.php';

$acao = $_GET['acao'] ?? '';

switch ($acao) {
    case 'inserir':
        $nome = $_POST['nome'] ?? '';
        $descricao = $_POST['descricao'] ?? '';

        $sql = "INSERT INTO categorias (Nome, Descricao) VALUES (?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $nome, $descricao);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: ../lista-categorias.php?msg=categoria_cadastrada");
        } else {
            header("Location: ../lista-categorias.php?msg=erro_ao_cadastrar");
        }
        break;

    case 'editar':
        $id = $_POST['id'] ?? 0;
        $nome = $_POST['nome'] ?? '';
        $descricao = $_POST['descricao'] ?? '';

        $sql = "UPDATE categorias SET Nome = ?, Descricao = ? WHERE CategoriaID = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssi", $nome, $descricao, $id);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: ../lista-categorias.php?msg=categoria_atualizada");
        } else {
            header("Location: ../lista-categorias.php?msg=erro_ao_atualizar");
        }
        break;

    case 'excluir':
        $id = $_GET['id'] ?? 0;

        $sql = "DELETE FROM categorias WHERE CategoriaID = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: ../lista-categorias.php?msg=categoria_excluida");
        } else {
            header("Location: ../lista-categorias.php?msg=erro_ao_excluir");
        }
        break;

    default:
        header("Location: ../lista-categorias.php?msg=acao_invalida");
        break;
}
?>
