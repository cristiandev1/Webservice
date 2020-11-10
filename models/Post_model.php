<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Post_model extends CI_Model{
  public function __construct(){
    parent:: __construct();
  }

  //cadastrar postagem
  public function cadastrar($dados){
    $sql = 'INSERT INTO post (id_usuario,id_blog,id_categoria,titulo,assunto,data_postagem,ativo) VALUES(?,?,?,?,?, NOW(), 0)';
    $sql_values = array(
      $this->usuarioglobal->id,
      $this->blogglobal->id,
      $this->categoriaglobal->id,
      $dados['titulo'],
      $dados['assunto'],
    );
    $this->blog->query($sql, $sql_values);
    $rs = $this->blog->affected_rows();
    if($rs>0){return true;}else{return false;}
  }

  //listar postagens
  public function listar(){
    $sql = "SELECT * FROM post WHERE id_blog = ? ORDER BY data_postagem DESC";
    $sql_values = array(
      $this->blogglobal->id,
    );
    $rs = $this->blog->query($sql,$sql_values);
    return issetRegistros($rs);
  }

  public function getPosts(){
    $sql = "SELECT * FROM post ORDER BY data_postagem DESC";
    $rs = $this->blog->query($sql);
    return issetRegistros($rs);
  }
}