<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * Biblioteca responsável por
 * - Verificações (tk, dados, versao)
 * - Conexão com os BDS
 */

class Init{
  public function __construct(){

    $CI =& get_instance();
    $headers = getallheaders();

    // VERIFICAÇÕES
    $CI->load->library('app/Verificacoes');

    if($CI->verificacoes->ok){

      // CONEXÃO BD
      $CI->load->library('app/Conexaobd');

      // DADOS DO USUARIO
      if(isset($_POST['usuario'])){
        $CI->load->library('app/UsuarioGlobal');
      };

      //DADOS DA CATEGORIA
      if(isset($_POST['dados_categoria'])){
        $CI->load->library('app/CategoriaGlobal');
      };

      //DADOS DO BLOG
      if(isset($_POST['dados_blog'])){
        $CI->load->library('app/BlogGlobal');
      }
    }
  }
}