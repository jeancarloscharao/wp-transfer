<?php

if(isset($_POST['txtDbHost'])){
    $varDbHost = $_POST['txtDbHost'];
}

if(isset($_POST['txtDbName'])){
    $varDbName = $_POST['txtDbName'];
}

if(isset($_POST['txtDbUserName'])){
    $varDbUserName = $_POST['txtDbUserName'];
}

if(isset($_POST['txtDbPassword'])){
    $varDbPassword = $_POST['txtDbPassword'];
}

if(isset($_POST['txtInstrucaoSql'])){
    $sql = $_POST['txtInstrucaoSql'];
}


//echo $varDbHost;
//echo "<br>";
//echo $varDbName;
//echo "<br>";
//echo $varDbUserName;
//echo "<br>";
//echo $varDbPassword;
//echo "<br>";
//echo $sql;
//echo "<br>";echo "<br>";




$conn = new PDO('mysql:host='.$varDbHost.';dbname='.$varDbName, $varDbUserName, $varDbPassword);

if($conn){
 
    $stmt = $conn->prepare($sql);

    $stmt->execute();

    $conn = null;
    
    echo "Alteração foi realizada com sucesso!";
    
} else {
    echo "Ocorreu um erro ao tentar conectar no banco de dados.";
    $conn = null;
}


?>