<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('issetPost')){
  // Verifica se POST foi enviado
  function issetPost(){
    $CI =& get_instance();
    return count($CI->input->post())>0;
  }
}

if(!function_exists('issetRegistro')){
  // Verifica se RESULTADO DO BD possui registros e retorna o primeiro
  function issetRegistro($rs){
    if($rs->num_rows()>0){
      return $rs->result()[0];
    }else{
      return null;
    }
  }
}

if(!function_exists('issetRegistros')){
  // Verifica se RESULTADO DO BD possui registros
  function issetRegistros($rs){
    if($rs->num_rows()>0){
      return $rs->result();
    }else{
      return null;
    }
  }
}