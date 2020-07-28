<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>

<section class="dados_pessoais">
    <h2 class="text-main" style="font-weight: 500;">Dados Pessoais</h2>
    <p>Atualize seus dados pessoais</p>
    <!-- Grid row -->
    <div class="row">
        <!-- Grid column -->
        <div class="col-sm-12 py-5 w-100">
            <div class="ripe-malinka-gradient">
                <!--Accordion wrapper-->
                <div class="accordion md-accordion accordion-2" id="accordionEx7" role="tablist" aria-multiselectable="true">
                    <!-- Accordion card -->
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header rgba-stylish-strong z-depth-1 mb-1" role="tab" id="heading1">
                            <a data-toggle="collapse" data-parent="#accordionEx7" href="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                <h6 class="mb-0 white-text text-uppercase font-thin">
                                    Alterar foto de perfil
                                    <i class="fas fa-angle-down rotate-icon"></i>
                                </h6>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapse1" class="collapse show" role="tabpanel" aria-labelledby="heading1" data-parent="#accordionEx7">
                            <div class="card-body mb-1 rgba-grey-light white-text">
                                <div class="d-flex flex-column justify-content-center align-items-center">
                                    <form class="md-form anunciar" id="perfil" enctype="multipart/form-data">
                                        <div class="file-field">
                                            <div class="mb-4 text-center img-div rounded-circle">
                                                <img id="imgPerfil" src="<?php echo $pagina['img_perfil'] . $foto ?>" class=" z-depth-1-half avatar-pic" style="width: 200px;" alt="example placeholder avatar" />
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <div class="btn btn-mdb-color btn-rounded float-left">
                                                    <span>Adicionar Foto</span>
                                                    <input id="campoFoto" type="file" name="fotoperfil">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header rgba-stylish-strong z-depth-1 mb-1" role="tab" id="heading2">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx7" href="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                <h6 class="mb-0 white-text text-uppercase font-thin">
                                    Alterar dados de contacto
                                    <i class="fas fa-angle-down rotate-icon"></i>
                                </h6>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapse2" class="collapse" role="tabpanel" aria-labelledby="heading2" data-parent="#accordionEx7">
                            <div class="card-body mb-1 rgba-grey-light white-text">
                                <form id="contacto" method="post" common-data action="<?php echo site_url("usuario/atualizar_contactos") ?>">
                                    <h5 class="main-text">
                                        Dados de contacto do usuário
                                    </h5>
                                    <div class="row">
                                        <div class="input-field col-sm-12 col-md-6 col-xl-3">
                                            <div class="md-form">
                                                <input type="text" id="name" name="nome" class="form-control" value="<?php echo $nome ?>" />
                                                <label for="name">Nome de usuario</label>
                                            </div>
                                        </div>
                                        <div class="input-field col-sm-12 col-md-6 col-xl-3">
                                            <div class="md-form">
                                                <input type="text" id="telefone" name="telefone" class="form-control" value="<?php echo $telefone ?>" />
                                                <label for="telefone">Numero de Telefone</label>
                                            </div>
                                        </div>
                                        <div class="input-field col-sm-12 col-md-6 col-xl-3">
                                            <div class="md-form">
                                                <input type="text" id="location" name="localizacao" value="<?php echo $localizacao ?>" class="form-control" />
                                                <label for="location">Localização</label>
                                            </div>
                                        </div>
                                        <div class="input-field col-sm-12 col-md-6 col-xl-3">
                                            <div class="md-form">
                                                <input type="text" id="mail" disabled name="email" class="form-control" value="<?php echo $email ?>" />
                                                <label for="mail">Email</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 text-center">
                                            <button type="submit" class="waves-effect waves-light btn btn-lg btn-mdb-color">
                                                Atualizar informação
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->

                    <!-- Accordion card -->
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header rgba-stylish-strong z-depth-1 mb-1" role="tab" id="heading3">
                            <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx7" href="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                <h6 class="mb-0 white-text text-uppercase font-thin">
                                    Alterar senha
                                    <i class="fas fa-angle-down rotate-icon"></i>
                                </h6>
                            </a>
                        </div>

                        <!-- Card body -->
                        <div id="collapse3" class="collapse" role="tabpanel" aria-labelledby="heading3" data-parent="#accordionEx7">
                            <div class="card-body mb-1 rgba-grey-light white-text">
                                <form id="senhas" common-data action="<?php echo site_url("usuario/atualizar_senha") ?>" method="post">
                                    <h5 class="main-text">Altere sua senha</h5>
                                    <div class="row">
                                        <div class="input-field col-sm-12 col-md-6 col-xl-3">
                                            <div class="md-form">
                                                <input type="password" id="password1" name="senha1" required class="form-control validate" />
                                                <label for="password1">Senha atual</label>
                                            </div>
                                        </div>
                                        <div class="input-field col-sm-12 col-md-6 col-xl-3">
                                            <div class="md-form">
                                                <input type="password" id="password2" name="senha2" required class="form-control validate" />
                                                <label for="password2">Nova Senha</label>
                                            </div>
                                        </div>
                                        <div class="input-field col-sm-12 col-md-6 col-xl-3">
                                            <div class="md-form">
                                                <input type="password" id="password3" name="senha3" required class="form-control validate" />
                                                <label for="password3">Confirme a senha</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-xl-3">
                                            <button type="submit" class="waves-effect waves-light btn w-100 btn-mdb-color btn-lg">
                                                Alterar senha
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Accordion card -->
                </div>
                <!--/.Accordion wrapper-->
            </div>
        </div>
        <!-- Grid column -->
    </div>
    <!-- Grid row -->
</section>



<!-- Frame Modal Top -->
<div class="modal fade top" id="alterar-foto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <!-- Add class .modal-frame and then add class .modal-top (or other classes from list above) to set a position to the modal -->
    <div class="modal-dialog modal-frame modal-top" role="document">


        <div class="modal-content">
            <div class="modal-body">
                <div class="row d-flex justify-content-center align-items-center">

                    <p class="pt-3 pr-2">Deseja salvar a nova foto?
                    </p>

                    <button type="button" onclick="setDefaultImg()" class="btn bg-main text-white" data-dismiss="modal">Não!</button>
                    <button type="button" onclick="submitFoto()" class="btn btn-mdb-color">Salvar alteração</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Frame Modal Top -->