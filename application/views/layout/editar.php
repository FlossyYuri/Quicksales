<?php
defined('BASEPATH') or exit('No direct script access allowed');

$categoria = '';
foreach ($pagina['categorias'] as $cat) {
    if ($anuncio['categoria'] ==  $cat['id']) {
        $categoria = $cat['valor'];
    }
}
$subcategoria = '';
foreach ($pagina['subcategorias'] as $sub) {
    if ($anuncio['subcategoria'] ==  $sub['id']) {
        $subcategoria = $sub['valor'];
    }
}



?>





<section class="anunciar">
    <h2 class="text-main" style="font-weight: 500;">Editar Anuncio</h2>
    <p>Edite o que desejar no seu anuncio</p>
    <form id="editar" class="col-sm-12 anunciar" enctype="multipart/form-data" method="post">
        <div class="row">
            <input type="hidden" value="<?php echo $anuncio['id'] ?>" name="id">
            <div class="input-field col-sm-12 p-0">
                <div class="md-form orange-input active-orange-input">
                    <input id="titulo_anuncio" type="text" name="titulo" min-length="10" data-length="100" value="<?php echo $anuncio['titulo'] ?>" required class="form-control" />
                    <label for="titulo_anuncio">Titulo</label>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 pr-2 pl-0 pr-sm-0">

                <div class="input-field">
                    <select class="icons mdb-select md-form colorful-select dropdown-danger" disabled searchable="Escreva a categoria...">
                        <option value="" disabled selected>Selecione a categoria do produto</option>
                        <option value="<?php echo $anuncio['categoria'] ?>" selected><?php echo $categoria ?></option>

                    </select>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 pl-2 pr-0 pl-sm-0">
                <div class="input-field">
                    <select class="icons mdb-select md-form colorful-select dropdown-danger" searchable="Escreva a subcategoria..." disabled>
                        <option value="" disabled>Selecione a subcategoria do produto</option>
                        <option value="<?php echo $anuncio['subcategoria'] ?>" selected><?php echo $subcategoria ?></option>

                    </select>
                </div>
            </div>

            <div class="col-sm-12 tab-perfil">
                <div class="row">
                    <div class="input-field col-md-12 col-lg-4 pl-0 pr-sm-0">
                        <div class="md-form orange-input active-orange-input">
                            <input id="price" name="preco" type="number" min="0" required value="<?php echo $anuncio['preco'] ?>" class="form-control validate" />
                            <label for="price">Preço</label>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4  my-2 d-flex justify-content-center align-items-center">
                        <div class="form-check pl-0">
                            <input type="checkbox" class="form-check-input" id="negociavel" name="negociavel" <?php if ($anuncio['negociavel']) echo 'checked' ?> />
                            <label class="form-check-label" for="negociavel">Negociável</label>
                        </div>
                        <!-- Material unchecked -->
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="troca" name="venda" <?php if ($anuncio['troca']) echo 'checked' ?> />
                            <label class="form-check-label" for="troca">Troca</label>
                        </div>

                        <!-- Material checked -->
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="venda" value="venda" name="venda" <?php if (!$anuncio['troca']) echo 'checked' ?> />
                            <label class="form-check-label" for="venda">Venda</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="input-field col-sm-12 p-0">
                <!--Material textarea-->
                <div class="md-form mb-4 pink-textarea active-pink-textarea">
                    <textarea id="descricao" required name="descricao" length="5000" data-length="5000" class="md-textarea form-control" rows="3"><?php echo $anuncio['descricao'] ?></textarea>
                    <label for="descricao">Descrição</label>
                </div>
            </div>
            <div class="col-sm-12 p-0">
                <p>Arraste as imagens para ordenar. A imagem de número zero será a miniatura do seu anuncio.</p>
            </div>
            <div class="row col-sm-12 uploads">
                <?php
                for ($k = 0; $k < count($anuncio['foto']); $k++) {
                ?>
                    <div prioridade="<?php echo $k; ?>" class="col-sm-6 col-md-4 col-lg-3 uploaded<?php echo $k; ?> d-flex justify-content-center">
                        <div for="imagem_<?php echo $k; ?>" class="d-flex align-items-center"><img class="img-item" id="imagem_<?php echo $k; ?>-" src="<?php
                                                                                                                                                        if (isset($anuncio['foto'][$k]))
                                                                                                                                                            echo $anuncio['foto'][$k]['nome'];
                                                                                                                                                        else
                                                                                                                                                            echo base_url("assets/img/add-image.png") ?>" /></div>
                        <span class="indice"><?php echo isset($anuncio['foto'][$k]) ? $anuncio['foto'][$k]['prioridade'] : "-"  ?></span>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="col-sm-12 text-center">
                <button id="editar" type="submit" class="waves-effect waves-light bg-main white-text btn btn-lg">
                    Salvar Alterações
                </button>
            </div>
        </div>
    </form>
</section>