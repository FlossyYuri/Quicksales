<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AjaxRequests extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('usuario_model', 'usuario');
        $this->load->helper('geral');
        $this->load->model('geral_model', 'geral');
    }
    public function index()
    {
        if ($this->input->post('ordenador') != null) :
            $dados = $this->input->post('dados');
            $ordenador = json_decode($this->input->post('ordenador'));
            //buscar anuncios com filtro de categoria
            //$anuncios = $this->geral->pesquisa('anuncio', 'categoria', 'Tecnologia');
            $where['categoria'] = $dados['anuncios'][0]['categoria'];
            $anuncios = $this->geral->pesquisaOrderBy('anuncio', $where, $ordenador);
            //buscar foto de cada anuncio e acrescentar localizacao e nome do anunciante
            $cont = 0;
            foreach ($anuncios as $anuncio) :
                $anunciante = $this->geral->buscarLinha('usuario', $anuncio['id_vendedor']);
                $anuncio['localizacao_anunciante'] = $anunciante['localizacao'];
                $anuncio['nome_anunciante'] = $anunciante['nome'];
                $anuncio['foto'] = $this->geral->pesquisa('imagem', 'id_anuncio', $anuncio['id']);
                $anuncios[$cont] = $anuncio;
                $cont++;
            endforeach;

            $dados['anuncios'] = $anuncios;
            $this->load->view('layout/listagem', $dados);
        endif;
    }

    public function desejos()
    {
        if ($this->input->post('ordenador') != null) :
            $dados = $this->input->post('dados');
            $ordenador = json_decode($this->input->post('ordenador'));
            //buscar anuncios com filtro de anunciante
            $anuncios = $this->geral->linhaJoin('anuncio', 'desejo', 'id', 'id_anuncio', array('tab2.id_usuario' => $this->session->userdata('usuario')->id), $ordenador);
            //buscar foto de cada anuncio
            $cont = 0;

            foreach ($anuncios as $anuncio) :
                $anuncio['localizacao_anunciante'] = $this->session->userdata('usuario')->localizacao;
                $anuncio['nome_anunciante'] = $this->session->userdata('usuario')->nome;
                $anuncio['foto'] = $this->geral->pesquisa('imagem', 'id_anuncio', $anuncio['id']);
                $anuncios[$cont] = $anuncio;
                $cont++;
            endforeach;
            $dados['anuncios'] = $anuncios;
            $this->load->view('layout/listagem', $dados);
        endif;
    }

    public function meusAnuncios()
    {
        if ($this->input->post('ordenador') != null) :
            $dados = $this->input->post('dados');
            $ordenador = json_decode($this->input->post('ordenador'));
            //buscar anuncios com filtro de anunciante
            $where['id_vendedor'] = $this->session->userdata('usuario')->id;
            $anuncios = $this->geral->pesquisaOrderBy('anuncio', $where, $ordenador);
            //buscar foto de cada anuncio
            $cont = 0;
            foreach ($anuncios as $anuncio) :
                $anuncio['localizacao_anunciante'] = $this->session->userdata('usuario')->localizacao;
                $anuncio['nome_anunciante'] = $this->session->userdata('usuario')->nome;
                $anuncio['foto'] = $this->geral->pesquisa('imagem', 'id_anuncio', $anuncio['id']);
                $anuncios[$cont] = $anuncio;
                $cont++;
            endforeach;
            $dados['anuncios'] = $anuncios;
            $this->load->view('layout/listagem', $dados);
        endif;
    }

    public function listar()
    {
        if ($this->input->post() != null) {
            $dados = $this->input->post('dados');
            $this->load->view('layout/listagem', $dados);
        }
    }

    public function categoria($categoria = '13')
    {
        //buscar anuncios com filtro de categoria
        $anuncios = $this->geral->pesquisa('anuncio', 'categoria', $categoria);
        //buscar foto de cada anuncio e acrescentar localizacao e nome do anunciante
        $cont = 0;
        foreach ($anuncios as $anuncio) :
            $anunciante = $this->geral->buscarLinha('usuario', $anuncio['id_vendedor']);
            $anuncio['localizacao_anunciante'] = $anunciante['localizacao'];
            $anuncio['nome_anunciante'] = $anunciante['nome'];
            $anuncio['foto'] = $this->geral->pesquisa('imagem', 'id_anuncio', $anuncio['id']);
            $anuncios[$cont] = $anuncio;
            $cont++;
        endforeach;
        echo json_encode($anuncios);
    }

    public function subcategoria($subcategoria = '9')
    {
        //buscar anuncios com filtro de subcategoria
        $anuncios = $this->geral->pesquisa('anuncio', 'subcategoria', $subcategoria);
        //buscar foto de cada anuncio e acrescentar localizacao e nome do anunciante
        $cont = 0;
        foreach ($anuncios as $anuncio) :
            $anunciante = $this->geral->buscarLinha('usuario', $anuncio['id_vendedor']);
            $anuncio['localizacao_anunciante'] = $anunciante['localizacao'];
            $anuncio['nome_anunciante'] = $anunciante['nome'];
            $anuncio['foto'] = $this->geral->pesquisa('imagem', 'id_anuncio', $anuncio['id']);
            $anuncios[$cont] = $anuncio;
            $cont++;
        endforeach;
        echo json_encode($anuncios);
    }
}
