<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuario_model extends CI_Model
{
    // data actual date('Y-m-d H:m:s')

    public function reset()
    {
        //limpa as tabelas
        $this->db->empty_table('usuario');
        $this->db->empty_table('anuncio');
        $this->db->empty_table('desejo');
        // Reinicia o auto incremente
        $this->db->query('ALTER TABLE usuario AUTO_INCREMENT = 1');
        $this->db->query('ALTER TABLE anuncio AUTO_INCREMENT = 1');
        $this->db->query('ALTER TABLE desejo AUTO_INCREMENT = 1');
    }

    public function cadastrar()
    {
        $dados = array(
            'nome' => $this->input->post('nome'),
            'email' => $this->input->post('email'),
            'senha' => $this->input->post('senha'),
            'telefone' => $this->input->post('telefone'),
            'localizacao' => $this->input->post('localizacao'),
            'dataCriacao' => date('Y-m-d H:m:s')
        );
        $this->db->insert('usuario', $dados);
        return $this->db->insert_id();
    }

    public function entrar()
    {
        $resultado = $this->db->from('usuario')
            ->where('email', $this->input->post('email'))
            ->where('senha', $this->input->post('senha'))
            ->get();
        if ($resultado->num_rows() == 0) {
            return false;
        } else {
            $usuario = $resultado->row();
            $this->session->set_userdata('usuario', $usuario);
            return true;
        }
    }

    public function anunciar($fotos)
    {
        if ($this->input->post('venda') == 'troca')
            $troca = 1;
        else
            $troca = 0;
        if ($this->input->post('negociavel') != null)
            $negociavel = 1;
        else
            $negociavel = 0;

        $dados_anuncio = array(
            'titulo' => $this->input->post('titulo'),
            'descricao' => $this->input->post('descricao'),
            'categoria' => $this->input->post('categoria'),
            'subcategoria' => $this->input->post('subcategoria'),
            'preco' => $this->input->post('preco'),
            'negociavel' => $negociavel,
            'troca' => $troca,
            'views' => 0,
            'id_vendedor' => $this->session->userdata('usuario') == null ? $this->input->post('id_vendedor') : $this->session->userdata('usuario')->id,
            'data' => date('Y-m-d H:m:s')
        );
        $this->db->insert('anuncio', $dados_anuncio);
        $id_anuncio = $this->db->insert_id();
        for ($i = 0; $i < count($fotos['nome']); $i++) {
            $dados_foto = array(
                'nome' => $fotos['nome'][$i],
                'tipo' => 'anuncio',
                'prioridade' => $fotos['prioridade'][$i],
                'id_anuncio' => $id_anuncio
            );
            $this->db->insert('imagem', $dados_foto);
        }


        return $id_anuncio;
    }

    public function editar()
    {
        if ($this->input->post('venda') == 'troca')
            $troca = 1;
        else
            $troca = 0;
        if ($this->input->post('negociavel') != null)
            $negociavel = 1;
        else
            $negociavel = 0;

        $dados_anuncio = array(
            'titulo' => $this->input->post('titulo'),
            'descricao' => $this->input->post('descricao'),
            'preco' => $this->input->post('preco'),
            'negociavel' => $negociavel,
            'troca' => $troca,
        );
        $id_anuncio = $this->input->post('id');
        $this->db->where('id', $id_anuncio)->update('anuncio', $dados_anuncio);
        $fotos = json_decode($this->input->post('novaOrdem'));
        for ($i = 0; $i < count($fotos); $i++) {
            $dados_foto = array(
                'prioridade' => $fotos[$i]->prioridade,
            );
            $this->db->where('nome', $fotos[$i]->url)->update('imagem', $dados_foto);
        }

        return $id_anuncio;
    }

    public function adicionarDesejo($id_usuario, $id_anuncio)
    {
        $resultado = $this->db
            ->from('desejo')
            ->where('id_usuario', $id_usuario)
            ->where('id_anuncio', $id_anuncio)
            ->get();
        if ($resultado->num_rows() == 0) :
            $dados_desejo = array(
                'id_usuario' => $id_usuario,
                'id_anuncio' => $id_anuncio,
                'data'       => date('Y-m-d H:m:s')
            );
            $this->db->insert('desejo', $dados_desejo);
            return $this->db->insert_id();
        else :
            return 0;
        endif;
    }
}
