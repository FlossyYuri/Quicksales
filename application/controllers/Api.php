<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('geral_model', 'geral');
  }
  public function getCategorias()
  {
    $categorias = $this->geral->get_opcoes('filtro', array('nome' => 'categoria'));
    for ($i = 0; $i < count($categorias); $i++) {
      $categorias[$i]['subcategorias'] = $this->geral->get_opcoes('filtro', array('nome' => 'subcategoria', 'referencia' => $categorias[$i]['id']));
    }
    header('Content-type:application/json');
    echo json_encode($categorias, JSON_UNESCAPED_UNICODE);
  }
  public function getCategoria($id)
  {
    $categoria = $this->geral->get_opcoes('filtro', array('nome' => 'categoria', 'id' => $id))[0];
    $categoria['subcategorias'] = $this->geral->get_opcoes('filtro', array('nome' => 'subcategoria', 'referencia' => $id));
    header('Content-type:application/json');
    echo json_encode($categoria, JSON_UNESCAPED_UNICODE);
  }
}
