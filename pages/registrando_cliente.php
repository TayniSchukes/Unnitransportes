<?php
    $conn = mysqli_connect('localhost', 'root', 'Fajota1428!', 'unnitransportes');

    if (!$conn) {
        die("Conexão falhou: " . mysqli_connect_error());
    }

    $sql = 'INSERT INTO registro(nome, empresa, num_telefone, endereco) values("' . $_POST["nome_usuario"] . '","' . $_POST["empresa_usuario"] . '","' . $_POST["num_telefone_usuario"] . '","' . $_POST["endereco_usuario"] . '")';
    $sql2 = "SELECT * from registro WHERE nome = '$nome'";
    $sql3 = 'INSERT INTO registro(nome, endereco) values("' . $_POST["nome_usuario"] . '","' . $_POST["endereco_usuario"] . '")';
    $result2 = $conn->query($sql2);
    $nome = $_POST["nome_usuario"];
    $endereco = $_POST["endereco_usuario"];
    $num = $_POST["num_telefone_usuario"];
    $empresa = $_POST["empresa_usuario"];

    if (!$num  && !$empresa) {
        if ($conn->query($sql3)) {
            header("Location: usuario_cadastrado.html");
            exit;
        } elseif ($result2->num_rows > 0) {
            header("Location: usuario_existe.html");
            exit;
        }
    } elseif ($nome && $endereco && $num && $empresa) {
        if ($conn->query($sql) === TRUE) {
            header("Location: usuario_cadastrado.html");
            exit;
        } elseif ($result2->num_rows > 0) {
            header("Location: usuario_existe.html");
            exit;
        } else {
            echo "Erro ao cadastrar cliente e endereço: " . $conn->error . "Favor, contatar o TI (Tayni :))";
        }
    } else {
        header("Location: campos.html");
        exit;
    }
?>