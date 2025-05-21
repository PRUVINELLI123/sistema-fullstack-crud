<?php
include_once '../include/logado.php';
include_once '../include/conexao.php';

$acao = $_GET['acao'] ?? '';

switch ($acao) {

    case 'inserir':
        $produtoID = $_POST['produto_id'] ?? null;
        $funcionarioID = $_POST['funcionario_id'] ?? null;
        $clienteID = $_POST['cliente_id'] ?? null;
        $dataProducao = $_POST['data_producao'] ?? null;
        $dataEntrega = $_POST['data_entrega'] ?? null;

        $sql = "INSERT INTO producao (ProdutoID, FuncionarioID, ClienteID, DataProducao, DataEntrega) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "iiiss", $produtoID, $funcionarioID, $clienteID, $dataProducao, $dataEntrega);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: ../lista-producao.php?msg=producao_inserida");
        } else {
            header("Location: ../lista-producao.php?msg=erro_ao_inserir");
        }
        break;

    case 'editar':
        $id = $_POST['id'] ?? 0;
        $produtoID = $_POST['produto_id'] ?? null;
        $funcionarioID = $_POST['funcionario_id'] ?? null;
        $clienteID = $_POST['cliente_id'] ?? null;
        $dataProducao = $_POST['data_producao'] ?? null;
        $dataEntrega = $_POST['data_entrega'] ?? null;

        $sql = "UPDATE producao SET ProdutoID = ?, FuncionarioID = ?, ClienteID = ?, DataProducao = ?, DataEntrega = ? WHERE ProducaoID = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "iiissi", $produtoID, $funcionarioID, $clienteID, $dataProducao, $dataEntrega, $id);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: ../lista-producao.php?msg=producao_atualizada");
        } else {
            header("Location: ../lista-producao.php?msg=erro_ao_atualizar");
        }
        break;

    case 'excluir':
        $id = $_GET['id'] ?? 0;

        $sql = "DELETE FROM producao WHERE ProducaoID = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: ../lista-producao.php?msg=producao_excluida");
        } else {
            header("Location: ../lista-producao.php?msg=erro_ao_excluir");
        }
        break;

    default:
        header("Location: ../lista-producao.php?msg=acao_invalida");
        break;
}
?>
