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
       
        $p_id_emprestimo = $_REQUEST["id_emprestimo"];
        $p_data = $_REQUEST["data"];

        //session_destroy("cadastro");

        if (empty($p_id_emprestimo) || empty($p_data)) {
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

            $sql = "BEGIN :r := RETORNO_MANGA(:p_id_emprestimo, :p_data); END;";

            $stmt = OCIParse($conn, $sql);

            OCIBindByName($stmt, ":p_id_emprestimo", $p_id_emprestimo);
            OCIBindByName($stmt, ":p_data", $p_data);
            OCIBindByName($stmt, ':r', $r, 40);
           
            if (ociexecute($stmt, OCI_COMMIT_ON_SUCCESS)) {
                echo "<font face='times new roman' size=3 color=#FF0000><center>Empréstimo cadastrado com Sucesso!</center></font><br>";
            } else {
                die("Erro no SQL");
            }
            print "$r\n";
            OCIFreeStatement($stmt);
            OCILogoff($conn);
        }
    }


    ?>

    <form action="<?php $PHP_SELF ?>" method="post">

        <div align="center">
            <table align="center" width="50%" border="0" cellpadding="2">
                <tr>
                    <td align="right" style="padding-right:5px;">ID Emprestimo</td>
                    <td><input type="text" name="id_emprestimo" size="30"></td>
                </tr>

                <tr>
                    <td align="right" style="padding-right:5px;">Data:</td>
                    <td><input type="text" name="data" size="12"></td>
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