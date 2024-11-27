<?php

include 'db.php';

if(isset($_GET['excluir'])){
    $id = $_GET['excluir'];
    $sql = "DELETE FROM pedidos WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id',$id);
    $stmt->execute();
    header('location: pedidos.php');
    exit;
}

if(isset($_GET['atualizar_status'])){
    $id = $_GET['atualizar_status'];
    $sql = "UPDATE pedidos SET status = CASE
        WHEN status = 'A fazer' THEN 'Em preparaçao'
        WHEN status = 'Em preparacao' THEN 'Pronto'
        WHEN status = 'Pronto' THEN 'A fazer'
        END WHERE id =:id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id',$id);
        $stmt->execute();

        header('location: pedidos.php');
}
$sql="SELECT pedidos.*,clientes.nome_cliente,clientes.telefone_cliente,clietes.endereco_cliente
FROM pedidos
JOIN clientes ON pedidos.cliente_id - cliente.id";


$stmt = $conn->prepare($sql);
$stmt->execute();
$pedidos = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos - Pizzaria</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <a href="index.php">Registrar Pedidos</a>
        <a href="pedidos.php">Visualizar Pedidos</a>
        <a href="cadastro.php">Cadastrar Clientes</a>
    </nav>

    <h1>Pedidos</h1>
    <div class="colunas">

        <div class="coluna">
            <h2>Pedidos a Fazer</h2>
                <?php foreach($pedidos as $pedido):?>
                    <?php if($pedido['status'] == 'A fazer'):?>
                        <div class="pedido">
                            <p><strong>Cliente:</strong><?php echo $pedido['nome_cliente'];?></p>
                            <p><strong>Telefone:</strong><?php echo $pedido['telefone_cliente'];?></p>
                            <p><strong>Endereço:</strong><?php echo $pedido['endereco_cliente'];?></p>
                            <p><strong>Sabor:</strong><?php echo $pedido['sabor_pizza'];?></p>
                            <p><strong>Quantidade</strong><?php echo $pedido['quantidade_pizza'];?></p>
                            <p><strong>Obserevação:</strong><?php echo $pedido['observacao'];?></p>
                            <p><strong>Status:</strong><?php echo $pedido['status'];?></p>
                            <a href="?atualizar_status=<?php echo $pedido['id'];?>">Alterar Status</a>
                            <a href="?excluir<?php echo $pedido['id'];?>">Excluir Pedido</a>
                        </div>
                            <?php endif;?>
                        <?php endforeach;?>
        </div>

        <div class="coluna">
            <h2>Pedidos em Preparação</h2>
                <?php foreach($pedidos as $pedido):?>
                    <?php if($pedido['status'] == 'Em preparacao'):?>
                        <div class="pedido">
                            <p><strong>Cliente:</strong><?php echo $pedido['nome_cliente'];?></p>
                            <p><strong>Telefone:</strong><?php echo $pedido['telefone_cliente'];?></p>
                            <p><strong>Endereço:</strong><?php echo $pedido['endereco_cliente'];?></p>
                            <p><strong>Sabor:</strong><?php echo $pedido['sabor_pizza'];?></p>
                            <p><strong>Quantidade</strong><?php echo $pedido['quantidade_pizza'];?></p>
                            <p><strong>Obserevação:</strong><?php echo $pedido['observacao'];?></p>
                            <p><strong>Status:</strong><?php echo $pedido['status'];?></p>
                            <a href="?atualizar_status=<?php echo $pedido['id'];?>">Alterar Status</a>
                            <a href="?excluir<?php echo $pedido['id'];?>">Excluir Pedido</a>
                                </div>
                            <?php endif;?>
                        <?php endforeach;?>
                    </div>

         <div class="coluna">
            <h2>Pedidos Prontos</h2>
                <?php foreach($pedidos as $pedido):?>
                    <?php if($pedido['status'] == 'Pronto'):?>
                        <div class="pedido">
                            <p><strong>Cliente:</strong><?php echo $pedido['nome_cliente'];?></p>
                            <p><strong>Telefone:</strong><?php echo $pedido['telefone_cliente'];?></p>
                            <p><strong>Endereço:</strong><?php echo $pedido['endereco_cliente'];?></p>
                            <p><strong>Sabor:</strong><?php echo $pedido['sabor_pizza'];?></p>
                            <p><strong>Quantidade</strong><?php echo $pedido['quantidade_pizza'];?></p>
                            <p><strong>Obserevação:</strong><?php echo $pedido['observacao'];?></p>
                            <p><strong>Status:</strong><?php echo $pedido['status'];?></p>
                            <a href="?atualizar_status=<?php echo $pedido['id'];?>">Alterar Status</a>
                            <a href="?excluir<?php echo $pedido['id'];?>">Excluir Pedido</a>
                                </div>
                            <?php endif;?>
                        <?php endforeach;?>


                    </div>
    </div>
</body>
