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

    <title>DATH</title>
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="50">

    <?php include("conexao.php"); ?>
    <?php session_start(); ?>
    <?php
    if (isset($_SESSION["alert"])) {
        if ($_SESSION["alert"] == true) {
        echo '<script>
        $( document ).ready(function() {
            alert("Email ou CPF já cadastrado!");
        });
        </script>';
        }
    $_SESSION["alert"] = false;
    }
?>
    <!--Header-->
    <div id="home" class="jumbotron jumbotron-fluid mb-0" style="background-image: url(img/pattern.jpg); background-attachment: fixed;">
        <div class="container-fluid text-center">
            <div class="masthead-brand display-1">Bem vindo!</div>
            <h1 class="masthead-heading">Comece a usar nossos serviços!</h1>
            <ul class="list-inline mt-4">
                <li>
                    <a href="#cadastro" class="btn btn-danger btn-lg">Cadastro</a>
                </li>
            </ul>
        </div>
    </div>
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
                        <a class="nav-link" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#cadastro">Cadastro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#sobre">Sobre</a>
                    </li>
                    <?php
                        if(isset($_SESSION['usuario'])) {
                            echo '<li class="nav-item"><a class="nav-link" href="perfil.php">Perfil</a></li>';
                        }
                        ?>

                </ul>
                <ul class="navbar-nav ml-auto">
                    <?php
                            if(!isset($_SESSION['usuario'])) {
                                echo '<li>
                                        <div class="btn-group">
                                        <a class="btn btn-primary btn-light" data-toggle="modal" data-target="#myModal">Login</a>
                                        </div>
                                     </li>';
                            } else {
                                $nome = $_SESSION["usuario"];
                                echo '<li class="nav-item">
                                        <a class="nav-link" href="perfil.php" style="color: white;">';
                                echo $nome;
                                echo '</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="logout.php">Sair</a>
                                    </li>';
                            }
                        ?>
                </ul>
            </div>
        </div>
    </nav>
    <!--Carousel-->
    <div id="carousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carousel" data-slide-to="0" class="active"></li>
            <li data-target="#carousel" data-slide-to="1"></li>
            <li data-target="#carousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="img/bg.png" alt="Primeiro slide">
                <div class="carousel-caption d-none d-md-block">
                    <h2>Primeiro slide!</h2>
                    <p>Texto texto texto</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="img/bg.png" alt="Segundo slide">
                <div class="carousel-caption d-none d-md-block">
                    <h2>Segundo slide!</h2>
                    <p>Texto texto texto</p>
                </div>
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="img/bg.png" alt="Terceiro slide">
                <div class="carousel-caption d-none d-md-block">
                    <h2>Terceiro slide!</h2>
                    <p>Texto texto texto</p>
                </div>
            </div>
        </div>

        <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
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
                    <form action="login.php" method="post">
                        <div class="form-group">
                            <label for="emailmodal">Email:</label>
                            <input type="email" class="form-control" id="emailmodal" name="emailmodal" placeholder="Digite seu email">
                        </div>
                        <div class="form-group">
                            <label for="pwdmodal">Senha:</label>
                            <input type="password" class="form-control" id="pwdmodal" name="pwdmodal" placeholder="Digite sua senha">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Intro-->
    <div class="jumbotron jumbotron-fluid mb-0" style="height: 10rem; background-image: url(img/albert.jpg); background-attachment: fixed; background-position: center; background-size: cover"></div>
    <!--Cadastro-->
    <section class="container-fluid bg-light" id="cadastro" style="padding: 30px;">
        <div class="container">
            <h1 class="text-center mb-4 display-4">Cadastro</h1>
            <div class="col-sm-10 mx-auto bg-white rounded p-4 border">
                <form method="post" action="cadastro.php" id="cadastro">
                    <div class="form-row">
                        <div class="form-group col-sm-12 p-0">
                            <label for="nome">Nome:</label>
                            <input type="text" class="form-control" id="nome" placeholder="Digite seu nome" name="nome" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-12 p-0">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Digite seu email" name="email" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-6 p-0">
                            <label for="pwd">Senha:</label>
                            <input type="password" class="form-control" id="pwd" placeholder="Digite sua senha" name="pswd" oninput="barra()" required>
                            <div class="progress mt-1">

                                <div id="progresspwd" class="progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 0%; transition: background-color .5s ease-in-out, width .5s ease-in-out">
                                    <span id="forcasenha" class="text-center" style="user-select: none; font-weight: bold; opacity: 0; transition: opacity .3s ease-in-out;"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-6 p-0">
                            <label for="repwd">Confirmar senha:</label>
                            <input type="password" class="form-control" id="repwd" placeholder="Redigite sua senha" oninput="senhasdiff()" required>
                            <span id="pwddiff" style="opacity: 0; display: block; color: #dc3545; font-weight: bold; transition: opacity .5s ease-in-out;">As senhas estão diferentes!</span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label for="tel">Telefone:</label>
                            <input type="text" class="form-control" id="tel" placeholder="Ex: 12 98765-4321" name="tel" maxlength="13" OnKeyPress="formatar('## #####-####', this)" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="cpf">CPF:</label>
                            <input type="text" class="form-control" id="cpf" placeholder="Ex: 123.456.789-00" name="cpf" maxlength="14" OnKeyPress="formatar('###.###.###-##', this)" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-4">
                            <label for="nasc">Nascimento:</label>
                            <input type="date" class="form-control" id="nasc" placeholder="Digite sua senha" name="nasc" required>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="sangue">Tipo sanguíneo:</label><br>
                            <select name="sangue" class="custom-select">
                                <option selected>A+</option>
                                <option>A-</option>
                                <option>B+</option>
                                <option>B-</option>
                                <option>AB+</option>
                                <option>AB-</option>
                                <option>O+</option>
                                <option>O-</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="conv">Convênio:</label><br>
                            <select name="conv" class="custom-select">
                                <option selected>Nenhum</option>
                                <option>--</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-4 btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-danger btn-sm active">
                                <input type="radio" name="sexo" id="masc" value="Masculino" checked>Masculino
                            </label>
                            <label class="btn btn-sm btn-danger">
                                <input type="radio" name="sexo" id="femi" value="Feminino">Feminino
                            </label>
                        </div>
                    </div>
                    <button type="submit" id="submit" class="btn btn-danger btn-lg btn-block">Enviar</button>
                </form>
            </div>
        </div>
    </section>
    <!--Hospitalzinho img-->
    <div class="jumbotron jumbotron-fluid mb-0" style="height: 10rem; background-image: url(img/albert.jpg); background-attachment: fixed; background-position: center; background-size: cover">
    </div>
    <!--Sobre-->
    <section class="container-fluid bg-light" id="sobre" style="padding: 30px;">
        <div class="container">
            <div class="col-sm-10 mx-auto">
                <h1 class="text-center mb-4 display-4">Sobre</h1>
                <div class="row">
                    <div class="col-sm-6">
                        <p class="text-justify lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    </div>
                    <div class="col-sm-6">
                        <img src="img/logosobre.png" class="rounded img-thumbnail">
                    </div>
                </div>

                <div class="row text-center mt-5">
                    <div class="col-md-4 mb-4">
                        <a href="https://www.facebook.com/alinefernandaoliveira.santos" target="_blank"><img class="aumenta img-fluid rounded-circle img-thumbnail shadow" src="https://scontent.fbsb9-1.fna.fbcdn.net/v/t1.0-9/35402348_815423871988252_2518923663982460928_n.jpg?_nc_cat=110&oh=30c12c5c2f9d967a899b4611d6f77b32&oe=5C2E6D94" alt="Aline"></a>
                        <h4 class="card-title mt-3">Aline Fernanda</h4>
                        <p class="card-text font-weight-bold text-secondary">Líder</p>
                    </div>
                    <div class="col-md-4 mb-4">
                        <a href="https://www.facebook.com/thomas.finholt.3" target="_blank"><img class="aumenta img-fluid rounded-circle img-thumbnail shadow" src="https://scontent.fbsb9-1.fna.fbcdn.net/v/t1.0-9/21730972_736343503222544_4077031390962284442_n.jpg?_nc_cat=109&oh=e5bbbed67c0bbb7e38ad7b4d44792cb8&oe=5C5A4307" alt="Thomás"></a>
                        <h4 class="card-title mt-3">Thomás Finholt</h4>
                        <p class="card-text font-weight-bold text-secondary">Vice-líder</p>
                    </div>
                    <div class="col-md-4 mb-4">
                        <a href="https://www.facebook.com/profile.php?id=100003143478476" target="_blank"><img class="aumenta img-fluid rounded-circle img-thumbnail shadow" src="https://scontent.fbsb9-1.fna.fbcdn.net/v/t1.0-9/17457431_1198077536973684_3185567605477200885_n.jpg?_nc_cat=106&oh=00315f40e3594984cbe7fe8fcb563042&oe=5C1E5FA4" alt="Denis"></a>
                        <h4 class="card-title mt-3">Denis Campos</h4>
                        <p class="card-text font-weight-bold text-secondary">Tenta ajudar</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--Footer-->
    <div class="jumbotron jumbotron-fluid text-center bg-dark" style="margin-bottom:0; background-color: #c00;">
        <p class="text-white">Copyright &copy; 2018 DATH - All rights reserved.</p>
    </div>
    <!-- Optional JavaScript -->
    <script>
        function barra() {
            if ($("input#pwd").val().length == 0) {
                $("div#progresspwd").css("width", "0%");
                $("span#forcasenha").css("opacity", "0");
            } else if ($("input#pwd").val().length < 8) {
                $("div#progresspwd").css("width", "25%");
                $("div#progresspwd").css("background-color", "#dc3545");
                $("span#forcasenha").css("opacity", "1");
                $("span#forcasenha").text("Senha fraca!");

            } else if ($("input#pwd").val().length < 12) {
                $("div#progresspwd").css("width", "50%");
                $("div#progresspwd").css("background-color", "#ffc107");
                $("span#forcasenha").css("opacity", "1");
                $("span#forcasenha").text("Senha quase boa!");
            } else if ($("input#pwd").val().length < 15) {
                $("div#progresspwd").css("width", "75%");
                $("div#progresspwd").css("background-color", "#28a745");
                $("span#forcasenha").css("opacity", "1");
                $("span#forcasenha").text("Senha top!");
            } else {
                $("div#progresspwd").css("width", "100%");
                $("div#progresspwd").css("background-color", "#007bff");
                $("span#forcasenha").css("opacity", "1");
                $("span#forcasenha").text("Senha muito loca!");
            }
        }

    </script>

    <script>
        function senhasdiff() {
            if ($("input#pwd").val() != $("input#repwd").val()) {
                $("span#pwddiff").css("opacity", "1");
            } else {
                $("span#pwddiff").css("opacity", "0");
            }
        }

    </script>

    <script>
        $("form#cadastro").submit(function(event) {
            if ($("input#pwd").val() != $("input#repwd").val()) {
                event.preventDefault();
                alert("As senhas estão diferentes!");
            }
            if ($("input#pwd").val().length < 8) {
                event.preventDefault();
                alert("Sua senha é muito pequena!");
            }
            if ($("input#tel").val().length < 13) {
                event.preventDefault();
                alert("Insira um telefone válido!");
            }
            if ($("input#cpf").val().length < 14) {
                event.preventDefault();
                alert("Insira um CPF válido!");
            }
        });

    </script>

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
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>
