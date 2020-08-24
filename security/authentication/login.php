<?php
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $msg = '';
    $link = "../../index.php?mensagem="; // colocar a $msg aqui pra nao ir uma msg vazia pro main.php

    if ($usuario == '') {
        $msg = "Preencha o campo usuário.";
    } else if ($senha == '') {
        $msg = "Preencha o campo senha.";
    } else {

        $senha = md5($senha);

        include "../database/connection.php";

        $sql = "SELECT usuario, senha FROM usuarios WHERE usuario = :usuario AND senha = :senha";
        
        $stm_sql = $db_connection -> prepare($sql);
        $stm_sql -> bindParam(':usuario', $usuario);
        $stm_sql -> bindParam(':senha', $senha);
        $stm_sql -> execute();

        if ($stm_sql -> rowCount() == 1) {
            session_start();

            $_SESSION['usuario'] = $usuario;
            $_SESSION['senha'] = $senha;
            $_SESSION['idsessao'] = session_id();

            $link = "../../app/main.php";
        } else {
            $msg = "Usuário ou senha incorretos.";
        }
    }
    header("Location: " . $link . $msg); // nunca usar mais de um header na mesma página
?>