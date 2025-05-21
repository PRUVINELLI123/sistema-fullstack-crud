<?php
include_once '../include/logado.php';
include_once '../include/conexao.php';

$acao = $_GET['acao'] ?? '';

switch ($acao) {

    case 'inserir':
        $nome = $_POST['nome'] ?? '';
        $preco = $_POST['preco'] ?? 0;
        $categoriaID = $_POST['categoria_id'] ?? null;
        $referencia = $_POST['referencia'] ?? '';
        $descricao = $_POST['descricao'] ?? '';
        $peso = $_POST['peso'] ?? 0;

        $sql = "INSERT INTO produtos (Nome, Preco, CategoriaID, Referencia, Descricao, Peso) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sdissi", $nome, $preco, $categoriaID, $referencia, $descricao, $peso);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: ../lista-produtos.php?msg=produto_cadastrado");
        } else {
            header("Location: ../lista-produtos.php?msg=erro_ao_cadastrar");
        }
        break;

    case 'editar':
        $id = $_POST['id'] ?? 0;
        $nome = $_POST['nome'] ?? '';
        $preco = $_POST['preco'] ?? 0;
        $categoriaID = $_POST['categoria_id'] ?? null;
        $referencia = $_POST['referencia'] ?? '';
        $descricao = $_POST['descricao'] ?? '';
        $peso = $_POST['peso'] ?? 0;

        $sql = "UPDATE produtos 
                SET Nome = ?, Preco = ?, CategoriaID = ?, Referencia = ?, Descricao = ?, Peso = ? 
                WHERE ProdutoID = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sdissii", $nome, $preco, $categoriaID, $referencia, $descricao, $peso, $id);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: ../lista-produtos.php?msg=produto_atualizado");
        } else {
            header("Location: ../lista-produtos.php?msg=erro_ao_atualizar");
        }
        break;

    case 'excluir':
        $id = $_GET['id'] ?? 0;

        $sql = "DELETE FROM produtos WHERE ProdutoID = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: ../lista-produtos.php?msg=produto_excluido");
        } else {
            header("Location: ../lista-produtos.php?msg=erro_ao_excluir");
        }
        break;

    default:
        header("Location: ../lista-produtos.php?msg=acao_invalida");
        break;
}
?>
