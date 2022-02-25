<?php

include('conexao.php');

try{
    $sql = "SELECT * from tblclientes";
    $qry = $con->query($sql);
    $clientes = $qry->fetchAll(PDO::FETCH_OBJ);

} catch(PDOException $e){

    echo $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <title>Vendas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


</head>

<body>

<div class="container">

    
<h1>Lista de Clientes</h1>

<hr>

<a href="frmcliente.php" class="btn btn-outline-primary">Novo Cadastro</a>


<hr>


    <thead>
        <!-- Inicio da tabela -->

    <table class="table table-striped">


        <tr>

           <th>id</th> 
           <th>Cliente</th>
           <th>E-mail</th>
           <th>Telefone</th>
           <th colspan=2>Ações</th>

        </tr>

    </thead>

    <tbody>

        <?php foreach($clientes as $cliente) { ?>

        <tr>

            <td><?php echo $cliente->idcliente ?></td>
            <td><?php echo $cliente->nome ?></td>
            <td><?php echo $cliente->email ?></td>
            <td><?php echo $cliente->contato ?></td>
            <td><a href="frmcliente.php?idcliente=<?php echo $cliente->idcliente ?>" class="btn btn-warning">Editar</a></td>
            <td><a href="frmcliente.php?op=del&idcliente=<?php echo  $cliente->idcliente ?>" class="btn btn-danger">Excluir</a></td>

        </tr>

        <?php } ?>

    </tbody>

</table>
<hr>
<a href="index.php" class="btn btn-secondary">Menu Principal</a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</div>

</body>
</html>
