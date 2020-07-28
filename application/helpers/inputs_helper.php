<?php
function definir_nome_ficheiro($original,$extensao){
    $chars = "abcdefghijklmnopqrstuvwxyz";
    $sufixo = '';
    for ($i=0; $i < 10; $i++) { 
        $sufixo.=substr($chars,rand(0,strlen($chars)-1),1);
    }
    $original = str_replace(" ", "_", $original);
    $original = str_replace(".", "_", $original);    
    return $original.'_'.$sufixo.'.'.$extensao;
}