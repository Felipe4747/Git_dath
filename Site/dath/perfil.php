<!doctype html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="style.css">

    <script src="jquery3.3.1.js" type="text/javascript"></script>
    <?php include('verifica_login.php'); ?>
    <title>
        <?php echo $_SESSION['usuario']; ?>
    </title>

</head>

<body>
    <?php
    if (isset($_SESSION["alert"])) {
        $alerta = $_SESSION["alert"];
        echo "<script>
        $( document ).ready(function() {{$alerta}});
        </script>";
    }
    unset($_SESSION["alert"]);
    ?>
    <?php
    include('conexao.php');
    $Id = $_SESSION["id"];
    $sql = "delete exa, exacon from exa
    right join exacon on exacon.id = exa.id_exacon
	where exacon.id_usuario = '$Id' and exacon.horario < now()";
    $result = $conn->prepare($sql);
    $result->execute();
    
    ?>
    <!--Navbar-->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top" style="background-color: #c00">
        <div class="container">
            <a class="navbar-brand h1 mb-0" href="index.php">DATH</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav navbar-left">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#cadastro">Cadastro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php#sobre">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Perfil</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link active">
                            <?php echo $_SESSION['usuario']; ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--Modal-->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Fazer login</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="emailmodal">Email:</label>
                            <input type="email" class="form-control" id="emailmodal" placeholder="Digite seu email" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="pwdmodal">Senha:</label>
                            <input type="password" class="form-control" id="pwdmodal" placeholder="Digite sua senha">
                        </div>
                        <div class="custom-control custom-checkbox form-group">
                            <input type="checkbox" class="custom-control-input" id="conect" name="conect">
                            <label class="custom-control-label" for="conect">Mantenha-me conectado</label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Perfil-->
    <section class="bg-light" id="perfil">
        <div class="jumbotron jumbotron-fluid mb-0 p-4">
            <div class="container">
                <div class="media p-3">
                    <img src="img/exemplo.png" class="mr-3 mt-3 rounded-circle my-auto img-fluid" style="width:200px;">
                    <div class="media-body my-auto">
                        <h2 style="font-size: 3rem" class="my-0 masthead-heading">
                            <?php echo $_SESSION['usuario']; ?>
                        </h2>
                        <p style="font-size: 2rem" class="my-0 masthead-heading">
                            <?php echo $_SESSION['email']; ?>
                        </p>
                        <p style="font-size: 1.5rem" class="my-0 masthead-heading">
                            <?php echo 'Id: ' . $_SESSION['id']; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Tabela exames-->
    <div class="container col-sm-10">
        <h1 class="text-center mb-4 mt-4 display-4">Exames</h1>
        <input class="form-control form-control-lg mb-4" id="pesquisaexa" type="text" placeholder="Pesquisar exames...">
        <div class="table-wrapper-scroll-y">
            <table class="table table-striped border mb-5 text-justify">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Hospital</th>
                        <th>Médico</th>
                        <th>Horário</th>
                        <th>Endereço</th>
                    </tr>
                </thead>
                <tbody id="exa" style="max-height: 40px; overflow: scroll;">
                    <?php
                        include("conexao.php");
                        $emailatual = $_SESSION["email"];
                        $sql = "SELECT count(*) FROM exacon 
                        left join exa on exacon.id = exa.id_exacon
                        where id_usuario = (select id from usuario where email = '$emailatual') and exa.id_exacon is not null";
                        $res = $conn->query($sql);
                    
                        if ($res->fetchColumn() > 0){
                            $sql = "SELECT exa.tipo as Tipo, hospital.nome as Hospital, medico.nome as Medico, date_format(horario, '%d/%m/%y %H:%i') as Horario, concat(rua.nome, ', ', endereco.num_predio, ' - ', cidade.nome, ', ', estado.nome, ', ', pais.nome) as Endereco from exacon
                                    left join hospital on exacon.id_hospital = hospital.id
                                    left join medico on exacon.id_medico = medico.id
                                    left join exa on exacon.id = exa.id_exacon
                                    inner join endereco on hospital.id_endereco = endereco.id
                                    inner join pais on endereco.id_pais = pais.id
                                    inner join estado on endereco.id_estado = estado.id
                                    inner join cidade on endereco.id_cidade = cidade.id
                                    inner join rua on endereco.id_rua = rua.id
                                    where exacon.id_usuario = (select id from usuario where email = '$emailatual') and exa.id_exacon is not null order by exacon.horario asc";
                            
                            foreach ($conn->query($sql) as $row) {
                                echo "<tr>";
                                echo "<td>" . $row['Tipo'] . "</td>";
                                echo "<td>" . $row['Hospital'] . "</td>";
                                echo "<td>" . $row['Medico'] . "</td>";
                                echo "<td>" . $row['Horario'] . "</td>";
                                echo "<td>" . $row['Endereco'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr>";
                            echo "<td>--</td>";
                            echo "<td>--</td>";
                            echo "<td>--</td>";
                            echo "<td>--</td>";
                            echo "<td>--</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!--Hospitalzinho img-->
    <div class="jumbotron jumbotron-fluid mb-0" style="height: 10rem; background-image: url(img/medico1.jpg); background-attachment: fixed; background-position: center; background-size: cover">
    </div>
    <div class="container col-sm-8">
        <h1 class="text-center mb-4 mt-4 display-4">Consultas</h1>
        <input class="form-control form-control-lg mb-4" id="pesquisacon" type="text" placeholder="Pesquisar consultas...">
        <div class="table-wrapper-scroll-y">
            <table class="table table-striped border mb-5 text-justify">
                <thead>
                    <tr>
                        <th>Hospital</th>
                        <th>Médico</th>
                        <th>Horário</th>
                        <th>Endereço</th>
                    </tr>
                </thead>
                <tbody id="con" style="max-height: 40px; overflow: scroll;">
                    <?php
                        include("conexao.php");
                        $emailatual = $_SESSION["email"];
                        $sql = "SELECT count(*) FROM exacon 
                        left join exa on exacon.id = exa.id_exacon
                        where id_usuario = (select id from usuario where email = '$emailatual') and exa.id_exacon is null";
                        $res = $conn->query($sql);
                    
                        if ($res->fetchColumn() > 0){
                            $sql = "SELECT hospital.nome as Hospital, if(exa.id_exacon is null, 'Consulta', 'Exame') as Tipo , medico.nome as Medico, date_format(horario, '%d/%m/%y %H:%i') as Horario, concat(rua.nome, ', ', endereco.num_predio, ' - ', cidade.nome, ', ', estado.nome, ', ', pais.nome) as Endereco from exacon
                                    left join hospital on exacon.id_hospital = hospital.id
                                    left join medico on exacon.id_medico = medico.id
                                    left join exa on exacon.id = exa.id_exacon
                                    inner join endereco on hospital.id_endereco = endereco.id
                                    inner join pais on endereco.id_pais = pais.id
                                    inner join estado on endereco.id_estado = estado.id
                                    inner join cidade on endereco.id_cidade = cidade.id
                                    inner join rua on endereco.id_rua = rua.id
                                    where exacon.id_usuario = (select id from usuario where email = '$emailatual') and exa.id_exacon is null order by exacon.horario asc";
                            
                            foreach ($conn->query($sql) as $row) {
                                echo "<tr>";
                                echo "<td>" . $row['Hospital'] . "</td>";
                                echo "<td>" . $row['Medico'] . "</td>";
                                echo "<td>" . $row['Horario'] . "</td>";
                                echo "<td>" . $row['Endereco'] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr>";
                            echo "<td>--</td>";
                            echo "<td>--</td>";
                            echo "<td>--</td>";
                            echo "<td>--</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="jumbotron jumbotron-fluid mb-0" style="height: 10rem; background-image: url(img/medico2.jpg); background-attachment: fixed; background-position: center; background-size: cover">
    </div>
    <!--Agendar-->
    <section class="container-fluid bg-light" id="agendar" style="padding: 30px;">
        <div class="container col-sm-6">
            <h1 class="text-center mb-4 display-4">Agendar</h1>
            <div class="col-sm-12 mx-auto bg-white rounded p-4 border">
                <form method="post" action="exacon.php">
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label for="tipo">Tipo:</label><br>
                            <select name="tipo" class="custom-select" id="tipo">
                                <option selected>Exame</option>
                                <option>Consulta</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-6" id="examede">
                            <label for="tipo">De:</label><br>
                            <input type="text" class="form-control" id="tipoexa" placeholder="Exame de..." name="tipoexa" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label>País:</label><br>
                            <select name="estado" class="custom-select">
                                <option selected>Brasil</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Estado:</label><br>
                            <select name="estado" class="custom-select">
                                <option selected>São Paulo</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label>Cidade:</label><br>
                            <select name="cidade" class="custom-select">
                                <option selected>Caraguatatuba</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="hospital">Hospital:</label><br>
                            <select name="hospital" class="custom-select">
                                <option value="1" selected>Casa de Saúde Stella Maris</option>
                                <option value="2">Hospital de Olhos e Clínicas - HOC</option>
                                <option value="3">Santa Casa</option>
                                <option value="4">Hospital Santos Dumont</option>
                                <option value="5">AME Caraguatatuba</option>
                                <option value="6">Centro Médico São Camilo</option>
                                <option value="7">Madre Tereza CEAMI</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label for="medico">Médico:</label><br>
                            <select name="medico" class="custom-select">
                                <option value="1" selected>Aline Fernanda</option>
                                <option value="2">Denis Campos</option>
                                <option value="3">Evelyn Pedrosa</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="nasc">Horário:</label>
                            <input type="datetime-local" class="form-control" id="nasc" name="horario" max="2999-12-31" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger btn-lg btn-block">Agendar</button>
                </form>
            </div>
        </div>
    </section>
    <!--Footer-->
    <div class="jumbotron jumbotron-fluid text-center bg-dark" style="margin-bottom:0; background-color: #c00;">
        <p class="text-white">Copyright &copy;
            <?php echo date("Y"); ?> DATH - All rights reserved.</p>
    </div>
    <!-- Optional JavaScript -->
    <script>
        function formatar(mascara, documento) {
            var i = documento.value.length;
            var saida = mascara.substring(0, 1);
            var texto = mascara.substring(i)

            if (texto.substring(0, 1) != saida) {
                documento.value += texto.substring(0, 1);
            }

        }

    </script>
    <script>
        $(document).ready(function() {
            $("#pesquisaexa").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#exa tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
            $("#pesquisacon").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#con tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

        $("select#tipo").change(function() {
            if ($(this).val() == "Consulta") {
                $("#examede").fadeOut("fast", function() {});
                $("#tipoexa").removeAttr("required");
                $("tipoexa").val() = "";
            } else {
                $("#examede").fadeIn("fast", function() {});
                $("#tipoexa").Attr("required");
            }
        });

    </script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="jquery3.3.1.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>
