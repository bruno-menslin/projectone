<?php //colocar sempre na primeira linha, pro usuário não ter acesso a nada da página, nenhum dado
    session_start();
    if (!isset($_SESSION['idsessao']) || ($_SESSION['idsessao']) != session_id()) { //se a variável não está definida, se o usuário não está autenticado
        header("Location: /projects/jean-projectone/index.php"); //vai ser usado em outros lugares
        exit; // pra não mostrar nada da página, por precaução
    }
?>