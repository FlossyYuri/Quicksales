<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<section class="anunciar">
    <h2 class="text-main" style="font-weight: 500;">Novo Anuncio</h2>
    <p>Introduza os dados do produto</p>
    <form id="anunciar" class="col-sm-12 anunciar" enctype="multipart/form-data" method="post">
        <div class="row">
            <div class="input-field col-sm-12 p-0">
                <div class="md-form orange-input active-orange-input">
                    <input id="titulo_anuncio" type="text" name="titulo" min-length="10" data-length="100" required class="form-control" />
                    <label for="titulo_anuncio">Titulo</label>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 pl-0 pr-sm-0 pr-2">

                <div class="input-field">
                    <select class="icons mdb-select md-form colorful-select dropdown-danger" searchable="Escreva a categoria..." name="categoria">
                        <option value="" disabled selected>Selecione a categoria do produto</option>
                        <?php
                        foreach ($pagina['categorias'] as $option) :
                            echo "<option value='" . $option['id'] . "'>" . $option['valor'] . "</option>";
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 pl-2 pr-0 pl-sm-0">
                <div class="input-field">
                    <select class="icons mdb-select md-form colorful-select dropdown-danger" searchable="Escreva a subcategoria..." name="subcategoria" disabled>
                        <option value="" disabled selected>Selecione a subcategoria do produto</option>

                    </select>
                </div>
            </div>

            <div class="col-sm-12 tab-perfil">
                <div class="row">
                    <div class="input-field col-md-12 col-lg-4 pl-0 pr-sm-0">
                        <div class="md-form orange-input active-orange-input">
                            <input id="price" name="preco" type="number" min="0" required class="form-control validate" />
                            <label for="price">Preço</label>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4 my-2 d-flex justify-content-center align-items-center">
                        <div class="form-check pl-0">
                            <input type="checkbox" class="form-check-input" id="negociavel" name="negociavel" />
                            <label class="form-check-label" for="negociavel">Negociável</label>
                        </div>
                        <!-- Material unchecked -->
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="troca" name="venda" />
                            <label class="form-check-label" for="troca">Troca</label>
                        </div>

                        <!-- Material checked -->
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="venda" value="venda" name="venda" checked />
                            <label class="form-check-label" for="venda">Venda</label>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4 pl-sm-0 pr-0 pl-sm-0">
                        <div class="input-field">
                            <select class="mdb-select md-form colorful-select dropdown-danger">
                                <option value="" disabled>Tipo de Anunciante</option>
                                <option value="2" selected>Particular</option>
                                <option value="3">Empresa</option>
                            </select>
                            <label class="disabled mdb-main-label">Tipo de Anunciante</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="input-field col-sm-12 p-0">
                <!--Material textarea-->
                <div class="md-form mb-4 pink-textarea active-pink-textarea">
                    <textarea id="descricao" required name="descricao" length="5000" data-length="5000" class="md-textarea form-control" rows="3"></textarea>
                    <label for="descricao">Descrição</label>
                </div>
            </div>

            <div class="row col-sm-12 uploads">
                <?php
                for ($k = 0; $k < 4; $k++) {
                ?>
                    <div class="col-sm-6 col-md-4 col-lg-3 uploaded<?php echo $k; ?> d-flex justify-content-center">
                        <input class="d-none imagens" type="file" id="imagem_<?php echo $k; ?>" name="imagem<?php echo $k; ?>" accept="image/*" />
                        <label for="imagem_<?php echo $k; ?>" class="d-flex align-items-center"><img class="img-item" id="imagem_<?php echo $k; ?>-" src="<?php echo base_url("assets/img/add-image.png") ?>" /></label>
                        <span class="indice">-</span>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="col-sm-12 text-center">
                <button id="publicar" type="submit" class="waves-effect waves-light bg-main white-text btn btn-lg">
                    Publicar anuncio
                </button>
            </div>
        </div>
    </form>
</section>