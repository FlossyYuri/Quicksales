<?php
defined('BASEPATH') or exit('No direct script access allowed');

?>
<!-- Conteudo -->
<?php

if (isset($anuncios)) {
    switch ($tipo_cartao) {
        case "horizontal_half":
            $cont = 0;
            foreach ($anuncios as $anuncio) {
                if ($cont < 12) {
                    $anuncio['pagina'] = $pagina;
                    $this->load->view('objects/card-horizontal-half', $anuncio);
                    $cont++;
                } else {
                    break;
                }
            }
            break;
        case "vertical_complete":
            $cont = 0;
            foreach ($anuncios as $anuncio) {
                if ($cont < 12) {
                    $anuncio['pagina'] = $pagina;
                    $this->load->view('objects/card-vertical-complete', $anuncio);
                    $cont++;
                } else {
                    break;
                }
            }
            break;
    }
} else {
    $this->load->view('layout/empty');
}
?>