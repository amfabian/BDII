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



        //session_destroy("cadastro");

        $flag = true;

        $conn = oci_pconnect("usr85", "usr85", "//200.132.53.144:1521/XEPDB1");
        if (!$conn) {
            echo "teste";
            // $e = oci_error();
            // trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
        }

        $stmt = ociparse($conn, 'SELECT * FROM produto WHERE quantidade_disponivel = 0');
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


    ?>

    <form action="<?php $PHP_SELF ?>" method="post">

        <div align="center">
            <table align="center" width="50%" border="0" cellpadding="2">

                <td><input type="submit" name="enviar" value="Consultar">
                </td>
            </table>
        </div>
    </form>

</div>