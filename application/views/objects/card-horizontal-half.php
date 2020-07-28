<?php
defined('BASEPATH') or exit('No direct script access allowed');
$CI = &get_instance();
$CI->load->helper('text');
?>
<div class="col-md-12 col-lg-6 mb-3 animated fadeIn">
    <!-- Horizontal Card -->
    <div class="card h-100">
        <div class="row no-gutters h-100">
            <div class="col-md-5 d-flex justify-content-center align-items-center">
                <a class="h-100" href="<?php echo site_url("principal/produto/") . $id ?>">
                    <img src="<?php
                                $img = $foto[0];
                                foreach ($foto as $f) {
                                    if ($f['prioridade'] == 0) {
                                        $img = $f;
                                        break;
                                    }
                                }
                                echo str_replace("anuncio", "thumbs", $img['nome']) ?>" class="card-img obj-fit-cover h-100" alt="..." /></a>
            </div>
            <div class="col-md-7">
                <div class="card-body pb-2">
                    <h5 class="card-title mb-1 truncate"><?php echo $titulo ?></h5>
                    <p class="card-text truncate-wrap">
                        <?php echo word_limiter($descricao, 25) ?>
                    </p>
                </div>

                <!-- Button -->
                <div class="d-flex justify-content-end">
                    <?php if (isset($pagina['botaoDelete']) and $pagina['botaoDelete'] == 'true') : ?>
                        <a href="<?php echo site_url("userLinks/editar/") . $id; ?>" class="btn-floating btn-action orange">
                            <i class="fas fa-pen"></i>
                        </a>
                        <a href="<?php echo site_url("usuario/apagar_anuncio/") . $id; ?>" class="btn-floating btn-action orange">
                            <i class="fas fa-trash"></i>
                        </a>
                    <?php endif; ?>

                    <?php if ($pagina['botaoDesejo']) : ?>
                        <a href="<?php echo site_url("usuario/cadastrar_desejo/") . $id ?>" class="btn-floating btn-action orange">
                            <i class="far fa-heart"></i>
                        </a>
                    <?php endif; ?>
                </div>
                <hr class="my-0" />
                <!-- Card footer -->
                <div class="py-2 mt-3 px-4">
                    <ul class="list-unstyled">
                        <li class="price-item">
                            <a href="<?php echo site_url("principal/produto/") . $id ?>"><?php echo number_format($preco, 2, ",", ".") ?> MT</a>
                        </li>
                        <li class="location-item">
                            <span class="blue-grey-text"><?php echo $localizacao_anunciante ?></span>
                        </li>
                        <li class="user-item">
                            <span class="black-text"><?php echo $nome_anunciante ?></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>