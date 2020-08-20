<?php
    include "../../security/authentication/validation.php";
    
    $codigo = $_POST['codigo'];
    $modelo = $_POST['modelo'];
    $valor = $_POST['valor'];
    $descricao = ($_POST['descricao'] != '') ? $_POST['descricao'] : NULL;
    $categoria_id = $_POST['categoria_id'];

    $msg = '';

    if ($categoria_id == '') {
        $msg = 'Escolha uma categoria.';
    } else if ($modelo == '') {
        $msg = 'Preencha o campo modelo.';
    } else if ($valor == '') {
        $msg = 'Preencha o campo valor.';
    } else {
        include "../../security/database/connection.php";
        //se ja tem mesmo modelo na mesma categoria com codigo diferente (o mesmo codigo é o proprio produto em alteracao)
        $sql = "SELECT * FROM produtos WHERE modelo = :modelo AND categorias_id = :categoria_id AND codigo <> :codigo";

        $stm_sql = $db_connection -> prepare($sql);
        $stm_sql -> bindParam(':modelo', $modelo);
        $stm_sql -> bindParam(':categoria_id', $categoria_id);
        $stm_sql -> bindParam(':codigo', $codigo);
        $stm_sql -> execute();

        if ($stm_sql -> rowCount() == 0) {
            $sql = "UPDATE produtos SET modelo = :modelo, valor = :valor, descricao = :descricao, categorias_id = :categoria_id WHERE codigo = :codigo";
            
            $stm_sql = $db_connection -> prepare($sql);
            $stm_sql -> bindParam(':modelo', $modelo);
            $stm_sql -> bindParam(':valor', $valor);
            $stm_sql -> bindParam(':descricao', $descricao);
            $stm_sql -> bindParam(':categoria_id', $categoria_id);
            $stm_sql -> bindParam(':codigo', $codigo);
            
            $result = $stm_sql -> execute();

            $msg = ($result) ? "Alteração efetuada com sucesso!" : "Falha ao alterar!";
        } else {
            $msg = "Este modelo já está cadastrado no banco de dados.";
        }
    }
?>

<h1>Aviso!</h1>
<p>
    <?php echo $msg; ?>
</p>
<a href="frmins.php">Voltar</a>