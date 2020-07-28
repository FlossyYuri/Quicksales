<?php
defined('BASEPATH') or exit('No direct script access allowed');
$dados['anuncios'] = $anuncios;
$dados['tipo_cartao'] = 'horizontal_half';
$dados['pagina'] = $pagina;
$dados['ordem'] = 'recentes';
?>

<script type="text/javascript">
    let data = <?php echo json_encode($dados) ?>;
    const url = "<?php echo site_url(); ?>ajaxRequests/listar";
</script>

<section class="meus-anuncios">
    <h2 class="text-main" style="font-weight: 500;">Meus anúncios</h2>
    <?php
    if (count($anuncios) > 0) :
        $this->load->view('layout/filter_bar', $dados);
    ?>
        <div id="painelListagem" class="row">
            <?php
            $this->load->view('layout/listagem', $dados);
            ?>
        </div>
        <?php
        if (count($anuncios) > 12) :
        ?>
            <div class="row">
                <div class="col-12 see-more">
                    <div class="d-flex justify-content-center">
                        <span style="color: var(--main-color)">Ver mais... <i class="fas fa-arrow-down"></i></span>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php
    else :
        $this->load->view('layout/empty');
    endif;
    ?>
</section>