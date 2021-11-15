<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Empréstimo Mangás</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">
            <span class="d-block d-lg-none">Empréstimo mangás</span>

        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#home">Home</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#emprestar_manga">Emprestar Mangá</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#devolver_manga">Devolver Mangá</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#disponibilidade_manga">Disponibilidade de Mangá</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#disponibilidade_volume">Disponibilidade de Volume</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger">*************************</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#cadastro_cliente">Cadastrar Cliente</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#cadastro_manga">Cadastrar Mangá</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#manga_indisponivel">Mangá Sem Disponiblidade</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#clientes_emprestimo">Clientes com Empréstimo</a></li>

            </ul>
        </div>
    </nav>
    <!-- Page Content-->
    <div class="container-fluid p-0">
        <!-- Inicio-->
        <section class="resume-section" id="home">
            <div class="resume-section-content">
                <h1 class="mb-0">
                    Empréstimo
                    <span class="text-primary">Mangás</span>
                </h1>

                <p class="lead mb-5">Onde você pode emprestar qualquer mangá do catalogo</p>
                <div class="social-icons">
                    <a class="social-icon" href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a class="social-icon" href="#"><i class="fab fa-github"></i></a>
                    <a class="social-icon" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="social-icon" href="#"><i class="fab fa-facebook-f"></i></a>
                </div>
            </div>
        </section>
        <hr class="m-0" />

        <section class="resume-section" id="emprestar_manga">
            <div class="resume-section-content">
                <h2 class="mb-5">Emprestar</h2>
                <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                    <div class="flex-grow-1">
                        <h3 class="mb-0">Emprestar mangá para cliente</h3>
                    </div>
                </div>

                <?php
                
                $flag = true;

                if (isset($_REQUEST["enviar_empresta_manga"])) {

                    $p_id_cliente = $_REQUEST["id_cliente"];
                    $p_id_manga = $_REQUEST["id_manga"];
                    $p_data = $_REQUEST["data"];
                     if (empty($p_id_cliente) || empty($p_id_manga) || empty($p_data)) {
                        echo "<font face='times new roman' size=3 color=#FF0000><center>Preencha todos os campos!</center></font><br>";
                        $flag = false;
                    } else {
                        $flag = true;

                        $conn = oci_pconnect("usr85", "usr85", "//200.132.53.144:1521/XEPDB1");
                        if (!$conn) {
                            echo "teste"; }

                        $sql = "BEGIN :r := EMPRESTA_MANGA(:p_id_cliente, :p_id_manga, :p_data); END;";

                        $stmt = OCIParse($conn, $sql);

                        OCIBindByName($stmt, ":p_id_cliente", $p_id_cliente);
                        OCIBindByName($stmt, ":p_id_manga", $p_id_manga);
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

                <form action="<?php $PHP_SELF ?>#emprestar_manga" method="post">
                    <div align="center">
                        <table align="center" width="50%" border="0" cellpadding="2">
                            <tr>
                                <td align="right" style="padding-right:5px;">ID Cliente</td>
                                <td><input type="text" name="id_cliente" size="30"></td>
                            </tr>
                            <tr>
                                <td align="right" style="padding-right:5px;">ID Mangá:</td>
                                <td><input type="text" name="id_manga" size="12"></td>
                            </tr>
                            <tr>
                                <td align="right" style="padding-right:5px;">Data:</td>
                                <td><input type="text" name="data" size="12"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="submit" name="enviar_empresta_manga" value="Emprestar">
                                    <input type="submit" name="limpar" value="Limpar"></td>
                        </table>
                    </div>
                </form>

            </div>
        </section>

        <section class="resume-section" id="devolver_manga">
            <div class="resume-section-content">
                <h2 class="mb-5">Devolver</h2>
                <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                    <div class="flex-grow-1">
                        <h3 class="mb-0">Devolver mangá de cliente</h3>
                    </div>
                </div>

                <?php
                
                $flag = true;
                
                if (isset($_REQUEST["enviar_devolver_manga"])) {

                    $p_id_emprestimo = $_REQUEST["id_emprestimo"];
                    $p_data = $_REQUEST["data"];
                    if (empty($p_id_emprestimo) || empty($p_data)) {
                        echo "<font face='times new roman' size=3 color=#FF0000><center>Preencha todos os campos!</center></font><br>";
                        $flag = false;
                    } else {
                        $flag = true;

                        $conn = oci_pconnect("usr85", "usr85", "//200.132.53.144:1521/XEPDB1");
                        if (!$conn) {
                            echo "teste";
                        }

                        $sql = "BEGIN :r := RETORNO_MANGA(:p_id_emprestimo, :p_data); END;";

                        $stmt = OCIParse($conn, $sql);

                        OCIBindByName($stmt, ":p_id_emprestimo", $p_id_emprestimo);
                        OCIBindByName($stmt, ":p_data", $p_data);
                        OCIBindByName($stmt, ':r', $r, 40);

                        if (ociexecute($stmt, OCI_COMMIT_ON_SUCCESS)) {
                            echo "<font face='times new roman' size=3 color=#FF0000><center>Empréstimo devolvido com Sucesso!</center></font><br>";
                        } else {
                            die("Erro no SQL");
                        }
                        print "$r\n";
                        OCIFreeStatement($stmt);
                        OCILogoff($conn);
                    }
                }

                ?>

                <form action="<?php $PHP_SELF ?>#devolver_manga" method="post">
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
                                <td><input type="submit" name="enviar_devolver_manga" value="Devolver">
                                    <input type="submit" name="limpar" value="Limpar"></td>
                            </tr>
                        </table>
                    </div>
                </form>


            </div>
        </section>

        <section class="resume-section" id="disponibilidade_manga">
            <div class="resume-section-content">
                <h2 class="mb-5">Disponibilidade</h2>
                <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                    <div class="flex-grow-1">
                        <h3 class="mb-0">Verifica disponibilidade de mangá</h3>
                    </div>
                </div>

                <?php
                
                $flag = true;
                if (isset($_REQUEST["enviar_disponibilidade_manga"])) {

                    $p_id_produto = $_REQUEST["id_produto"];
                    if (empty($p_id_produto)) {
                        echo "<font face='times new roman' size=3 color=#FF0000><center>Preencha o campo!</center></font><br>";
                        $flag = false;
                    } else {
                        $flag = true;

                        $conn = oci_pconnect("usr85", "usr85", "//200.132.53.144:1521/XEPDB1");
                        if (!$conn) {
                            echo "teste";
                        }

                        $sql = "BEGIN :r := VERIFICA_MANGA(:p_id_produto); END;";

                        $stmt = OCIParse($conn, $sql);

                        OCIBindByName($stmt, ":p_id_produto", $p_id_produto);
                        OCIBindByName($stmt, ':r', $r, 40);

                        if (ociexecute($stmt, OCI_COMMIT_ON_SUCCESS)) {
                            echo "<font face='times new roman' size=3 color=#FF0000><center>Disponibildade: " . $r . " </center></font>";
                        } else {
                            die("Erro no SQL");
                        }
                        
                        OCIFreeStatement($stmt);
                        OCILogoff($conn);
                    }
                }


                ?>

                <form action="<?php $PHP_SELF ?>#disponibilidade_manga" method="post">

                    <div align="center">
                        <table align="center" width="50%" border="0" cellpadding="2">
                            <tr>
                                <td align="right" style="padding-right:5px;">ID Produto</td>
                                <td><input type="text" name="id_produto" size="30"></td>
                            </tr>


                            <tr>
                                <td></td>
                                <td><input type="submit" name="enviar_disponibilidade_manga" value="Verificar">
                                    <input type="submit" name="limpar" value="Limpar"></td>
                            </tr>
                        </table>
                    </div>
                </form>

            </div>
        </section>


        <section class="resume-section" id="disponibilidade_volume">
            <div class="resume-section-content">
                <h2 class="mb-5">Disponibilidade</h2>
                <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                    <div class="flex-grow-1">
                        <h3 class="mb-0">Verifica disponibilidade dos volumes</h3>
                    </div>
                </div>

                <?php
               
                $flag = true;
                if (isset($_REQUEST["enviar_disponibilidade_volume"])) {

                    $p_nome_produto = $_REQUEST["nome_produto"];
                    if (empty($p_nome_produto)) {
                        echo "<font face='times new roman' size=3 color=#FF0000><center>Preencha o campo!</center></font><br>";
                        $flag = false;
                    } else {
                        $flag = true;

                        $conn = oci_pconnect("usr85", "usr85", "//200.132.53.144:1521/XEPDB1");
                        if (!$conn) {
                            echo "teste";
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

                <form action="<?php $PHP_SELF ?>#disponibilidade_volume" method="post">

                    <div align="center">
                        <table align="center" width="50%" border="0" cellpadding="2">
                            <tr>
                                <td align="right" style="padding-right:5px;">Nome Produto:</td>
                                <td><input type="text" name="nome_produto" size="30"></td>
                            </tr>


                            <tr>
                                <td></td>
                                <td><input type="submit" name="enviar_disponibilidade_volume" value="Verificar">
                                    <input type="submit" name="limpar" value="Limpar"></td>
                            </tr>
                        </table>
                    </div>
                </form>




            </div>
        </section>

       <section class="resume-section" id="cadastro_cliente">
            <div class="resume-section-content">
                <h2 class="mb-5">Cadastrar</h2>
                <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                    <div class="flex-grow-1">
                        <h3 class="mb-0">Cadastrar novo cliente</h3>
                    </div>
                </div>

                <?php
                

                $flag = true;

                if (isset($_REQUEST["enviar_cadastrar_cliente"])) {

                    $p_nome_cliente = $_REQUEST["nome_cliente"];
                    $p_email = $_REQUEST["email"];
                    $p_telefone = $_REQUEST["telefone"];

                   

                    if (empty($p_nome_cliente) || empty($p_email) || empty($p_telefone)) {
                        echo "<font face='times new roman' size=3 color=#FF0000><center>Preencha todos os campos!</center></font><br>";
                        $flag = false;
                    } else {
                        $flag = true;

                        $conn = oci_pconnect("usr85", "usr85", "//200.132.53.144:1521/XEPDB1");
                        if (!$conn) {
                            echo "teste";
                            
                        }

                        $sql = "BEGIN novo_cliente(:p_nome_cliente, :p_email, :p_telefone); END;";

                        $stmt = OCIParse($conn, $sql);

                        OCIBindByName($stmt, ":p_nome_cliente", $p_nome_cliente);
                        OCIBindByName($stmt, ":p_email", $p_email);
                        OCIBindByName($stmt, ":p_telefone", $p_telefone);

                        if (ociexecute($stmt, OCI_COMMIT_ON_SUCCESS)) {
                            echo "<font face='times new roman' size=3 color=#FF0000><center>Cliente cadastrado com sucesso!</center></font><br>";
                        } else {
                            die("Erro no SQL");
                        }
                        OCIFreeStatement($stmt);
                        OCILogoff($conn);
                    }
                }


                ?>

                <form action="<?php $PHP_SELF ?>#cadastro_cliente" method="post">

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
                                <td><input type="submit" name="enviar_cadastrar_cliente" value="Cadastrar">
                                    <input type="submit" name="limpar" value="Limpar"></td>
                        </table>
                    </div>
                </form>
            </div>
        </section>
        <section class="resume-section" id="cadastro_manga">
            <div class="resume-section-content">
                <h2 class="mb-5">Cadastrar</h2>
                <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                    <div class="flex-grow-1">
                        <h3 class="mb-0">Cadastrar novo mangá</h3>

                    </div>

                </div>

                <?php
             
                $flag = true;

                if (isset($_REQUEST["enviar_cadastrar_manga"])) {

                    $p_genero = $_REQUEST["genero"];
                    $p_nome_manga = $_REQUEST["nome_manga"];
                    $p_volume = $_REQUEST["volume"];
                    $p_quantidade = $_REQUEST["quantidade"];

                    if (empty($p_genero) || empty($p_nome_manga) || empty($p_volume) || empty($p_quantidade)) {
                        echo "<font face='times new roman' size=3 color=#FF0000><center>Preencha todos os campos!</center></font><br>";
                        $flag = false;
                    } else {
                        $flag = true;

                        $conn = oci_pconnect("usr85", "usr85", "//200.132.53.144:1521/XEPDB1");
                        if (!$conn) {
                            echo "teste";}

                        $sql = "BEGIN novo_manga(:p_genero, :p_nome_manga, :p_volume, :p_quantidade); END;";

                        $stmt = OCIParse($conn, $sql);

                        OCIBindByName($stmt, ":p_genero", $p_genero);
                        OCIBindByName($stmt, ":p_nome_manga", $p_nome_manga);
                        OCIBindByName($stmt, ":p_volume", $p_volume);
                        OCIBindByName($stmt, ":p_quantidade", $p_quantidade);

                        if (ociexecute($stmt, OCI_COMMIT_ON_SUCCESS)) {
                            echo "<font face='times new roman' size=3 color=#FF0000><center>Mangá cadastrado com sucesso!</center></font><br>";
                        } else {
                            die("Erro no SQL");
                        }

                        OCIFreeStatement($stmt);
                        OCILogoff($conn);
                    }
                }

                ?>

                <form action="<?php $PHP_SELF ?>#cadastro_manga" method="post">
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
                                <td><input type="submit" name="enviar_cadastrar_manga" value="Cadastrar">
                                    <input type="submit" name="limpar" value="Limpar"></td>
                        </table>
                    </div>
                </form>
 </div>
        </section>

        <section class="resume-section" id="manga_indisponivel">
            <div class="resume-section-content">
                <h2 class="mb-5">Consultar</h2>
                <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                    <div class="flex-grow-1">
                        <h3 class="mb-0">Consultar Mangás sem disponibilidade</h3>

                    </div>

                </div>


                <?php
               
                $flag = true;


                if (isset($_REQUEST["enviar_manga_indisponivel"])) {

                    $flag = true;

                    $conn = oci_pconnect("usr85", "usr85", "//200.132.53.144:1521/XEPDB1");
                    if (!$conn) {
                        echo "teste";
                        
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

                <form action="<?php $PHP_SELF ?>#manga_indisponivel" method="post">

                    <div align="center">
                        <table align="center" width="50%" border="0" cellpadding="2">

                            <td><input type="submit" name="enviar_manga_indisponivel" value="Consultar">
                            </td>
                        </table>
                    </div>
                </form>
            </div>
        </section>

        <section class="resume-section" id="clientes_emprestimo">
            <div class="resume-section-content">
                <h2 class="mb-5">Verifica quais clientes estão com mangás</h2>
                <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                    <div class="flex-grow-1">
                        <h3 class="mb-0">Verifica quais clientes estão com mangás</h3>
                    </div>
                </div>
                <?php
                $flag = true;
                if (isset($_REQUEST["enviar_clientes_emprestimo"])) {
                    $flag = true;

                    $conn = oci_pconnect("usr85", "usr85", "//200.132.53.144:1521/XEPDB1");
                    if (!$conn) {
                        echo "teste";
                    }

                    $stmt = ociparse($conn, 'SELECT id_cliente FROM emprestimo WHERE data_entrega is NULL');
                    ociexecute($stmt);

                    echo "<table align='center' border='1'>\n";
                    while ($row = oci_fetch_array($stmt, OCI_ASSOC + OCI_RETURN_NULLS)) {
                        echo "<tr>\n";
                        foreach ($row as $item) {
                            echo "<td align='center'> Cliente com Manga ID </td><td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
                        }
                        echo "</tr>\n";
                    }
                    echo "</table>\n";

                    OCIFreeStatement($stmt);
                    OCILogoff($conn);
                }

                ?>

                <form action="<?php $PHP_SELF ?>#clientes_emprestimo" method="post">
                    <div align="center">
                        <table align="center" width="50%" border="0" cellpadding="2">
                            <td align="center"><input type="submit" name="enviar_clientes_emprestimo" value="Consultar">
                            </td>
                        </table>
                    </div>
                </form>

            </div>
        </section>


        <hr class="m-0" />

    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>