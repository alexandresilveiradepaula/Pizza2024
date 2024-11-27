<?php

include 'db.php';

if($_SERVER['REQUEST_METHOD']=="POST"){
    $sabor_pizza = $_POST['sabor_pizza'];

    $sql="INSERT INTO pizzas (sabor_pizza) VALUES(:sabor_pizza)";

    $stmt =  $conn->prepare($sql);

    $stmt->bindParam(':sabor_pizza',$sabor_pizza);
    $stmt->execute();

    header('location: cadastro_pizza.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Pizza - Pizzaria</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <a href="index.php">Registrar Pedido</a>
        <a href="pedidos.php">Visualizar Pedidos</a>
        <a href="cadastro.php">Cadastrar Clientes</a>
        <a href="cadastro_pizza.php">Cadastrar Pizzas</a>
    </nav>

    <h1>Cadastrar Pizza</h1>
    <form action="cadastro_pizza.php" method="POST">
        <label for="sabor_pizza">Sabor da Pizza</label>
        <input type="text" id="sabor_pizza" name="sabor_pizza" required><br>

        <button type="submit">Cadastrar Pizza</button>
    </form>
    
</body>
</html>


