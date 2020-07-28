<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserLinks extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('geral');
        $this->load->model('geral_model', 'geral');
    }
    public function index()
    {
        $this->load->view('layout/login');
    }
    public function anunciar()
    {
        if ($this->session->has_userdata('usuario')) :
            $dados_pagina['pagina'] = config_pag('Anunciar produto - Quick Sales');
            $dados_pagina['links'] = ['assets/css/custom/anunciar.css'];
            $scripts['scripts'] = ['assets/js/jquery-ui.min.js', 'assets/js/custom/anunciar.js'];
            $dados_pagina['description'] = 'Anuncie aqui seu produto para venda ou troca.';
            $this->load->view('base/head', $dados_pagina);
            $this->load->view('base/header');
            $this->load->view('layout/anunciar');
            $this->load->view('base/footer', $scripts);
        else :
            redirect('userLinks');
        endif;
    }

    public function editar($id)
    {
        if ($this->session->has_userdata('usuario') || !isset($id)) {
            $dados['pagina'] = config_pag('Anunciar');

            //buscar anuncios com filtro de anunciante
            $anuncio = $this->geral->buscarLinha('anuncio', $id);
            //buscar foto de cada anuncio
            if ($anuncio['id_vendedor'] == $this->session->userdata('usuario')->id) {
                $anuncio['localizacao_anunciante'] = $this->session->userdata('usuario')->localizacao;
                $anuncio['nome_anunciante'] = $this->session->userdata('usuario')->nome;
                $anuncio['foto'] = $this->geral->pesquisaOrder('imagem', array('id_anuncio' => $anuncio['id']), array('campo' => 'prioridade', 'ordem' => 'ASC'));
                $conteudo['anuncio'] = $anuncio;
                $dados['links'] = ['assets/css/custom/anunciar.css'];
                $scripts['scripts'] = ['assets/js/jquery-ui.min.js', 'assets/js/custom/editar.js'];
                $this->load->view('base/head', $dados);
                $this->load->view('base/header');
                $this->load->view('layout/editar', $conteudo);
                $this->load->view('base/footer', $scripts);
            } else {
                redirect('userLinks/meusAnuncios');
            }
        } else {
            redirect('userLinks');
        }
    }

    public function meusAnuncios()
    {
        if ($this->session->has_userdata('usuario')) :
            //buscar anuncios com filtro de anunciante
            $anuncios = $this->geral->pesquisa('anuncio', array('id_vendedor' => $this->session->userdata('usuario')->id));
            //buscar foto de cada anuncio
            $cont = 0;
            foreach ($anuncios as $anuncio) :
                $anuncio['localizacao_anunciante'] = $this->session->userdata('usuario')->localizacao;
                $anuncio['nome_anunciante'] = $this->session->userdata('usuario')->nome;
                $anuncio['foto'] = $this->geral->pesquisa('imagem', array('id_anuncio' => $anuncio['id']));
                $anuncios[$cont] = $anuncio;
                $cont++;
            endforeach;
            $conteudo['anuncios'] = $anuncios;
            //configuracoes da pagina
            $dados_pagina['pagina'] = config_pag('Meus Anuncios');
            $dados_pagina['pagina']['botaoDesejo'] = false;
            $dados_pagina['pagina']['botaoDelete'] = true;
            $dados_pagina['pagina']['botaoEdit'] = false;
            $scripts['scripts'] = ['assets/custom/js/sort.js'];
            $this->load->view('base/head', $dados_pagina);
            $this->load->view('base/header');
            $this->load->view('layout/meusAnuncios', $conteudo);
            $this->load->view('base/footer', $scripts);
        else :
            redirect('userLinks');
        endif;
    }

    public function desejos()
    {
        if ($this->session->has_userdata('usuario')) :
            //buscar anuncios com filtro de anunciante
            $anuncios = $this->geral->linhaJoin('anuncio', 'desejo', 'id', 'id_anuncio', array('tab2.id_usuario' => $this->session->userdata('usuario')->id));
            //buscar foto de cada anuncio
            $cont = 0;

            foreach ($anuncios as $anuncio) :
                $anuncio['localizacao_anunciante'] = $this->session->userdata('usuario')->localizacao;
                $anuncio['nome_anunciante'] = $this->session->userdata('usuario')->nome;
                $anuncio['foto'] = $this->geral->pesquisa('imagem', array('id_anuncio' => $anuncio['id']));
                $anuncios[$cont] = $anuncio;
                $cont++;
            endforeach;

            $conteudo['anuncios'] = $anuncios;

            //configuracoes da pagina
            $dados_pagina['pagina'] = config_pag('Meus Anuncios');
            $dados_pagina['pagina']['botaoDesejo'] = false;
            $dados_pagina['pagina']['botaoDelete'] = true;
            $scripts['scripts'] = ['assets/custom/js/sort.js'];
            $this->load->view('base/head', $dados_pagina);
            $this->load->view('base/header');
            $this->load->view('layout/desejos', $conteudo);
            $this->load->view('base/footer', $scripts);
        else :
            redirect('userLinks');
        endif;
    }

    public function dados_pessoais()
    {
        if ($this->session->has_userdata('usuario')) :
            $usuario = (array) $this->session->userdata('usuario');
            $imgs = $this->geral->linhaJoin('imagem', 'usuario', 'id_usuario', 'id');
            $usuario['foto'] = 'avatar.jpg';
            if (count($imgs) > 0) :
                foreach ($imgs as $img) :
                    if ($img['tipo'] == 'perfil' and $img['id_usuario'] ==  $usuario['id']) {
                        $usuario['foto'] = $img['nome'];
                    }
                endforeach;
            endif;
            //configuracoes da pagina
            $dados_pagina['pagina'] = config_pag('Dados pessoais');
            $dados_pagina['links'] = ['assets/css/custom/dados.css'];
            $scripts['scripts'] = ['assets/js/custom/dados_pessoais.js'];
            $this->load->view('base/head', $dados_pagina);
            $this->load->view('base/header');
            $this->load->view('layout/dados_pessoais', $usuario);
            $this->load->view('base/footer', $scripts);
        else :
            redirect('userLinks');
        endif;
    }

    public function get_subcategorias()
    {
        echo json_encode($this->geral->get_opcoes('filtro', array('nome' => 'subcategoria')));
    }
}
