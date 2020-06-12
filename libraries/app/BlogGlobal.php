<?php defined('BASEPATH') OR exit('No direct script access allowed');
class BlogGlobal{
  private $CI;
  public $id;

  public function __construct(){
    $this->CI =& get_instance();
    $this->id = $this->CI->input->post('dados_blog')['id_blog'];
  }
}