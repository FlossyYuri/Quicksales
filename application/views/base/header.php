<?php
defined('BASEPATH') or exit('No direct script access allowed');
$logged = $this->session->has_userdata('usuario');
if ($logged) {
    $userdata = $this->session->userdata('usuario');
}
$link_home = site_url("principal");
$link_meus = site_url("userLinks/meusAnuncios");
$link_anunciar = site_url("userLinks/anunciar");
$link_desejos = site_url("userLinks/desejos");
$link_dados = site_url("userLinks/dados_pessoais");
$link_sair = site_url("usuario/sair");
$link_login = site_url("userLinks");
$onlineUsers =  rand(80, 200);
?>
<!--Main Navigation-->
<header>
    <div class="container-xl top-bar d-none d-lg-block">
        <div class="row my-2">
            <div class="col-md-6">
                <ul>
                    <li>
                        <a href="<?php echo $link_home ?>" class="p-0"><img style="height: 35px;" src="<?php echo base_url("assets/ai/quick.png") ?>" alt="" /></a>
                    </li>
                    <?php if ($logged) : ?>
                        <li>
                            <a href="<?php echo $link_meus ?>" class="btn btn-outline-main waves-effect d-flex"><i class="fas fa-list-ul"></i> Meus anúncios</a>
                        </li>
                    <?php endif ?>
                    <li>
                        <a href="<?php echo $link_anunciar ?>" class="btn bg-main d-flex text-white"><i class="fas fa-plus left"></i> Anunciar</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <ul class="d-flex justify-content-end">
                    <li>
                        <a class="btn btn-outline-danger btn-rounded waves-effect peopleOnline d-flex justify-content-center">
                            <i class="fas fa-eye"></i><?php echo $onlineUsers ?>
                        </a>
                    </li>
                    <?php if ($logged) : ?>
                        <li>
                            <a href="<?php echo $link_desejos ?>" class="btn btn-outline-main waves-effect d-flex"><i class="far fa-heart"></i> Desejos</a>
                        </li>
                    <?php endif ?>
                    <?php if ($logged) : ?>
                        <li>
                            <!--Dropdown primary-->
                            <div class="dropdown">

                                <!--Trigger-->
                                <a class="btn btn-outline-main waves-effect d-flex dropdown-toggle" id="minhaConta" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="far fa-user-circle"></i>Minha conta</a>


                                <!--Menu-->
                                <div class="dropdown-menu dropdown-danger">
                                    <a class="dropdown-item" href="<?php echo $link_meus ?>">Meus anúncios</a>
                                    <a class="dropdown-item" href="<?php echo $link_desejos ?>">Desejos</a>
                                    <a class="dropdown-item" href="#modalInteresses" data-toggle="modal" data-target="#modalInteresses">Meus interesses</a>
                                    <a class="dropdown-item" href="<?php echo $link_dados ?>">Dados Pessoais</a>
                                    <a class="dropdown-item" href="<?php echo $link_sair ?>">Sair</a>
                                </div>
                            </div>
                            <!--/Dropdown primary-->
                        </li>
                    <?php else : ?>
                        <li>
                            <a href="<?php echo $link_login ?>" class="btn btn-outline-main waves-effect d-flex"><i class="far fa-user-circle"></i>
                                Entrar/Registrar
                            </a>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-main">
        <div class="container-xl flex-column">
            <!-- Large outline input -->
            <div class="col-sm-12 p-0">
                <!-- Material background input -->
                <div class="md-form md-bg m-1 z-depth-1">
                    <input type="text" id="pesquisa" placeholder="Pesquisar" class="form-control" />
                </div>
            </div>
            <div class="col-sm 12 p-0 categorias d-none d-lg-block">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a data-activates="categories" class="nav-link button-collapse"><i class="fas fa-caret-right"></i> Todas Categorias</a>
                        </li>
                        <?php
                        $cont = 0;
                        foreach ($pagina['categorias'] as $value) {
                            echo "<li class='nav-item'><a class='nav-link' href='" . site_url("principal/categoria/") . $value['id'] . "'>" . $value['icon'] . " <span>" . $value['valor'] . "</span></a></li>";
                            if ($cont >= 4)
                                break;
                            $cont++;
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
<!--Main Navigation-->

<div class="online-container d-lg-none d-flex justify-content-center">
    <a class="btn btn-outline-danger btn-rounded waves-effect peopleOnline d-flex justify-content-center align-items-center">
        <i class="fas fa-eye mr-2"></i><?php echo $onlineUsers ?>
    </a>
</div>

<!--Bottom Bar-->
<div class="container-fluid bg-main bottom-bar p-0 fixed-bottom z-depth-3 d-lg-none">
    <div class="d-flex justify-content-around align-items-center">
        <div class="text-center">
            <a href="<?php echo $link_home ?>" class="btn-floating z-depth-0 mx-0 d-flex align-items-center justify-content-center <?php if ($pagina['titulo'] == "Home") echo 'active' ?>"><img src="<?php echo base_url('assets/ai/quick-mini-white-min.png') ?>" alt="logo" /><span>home</span></a>
        </div>
        <div class="text-center">
            <a type="button" data-activates="categories" class="btn-floating z-depth-0 mx-0 button-collapse"><i class="fas fa-list-ul"><span>categorias</span></i></a>
        </div>
        <div class="text-center">
            <a href="<?php echo $link_anunciar ?>" type="button" class="btn-floating z-depth-0 mx-0 <?php if ($pagina['titulo'] == "Anunciar") echo 'active' ?>"><i class="fas fa-plus"><span>Anunciar</span></i></a>
        </div>
        <?php if ($logged) : ?>
            <div class="text-center">
                <a type="button" data-activates="profile" class="btn-floating  z-depth-0 mx-0 button-collapse"><i class="far fa-user-circle"><span>Minha Conta</span></i></a>
            </div>
        <?php else : ?>
            <div class="text-center">
                <a href="<?php echo $link_login ?>" type="button" class="btn-floating  z-depth-0 mx-0"><i class="fas fa-sign-in-alt"><span>Entrar</span></i></a>
            </div>
        <?php endif ?>
    </div>
</div>
<!--Bottom Bar-->

<!-- Profile Sidebar -->
<?php if ($logged) : ?>
    <div id="profile" class="side-nav white">
        <ul class="custom-scrollbar">
            <!-- Logo -->
            <li class="userdata" style="background-image: url(<?php echo base_url('assets/img/bg720.jpg') ?>);">
                <img class="z-depth-2 m-0" src="<?php echo $pagina['img_perfil'] ?>" alt="<?php echo base_url('assets/userdata/fotos/perfil/avatar.jpg') ?>" srcset="<?php echo base_url('assets/userdata/fotos/perfil/avatar.jpg') ?>" />
                <h6 class="mt-3 mb-0"><?php echo $userdata->nome ?></h6>
                <span class="font-small"><?php echo $userdata->email ?></span>
            </li>
            <!--/. Logo -->
            <!-- Side navigation links -->
            <li>
                <ul class="collapsible collapsible-accordion mt-0">
                    <span class="font-small text-muted" style="padding-left: 20px;">Definições</span>
                    <li>
                        <a href="<?php echo $link_desejos ?>" class="waves-effect text-muted"><i class="far fa-heart"></i> Desejos</a>
                    </li>
                    <li>
                        <a href="<?php echo $link_meus ?>" class="waves-effect text-muted"><i class="fas fa-list-ul"></i> Meus anúncios</a>
                    </li>
                    <li>
                        <a href="#modalInteresses" class="waves-effect text-muted" data-toggle="modal" data-target="#modalInteresses"><i class="fas fa-folder-open"></i> Meus interesses</a>
                    </li>
                    <li>
                        <a href="<?php echo $link_dados ?>" class="waves-effect text-muted"><i class="fas fa-info-circle"></i> Dados pessoais</a>
                    </li>
                    <li>
                        <a href="<?php echo $link_sair ?>" class="waves-effect text-muted"><i class="fas fa-sign-out-alt"></i> Sair</a>
                    </li>
                </ul>
            </li>
            <!--/. Side navigation links -->
        </ul>
    </div>
<?php endif ?>
<!--/. Profile Sidebar -->

<!-- Categories Sidebar -->
<div id="categories" class="side-nav">
    <ul class="custom-scrollbar">
        <!-- Side navigation links -->
        <li>
            <ul class="collapsible collapsible-accordion">
                <span class="font-small text-muted" style="padding-left: 20px;">Categorias</span>
                <?php
                foreach ($pagina['categorias'] as $value) :
                ?>
                    <li>
                        <a class="collapsible-header waves-effect arrow-r"><?php echo $value['icon'] ?> <?php echo $value['valor'] ?><i class="fas fa-angle-down rotate-icon"></i></a>
                        <div class="collapsible-body">
                            <ul>
                                <?php
                                foreach ($pagina['subcategorias'] as $value2) :
                                    if ($value2['referencia'] == $value['id']) :
                                ?>
                                        <li><a href="<?php echo site_url("principal/subcategoria/") . $value2['id'] ?>" class="waves-effect"><?php echo $value2['icon'] ?> <?php echo $value2['valor'] ?></a></li>
                                <?php
                                    endif;
                                endforeach;
                                ?>
                                <li><a href="<?php echo site_url("principal/categoria/") . $value['id'] ?>" class="waves-effect"><?php echo $value['icon'] ?> Todos</a></li>
                            </ul>
                        </div>
                    </li>
                <?php
                endforeach;
                ?>
                <!-- <li>
              <div class="row">
                <div class="col-sm-6 d-flex justify-content-center p-0">
                  <div class="categorie-card">
                    <div class="icon d-flex justify-content-center align-items-center"><i class="fas fa-bolt m-0"></i></div>
                    <span class="text">Telemóveis</span>
                    <span class="quant">50 artigos</span>
                  </div>
                </div>
              </div>
            </li> -->
            </ul>
        </li>
        <!--/. Side navigation links -->
    </ul>
</div>
<!--/. Categories Sidebar -->

<!-- Main Start -->
<main class="py-2 d-flex align-items-center">
    <div class="container-xl">