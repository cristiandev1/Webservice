<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('echoReturn')){
  function echoReturn($dados = null, $texto=''){
    $rs_json = array(
      "status" => "ok",
      "message" => $texto,
      "dados" => $dados
    );
    echo json_encode($rs_json); exit;
  }
}


if(!function_exists('echoError')){
  function echoError($error_code, $texto){
    $rs_json = array(
      "status" => "error",
      "error_code" => $error_code,
      "message" => $texto
    );
    echo json_encode($rs_json); exit;
  }
}







