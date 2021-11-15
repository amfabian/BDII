<div id="centro">

<p align="center" style="font-family:'Times New Roman', Times, serif; font-size:20px; padding-bottom:20px;">
	Cadastro
</p>

<?php
//session_start();

$flag = true;

//include "conexao.inc.php";

//VAR_DUMP ($_REQUEST);

if(isset($_REQUEST["enviar"])) {

	$p_nome_cliente = $_REQUEST["nome_cliente"];
	$p_email = $_REQUEST["email"];
	$p_telefone = $_REQUEST["telefone"];
		
//session_destroy("cadastro");

	if(empty($p_nome_cliente) || empty($p_email) || empty($p_telefone)) {
		echo "<font face='times new roman' size=3 color=#FF0000><center>Preencha todos os campos!</center></font><br>";
		$flag = false;
	}
	else {
		$flag = true;

$conn = oci_pconnect("usr85", "usr85", "//200.132.53.144:1521/XEPDB1");
if (!$conn) {
    echo "teste";
   // $e = oci_error();
   // trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
		
		$sql = "BEGIN novo_cliente(:p_nome_cliente, :p_email, :p_telefone); END;";

		$stmt = OCIParse($conn,$sql);
			
		OCIBindByName($stmt, ":p_nome_cliente",$p_nome_cliente);
		OCIBindByName($stmt, ":p_email", $p_email);
		OCIBindByName($stmt, ":p_telefone", $p_telefone);
				
		if(ociexecute($stmt, OCI_COMMIT_ON_SUCCESS)){
			echo "<font face='times new roman' size=3 color=#FF0000><center>Cadastrado com Sucesso!</center></font><br>";
		}	
		else{
			die ("Erro no SQL");
		}
		OCIFreeStatement($stmt); 
		OCILogoff($conn); 
	}
}


?>

<form action="<?php $PHP_SELF ?>" method="post">

<div align="center"> 
	<table align="center" width="50%" border="0" cellpadding="2">
		<tr>
        	<td align="right" style="padding-right:5px;">Nome Cliente</td>
            <td><input type="text" name="nome_cliente" size="30"></td>
        </tr>
		
        <tr>
        	<td align="right" style="padding-right:5px;">E-mail:</td>
            <td><input type="text" name="email" size="12"></td>
        </tr>
        <tr>
        	<td align="right" style="padding-right:5px;">Telefone:</td>
            <td><input type="text" name="telefone" size="12"></td>
        </tr>
        <tr>
        	<td></td>
            <td><input type="submit" name="enviar" value="Cadastrar">
            	<input type="submit" name="limpar" value="Limpar"></td>
	</table>    
</div>
</form>

</div>