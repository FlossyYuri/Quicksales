<?php

function config_pag($titulo)
{
    $CI = &get_instance();
    $CI->load->model('geral_model', 'geral');
    return array(
        'titulo' => $titulo,
        'imgs'   => base_url('assets/img/'),
        'img_perfil' => base_url('assets/userdata/fotos/perfil/'),
        'categorias' => $CI->geral->get_opcoes('filtro', array('nome' => 'categoria')),
        'subcategorias' => $CI->geral->get_opcoes('filtro', array('nome' => 'subcategoria')),
        'img_anuncio' => base_url('assets/userdata/fotos/anuncio/'),
        'cor_p' => 'red',
        'cor_p_text' => 'red-text text-darken-4',
        'cor_s' => 'red',
        'cor_s_text' => 'red',
        'cor_t' => 'red',
        'cor_t_text' => 'red',
    );
}

function check_file_exists_here($url)
{
    $result = get_headers($url);
    return stripos($result[0], "200 OK") ? true : false; //check if $result[0] has 200 OK
}

function get_user_ip()
{
    $whitelist = array(
        '127.0.0.1',
        '::1'
    );
    if (!in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
        $ip = getenv('HTTP_CLIENT_IP') ? getenv('HTTP_CLIENT_IP') : (getenv('HTTP_X_FORWARDED_FOR') ? getenv('HTTP_X_FORWARDED_FOR') : getenv('REMOTE_ADDR'));
        return $ip;
    } else {
        return '192.162.30.124';
    }
}
