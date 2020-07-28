<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="pt-pt">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Entrar ou Registar se na Quick Sales</title>
    <!-- MDB icon -->
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" />
    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/mdb.min.css') ?>" />
    <!-- Your custom styles (optional) -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/custom/login.css') ?>" />
</head>

<body>
    <input type="hidden" id="base" value="<?php echo base_url(); ?>">
    <a href="<?php echo site_url('') ?>" class="waves-effect home-button">HOME</a>
    <div class="login-window vh-100" style="background-image: url('assets/img/buy.png');">
        <div class="container vh-100 login center-painel d-flex justify-content-center align-items-center">
            <div class="row main-pan d-flex align-items-center">
                <div class="col-md-4 py-2 carousel-side h-100 z-depth-3">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <!--Indicators-->
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-1z" data-slide-to="1"></li>
                            <li data-target="#carousel-example-1z" data-slide-to="2"></li>
                        </ol>
                        <!--/.Indicators-->
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="px-2 py-4 d-flex flex-column align-items-center text-center">
                                    <h4 class="white-text font-weight-bold mb-3">
                                        Anuncie aqui!
                                    </h4>
                                    <img class="mb-3 w-100" src="<?php echo base_url('assets/img/login1.png') ?>" />
                                    <p class="white-text">
                                        Melhor plataforma para anunciar os produtos que deseja
                                        vender.
                                    </p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="px-2 py-4 d-flex flex-column align-items-center text-center">
                                    <h2 class="white-text font-weight-bold mb-3" style="font-size: 16pt;">
                                        Encontre o que precisa aqui
                                    </h2>
                                    <img class="mb-3" src="<?php echo base_url('assets/img/compre.png') ?>" />
                                    <p class="white-text">
                                        Aqui voce encontra todo tipo de produtos e serviços.
                                    </p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="px-2 py-4 d-flex flex-column align-items-center text-center">
                                    <h2 class="white-text font-weight-bold mb-3" style="font-size: 16pt;">
                                        Third Panel
                                    </h2>
                                    <p class="white-text">
                                        Cadastre se para desfrutar de todas funcionalidades
                                    </p>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12 credentials-side z-depth-3">
                    <div class="row h-100">
                        <div class="col-md-12 white sign p-0">
                            <div class="pan">
                                <!-- Classic tabs -->
                                <div class="classic-tabs">
                                    <ul class="nav tabs-white nav-justified z-depth-1" id="myClassicTab" role="tablist">
                                        <li class="nav-item ml-0">
                                            <a class="nav-link waves-light active show" id="profile-tab-classic" data-toggle="tab" href="#profile-classic" role="tab" aria-controls="profile-classic" aria-selected="true">Entrar</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link waves-light" id="follow-tab-classic" data-toggle="tab" href="#follow-classic" role="tab" aria-controls="follow-classic" aria-selected="false">REGISTAR-SE</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content p-0" id="myClassicTabContent">
                                        <div class="tab-pane fade active show" id="profile-classic" role="tabpanel" aria-labelledby="profile-tab-classic">
                                            <div id="test1" class="col-sm-12 login">
                                                <form id="login" class="col-sm-12" action="" method="post">
                                                    <div class="row">
                                                        <!-- Material input -->
                                                        <div class="col-sm-12">
                                                            <div class="md-form mb-2">
                                                                <input id="mail" name="email" type="email" class="form-control validate mb-0" />
                                                                <label for="mail" data-error="wrong" data-success="right">Email</label>
                                                            </div>
                                                        </div>
                                                        <!-- Material input -->
                                                        <div class="col-sm-12">
                                                            <div class="md-form">
                                                                <input id="password" name="senha" type="password" class="form-control validate mb-0" />
                                                                <label for="password" data-error="wrong" data-success="right">Senha</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="d-flex justify-content-between">
                                                                <div class="form-check m-0 p-0">
                                                                    <input name="lembrar" type="checkbox" class="form-check-input" id="cbx-lembrar" />
                                                                    <label class="form-check-label" for="cbx-lembrar">Lembrar de mim</label>
                                                                </div>
                                                                <a class="right pattern-link" href="">Esqueceu a senha?</a>
                                                            </div>
                                                            <button type="submit" class="waves-effect waves-light w-100 m-0 my-3 btn btn-login">
                                                                Entrar
                                                            </button>
                                                            <p class="termos blue-grey-text">
                                                                Ao fazer o Login está a aceitar os Termos e
                                                                Condições da QuickSales.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="follow-classic" role="tabpanel" aria-labelledby="follow-tab-classic">
                                            <div id="test2" class="col-sm-12 register">
                                                <form id="registro" class="col-sm-12" action="" method="post">
                                                    <div class="row">
                                                        <!-- Material input -->
                                                        <div class="col-sm-12">
                                                            <div class="md-form mb-2">
                                                                <input id="mail" name="email" type="email" class="form-control validate mb-0" />
                                                                <label for="mail" data-error="wrong" data-success="right">Email</label>
                                                            </div>
                                                        </div>
                                                        <!-- Material input -->
                                                        <div class="col-sm-12">
                                                            <div class="md-form">
                                                                <input id="password" name="senha" type="password" class="form-control validate" />
                                                                <label for="password" data-error="wrong" data-success="right">Senha</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="d-flex justify-content-between">
                                                                <div class="form-check m-0 p-0">
                                                                    <input name="termos" type="checkbox" class="form-check-input" id="cbx-termos" />
                                                                    <label class="form-check-label" for="cbx-termos">
                                                                        Eu aceito os termos e Condições de uso
                                                                        desta aplicação.
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <a class="waves-effect waves-light btn w-100 m-0 my-3 btn-login modal-trigger" data-toggle="modal" data-target="#userForm">REGISTAR-SE</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Classic tabs -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="userForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h4 class="modal-title w-100 font-weight-bold">
                                Dados do usuário
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body mx-3">
                            <div class="md-form mb-5">
                                <i class="fas fa-envelope prefix grey-text"></i>
                                <input id="name" name="nome" type="text" class="form-control validate" form="registro" />
                                <label data-error="wrong" data-success="right" for="name">Nome de usuário</label>
                            </div>

                            <div class="md-form mb-4">
                                <i class="fas fa-lock prefix grey-text"></i>
                                <input id="telefone" name="telefone" type="text" class="form-control validate" form="registro" />
                                <label data-error="wrong" data-success="right" for="telefone">Numero de Telefone</label>
                            </div>

                            <div class="md-form mb-4">
                                <i class="fas fa-lock prefix grey-text"></i>
                                <input id="location" name="localizacao" type="text" form="registro" class="form-control validate" />
                                <label data-error="wrong" data-success="right" for="localizacao">Localização</label>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" form="registro" class="btn btn-outline-orange">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/popper.min.js') ?>"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="<?php echo base_url('assets/js/mdb.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/sweetalert2/sweetalert2.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/custom/login.js') ?>"></script>
</body>

</html>