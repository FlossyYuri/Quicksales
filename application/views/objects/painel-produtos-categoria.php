<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Card Panel -->
<section class="card-panel mb-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title text-main mb-4">
                <div class="circle d-inline-block mr-2">
                    <?php echo $icon ?>
                </div>
                <?php echo $titulo_painel ?>
            </h5>
            <div class="row">
                <?php
                switch ($tipo_cartao) {
                    case "horizontal_half":
                        foreach ($anuncios as $anuncio) {
                            $anuncio['pagina'] = $pagina;
                            $this->load->view('objects/card-horizontal-half', $anuncio);
                        }
                        break;
                    case "vertical_complete":
                        foreach ($anuncios as $anuncio) {
                            $anuncio['pagina'] = $pagina;
                            $this->load->view('objects/card-vertical-complete', $anuncio);
                        }
                        break;
                }
                ?>
            </div>
            <?php if (isset($cat_id)) : ?>
                <div class="row">
                    <div class="col-12 see-more">
                        <div class="d-flex justify-content-center">
                            <a href="<?php echo base_url('principal/categoria/' . $cat_id) ?>"><span style="color: var(--main-color)">Ver mais...</span></a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<!-- / Card Panel -->