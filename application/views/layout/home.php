<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<?php
// Criar painel com cartoes verticais de anuncios recentes
$dados1['titulo_painel'] = 'Anuncios recentes';
$dados1['anuncios'] = $anuncios_recentes;
$dados1['tipo_cartao'] = 'vertical_complete';
$dados1['icon'] = '<i class="far fa-clock"></i>';
$dados2['cat_id'] = 0;
$dados1['pagina'] = $pagina;
$this->load->view('objects/painel-produtos-categoria', $dados1);

$dados2['titulo_painel'] = 'Artigos Eletrônicos';
$dados2['anuncios'] = $anuncios_computadores;
$dados2['tipo_cartao'] = 'vertical_complete';
$dados2['icon'] = $icon;
$dados2['cat_id'] = $cat_id;
$dados2['pagina'] = $pagina;
$this->load->view('objects/painel-produtos-categoria', $dados2);

// foreach ($paineis as $painel) {
//         $data['titulo_painel'] = $painel['categoria'];
//         $data['anuncios'] = $painel['anuncios'];
//         $data['tipo_cartao'] = 'horizontal_half';
//         $data['icon'] = $painel['icon'];
//         $data['pagina'] = $pagina;
//         $this->load->view('objects/painel-produtos-categoria', $data);
// }

// Criar painel com cartoes horizontais de uma determinada subcategoria
// $dados2['titulo_painel'] = $categoria;
// $dados2['anuncios'] = $anuncios_computadores;
// $dados2['tipo_cartao'] = 'horizontal_half';
// $dados2['icon'] = $icon;
// $dados2['pagina'] = $pagina;
// $this->load->view('objects/painel-produtos-categoria', $dados2);


?>
<!-- Central Modal Small -->
<div class="modal fade" id="modalInteresses" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

        <!-- Change class .modal-sm to change the size of the modal -->
        <div class="modal-dialog modal-lg" role="document">


                <div class="modal-content">
                        <div class="card">
                                <form id="cadastrar-interesses" method="post">
                                        <div class="card-body">
                                                <h5 class="card-title">Escolha as subcategorias que mais lhe interessam.</h5>
                                                <p class="text-muted">Clique em pelo menos uma.</p>

                                                <?php foreach ($pagina['categorias'] as $cat) : ?>
                                                        <div class="header-circle">
                                                                <a data-toggle="collapse" href="#collapse<?php echo $cat['id']  ?>" aria-expanded="false" aria-controls="collapse<?php echo $cat['id']  ?>">
                                                                        <h6 class="mb-0"><?php echo $cat['icon'] . '<span>' . $cat['valor'] . '</span>'  ?> <i class="fas fa-angle-down ml-2"></i></h6>
                                                                </a>
                                                                <div class="collapse mt-2" id="collapse<?php echo $cat['id']  ?>">
                                                                        <div class="categories-container">
                                                                                <?php foreach ($pagina['subcategorias'] as $subcat) :
                                                                                        if ($subcat['referencia'] == $cat['id']) : ?>
                                                                                                <div class="categories-container">
                                                                                                        <div class="category-card">
                                                                                                                <div class="icon-field"><?php echo $subcat['icon']  ?></div>
                                                                                                                <hr class="my-2">
                                                                                                                <div class="category-name"><span><?php echo $subcat['valor']  ?></span></div>
                                                                                                                <input type="hidden" name="sub<?php echo $subcat['id']  ?>" value="<?php echo $subcat['id']  ?>">
                                                                                                        </div>
                                                                                                </div>
                                                                                <?php endif;
                                                                                endforeach; ?>
                                                                        </div>
                                                                </div>
                                                        </div>
                                                <?php endforeach; ?>
                                                <div class="d-flex justify-content-center">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                        <button type="submit" class="btn bg-main waves-effect waves-light text-white">
                                                                Salvar
                                                        </button>
                                                </div>
                                        </div>
                                </form>
                        </div>
                </div>
        </div>
</div>
<!-- Central Modal Small -->