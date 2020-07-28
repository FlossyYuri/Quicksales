<?php
defined('BASEPATH') or exit('No direct script access allowed');
$CI = &get_instance();
$CI->load->helper('text');
$img = $foto[0];
foreach ($foto as $f) {
    if ($f['prioridade'] == 0) {
        $img = $f;
        break;
    }
}
$imgUrl = str_replace("anuncio", "thumbs", $img['nome'])
?>

<!-- Card -->
<div class="col-sm-6 col-lg-4 col-xl-3 mb-4 animated fadeIn">
    <div class="card card-vertical z-depth-0">
        <!-- Card image -->
        <div class="view overlay card-image d-flex align-items-center">
            <a class="img-link" href="<?php echo site_url("principal/produto/") . $id ?>">
                <img class="card-img-top h-100" src="<?php echo $imgUrl ?>" alt="Card image cap" />
            </a>
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
        <!-- Card content -->
        <div class="card-body px-4 pt-4 pb-2">
            <!-- Title -->
            <h4 class="card-title truncate mb-1"><?php echo $titulo ?></h4>
            <hr class="my-2" />
            <!-- Text -->
            <p class="card-text truncate-wrap">
                <?php echo word_limiter($descricao, 20) ?>
            </p>
        </div>

        <!-- Card footer -->
        <div class="rounded-bottom rgba-blue-grey-slight px-4 py-2">
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
<!-- Card -->