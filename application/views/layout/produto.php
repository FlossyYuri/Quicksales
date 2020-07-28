<?php
defined('BASEPATH') or exit('No direct script access allowed');
$meses = array(
    '01' => 'Janeiro',
    '02' => 'Fevereiro',
    '03' => 'Março',
    '04' => 'Abril',
    '05' => 'Maio',
    '06' => 'Junho',
    '07' => 'Julho',
    '08' => 'Agosto',
    '09' => 'Setembro',
    '10' => 'Outubro',
    '11' => 'Novembro',
    '12' => 'Dezembro'
);
?>



<div class="row">
    <div class="col-lg-9">
        <section class="produto">
            <div class="images">
                <!--Carousel Wrapper-->
                <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails" data-ride="carousel">
                    <!-- Slides -->
                    <div class="carousel-inner" role="listbox">
                        <?php
                        $active = false;
                        foreach ($produto['foto'] as $value) :
                        ?>

                            <div class="carousel-item d-flex justify-content-center <?php echo !$active ? 'active' : "" ?>">
                                <img src="<?php echo $value['nome'] ?>" alt="First slide" />
                            </div>
                        <?php
                            $active = true;
                        endforeach;
                        $active = false;
                        ?>
                    </div>
                    <!--/.Slides-->
                    <!--Controls-->
                    <a class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    <!--/.Controls-->
                    <ol class="carousel-indicators">
                        <?php
                        $cont_img = 0;
                        foreach ($produto['foto'] as $value) :
                        ?>
                            <li data-target="#carousel-thumb" data-slide-to="<?php echo $cont_img++ ?>" <?php echo !$active ? 'class="active"' : "" ?>>
                                <img src="<?php echo $value['nome'] ?>" />
                            </li>
                        <?php
                            $active = true;
                        endforeach;
                        ?>
                    </ol>
                </div>
                <!--/.Carousel Wrapper-->
            </div>
            <h3 class="h3 text-main d-flex justify-content-between align-items-center">
                <?php echo $produto['titulo'];
                if ($this->session->has_userdata('usuario'))
                    if ($produto['id_vendedor'] == $this->session->userdata('usuario')->id) : ?>
                    <a href="<?php echo base_url('userLinks/editar/') . $produto['id'] ?>" class="btn btn-outline-main waves-effect w-auto py-2 px-4 m-0 d-none d-sm-block"><i class="far fa-user-circle"></i>
                        Editar
                    </a>
                    <a href="<?php echo site_url("userLinks/editar/") . $produto['id']; ?>" class="btn-floating btn-action orange d-block d-sm-none">
                        <i class="fas fa-pen"></i>
                    </a>
                <?php endif; ?>
            </h3>

            <div class="col-sm-12 specs">
                <div class="row dados">
                    <div class="col-sm-12 p-0">
                        <div class="card bg-dark-main text-center white-text">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6 col-md-3 center-align">
                                        <i class="far fa-eye"></i>
                                        <br />
                                        <span><?php echo $produto['views'] ?> Visualizações</span>
                                    </div>
                                    <div class="col-sm-6 col-md-3 center-align">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <br />
                                        <span><?php echo $anunciante['localizacao'] ?></span>
                                    </div>

                                    <div class="col-sm-6 col-md-3 center-align">
                                        <i class="far fa-clock"></i>
                                        <br />
                                        <span><?php
                                                $dataL = strtotime($produto['data']);
                                                $mes = $meses[date('m', $dataL)];
                                                echo  date('d', $dataL) . ' ' . $mes;
                                                ?></span>
                                    </div>
                                    <div class="col-sm-6 col-md-3 center-align">
                                        <i class="fas fa-hashtag"></i>
                                        <br />
                                        <span>ID: <?php echo $produto['id'] ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card my-4 w-100">
                        <div class="card-body">
                            <h1 class="h3 card-title">Descrição</h1>
                            <?php echo $produto['descricao'] ?>
                        </div>
                    </div>
                    <!-- <div class="col-sm-12">
                        <a class="image-popup-vertical-fit" href="http://farm9.staticflickr.com/8241/8589392310_7b6127e243_b.jpg" title="Caption. Can be aligned to any side and contain any HTML.">
                            <img src="http://farm9.staticflickr.com/8241/8589392310_7b6127e243_s.jpg" width="75" height="75">
                        </a>
                        <a class="image-popup-fit-width" href="http://farm9.staticflickr.com/8379/8588290361_ecf8c27021_b.jpg" title="This image fits only horizontally.">
                            <img src="http://farm9.staticflickr.com/8379/8588290361_ecf8c27021_s.jpg" width="75" height="75">
                        </a>
                        <a class="image-popup-no-margins" href="http://farm4.staticflickr.com/3721/9207329484_ba28755ec4_o.jpg">
                            <img src="http://farm4.staticflickr.com/3721/9207329484_ba28755ec4_o.jpg" width="107" height="75">
                        </a>
                    </div> -->
                </div>
            </div>
        </section>
    </div>
    <div class="col-lg-3">
        <aside class="seller-side">
            <div class="card orange accent-4">
                <div class="card-body price">
                    <h5 class="card-title white-text text-center my-1">
                        <?php echo  number_format($produto['preco'], 2, ",", ".") . ' MT' ?>
                    </h5>
                    <?php if ($produto['negociavel']) : ?>
                        <p class="orange-text m-0 w-100">Negociável</p>
                    <?php endif; ?>
                </div>
            </div>
            <!-- Card -->
            <div class="card mt-4" data-toggle="tooltip" data-placement="left" title="Clique para ver detalhes do vendedor">
                <!-- Card image -->
                <div class="view overlay" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    <img class="card-img-top" src="<?php echo $pagina['img_perfil'] . $anunciante['foto'] ?>" alt="Card image cap" />
                    <a href="#!">
                        <div class="mask rgba-white-slight"></div>
                    </a>
                </div>

                <!-- Card content -->

                <!-- Card content -->
                <div class="card-body p-0">
                    <div class="card-button px-2 mt-3">
                        <a class="btn-floating btn-lg orange accent-4 float-right" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-phone"></i></a>
                    </div>
                    <div class="white px-4 pb-4 pt-3-5">
                        <div class="seller-name d-flex mb-1 justify-content-between">
                            <span><?php echo $anunciante['nome'] ?></span>
                        </div>

                        <div class="collapse revealed mb-2" id="collapseExample">
                            <span class="card-title grey-text" style="font-weight: 400; font-size: 18px;">Sobre Anunciante
                            </span>
                            <div class="card white my-3">
                                <div class="p-4 text-center">
                                    <a href="mailto:<?php echo $anunciante['email'] ?>" class="btn bg-main btn-rounded waves-effect w-100 p-2 m-0 mb-2">
                                        <div class="d-flex justify-content-between px-3">
                                            Enviar Email<i class="far fa-envelope right"></i></div>
                                    </a>
                                    <a href="tel:<?php echo $anunciante['telefone'] ?>" class="btn bg-main btn-rounded waves-effect w-100 p-2 m-0 mb-2 ver-contato">
                                        <div class="d-flex justify-content-between px-3">
                                            <span><?php echo $anunciante['telefone'] ?></span><i class="fas fa-phone ml-1"></i></div>
                                    </a>
                                    <span class="blue-grey-text font-small">Ultimo acesso ha 3 dias</span>
                                </div>
                            </div>
                            <div class="card white">
                                <div class="p-4 text-center">
                                    <a class="btn bg-main btn-rounded waves-effect w-100 p-2 m-0 mb-2 white-text" href="<?php echo site_url("principal/anuncios/") . $anunciante['id'] ?>" data-position="bottom" data-tooltip="Ver todos anuncios">
                                        <div class="d-flex justify-content-between px-3">
                                            Ver anuncios
                                            <i class="fas fa-stream right"></i></div>
                                    </a>
                                    <p class="blue-grey-text">
                                        Na QuickSales a 1anos
                                    </p>
                                    <!-- <p class="blue-grey-text">
                                        Ultimo acesso ha 3 dias
                                    </p> -->
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo site_url("principal/anuncios/") . $anunciante['id'] ?>" class="text-main font-small mb-2">Ver todos anuncios</a>
                    </div>
                </div>
            </div>
            <!-- Card -->

            <!-- Dicas -->
            <div class="card dicas mt-4 bg-main">
                <div class="card-body">
                    <div class="accordion" id="accordionExample">
                        <div class="card z-depth-0">
                            <span class="accordion-title mb-1">Dicas de segurança</span>
                            <div class="card-header" id="headingOne">
                                <div class="mb-0 d-flex collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <div class="icon mr-3 d-flex align-items-center">
                                        <i class="fas fa-circle-notch"></i>
                                    </div>
                                    <div class="title">
                                        <span>
                                            Realize transações em locais públicos.
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="card-body">
                                    Para evitar possivel assalto é aconselhavel encontrar
                                    se com o vendedor em locais publicos.
                                </div>
                            </div>
                        </div>
                        <div class="card z-depth-0">
                            <div class="card-header" id="headingTwo">
                                <div class="mb-0 d-flex" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <div class="icon mr-3 d-flex align-items-center">
                                        <i class="fas fa-circle-notch"></i>
                                    </div>
                                    <div class="title">
                                        <span>
                                            Desconfie de preços não realistas.
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    Se reparar um preço absurdamente exagerado (muito
                                    baixo ou elevado) desconfie.
                                </div>
                            </div>
                        </div>
                        <div class="card z-depth-0">
                            <div class="card-header" id="headingThree">
                                <div class="mb-0 d-flex" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <div class="icon mr-3 d-flex align-items-center">
                                        <i class="fas fa-circle-notch"></i>
                                    </div>
                                    <div class="title">
                                        <span>
                                            Evite pagar adiantado mesmo para entrega.
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                <div class="card-body">
                                    Por motivos de segurança nao envie qualquer valor ao
                                    vendedor antes de obter o produto.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Dicas -->

            <!-- Share -->
            <div class="card mt-4 white center-align">
                <div class="card-body">
                    <h5 class="card-title mt-3 text-center orange-text">
                        Opções adicionais
                    </h5>
                    <div class="d-flex justify-content-center">
                        <a class="btn-floating btn-large waves-effect waves-light orange accent-4" href="<?php echo site_url("usuario/cadastrar_desejo/") . $produto['id']  ?>" data-toggle="tooltip" data-placement="bottom" title="Adicionar a lista de desejos"><i class="far fa-heart"></i></a>
                        <a class="btn-floating btn-large waves-effect waves-light orange accent-4" href="<?php echo site_url("principal/anuncios/") . $produto['id_vendedor'] ?>" data-toggle="tooltip" data-placement="bottom" title="Denunciar"><i class="fas fa-bullhorn"></i></a>
                        <a class="btn-floating btn-large waves-effect waves-light orange accent-4" href="" data-toggle="tooltip" data-placement="bottom" title="Copiar link"><i class="far fa-share-square"></i></a>
                    </div>
                </div>
            </div>
            <!-- Share -->
        </aside>
    </div>
</div>