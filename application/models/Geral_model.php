<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Geral_model extends CI_Model
{
    public function buscarLinha($tabela, $id)
    {
        $resultado = $this->db
            ->from($tabela)
            ->where('id', $id)
            ->get();
        return $resultado->result_array()[0];
    }
    public function linhaJoin($tab1, $tab2, $campo1, $campo2, $where = null, $order = null)
    {
        if ($where != null) :
            $this->db->where($where);
        endif;
        if ($order != null) :
            if ($order[0]->pmin != null and $order[0]->pmin > 0) :
                $this->db->where('preco >=', $order[0]->pmin);
            endif;
            if ($order[0]->pmax != null and $order[0]->pmax > $order[0]->pmin) :
                $this->db->where('preco <=', $order[0]->pmax);
            endif;

            foreach ($order as $ord) :
                $this->db->order_by($ord->campo, $ord->ordem);
            endforeach;
        endif;
        $resultado = $this->db
            ->select('tab1.*')
            ->from($tab1 . ' as tab1')
            ->join($tab2 . ' as tab2', 'tab1.' . $campo1 . ' = tab2.' . $campo2)
            ->get();
        return $resultado->result_array();
    }
    public function pesquisa($tabela, $where, $tamanho = 0)
    {
        if ($tamanho == 0) :
            $resultado = $this->db
                ->where($where)
                ->get($tabela, 20);
            return $resultado->result_array();

        else :
            $resultado = $this->db
                ->where($where)
                ->get($tabela, $tamanho);

            return $resultado->result_array();
        endif;
    }

    public function pesquisaOrder($tabela, $where, $order)
    {
        $this->db->where($where);
        $this->db->order_by($order['campo'], $order['ordem']);
        $resultado = $this->db->get($tabela);
        return $resultado->result_array();
    }

    public function pesquisaOrderBy($tabela, $where, $order)
    {
        $this->db->where($where);
        if ($order[0]->pmin != null and $order[0]->pmin > 0) :
            $this->db->where('preco >=', $order[0]->pmin);
        endif;
        if ($order[0]->pmax != null and $order[0]->pmax > $order[0]->pmin) :
            $this->db->where('preco <=', $order[0]->pmax);
        endif;
        foreach ($order as $ord) :
            $this->db->order_by($ord->campo, $ord->ordem);
        endforeach;
        $resultado = $this->db->get($tabela, 20);
        return $resultado->result_array();
    }
    public function buscarArray($tabela, $count = 8)
    {
        $resultado = $this->db
            ->from($tabela)
            ->order_by('id', 'desc')
            ->limit($count)
            ->get();
        return $resultado->result_array();
    }

    public function update($tabela, $campo, $valor, $dados)
    {
        $this->db->where($campo, $valor)->update($tabela, $dados);
    }

    public function update_session()
    {
        $resultado = $this->db->from('usuario')
            ->where('id', $this->session->userdata('usuario')->id)
            ->get();
        $this->session->unset_userdata('usuario');
        $this->session->set_userdata('usuario', $resultado->row());
    }

    public function campo_por_campo($tabela, $campo1, $criterio, $campo2)
    {
        $resultado = $this->db
            ->select($campo2)
            ->from($tabela)
            ->where($campo1, $criterio)
            ->get();
        return $resultado->row();
    }


    public function get_opcao($tabela, $array, $padrao = NULL)
    {
        $resultado = $this->db->where($array)->get($tabela, 1);
        if ($resultado->num_rows() == 1) :
            return $resultado->row();
        else :
            return $padrao;
        endif;
    }
    public function get_opcoes($tabela, $array = array(), $padrao = NULL)
    {
        $resultado = $this->db->where($array)->get($tabela);
        if ($resultado->num_rows() > 0) :
            return $resultado->result_array();
        else :
            return $padrao;
        endif;
    }

    public function insert_opcao($tabela, $array)
    {
        $resultado = $this->db->where($array)->get($tabela);
        if ($resultado->num_rows() > 0) :
            return 0;
        else :
            //Opcao nao existe, devo criar
            $this->db->insert($tabela, $array);
            return $this->db->insert_id();
        endif;
    }
    public function update_opcao($tabela, $id, $array)
    {
        $this->db->where('id', $id)
            ->update($tabela, $array);
        return $this->db->affected_rows();
    }

    public function count($tabela, $where)
    {
        $this->db->where($where);
        $this->db->from($tabela);
        return $this->db->count_all_results(); // Produces an integer, like 17
    }

    public function create($tabela, $insert)
    {
        $this->db->insert($tabela, $insert);
        return $this->db->insert_id();
    }

    public function pesquisaGeral($select, $tabela, $like)
    {
        $resultado = $this->db->query("
SELECT *
FROM $tabela 
WHERE LOWER($select)
LIKE LOWER('%$like%')");
        return $resultado->result_array();
    }

    public function delete($tabela, $where)
    {
        $this->db->where($where);
        $this->db->delete($tabela);
        return $this->db->affected_rows();
    }
}
