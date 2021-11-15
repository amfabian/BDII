<!-- HTML5 -->
<meta charset="utf-8" />
<div id="centro">

    <p align="center" style="font-family:'Times New Roman', Times, serif; font-size:20px; padding-bottom:20px;">
        Cadastro
    </p>

    <?php
    //session_start();

    $flag = true;

    //include "conexao.inc.php";


    if (isset($_REQUEST["enviar"])) {

        $p_nome_produto = $_REQUEST["nome_produto"];

        //session_destroy("cadastro");

        if (empty($p_nome_produto)) {
            echo "<font face='times new roman' size=3 color=#FF0000><center>Preencha o campo!</center></font><br>";
            $flag = false;
        } else {
            $flag = true;

            $conn = oci_pconnect("usr85", "usr85", "//200.132.53.144:1521/XEPDB1");
            if (!$conn) {
                echo "teste";
                // $e = oci_error();
                // trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            }


            $stmt = ociparse($conn, 'SELECT * FROM produto WHERE nome = :p_nome_produto');


            OCIBindByName($stmt, ":p_nome_produto", $p_nome_produto);

            ociexecute($stmt);
            echo "<table border='1'>\n";
            while ($row = oci_fetch_array($stmt, OCI_ASSOC + OCI_RETURN_NULLS)) {
                echo "<tr>\n";
                foreach ($row as $item) {
                    echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
                }
                echo "</tr>\n";
            }
            echo "</table>\n";
            OCIFreeStatement($stmt);
            OCILogoff($conn);
        }
    }


    ?>

    <form action="<?php $PHP_SELF ?>" method="post">

        <div align="center">
            <table align="center" width="50%" border="0" cellpadding="2">
                <tr>
                    <td align="right" style="padding-right:5px;">Nome Produto:</td>
                    <td><input type="text" name="nome_produto" size="30"></td>
                </tr>


                <tr>
                    <td></td>
                    <td><input type="submit" name="enviar" value="Cadastrar">
                        <input type="submit" name="limpar" value="Limpar"></td>
                </tr>
            </table>
        </div>
    </form>

</div>