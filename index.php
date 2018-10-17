<?php

if (isset($_POST['txtUrlAtual'])) {
    $varUrlAtual = $_POST['txtUrlAtual'];
    $varUrlAtual = strtolower($varUrlAtual);
    $varUrlAtual = trim($varUrlAtual);
}

if (isset($_POST['txtUrlNova'])) {
    $varUrlNova = $_POST['txtUrlNova'];
    $varUrlNova = strtolower($varUrlNova);
    $varUrlNova = trim($varUrlNova);
}


if (isset($varUrlAtual) && isset($varUrlNova)) {
    $varSql1 = "UPDATE wp_options SET option_value = replace(option_value, '" . $varUrlAtual . "', '" . $varUrlNova . "') WHERE option_name = 'home' OR option_name = 'siteurl'";

    $varSql2 = "UPDATE wp_posts SET guid = REPLACE (guid, '" . $varUrlAtual . "', '" . $varUrlNova . "')";
    
    $varSql3 = "UPDATE wp_posts SET post_content = REPLACE (post_content, '" . $varUrlAtual . "', '" . $varUrlNova . "')";

    $varSql4 = "";
    
    $varSql5 = "UPDATE wp_postmeta SET meta_value = REPLACE (meta_value, '" . $varUrlAtual . "','" . $varUrlNova . "')";

}



?>
<html lang="Pt-br">

    <head>
        <title>Wp Transfer</title>
        <style>
        input[type="text"]{
           width: 250px;
        }
        
        input[type="textarea"]{
           width: 500px;
        }
        </style>
    </head>
    <body>
        <h1>Wp Transfer</h1>
        <hr>
        <form method="post" action="index.php">
            <input type="text" name="txtUrlAtual" id="txtUrlAtual" placeholder="URL Atual" required="required">
            <input type="text" name="txtUrlNova" id="txtUrlNova" placeholder="URL Nova" required="required">
            <input type="submit" value="Enviar">
        </form>

        <br>
        <?php if (isset($varSql1)) { ?>
            <strong>Alterar siteurl e homeurl</strong><br>
            <textarea style="width: 90%"><?php echo $varSql1 ?></textarea>
        <?php } ?>
            
        <?php if (isset($varSql2)) { ?> <br><br>
            <strong>Alterar GUID</strong><br>
            <textarea style="width: 90%"><?php echo $varSql2 ?></textarea>
        <?php } ?>
            
        <?php if (isset($varSql3)) { ?> <br><br>
            <strong>Alterar URL no conteúdo</strong><br>
            <textarea style="width: 90%"><?php echo $varSql3 ?></textarea>
        <?php } ?>
            
        <?php if (isset($varUrlAtual) && isset($varUrlNova)){  ?> <br><br>
            <strong>Alterar apenas o caminho das imagens</strong><br>
            <textarea style="width: 90%">UPDATE wp_posts SET post_content = REPLACE (post_content, 'src="<?php echo $varUrlAtual ?>', 'src="<?php echo $varUrlNova ?>')</textarea>
        <?php } ?>  
            
        <?php if (isset($varSql5)) { ?> <br><br>
            <strong>Atualizar Post Meta</strong><br>
            <textarea style="width: 90%"><?php echo $varSql5 ?></textarea>
        <?php } ?>    
           
            
            
            
            
        <?php if(isset($varSql1) && isset($varSql2) && isset($varSql3) && isset($varSql5) ){   ?>   
            
            <form id="frmWp" name="frmWp" method="post" action="conexao-pdo.php">
                <br><br><br>
                <textarea style="width: 90%; height: 100px" id="txtInstrucaoSql" name="txtInstrucaoSql"><?php echo $varSql1; ?>; <?php echo $varSql2; ?>; <?php echo $varSql3; ?>; UPDATE wp_posts SET post_content = REPLACE (post_content, 'src="<?php echo $varUrlAtual ?>', 'src="<?php echo $varUrlNova ?>'); <?php echo $varSql5; ?></textarea>

                <br><br>
                <strong>Insira os Dados de Conexão no Banco de Dados:</strong><br>

                <input type="text" id="txtDbHost" name="txtDbHost" placeholder="Host do Banco de Dados" style="width: 15%">
                <input type="text" id="txtDbName" name="txtDbName" placeholder="Nome Banco de Dados" style="width: 15%">
                <input type="text" id="txtDbUserName" name="txtDbUserName" placeholder="Usuário do Banco de Dados" style="width: 15%">  
                <input type="password" id="txtDbPassword" name="txtDbPassword" placeholder="Senha do Banco de Dados" style="width: 15%">
                <input type="submit" value="Fazer Alterações" style="cursor: pointer">
          </form>
            
            
            
                
          <?php }    ?> 
    </body>
</html>