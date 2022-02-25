<?php 

$idordem = isset($_GET["idordem"]) ? $_GET["idordem"]: null;
$op = isset($_GET["op"]) ? $_GET["op"]: null;
 

    try {
        $servidor = "localhost";
        $usuario = "root";
        $senha = "";
        $bd = "bdsistemaos";
        $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha); 

        if($op=="del"){
            $sql = "delete  FROM  tblordem where idordem= :idordem";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idordem",$idordem);
            $stmt->execute();
            header("Location:listarordens.php");
        }


        if($idordem){
            
            $sql = "SELECT * FROM  tblordem where idordem= :idordem";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idordem",$idordem);
            $stmt->execute();
            $ordem = $stmt->fetch(PDO::FETCH_OBJ);
            
        }
        if($_POST){
            if($_POST["idordem"]){
                $sql = "UPDATE tblordem SET ordem=:ordem, preco=:preco, produto=:produto, situacao=:situacao, cliente=:cliente, tecnico=:tecnico, dtinicio=:dtinicio, dtfim=:dtfim WHERE idordem =:idordem";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":ordem", $_POST["ordem"]);
                $stmt->bindValue(":preco", $_POST["preco"]);
                $stmt->bindValue(":produto", $_POST["produto"]);
                $stmt->bindValue(":situacao", $_POST["situacao"]);
                $stmt->bindValue(":cliente", $_POST["cliente"]);
                $stmt->bindValue(":tecnico", $_POST["tecnico"]);
                $stmt->bindValue(":dtinicio", $_POST["dtinicio"]);
                $stmt->bindValue(":dtfim", $_POST["dtfim"]);
                $stmt->bindValue(":idordem", $_POST["idordem"]);
                $stmt->execute(); 
            } else {
                $sql = "INSERT INTO tblordem (ordem,preco,produto,situacao,cliente,tecnico,dtinicio,dtfim) VALUES (:ordem,:preco,:produto,:situacao,:cliente,:tecnico,:dtinicio,:dtfim)";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":ordem", $_POST["ordem"]);
                $stmt->bindValue(":preco", $_POST["preco"]);
                $stmt->bindValue(":produto", $_POST["produto"]);
                $stmt->bindValue(":situacao", $_POST["situacao"]);
                $stmt->bindValue(":cliente", $_POST["cliente"]);
                $stmt->bindValue(":tecnico", $_POST["tecnico"]);
                $stmt->bindValue(":dtinicio", $_POST["dtinicio"]);
                $stmt->bindValue(":dtfim", $_POST["dtfim"]);
                $stmt->execute(); 
            }
            header("Location:listarordens.php");
        } 
    } catch(PDOException $e){
         echo "erro".$e->getMessage;
        }


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ordens</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>

<?php

require 'conexao.php';
?>

<div class="container">

<h1>Cadastro de ordens</h1>
<hr>
<form method="POST">
Serviço:        <input type="text" name="ordem"     required     value="<?php echo isset($ordem) ? $ordem->ordem : null ?>"><br><br>
Preço R$:       <input type="text" name="preco"     required     value="<?php echo isset($ordem) ? $ordem->preco : null ?>"><br><br>
Produto:        <input type="text" name="produto"   required     value="<?php echo isset($ordem) ? $ordem->produto : null ?>"><br><br>
Situação:       <select name="situacao">
                <option>Selecione</option>
 <?php 
        $result_tblsituacao = "SELECT * FROM tblsituacao";
        $resultado_tblsituacao = mysqli_query ($con, $result_tblsituacao);
        while($row_tblsituacao = mysqli_fetch_assoc ($resultado_tblsituacao)) { ?>
            <option value="<?php echo $row_tblsituacao ['situacao']; ?>"><?php echo $row_tblsituacao ['situacao'];?>
            </option> <?php
        }
        ?>
 </select><br><br>
Cliente:        <select name="cliente">
                <option>Selecione</option>
 <?php 
        $result_tblclientes = "SELECT * FROM tblclientes";
        $resultado_tblclientes = mysqli_query ($con, $result_tblclientes);
        while($row_tblclientes = mysqli_fetch_assoc ($resultado_tblclientes)) { ?>
            <option value="<?php echo $row_tblclientes ['nome']; ?>"><?php echo $row_tblclientes ['nome'];?>
            </option> <?php
        }
        ?>
 </select><br><br>
Técnico:        <select name="tecnico">
                <option>Selecione</option>
 <?php 
        $result_tbltecnicos = "SELECT * FROM tbltecnicos";
        $resultado_tbltecnicos = mysqli_query ($con, $result_tbltecnicos);
        while($row_tbltecnicos = mysqli_fetch_assoc ($resultado_tbltecnicos)) { ?>
            <option value="<?php echo $row_tbltecnicos ['tecnico']; ?>"><?php echo $row_tbltecnicos ['tecnico'];?>
            </option> <?php
        }
        ?>
 </select><br><br>
Data de Início: <input type="date" name="dtinicio"  required     value="<?php echo isset($ordem) ? $ordem->dtinicio : null ?>"><br><br>
Data de Entrega:<input type="date" name="dtfim"                  value="<?php echo isset($ordem) ? $ordem->dtfim : null ?>"><br><br>



<input type="hidden"     name="idordem"   value="<?php echo isset($ordem) ? $ordem->idordem : null ?>">
<input type="submit" class="btn btn-primary" value="Cadastrar">
</form>
<hr>
<a href="listarordens.php" class="btn btn-success">Voltar</a> 
<a href="index.php" class="btn btn-secondary">Menu Principal</a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</div>
</body>
</html>