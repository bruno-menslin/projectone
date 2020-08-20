<?php
    $nome = $_POST['nome'];
    $descricao = ($_POST['descricao'] != '') ? $_POST['descricao'] : null;

    if ($nome == '') {
        $msg = "Preencha o campo nome.";
    } else {

        $sql = "SELECT * FROM categorias WHERE nome = :nome";

        $stm_sql = $db_connection -> prepare($sql);
        $stm_sql -> bindParam(':nome', $nome);
        $stm_sql -> execute();

        if ($stm_sql -> rowCount() == 0) {

            $sql = "INSERT INTO categorias VALUES (:id, :nome, :descricao)";

            $stm_sql = $db_connection -> prepare($sql);

            $id = null;

            $stm_sql -> bindParam(':id', $id);
            $stm_sql -> bindParam(':nome', $nome);
            $stm_sql -> bindParam(':descricao', $descricao);
            
            $result = $stm_sql -> execute();

            $msg = ($result) ? "Cadastro efetuado com sucesso!" : "Falha ao cadastrar!";
        } else {
            $msg = "Esta categoria já está cadastrada no banco de dados.";
        }
    }
?>

<h1>Aviso!</h1>
<p>
    <?php echo $msg; ?>
</p>
<a href="main.php?folder=categories/&file=frmins.php">Voltar</a>