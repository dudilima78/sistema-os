<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "bdsistemaos";

//Criar a conexão

$con = mysqli_connect($servidor, $usuario, $senha, $dbname);

if(!$con){

    die("Falha na conexao: " . mysqli_connect_error());

}else{

}

?>

