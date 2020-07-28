<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>


<!-- Filtros Sidebar -->
<div id="filters" class="side-nav ">
    <ul class="custom-scrollbar">
        <li><a class="subheader">Filtros</a></li>
        <li>
            <a id="recent" class="waves-effect btn-filtro <?php if ($ordem == 'recentes') echo 'active '; ?>"><i class="far fa-star mr-2"></i> <span>Recentes</span></a>
        </li>
        <li>
            <a id="views" class="waves-effect btn-filtro <?php if ($ordem == 'views') echo 'active'; ?>"><i class="fab fa-hotjar mr-2"></i> <span>Mais vistos</span></a>
        </li>
        <li>
            <a id="preco" class="waves-effect btn-filtro <?php if ($ordem == 'preco') echo 'active'; ?>"><i class="fas fa-sort-numeric-down mr-2"></i> <span>Preço</span></a>
        </li>
    </ul>
</div>
<!--/. Filtros Sidebar -->


<div class="row filter-bar mb-3">
    <div class="col-sm-12 d-flex justify-content-around d-lg-none">
        <a data-activates="filters" class="btn btn-outline-main waves-effect px-4 button-collapse"><span>Filtros</span><i class="fas fa-filter"></i></a>
        <!-- <a class="btn btn-outline-main waves-effect btn-filtro px-4"><span>Listagem</span><i class="fas fa-th-list"></i></a> -->
    </div>

    <div class="col-sm-8 align-items-center d-none d-lg-flex">
        <ul class="list-unstyled d-flex align-items-center">
            <li><span>Ordenar por:</span></li>
            <li>
                <a id="recent" class="btn btn-outline-main waves-effect z-depth-0 btn-filtro <?php if ($ordem == 'recentes') echo 'active '; ?>"><span>Recentes</span><i class="far fa-star"></i></a>
            </li>
            <li>
                <a id="views" class="btn btn-outline-main waves-effect z-depth-0 btn-filtro <?php if ($ordem == 'views') echo 'active'; ?>"><span>Mais vistos</span><i class="fab fa-hotjar"></i></a>
            </li>
            <li>
                <a id="preco" class="btn btn-outline-main waves-effect z-depth-0 btn-filtro <?php if ($ordem == 'preco') echo 'active'; ?>"><span>Preço</span><i class="fas fa-sort-numeric-down"></i></a>
            </li>
            <li>
                <a id="listagem" class="btn btn-outline-main waves-effect z-depth-0 btn-list"><span>Listagem</span><i class="fas fa-th-list"></i></a>
            </li>
        </ul>
    </div>

    <div class="col-sm-4 d-none d-lg-flex">
        <div class="md-form mr-4 my-2">
            <input id="preco-min" type="number" min="0" class="form-control" />
            <label for="preco-min">Min</label>
        </div>
        <div class="md-form my-2">
            <input id="preco-max" type="number" min="0" class="form-control" />
            <label for="preco-max">Max</label>
        </div>
    </div>
</div>