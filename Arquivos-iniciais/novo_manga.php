<!-- HTML 4 -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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

    //VAR_DUMP ($_REQUEST);

    if (isset($_REQUEST["enviar"])) {

        $p_genero = $_REQUEST["genero"];
        $p_nome_manga = $_REQUEST["nome_manga"];
        $p_volume = $_REQUEST["volume"];
        $p_quantidade = $_REQUEST["quantidade"];

        //session_destroy("cadastro");

        if (empty($p_genero) || empty($p_nome_manga) || empty($p_volume) || empty($p_quantidade)) {
            echo "<font face='times new roman' size=3 color=#FF0000><center>Preencha todos os campos!</center></font><br>";
            $flag = false;
        } else {
            $flag = true;

            $conn = oci_pconnect("usr85", "usr85", "//200.132.53.144:1521/XEPDB1");
            if (!$conn) {
                echo "teste";
                // $e = oci_error();
                // trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            }

            $sql = "BEGIN novo_manga(:p_genero, :p_nome_manga, :p_volume, :p_quantidade); END;";

            $stmt = OCIParse($conn, $sql);

            OCIBindByName($stmt, ":p_genero", $p_genero);
            OCIBindByName($stmt, ":p_nome_manga", $p_nome_manga);
            OCIBindByName($stmt, ":p_volume", $p_volume);
            OCIBindByName($stmt, ":p_quantidade", $p_quantidade);

            if (ociexecute($stmt, OCI_COMMIT_ON_SUCCESS)) {
                echo "<font face='times new roman' size=3 color=#FF0000><center>Cadastrado com Sucesso!</center></font><br>";
            } else {
                die("Erro no SQL");
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
                    <td align="right" style="padding-right:5px;">Gênero:</td>
                    <td><input type="text" name="genero" size="30"></td>
                </tr>
                <tr>
                    <td align="right" style="padding-right:5px;">Nome Mangá:</td>
                    <td><input type="text" name="nome_manga" size="30"></td>
                </tr>
                <tr>
                    <td align="right" style="padding-right:5px;">Volume:</td>
                    <td><input type="text" name="volume" size="12"></td>
                </tr>
                <tr>
                    <td align="right" style="padding-right:5px;">Quantidade:</td>
                    <td><input type="text" name="quantidade" size="12"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="enviar" value="Cadastrar">
                        <input type="submit" name="limpar" value="Limpar"></td>
            </table>
        </div>
    </form>

</div>