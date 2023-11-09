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

    
        $sql = "SELECT * FROM produtos ORDER by id asc";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
          // output data of each row

          echo "<a href='index.php'>Voltar</a>";
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
            // Exibe um link para editar ou excluir o produto
            echo "<td><a href='editar.php?id=" . $row["id"] . "'>Editar</a> | <a href='excluir.php?id=" . $row["id"] . "'>Excluir</a></td>";
            echo "</tr>";
        
        
        
          }

          echo "</table>";
          


        } else {
          echo "0 results";
        }
    
    
 
    
    
    
    
    

// Fecha a conexão com o banco de dados
$conn->close();
?>