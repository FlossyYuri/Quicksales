<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Principal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('geral_model', 'geral');
        $this->load->helper('geral');
    }

    public function home()
    {
        redirect("principal");
    }

    public function index()
    {
        // $paineis = [];
        // if ($this->session->has_userdata('usuario')) {
        //     $interreses =  json_decode($this->session->userdata('usuario')->interesses);
        //     if (count($interreses) <= 4) {
        //         foreach ($interreses as $subcat) {
        //             //buscar anuncios com filtro de subcategoria
        //             $listaDeAnuncios = $this->geral->pesquisa('anuncio', array('subcategoria' => $subcat), 8);
        //             if (count($listaDeAnuncios) > 0) {
        //                 $item = $this->geral->get_opcao('filtro', array('id' => $subcat));
        //                 $interrese['categoria'] =  $item->valor;
        //                 $interrese['icon'] =  $item->icon;
        //                 //buscar foto de cada anuncio e acrescentar localizacao e nome do anunciante
        //                 $cont = 0;
        //                 foreach ($listaDeAnuncios as $ad) :
        //                     $anunciante = $this->geral->buscarLinha('usuario', $ad['id_vendedor']);
        //                     $ad['localizacao_anunciante'] = $anunciante['localizacao'];
        //                     $ad['nome_anunciante'] = $anunciante['nome'];
        //                     $ad['foto'] = $this->geral->pesquisa('imagem', array('id_anuncio' => $ad['id']));
        //                     $listaDeAnuncios[$cont] = $ad;
        //                     $cont++;
        //                 endforeach;
        //                 // adicionar á lista de paneis
        //                 $interrese['anuncios'] =  $listaDeAnuncios;
        //                 array_push($paineis, $interrese);
        //             }
        //             // se nao tiver itens nao precisa adicionar
        //         }
        //     } else {
        //         foreach ($interreses as $subcatI => $subcatV) {
        //             if ($this->geral->count('anuncio', array('subcategoria' => $subcatV)) == 0) {
        //                 unset($interreses[$subcatI]);
        //             }
        //         }
        //         if (count($interreses) > 0) {
        //             foreach ($interreses as $subcat) {
        //                 //buscar anuncios com filtro de subcategoria
        //                 $listaDeAnuncios = $this->geral->pesquisa('anuncio', array('subcategoria' => $subcat), 8);
        //                 if (count($listaDeAnuncios) > 0) {
        //                     $item = $this->geral->get_opcao('filtro', array('id' => $subcat));
        //                     $interrese['categoria'] =  $item->valor;
        //                     $interrese['icon'] =  $item->icon;
        //                     //buscar foto de cada anuncio e acrescentar localizacao e nome do anunciante
        //                     $cont = 0;
        //                     foreach ($listaDeAnuncios as $ad) :
        //                         $anunciante = $this->geral->buscarLinha('usuario', $ad['id_vendedor']);
        //                         $ad['localizacao_anunciante'] = $anunciante['localizacao'];
        //                         $ad['nome_anunciante'] = $anunciante['nome'];
        //                         $ad['foto'] = $this->geral->pesquisa('imagem', array('id_anuncio' => $ad['id']));
        //                         $listaDeAnuncios[$cont] = $ad;
        //                         $cont++;
        //                     endforeach;
        //                     // adicionar á lista de paneis
        //                     $interrese['anuncios'] =  $listaDeAnuncios;
        //                     array_push($paineis, $interrese);
        //                 }
        //                 // se nao tiver itens nao precisa adicionar
        //             }
        //         }
        //     }
        // } else {
        //     $interreses =  json_decode($this->geral->get_opcoes('configuracoes', array('opcao' => 'interesses'))[0]['valor']);
        //     foreach ($interreses as $subcatI => $subcatV) {
        //         if ($this->geral->count('anuncio', array('subcategoria' => $subcatV)) == 0) {
        //             unset($interreses[$subcatI]);
        //         }
        //     }
        //     $chosen = [];
        //     $counter = 0;
        //     foreach ($interreses as $in) {
        //         if ($counter < 4)
        //             array_push($chosen, $in);
        //         else
        //             break;
        //         $counter++;
        //     }
        //     sort($chosen);
        //     foreach ($chosen as $subcat) {
        //         //buscar anuncios com filtro de subcategoria
        //         $listaDeAnuncios = $this->geral->pesquisa('anuncio', array('subcategoria' => $subcat), 8);
        //         if (count($listaDeAnuncios) > 0) {
        //             $item = $this->geral->get_opcao('filtro', array('id' => $subcat));
        //             $interrese['categoria'] =  $item->valor;
        //             $interrese['icon'] =  $item->icon;
        //             //buscar foto de cada anuncio e acrescentar localizacao e nome do anunciante
        //             $cont = 0;
        //             foreach ($listaDeAnuncios as $ad) :
        //                 $anunciante = $this->geral->buscarLinha('usuario', $ad['id_vendedor']);
        //                 $ad['localizacao_anunciante'] = $anunciante['localizacao'];
        //                 $ad['nome_anunciante'] = $anunciante['nome'];
        //                 $ad['foto'] = $this->geral->pesquisa('imagem', array('id_anuncio' => $ad['id']));
        //                 $listaDeAnuncios[$cont] = $ad;
        //                 $cont++;
        //             endforeach;
        //             // adicionar á lista de paneis
        //             $interrese['anuncios'] =  $listaDeAnuncios;
        //             array_push($paineis, $interrese);
        //         }
        //         // se nao tiver itens nao precisa adicionar
        //     }
        // }


        //buscar anuncios com filtro de subcategoria
        $categoria = 1;
        $cat = $this->geral->get_opcao('filtro', array('id' => $categoria));
        $conteudo['categoria'] =  $cat->valor;
        $conteudo['cat_id'] =  $cat->id;
        $conteudo['icon'] =  $cat->icon;
        $anuncios_computadores = $this->geral->pesquisa('anuncio', array('categoria' => $categoria), 12);
        //buscar foto de cada anuncio e acrescentar localizacao e nome do anunciante
        $cont = 0;
        foreach ($anuncios_computadores as $anuncio) :
            $anunciante = $this->geral->buscarLinha('usuario', $anuncio['id_vendedor']);
            $anuncio['localizacao_anunciante'] = $anunciante['localizacao'];
            $anuncio['nome_anunciante'] = $anunciante['nome'];
            $anuncio['foto'] = $this->geral->pesquisa('imagem', array('id_anuncio' => $anuncio['id']));
            $anuncios_computadores[$cont] = $anuncio;
            $cont++;
        endforeach;

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

        $conteudo['anuncios_computadores'] = $anuncios_computadores;
        $conteudo['anuncios_recentes'] = $anuncios_recentes;
        // $conteudo['paineis'] = $paineis;

        //configuracoes da pagina
        $dados_pagina['pagina'] = config_pag('Home - Bem-vindo a Quick Sales');
        $dados_pagina['pagina']['botaoDesejo'] = true;
        $dados_pagina['pagina']['botaoDelete'] = false;
        $dados_pagina['description'] = 'Compre ou venda qualquer artigo que voce tenha na sua casa através da nossa plataforma. Comprar e vender nunca foi tão quick.';
        $dados_pagina['base_og'] = true;
        $this->load->view('base/head', $dados_pagina);
        $this->load->view('base/header');
        $this->load->view('layout/home', $conteudo);
        $this->load->view('base/footer');
    }
    public function categoria($categoria = '13')
    {
        //buscar anuncios com filtro de categoria
        if ($categoria == '0') {
            $anuncios = $this->geral->buscarArray('anuncio', 50);
        } else {

            $anuncios = $this->geral->pesquisa('anuncio', array('categoria' => $categoria));
        }
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

        $conteudo['anuncios'] = $anuncios;
        $scripts['scripts'] = ['assets/js/custom/sort.js'];
        //configuracoes da pagina
        $dados_pagina['pagina'] = config_pag($this->geral->get_opcao('filtro', array('id' => 13))->valor . ' - Quick Sales');
        $dados_pagina['pagina']['botaoDesejo'] = true;
        $dados_pagina['pagina']['botaoDelete'] = false;
        $dados_pagina['description'] =  'Encontre itens relacionados à ' . $this->geral->get_opcao('filtro', array('id' => 13))->valor;
        $this->load->view('base/head', $dados_pagina);
        $this->load->view('base/header');
        $this->load->view('layout/categoria', $conteudo);
        $this->load->view('base/footer', $scripts);
    }
    public function subcategoria($subcategoria = '9')
    {
        //buscar anuncios com filtro de subcategoria
        $anuncios = $this->geral->pesquisa('anuncio', array('subcategoria' => $subcategoria));
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

        $conteudo['anuncios'] = $anuncios;
        $scripts['scripts'] = ['assets/js/custom/sort.js'];
        //configuracoes da pagina
        $dados_pagina['pagina'] = config_pag($this->geral->get_opcao('filtro', array('id' => 13))->valor . ' - Quick Sales');
        $dados_pagina['pagina']['botaoDesejo'] = true;
        $dados_pagina['pagina']['botaoDelete'] = false;
        $dados_pagina['description'] =  'Encontre itens relacionados à ' . $this->geral->get_opcao('filtro', array('id' => 13))->valor;
        $this->load->view('base/head', $dados_pagina);
        $this->load->view('base/header');
        $this->load->view('layout/categoria', $conteudo);
        $this->load->view('base/footer', $scripts);
    }
    public function pesquisaView($pesq)
    {
        $pesq = utf8_decode(urldecode($pesq));
        //buscar anuncios com filtro de categoria
        $anuncios = $anuncios = $this->geral->pesquisaGeral('titulo', 'anuncio', $pesq);
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

        $conteudo['anuncios'] = $anuncios;
        $conteudo['pesquisa'] = $pesq;

        $scripts['scripts'] = ['assets/js/custom/js/sort.js'];
        //configuracoes da pagina
        $dados_pagina['pagina'] = config_pag($pesq . ' - Quick Sales');
        $dados_pagina['pagina']['botaoDesejo'] = true;
        $dados_pagina['pagina']['botaoDelete'] = false;
        $dados_pagina['description'] = $pesq;
        $this->load->view('base/head', $dados_pagina);
        $this->load->view('base/header');
        $this->load->view('layout/pesquisa', $conteudo);
        $this->load->view('base/footer', $scripts);
    }
    public function produto($id)
    {
        // Tratamento das views
        $ip = get_user_ip();
        $this->geral->create(
            'movimento',
            array(
                'acao' => 'visualizacao',
                'valor' => 'anuncio',
                'referencia' => $id,
                'id_usuario' => $ip,
                'data' => date('Y-m-d H:m:s')
            )
        );
        $views = $this->geral->count('movimento', array(
            'acao' => 'visualizacao',
            'valor' => 'anuncio',
            'referencia' => $id
        ));
        $this->geral->update_opcao('anuncio', $id, array(
            'views' => $views
        ));

        //buscar produto com este id
        $dados['produto'] = $this->geral->buscarLinha('anuncio', $id);

        $dados['produto']['foto'] = $this->geral->pesquisaOrder('imagem', array('id_anuncio' => $id), array('campo' => 'prioridade', 'ordem' => 'ASC'));
        //buscar anunciante desse produto
        $dados['anunciante'] = $this->geral->buscarLinha('usuario', $dados['produto']['id_vendedor']);

        //buscar imagem de perfil do usuario
        $imgs = $this->geral->linhaJoin('imagem', 'usuario', 'id_usuario', 'id');
        $dados['anunciante']['foto'] = 'avatar.jpg';
        if (count($imgs) > 0) :
            foreach ($imgs as $img) :
                if ($img['tipo'] == 'perfil' and $img['id_usuario'] == $dados['anunciante']['id']) {
                    $dados['anunciante']['foto'] = $img['nome'];
                }
            endforeach;
        endif;

        $dados_pagina['og_img'] = str_replace("anuncio", "thumbs", $this->geral->pesquisa('imagem', array('id_anuncio' => $id, 'prioridade' => 0))[0]['nome']);

        $scripts['scripts'] = ['assets/js/custom/produto.js'];
        //configuracoes da pagina
        $dados_pagina['pagina'] = config_pag($dados['produto']['titulo'] . ' - Quick Sales');
        $dados_pagina['links'] = ['assets/css/custom/produto.css'];
        $dados_pagina['description'] = $dados['produto']['descricao'];
        $dados_pagina['base_og'] = false;
        //carregar as views com os dados
        $this->load->view('base/head', $dados_pagina);
        $this->load->view('base/header');
        $this->load->view('layout/produto', $dados);
        $this->load->view('base/footer', $scripts);
    }

    public function anuncios($id)
    {
        //buscar anuncios com filtro de anunciante
        $anuncios = $this->geral->pesquisa('anuncio', array('id_vendedor' => $id));
        $anunciante = $this->geral->pesquisa('usuario', array('id' => $id))[0];
        //buscar foto de cada anuncio
        $cont = 0;
        foreach ($anuncios as $anuncio) :
            $anuncio['localizacao_anunciante'] = $anunciante['localizacao'];
            $anuncio['nome_anunciante'] = $anunciante['nome'];
            $anuncio['foto'] = $this->geral->pesquisa('imagem', array('id_anuncio' => $anuncio['id']));
            $anuncios[$cont] = $anuncio;
            $cont++;
        endforeach;
        $conteudo['anuncios'] = $anuncios;
        $scripts['scripts'] = ['assets/js/custom/sort.js'];
        //configuracoes da pagina
        $dados_pagina['pagina'] = config_pag('Anuncio do ' . $this->geral->campo_por_campo('usuario', 'id', $id, 'nome')->nome);
        $dados_pagina['pagina']['botaoDesejo'] = true;
        $dados_pagina['pagina']['botaoDelete'] = false;
        $dados_pagina['description'] = 'Anuncios relacionados a: ' . $anunciante['nome'];
        $this->load->view('base/head', $dados_pagina);
        $this->load->view('base/header');
        $this->load->view('layout/meusAnuncios', $conteudo);
        $this->load->view('base/footer', $scripts);
    }

    public function pesquisa($pesq)
    {
        $anuncios = $this->geral->pesquisaGeral('titulo', 'anuncio', $pesq);

        // $anuncios = $this->geral->pesquisaGeral('titulo', 'anuncio', array('titulo' => $pesq));
        echo json_encode($anuncios, JSON_UNESCAPED_UNICODE);
    }

    public function updateFotos()
    {
        $fotos = $this->geral->get_opcoes('imagem', array("tipo" => "anuncio"));
        foreach ($fotos as $foto) {
            if (count($foto['nome']) < 50) {
                $this->geral->update_opcao("imagem", $foto['id'], array("nome" => base_url("assets/userdata/fotos/anuncio/" . $foto['nome'])));
            }
        }
    }

    public function base_url()
    {
        echo base_url();
    }
    public function resetInteresses()
    {
        $this->geral->update('usuario', 'interesses', '', array('interesses' => '[9,12,17,18]'));
        redirect("principal");
    }

    public function corrigirLinks()
    {
        $fotos = $this->geral->get_opcoes('imagem');
        foreach ($fotos as $foto) {
            $this->geral->update_opcao('imagem', $foto['id'], array('nome' => str_replace("projects", "deployed", $foto['nome'])));
        }
    }
}
