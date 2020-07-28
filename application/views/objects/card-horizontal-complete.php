<?php
defined('BASEPATH') or exit('No direct script access allowed');
$CI = &get_instance();
$CI->load->helper('text');
?>
<div class="col s12">
    <div class="row card horizontal hoverable">
        <div class="card-image col s3">
            <a href="<?php echo site_url("principal/produto/") . $id ?>"><img src="<?php echo str_replace("anuncio", "thumbs", $foto[0]['nome']) ?>"></a>
        </div>
        <div class="card-stacked col s9">
            <div class="card-content">
                <span class="card-title <?php echo $pagina['cor_p_text'] ?>"><?php echo $titulo ?></span>
                <p><?php echo word_limiter($descricao, 50) ?></p>
                <div class="botoes">
                    <?php if (isset($pagina['botaoDelete']) and $pagina['botaoDelete'] == 'true') : ?>
                        <a href="<?php

                                    if ($titulo == "Meus Anuncios")
                                        echo site_url("usuario/apagar_anuncio/") . $id;
                                    else
                                        echo site_url("usuario/apagar_desejo/") . $id;
                                    ?>" class="btn-floating halfway-fab waves-effect waves-light btn-large orange accent-4"><i class="fas fa-trash"></i></a>
                    <?php endif; ?>
                    <?php if (isset($pagina['botaoDesejo']) and $pagina['botaoDesejo'] == 'true') : ?>
                        <a href="<?php echo site_url("usuario/cadastrar_desejo/") . $id ?>" class="btn-floating halfway-fab waves-effect waves-light btn-large orange accent-4"><i class="far fa-heart"></i></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card-action">
                <a href="<?php echo site_url("principal/produto/") . $id ?>" class="<?php echo $pagina['cor_p_text'] ?>"><?php echo number_format($preco, 2, ",", ".") ?> MT</a>
                <span class="localizacao blue-grey-text"><?php echo $localizacao_anunciante ?></span>
                <span class="Vendedor blue-grey-text text-darken-4"><?php echo $nome_anunciante ?></span>
            </div>
        </div>
    </div>
</div>