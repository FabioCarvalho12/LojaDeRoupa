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
    // Recebe o id do produto a ser editado
    $id = $_GET["id"];

    // Verifica se há dados enviados pelo formulário
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recebe os dados do formulário
        $tipo = $_POST["tipo"];
        $modelo = $_POST["modelo"];
        $tamanho = $_POST["tamanho"];
        $quantidade = $_POST["quantidade"];
        $preco = $_POST["preco"];

        // Atualiza os dados do produto no banco de dados
        $sql = "UPDATE produtos SET tipo = '$tipo', modelo = '$modelo', tamanho = '$tamanho', quantidade = $quantidade, preco = $preco WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            echo "<h1>Produto editado com sucesso.</h1>";
            echo "<a href='index.php'>Voltar</a> ";
        } else {
            echo "<p>Erro ao editar o produto: " . $conn->error . "</p>";
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
    
    
 
    
    
    
    
    } else {
        // Consulta os dados do produto no banco de dados
        $sql = "SELECT * FROM produtos WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Recebe os dados do produto em um array associativo
            $produto = $result->fetch_assoc();

            // Exibe um formulário com os dados do produto preenchidos
            echo "<form action='editar.php?id=$id' method='post'>";
            echo "<h1>Edição de Produtos</h1>";
            echo "<label for='tipo'>Tipo:</label>";
            echo "<input type='text' id='tipo' name='tipo' value='" . $produto["tipo"] . "' required><br>";
            echo "<label for='modelo'>Modelo:</label>";
            echo "<input type='text' id='modelo' name='modelo' value='" . $produto["modelo"] . "' required><br>";
            echo "<label for='tamanho'>Tamanho:</label>";
            echo "<input type='text' id='tamanho' name='tamanho' value='" . $produto["tamanho"] . "' required><br>";
            echo "<label for='quantidade'>Quantidade:</label>";
            echo "<input type='number' id='quantidade' name='quantidade' value='" . $produto["quantidade"] . "' min='0' required><br>";
            echo "<label for='preco'>Preço:</label>";
            echo "<input type='number' id='preco' name='preco' value='" . $produto["preco"] . "' min='0' step='0.01' required><br>";
            echo "<input type='submit' value='Salvar'>";
            echo '<a href="index.php" id="edita" >Voltar</a>';
            echo "</form>";
            
        } else {
            // Se não houver nenhum produto com o id informado, exibe uma mensagem
            echo "<p>Nenhum produto encontrado.</p>";
        }
    }
} else {
    // Se não houver nenhum id enviado pela URL, exibe uma mensagem
    echo "<p>Nenhum id informado.</p>";
}

// Fecha a conexão com o banco de dados
$conn->close();
?>