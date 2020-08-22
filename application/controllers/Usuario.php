<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuario extends CI_Controller
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
        //configuracoes da pagina
        $dados_pagina['pagina'] = config_pag('Home - Bem-vindo a Quick Sales');
        $dados_pagina['description'] = 'Compre ou venda qualquer artigo que voce tenha na sua casa através da nossa plataforma. Comprar e vender nunca foi tão quick.';
        $this->load->view('base/head', $dados_pagina);
        $this->load->view('base/header');
        $this->load->view('layout/login');
        $this->load->view('base/footer');
    }
    public function erros()
    {
        //configuracoes da pagina
        $this->load->view('errors/html/error_php');
    }

    public function cadastrar()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[usuario.email]');
        $this->form_validation->set_rules('senha', 'Senha', 'required|min_length[8]');
        $this->form_validation->set_rules('localizacao', 'Localizacao', 'required');
        $this->form_validation->set_rules('nome', 'Nome do Usuario', 'required|min_length[6]|max_length[50]|trim|is_unique[usuario.nome]');
        $this->form_validation->set_rules('telefone', 'Telefone', 'required|min_length[9]|max_length[13]|trim|is_unique[usuario.telefone]');
        if ($this->form_validation->run() == FALSE) :
            //Erro no cadastro
            $this->form_validation->set_error_delimiters('|', '|');
            echo validation_errors();
        else :
            //cadastrar
            if ($this->usuario->cadastrar() > 0) :
                $this->usuario->entrar();
                echo base_url('principal');

            else :
                echo '|Ocorreu algum erro';
            endif;
        endif;
    }

    public function entrar()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('senha', 'Senha', 'required|min_length[8]');
        if ($this->form_validation->run() == FALSE) :
            //Erro no cadastro
            $this->form_validation->set_error_delimiters('|', '|');
            echo validation_errors();
        else :
            //entrar
            if ($this->usuario->entrar()) :
                echo base_url('principal');
            else :
                echo '|Dados invalidos. Tente novamente!';
            endif;
        endif;
    }

    public function cadastrar_desejo($id_anuncio)
    {
        if ($this->session->has_userdata('usuario')) :
            if ($this->usuario->adicionarDesejo($this->session->userdata('usuario')->id, $id_anuncio) > 0) :
                redirect('userLinks/desejos');
            else :
                // esse anuncio ja faz parte dos seus desejos
                redirect('userLinks/desejos');
            endif;
        else :
            redirect('userLinks');
        endif;
    }

    public function apagar_desejo($id_anuncio)
    {
        if ($this->session->has_userdata('usuario')) :
            $this->geral->delete('desejo', array(
                'id_usuario' => $this->session->userdata('usuario')->id,
                'id_anuncio' => $id_anuncio
            ));
            redirect('userLinks/desejos');
        else :
            redirect('userLinks');
        endif;
    }
    public function apagar_anuncio($id_anuncio)
    {
        if ($this->session->has_userdata('usuario')) :
            $this->geral->delete('anuncio', array(
                'id_vendedor' => $this->session->userdata('usuario')->id,
                'id' => $id_anuncio
            ));
            redirect('userLinks/meusAnuncios');
        else :
            redirect('userLinks');
        endif;
    }

    public function cadastrar_anuncio()
    {
        /*
        sessao - Erro de essao
        validacao - Erros de validacao de campos
        fotos - Erro ao fazer upload
        ok - Correu tudo bem
        */
        $response['type'] = "ok";
        $response['message'] = "";
        if ($this->session->has_userdata('usuario')) :
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('titulo', 'Titulo do anuncio', 'required|min_length[5]|max_length[100]|trim');
            $this->form_validation->set_rules('categoria', 'Categoria do anuncio', 'required|max_length[50]|trim');
            $this->form_validation->set_rules('subcategoria', 'Subcategoria do anuncio', 'required|max_length[50]|trim');
            $this->form_validation->set_rules('preco', 'Preço do anuncio', 'required|trim');
            $this->form_validation->set_rules('descricao', 'Descrição do anuncio', 'required|trim|min_length[10]|max_length[5000]');
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
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        else :
            redirect('userLinks');
        endif;
    }
    public function editar_anuncio()
    {
        $response['type'] = "ok";
        $response['message'] = "";
        if ($this->session->has_userdata('usuario')) :
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('titulo', 'Titulo do anuncio', 'required|min_length[5]|max_length[100]|trim');
            $this->form_validation->set_rules('preco', 'Preço do anuncio', 'required|trim');
            $this->form_validation->set_rules('descricao', 'Descrição do anuncio', 'required|trim|min_length[10]|max_length[5000]');
            if ($this->form_validation->run() == FALSE) :
                $this->form_validation->set_error_delimiters('|', '|');
                $response['type'] = "validacao";
                $response['message'] = validation_errors();
            else :
                $this->load->model('usuario_model', 'usuario');
                $fts = json_decode($this->input->post('novaOrdem'));
                $this->load->helper('geral');
                if ($fts[0]->prioridade == 0) {
                    if (!check_file_exists_here(str_replace('anuncio', 'thumb', $fts[0]->url))) {
                        // criar thumbnail
                        // echo '.' . substr($fts[0]->url, strpos($fts[0]->url, '/assets'));
                        $this->load->library('image_lib');
                        $config2['image_library']  = 'gd2';
                        $config2['source_image']   = '.' . substr($fts[0]->url, strpos($fts[0]->url, '/assets'));
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
                    }
                }
                $id_anuncio = $this->usuario->editar();
                $response['type'] = "ok";
                $response['message'] = base_url('principal/produto/') . $id_anuncio;
            endif;
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        else :
            redirect('userLinks');
        endif;
    }

    public function sair()
    {
        if ($this->session->has_userdata('usuario')) :
            $this->session->unset_userdata('usuario');
        endif;
        redirect('principal');
    }

    public function resetDB()
    {
        $this->load->model('usuario');
        $this->usuario->reset();
        redirect('principal');
    }

    public function atualizar_perfil()
    {
        //fazer upload das imagens
        //definir caracteristicas das imagens para a biblioteca
        $config = array(
            'upload_path' => './assets/userdata/fotos/perfil/',
            'allowed_types' => 'jpg|png|jpeg',
            'max-size' => 4096,
            'max-width' => 5000,
            'max-height' => 5000
        );

        $ficheiro = $_FILES['fotoperfil']['name'];
        $file_name = pathinfo($ficheiro, PATHINFO_FILENAME);
        $file_ext = pathinfo($ficheiro, PATHINFO_EXTENSION);
        $this->load->helper('inputs');
        $nomeCompleto = definir_nome_ficheiro($file_name, $file_ext);
        $config['file_name'] = $nomeCompleto;
        $this->load->library('upload');
        $this->upload->initialize($config);
        if ($this->upload->do_upload('fotoperfil')) :
            //criar thumbnail
            $config['image_library'] = 'gd2';
            $config['source_image'] = './assets/userdata/fotos/Anuncio/' . $nomeCompleto;
            $config['create_thumb'] = TRUE;
            $config['maintain_ratio'] = TRUE;
            $config['width']         = 300;
            $config['height']       = 300;
            $this->load->library('image_lib', $config);

            $this->image_lib->resize();

            $dados_foto = array(
                'nome' => $nomeCompleto,
                'tipo' => 'perfil',
                'prioridade' => 0,
                'id_usuario' => $this->session->userdata('usuario')->id
            );
            $this->db->insert('imagem', $dados_foto);
            $this->load->model('geral_model', 'geral');
            $dados['imagem'] = $nomeCompleto;
            $this->geral->update('usuario', 'id', $this->session->userdata('usuario')->id, $dados);
            $this->geral->update_session();
            echo "Imagem de perfil cadastrada com sucesso";

        else :
            echo $this->upload->display_errors();
        endif;
    }



    public function atualizar_contactos()
    {
        $nome = false;
        $localizacao = false;
        $telefone = false;

        $response['type'] = "ok";
        $response['message'] = "";
        if ($this->input->post('nome') == $this->session->userdata('usuario')->nome)
            $nome = true;

        if ($this->input->post('localizacao') == $this->session->userdata('usuario')->localizacao)
            $localizacao = true;

        if ($this->input->post('telefone') == $this->session->userdata('usuario')->telefone)
            $telefone = true;

        if ($nome and $localizacao and $telefone) :
            $response['type'] = "error";
            $response['message'] = "Nada foi alterado";
        else :

            $this->load->helper('form');
            $this->load->library('form_validation');
            if ($localizacao == false) :
                $this->form_validation->set_rules('localizacao', 'Localizacao', 'min_length[6]|max_length[50]|trim');
            endif;
            if ($nome == false) :
                $this->form_validation->set_rules('nome', 'Nome do Usuario', 'min_length[6]|max_length[50]|trim|is_unique[usuario.nome]');
            endif;
            if ($telefone == false) :
                $this->form_validation->set_rules('telefone', 'Telefone', 'min_length[9]|max_length[13]|trim|is_unique[usuario.telefone]');
            endif;
            if ($this->form_validation->run() == FALSE) :

                $response['type'] = "validation";
                $response['message'] = validation_errors();
            else :
                if ($this->input->post('nome') != $this->session->userdata('usuario')->nome) :
                    $dados_contacto['nome'] = $this->input->post('nome');
                endif;
                if ($this->input->post('localizacao') != $this->session->userdata('usuario')->localizacao) :
                    $dados_contacto['localizacao'] = $this->input->post('localizacao');
                endif;
                if ($this->input->post('telefone') != $this->session->userdata('usuario')->telefone) :
                    $dados_contacto['telefone'] = $this->input->post('telefone');
                endif;
                $this->geral->update('usuario', 'id', $this->session->userdata('usuario')->id, $dados_contacto);
                $this->geral->update_session();

                $response['type'] = "ok";
                $response['message'] = "Alteração feita com sucesso";

            endif;
        endif;
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }

    public function atualizar_senha()
    {

        $response['type'] = "error";
        $response['message'] = '';
        if ($this->geral->campo_por_campo('usuario', 'id', $this->session->userdata('usuario')->id, 'senha')->senha == $this->input->post('senha1')) :
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('senha1', 'Senha Actual', 'required|min_length[8]');
            $this->form_validation->set_rules('senha2', 'Nova Senha', 'required|min_length[8]');
            $this->form_validation->set_rules('senha3', 'Confirme a senha', 'required|min_length[8]|matches[senha2]');
            if ($this->form_validation->run() == FALSE) :
                $response['type'] = "validation";
                $response['message'] = validation_errors();
            else :
                $dados_senha = array(
                    'senha' => $this->input->post('senha2')
                );
                $this->geral->update('usuario', 'id', $this->session->userdata('usuario')->id, $dados_senha);
                $this->geral->update_session();
                $response['type'] = "ok";
                $response['message'] = "Alteração feita com sucesso";
            endif;
        else :
            $response['type'] = "error";
            $response['message'] = "Palavra passe erada!";
        endif;
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }

    public function atualizar_interesses()
    {
        $response['type'] = "error";
        $response['message'] = '';
        if ($this->session->has_userdata('usuario')) :

            $interesses = json_decode($this->input->post('interesses'));
            $this->geral->update_opcao('usuario', $this->session->userdata('usuario')->id, array(
                'interesses' => json_encode($interesses)
            ));
            $this->geral->update_session();
            $response['type'] = "ok";
            $response['message'] = 'Interesses atualizados com sucesso';
        else :
            $response['type'] = "error";
            $response['message'] = 'Não tem autorização para realizar a operação.';
        endif;
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }

    public function get()
    {
        $usuarios = $this->geral->get_opcoes('usuario');
        echo  json_encode($usuarios, JSON_UNESCAPED_UNICODE);
    }
    public function getByID($id)
    {
        $usuario = $this->geral->get_opcoes('usuario', array("id" => $id))[0];
        echo  json_encode($usuario, JSON_UNESCAPED_UNICODE);
    }
    public function salvar()
    {
        $usuarios = $this->geral->get_opcoes('usuario');
        echo  json_encode($usuarios, JSON_UNESCAPED_UNICODE);
    }
    public function atualizar()
    {
        $usuarios = $this->geral->get_opcoes('usuario');
        echo  json_encode($usuarios, JSON_UNESCAPED_UNICODE);
    }
    public function meusAnuncios($id = 0)
    {
        if ($id !== 0) {
            //buscar anuncios com filtro de anunciante
            $usuario = $this->geral->get_opcoes('usuario', array("id" => $id))[0];
            $anuncios = $this->geral->pesquisa('anuncio', array('id_vendedor' => $id));
            //buscar foto de cada anuncio
            $cont = 0;
            foreach ($anuncios as $anuncio) :
                $anuncio['localizacao_anunciante'] = $usuario['localizacao'];
                $anuncio['nome_anunciante'] = $usuario['nome'];
                $anuncio['foto'] = $this->geral->pesquisa('imagem', array('id_anuncio' => $anuncio['id']));
                $anuncios[$cont] = $anuncio;
                $cont++;
            endforeach;
        } else {
            $anuncios = array();
        }
        echo json_encode($anuncios, JSON_UNESCAPED_UNICODE);
    }
    public function meusDesejos($id = 0)
    {
        if ($id !== 0) {
            //buscar anuncios com filtro de anunciante
            $usuario = $this->geral->get_opcoes('usuario', array("id" => $id))[0];
            $anuncios = $this->geral->linhaJoin('anuncio', 'desejo', 'id', 'id_anuncio', array('tab2.id_usuario' => $usuario['id']));
            //buscar foto de cada anuncio
            $cont = 0;

            foreach ($anuncios as $anuncio) :
                $anuncio['localizacao_anunciante'] = $usuario['localizacao'];
                $anuncio['nome_anunciante'] = $usuario['nome'];
                $anuncio['foto'] = $this->geral->pesquisa('imagem', array('id_anuncio' => $anuncio['id']));
                $anuncios[$cont] = $anuncio;
                $cont++;
            endforeach;
        } else {
            $anuncios = array();
        }
        header('Access-Control-Allow-Origin: *');
        header('Content-type:application/json');
        echo json_encode($anuncios, JSON_UNESCAPED_UNICODE);
    }
}
