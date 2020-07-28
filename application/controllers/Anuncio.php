<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Anuncio extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('geral_model', 'geral');
  }
  public function get()
  {
    //buscar anuncios recentes
    $anuncios_recentes = $this->geral->buscarArray('anuncio', 12);
    //buscar foto de cada anuncio e acrescentar localizacao e nome do anunciante
    $cont = 0;
    foreach ($anuncios_recentes as $anuncio) :
      $anunciante = $this->geral->buscarLinha('usuario', $anuncio['id_vendedor']);
      $anuncio['localizacao_anunciante'] = $anunciante['localizacao'];
      $anuncio['nome_anunciante'] = $anunciante['nome'];
      $anuncio['foto'] = $this->geral->pesquisa('imagem', array('id_anuncio' => $anuncio['id']));
      $anuncios_recentes[$cont] = $anuncio;
      $cont++;
    endforeach;

    echo json_encode($anuncios_recentes, JSON_UNESCAPED_UNICODE);
  }
  public function getById($id)
  {
    //buscar anuncios recentes
    $anuncios_recentes = $this->geral->get_opcoes('anuncio', array("id" => $id))[0];
    //buscar foto de cada anuncio e acrescentar localizacao e nome do anunciante
    $anunciante = $this->geral->buscarLinha('usuario', $anuncios_recentes['id_vendedor']);
    $anuncios_recentes['localizacao_anunciante'] = $anunciante['localizacao'];
    $anuncios_recentes['nome_anunciante'] = $anunciante['nome'];
    $anuncios_recentes['foto'] = $this->geral->pesquisa('imagem', array('id_anuncio' => $anuncios_recentes['id']));


    echo json_encode($anuncios_recentes, JSON_UNESCAPED_UNICODE);
  }

  public function pesquisa($pesquisa)
  {
    $pesquisa = utf8_decode(urldecode($pesquisa));
    //buscar anuncios com filtro de categoria
    $anuncios = $anuncios = $this->geral->pesquisaGeral('titulo', 'anuncio', $pesquisa);
    //buscar foto de cada anuncio e acrescentar localizacao e nome do anunciante
    $cont = 0;
    foreach ($anuncios as $anuncio) :
      $anunciante = $this->geral->buscarLinha('usuario', $anuncio['id_vendedor']);
      $anuncio['localizacao_anunciante'] = $anunciante['localizacao'];
      $anuncio['nome_anunciante'] = $anunciante['nome'];
      $anuncio['foto'] = $this->geral->pesquisa('imagem', array('id_anuncio' => $anuncio['id']));
      $anuncios[$cont] = $anuncio;
      $cont++;
    endforeach;
    echo json_encode($anuncios, JSON_UNESCAPED_UNICODE);
  }
}
