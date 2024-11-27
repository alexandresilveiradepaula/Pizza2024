<?php

include 'db.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
    $cliente_id = $_POST['cliente_id'];
    $sabor_pizza = $_POST['sabor_pizza'];
    $quantidade = $_POST['quantidade_pizza'];
    $observacao = $_POS['obsservacao'];

    $sql = "INSERT INTO pedidos (cliente_id,sabor_pizza,quantidade_pizza, observacao)
    values (:cliente_id,:sabor_pizza,:quantidade_pizza,:observacao)";

    $stmt=$conn->prepare($sql);
    $stmt->bindParam(':cliente_id',$cliente_id);
    $stmt->bindParam(':sabor_pizza',$sabor_pizza);
    $stmt->bindParam(':quantidade_pizza',$quantidade);
    $stmt->bindParam(':observacao',$observacao);

    $stmt->execute();

    header('location:pedidos.php');
    exit;
}

$sql = "SELECT * from clientes";
$stmt = $conn->prepare($sql);
$stmt->execute();
$clientes = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Pedido - Pizzaria</title>
    <link rel="stylesheet" href="style.css">
    <script>

        function preencheDadosClientes(){
            var clienteId = document.getElementById("cliente_id").value;
            var telefone = document.getElementById("telefone");
            var endereco = document.getElementById("endereco");

            <?php foreach($clientes as $cliente):?>
                if(clienteId == <?php echo $cliente['id'];?>){
                    telefone.value = "<?php echo $cliente['telefone_cliente'];?>";
                    endereco.value = "<?php echo $cliente['endereco_cliente'];?>";
                }

                <?php endforeach; ?>
        }
    </script>
</head>
<body>
    <nav>
        <a href="index.php">Registrar Pedido</a>
        <a href="pedidos.php">Visualizar Pedidos</a>
        <a href="cadastro.php">Cadastrar Cliente</a>
    </nav>

    <h1>Registrar Pedido</h1>
    <form action="index.php" method="post">
        <label for="cliente_id">Selecione o cliente:</label>
        <select id="cliente-id" name="cliente_id" onchange="preencherDadosCliente()" required>
            <option_value="">Escolha o Cliente</option>
            <?php foreach($clientes as $cliente):?>
            <option_value="<?php echo $cliente['id']; ?>".<?php echo $cliente['nome_cliente'];?></option>
            <?php endforeach;?>
    </select><br>

    <label for="telefone">Telefone</label>
    <input type="text" id="telefone" name="telefone" disabled><br>

    <label for="endereco">Endereco</label>
    <input type="text" id="endereco" name="endereco" disabled><br>

    <label for="sabor_pizza">Sabor da Pizza:</label>
    <input type="text" id="sabor_pizza" name="sabor_piza" required><br>

    <label for="quantidade_pizza">Quantidade:</label><br>
    <input type="number" name="quantidade_pizza" id="quantidade_pizza" required><br>

    <label for="observacao">Observação </label><br>
    <input type="text" id="observacao" name="observacao">

    <button type="submit">Registrar Pedido</button>
    </form>

    
    
</body>
</html>