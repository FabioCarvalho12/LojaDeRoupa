<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <title>Luluzinha Model</title>
</head>
<body>
    <div id="conteiner">
    
        <img src="imagens/luluzinha-removebg-preview-removebg-preview.png" alt="" height="120" center >
        
        
    </div>
    <form action="cadastro.php" method="post">
        <p>Cadastro de Produtos</p>
        <label for="tipo">Tipo:</label>
        <input type="text" id="tipo" name="tipo" required><br>
        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo" name="modelo" required><br>
        <label for="tamanho">Tamanho:</label>
        <input type="text" id="tamanho" name="tamanho" required><br>
        <label for="quantidade">Quantidade:</label>
        <input type="number" id="quantidade" name="quantidade" min="0" required><br>
        <label for="preco">Preço:</label>
        <input type="number" id="preco" name="preco" min="0" step="0.01" required><br>
        <input type="submit" value="Cadastrar">
    </form>
  <br>
    <form action="visualizar.php" method="post">
    <input type="submit" value="visualizar tabela">
    </form>


</body>
</html>