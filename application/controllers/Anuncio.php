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
    header('Content-Type: application/json');
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
    header('Content-Type: application/json');
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

    header('Content-Type: application/json');
    echo json_encode($anuncios, JSON_UNESCAPED_UNICODE);
  }
  public function post()
  {
    $response['type'] = "ok";
    $response['message'] = "";
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->form_validation->set_rules('titulo', 'Titulo do anuncio', 'required|min_length[5]|max_length[100]|trim');
    $this->form_validation->set_rules('categoria', 'Categoria do anuncio', 'required|max_length[50]|trim');
    $this->form_validation->set_rules('subcategoria', 'Subcategoria do anuncio', 'required|max_length[50]|trim');
    $this->form_validation->set_rules('preco', 'Preço do anuncio', 'required|trim');
    $this->form_validation->set_rules('descricao', 'Descrição do anuncio', 'required|trim|min_length[10]|max_length[5000]');
    $this->form_validation->set_rules('id_vendedor', 'ID do anunciante', 'required|trim');
    $this->form_validation->set_rules('venda', 'Venda', 'required|trim');
    if ($this->form_validation->run() == FALSE) :
      $this->form_validation->set_error_delimiters('|', '|');
      $response['type'] = "validacao";
      $response['message'] = validation_errors();
    else :
      $config = array(
        'upload_path' => './assets/userdata/fotos/anuncio/',
        'allowed_types' => 'jpg|png|jpeg',
        'max-size' => 4096,
        'max-width' => 3000,
        'max-height' => 3000
      );
      $foto['nome'] = [];
      $foto['prioridade'] = [];
      $errors = "";
      $this->load->library('image_lib');
      for ($i = 0; $i < 6; $i++) {
        if (isset($_FILES["imagem$i"]) && strlen($_FILES["imagem$i"]['name']) > 0) {
          $ficheiro = $_FILES["imagem$i"]['name'];
          $file_name = pathinfo($ficheiro, PATHINFO_FILENAME);
          $file_ext = pathinfo($ficheiro, PATHINFO_EXTENSION);
          $this->load->helper('inputs');
          $nomeCompleto = definir_nome_ficheiro($file_name, $file_ext);
          $config['file_name'] = $nomeCompleto;
          array_push($foto['nome'], base_url("assets/userdata/fotos/anuncio/" . $nomeCompleto));
          array_push($foto['prioridade'], $i);
          $this->load->library('upload');
          $this->upload->initialize($config);
          if ($this->upload->do_upload("imagem$i")) :
            // criar thumbnail
            $config2['image_library']  = 'gd2';
            $config2['source_image']   = './assets/userdata/fotos/anuncio/' . $nomeCompleto;
            $config2['new_image'] = './assets/userdata/fotos/thumbs/';
            $config2['thumb_marker'] = false;
            $config2['create_thumb']   = TRUE;
            $config2['maintain_ratio'] = TRUE;
            $config2['width']          = 300;
            $config2['height']         = 300;
            $this->image_lib->clear();
            $this->image_lib->initialize($config2);
            $this->image_lib->resize();
          // Uploaded and resized
          else :
            $errors = $errors . $this->upload->display_errors('|', '|');
          endif;
        }
      }
      if (strlen($errors) > 0) {
        $response['type'] = "foto";
        $response['message'] = $errors;
      } else {
        // cadastrar todos dados
        $this->load->model('usuario_model', 'usuario');
        $id_anuncio = $this->usuario->anunciar($foto);
        $response['type'] = "ok";
        $response['message'] = base_url('principal/produto/') . $id_anuncio;
      }
    endif;
    header('Content-type:application/json');
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
  }
}
