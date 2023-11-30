<?php
    $conn = mysqli_connect('localhost', 'root', 'Fajota1428!', 'unnitransportes');

    if (!$conn) {
        die("Conexão falhou: " . mysqli_connect_error());
    }

    $nome = $_POST['nome_usuario'];
    $endereco = $_POST['novo_endereco'];
    $num = $_POST['novo_num'];
    $sql = "UPDATE registro SET endereco = '$endereco' WHERE nome = '$nome'";
    $sql2 = "UPDATE registro SET endereco = '$endereco', num_telefone = '$num' WHERE nome = '$nome'";
    $sql3 = "SELECT * from registro WHERE nome = '$nome'";
    $sql4 = "UPDATE registro SET num_telefone = '$num' WHERE nome = '$nome'";
    $result3 = $conn->query($sql3);

    if ($result3->num_rows === 0) {
        header("Location: usuario_nexiste.html");
    } elseif (!$num) {
        if ($conn->query($sql) === TRUE) {
            header("Location: confirma_alteracao.html");
        } 
    } elseif ($nome && $endereco && $num) {
        if ($conn->query($sql2) === TRUE) {
            header("Location: confirma_alteracao.html");
        }
    } elseif ($nome && $num && !$endereco) {
        if ($conn->query($sql4) === TRUE) {
            header("Location: confirma_alteracao.html");
        }
    }
?>