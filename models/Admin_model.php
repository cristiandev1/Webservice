<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model{
  public function __construct(){
    parent:: __construct();
  }

  //verifica se existe usuario informado
  public function verificaUsuario($id){
    $sql = 'SELECT * FROM usuario WHERE id_usuario = ?';
    $sql_values = array(
      $id,
    );
    $rs = $this->blog->query($sql,$sql_values);
    return issetRegistro($rs);
  }

  //dados do usuario
  public function dados($id){
    $sql = 'SELECT nome, sobrenome, cidade, email, status FROM usuario WHERE id_usuario = ? ';
    $sql_values = array(
      $id,
    );
    $rs = $this->blog->query($sql,$sql_values);
    return issetRegistro($rs);
  }

  //listar usuarios
  public function listarUsuarios(){
    $sql = "SELECT id_usuario, nome, sobrenome, cidade, email FROM usuario";
    $rs = $this->blog->query($sql);
    return issetRegistros($rs);
  }

  //inativar usuario
  public function inativarUsuario($id){
    $this->blog->set('status',1);
    $this->blog->where('id_usuario',$id);
    $this->blog->update('usuario');
    $rs = $this->blog->affected_rows();
    if($rs>0){return true;}else{return false;}
  }

  //dono blog
  public function dadosBlog(){
    $sql = "SELECT * FROM blog WHERE id_blog = ?";
    $sql_values = array(
      $this->blogglobal->id,
    );
    $rs = $this->blog->query($sql,$sql_values);
    return issetRegistro($rs);
  }
}