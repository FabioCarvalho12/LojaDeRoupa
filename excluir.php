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

// Verifica se há um id enviado pela URL
if (isset($_GET["id"])) {
    // Recebe o id do produto a ser excluído
    $id = $_GET["id"];

    // Exclui o produto do banco de dados
    $sql = "DELETE FROM produtos WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "<h1>Produto excluído com sucesso.</h1>";
        echo "<a href='index.php'>Voltar</a>";
    } else {
        echo "<p>Erro ao excluir o produto: " . $conn->error . "</p>";
    }
} else {
    // Se não houver nenhum id enviado pela URL, exibe uma mensagem
    echo "<p>Nenhum id informado.</p>";
}

$sql = "SELECT * FROM produtos ORDER by id asc";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row


  echo "<table>";
  echo "<tr>";
  echo "<th>Tipo</th>";
  echo "<th>Modelo</th>";
  echo "<th>Tamanho</th>";
  echo "<th>Quantidade</th>";
  echo "<th>Preço</th>";
  echo "<th>Ações</th>";
  echo "</tr>";

  while($row = mysqli_fetch_assoc($result)) {
  
    echo "<tr>";
    echo "<td>" . $row["tipo"] . "</td>";
    echo "<td>" . $row["modelo"] . "</td>";
    echo "<td>" . $row["tamanho"] . "</td>";
    echo "<td>" . $row["quantidade"] . "</td>";
    echo "<td>" . $row["preco"] . "</td>";
    echo "<td><a href='editar.php?id=" . $row["id"] . "'>Editar</a> | <a href='excluir.php?id=" . $row["id"] . "'>Excluir</a></td>";
    // Exibe um link para editar ou excluir o produto
    echo "</tr>";



  }

  echo "</table>";


} else {
  echo "0 results";
}




// Fecha a conexão com o banco de dados
$conn->close();
?>