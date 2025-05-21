<?php
include_once '../include/logado.php';
include_once '../include/conexao.php';

$acao = $_GET['acao'];

switch ($acao) {
    case 'inserir':
        $nome = $_POST['nome'];
        $dataNascimento = $_POST['data_nascimento'];
        $email = $_POST['email'];
        $ramal = $_POST['ramal'];
        $cargoID = $_POST['cargo_id'];
        $setorID = $_POST['setor_id'];
        $salario = $_POST['salario'];
        $sexo = $_POST['sexo'];
        $altura = $_POST['altura'];
        $cpf = $_POST['cpf'];
        $rg = $_POST['rg'];

        $sql = "INSERT INTO funcionarios 
            (Nome, DataNascimento, Email, Ramal, CargoID, SetorID, Salario, Sexo, Altura, CPF, RG)
            VALUES 
            ('$nome', '$dataNascimento', '$email', '$ramal', '$cargoID', '$setorID', '$salario', '$sexo', '$altura', '$cpf', '$rg')";

        if (mysqli_query($conn, $sql)) {
            header("Location: ../lista-funcionarios.php?msg=sucesso_inserir");
        } else {
            header("Location: ../lista-funcionarios.php?msg=erro_inserir");
        }
        break;

    case 'editar':
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $dataNascimento = $_POST['data_nascimento'];
        $email = $_POST['email'];
        $ramal = $_POST['ramal'];
        $cargoID = $_POST['cargo_id'];
        $setorID = $_POST['setor_id'];
        $salario = $_POST['salario'];
        $sexo = $_POST['sexo'];
        $altura = $_POST['altura'];
        $cpf = $_POST['cpf'];
        $rg = $_POST['rg'];

        $sql = "UPDATE funcionarios SET 
            Nome='$nome', 
            DataNascimento='$dataNascimento', 
            Email='$email', 
            Ramal='$ramal', 
            CargoID='$cargoID', 
            SetorID='$setorID', 
            Salario='$salario', 
            Sexo='$sexo', 
            Altura='$altura', 
            CPF='$cpf', 
            RG='$rg'
            WHERE FuncionarioID='$id'";

        if (mysqli_query($conn, $sql)) {
            header("Location: ../lista-funcionarios.php?msg=sucesso_editar");
        } else {
            header("Location: ../lista-funcionarios.php?msg=erro_editar");
        }
        break;

    case 'excluir':
        $id = $_GET['id'];

        $sql = "DELETE FROM funcionarios WHERE FuncionarioID = '$id'";

        if (mysqli_query($conn, $sql)) {
            header("Location: ../lista-funcionarios.php?msg=sucesso_excluir");
        } else {
            header("Location: ../lista-funcionarios.php?msg=erro_excluir");
        }
        break;

    default:
        header("Location: ../lista-funcionarios.php?msg=acao_invalida");
        break;
}
?>
