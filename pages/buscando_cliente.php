<?php
    $conn = mysqli_connect('localhost', 'root', 'Fajota1428!', 'unnitransportes');

    if (!$conn) {
        die("Conexão falhou: " . mysqli_connect_error());
    }

    $nome = $_POST['nome_cliente'];
    $endereco = $_POST['endereco_cliente'];
    $num = $_POST['tel_cliente'];
    $empresa = $_POST['empresa_cliente'];
    $sql = "SELECT * from registro WHERE nome = '$nome';";
    $sql2 = "SELECT * from registro WHERE endereco LIKE '%$endereco%';";
    $sql3 = "SELECT * from registro WHERE num_telefone LIKE '%$num%';";
    $sql4 = "SELECT * from registro WHERE empresa LIKE '%$empresa%';";

    if (!$endereco && !$num && !$empresa){
        $result = $conn->query($sql);
        exibirResultados($result);
    } elseif (!$nome && !$num && !$empresa) {
        $result = $conn->query($sql2);
        exibirResultados($result);
    } elseif (!$nome && !$endereco && !$empresa) {
        $result = $conn->query($sql3);
        exibirResultados($result);
    } elseif (!$nome && !$endereco && !$num) {
        $result = $conn->query($sql4);
        exibirResultados($result);
    }

    function exibirResultados($result) {
        if ($result->num_rows > 0) {
            echo "<head>";
            echo "<link rel='stylesheet' href='../css/style_resultados.css'>";
            echo "</head>";
            echo "<h2>Resultados:</h2>";
            echo "<table border='1'>";
            echo "<tr><th>Nome</th><th>Endereço</th><th>Número de Telefone</th><th>Empresa</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['nome'] . "</td>";
                echo "<td>" . $row['endereco'] . "</td>";
                echo "<td>" . $row['num_telefone'] . "</td>";
                echo "<td>" . $row['empresa'] . "</td>";
                echo "</tr>";
            }

            echo "</table><br>";
            echo "<button>";
            echo "<a href='busca.html'>Buscar novamente</a>";
            echo "</button><button>";
            echo "<a href='../index.html'>Início</a>";
            echo "</button>";
        } elseif ($result->num_rows == 0) {
            echo "Nenhum resultado encontrado.";
        }
    }
?>