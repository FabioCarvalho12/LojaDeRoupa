
<link rel="stylesheet" href="css/cadastro.css">

<?php
    // Conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "loja_de_roupas";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Verifica se há dados enviados pelo formulário
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recebe os dados do formulário
        $tipo = $_POST["tipo"];
        $modelo = $_POST["modelo"];
        $tamanho = $_POST["tamanho"];
        $quantidade = $_POST["quantidade"];
        $preco = $_POST["preco"];

         // Verifica se há algum produto com o mesmo tipo, modelo e tamanho
        $sql = "SELECT * FROM produtos WHERE tipo = '$tipo' AND modelo = '$modelo' AND tamanho = '$tamanho'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Se houver, atualiza a quantidade e o preço
            $sql = "UPDATE produtos SET quantidade = quantidade + $quantidade, preco = $preco WHERE tipo = '$tipo' AND modelo = '$modelo' AND tamanho = '$tamanho'";
            if ($conn->query($sql) === TRUE) {
                echo "<h1>Produto atualizado com sucesso.</h1>";
                echo "<a href='index.php'>Voltar</a>";
            } else {
                echo "<p>Erro ao atualizar o produto: " . $conn->error . "</p>";
            }
        } else {
            // Se não houver, insere um novo produto
            $sql = "INSERT INTO produtos (tipo, modelo, tamanho, quantidade, preco) VALUES ('$tipo', '$modelo', '$tamanho', $quantidade, $preco)";
            if ($conn->query($sql) === TRUE) {
                echo "<h1>Produto cadastrado com sucesso.</h1>";
                 echo "<a href='index.php'>Voltar</a>";
            } else {
                echo "<p>Erro ao cadastrar o produto: " . $conn->error . "</p>";
            }
        }
    }

    // Exibe todos os produtos cadastrados em uma tabela
    echo "<table>";
    echo "<tr>";
    echo "<th>Tipo</th>";
    echo "<th>Modelo</th>";
    echo "<th>Tamanho</th>";
    echo "<th>Quantidade</th>";
    echo "<th>Preço</th>";
    echo "<th>Ações</th>";
    echo "</tr>";

    // Consulta todos os produtos do banco de dados
    $sql = "SELECT * FROM produtos ORDER by id asc";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Percorre cada linha do resultado
        while($row = $result->fetch_assoc()) {
            // Exibe os dados da linha em uma célula da tabela
            echo "<tr>";
            echo "<td>" . $row["tipo"] . "</td>";
            echo "<td>" . $row["modelo"] . "</td>";
            echo "<td>" . $row["tamanho"] . "</td>";
            echo "<td>" . $row["quantidade"] . "</td>";
            echo "<td>" . $row["preco"] . "</td>";
            // Exibe um link para editar ou excluir o produto
            echo "<td><a href='editar.php?id=" . $row["id"] . "'>Editar</a> | <a href='excluir.php?id=" . $row["id"] . "'>Excluir</a></td>";
            echo "</tr>";
        }
    } else {
        // Se não houver nenhum produto, exibe uma mensagem
        echo "<tr><td colspan='6'>Nenhum produto encontrado.</td></tr>";
    }

    echo "</table>";

    // Fecha a conexão com o banco de dados
    $conn->close();
    ?>