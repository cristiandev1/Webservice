<?php defined('BASEPATH') OR exit('No direct script access allowed');


class CategoriaGlobal{

  private $CI;
  public $id;

  public function __construct(){
    $this->CI =& get_instance();
    $this->id = $this->CI->input->post('dados_categoria')['id_categoria'];
  }

}